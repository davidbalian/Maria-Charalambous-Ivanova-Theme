<?php
/**
 * Seeds the four default gallery posts on first run.
 *
 * Tracks completion via an option so we never re-create posts the admin may
 * have intentionally deleted.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Seeder
 */
final class MCI_Galleries_Seeder {

	/**
	 * Hook registration.
	 */
	public function register() {
		add_action( 'admin_init', array( $this, 'maybe_seed' ) );
	}

	/**
	 * Run the seeder if it has not run before.
	 */
	public function maybe_seed() {
		if ( get_option( MCI_Galleries_Constants::SEED_OPTION ) ) {
			return;
		}

		foreach ( MCI_Galleries_Default_Data::definitions() as $location_slug => $definition ) {
			$this->create_gallery_post( $location_slug, $definition );
		}

		update_option( MCI_Galleries_Constants::SEED_OPTION, time(), false );
	}

	/**
	 * Insert a gallery post and attach its location + URL-based image items.
	 *
	 * @param string                                                                $location_slug Location slug.
	 * @param array{title:string, items:array<int, array<string, string>>}          $definition    Default data.
	 * @return int Post ID or 0 on failure.
	 */
	private function create_gallery_post( $location_slug, $definition ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => MCI_Galleries_Constants::POST_TYPE,
				'post_status' => 'publish',
				'post_title'  => $definition['title'],
			),
			true
		);

		if ( is_wp_error( $post_id ) || 0 === (int) $post_id ) {
			return 0;
		}

		update_post_meta( $post_id, MCI_Galleries_Constants::META_LOCATION, $location_slug );
		update_post_meta( $post_id, MCI_Galleries_Constants::META_IMAGES, $this->to_url_items( $definition['items'] ) );
		update_post_meta( $post_id, MCI_Galleries_Constants::SEED_MARK_META, 1 );

		return (int) $post_id;
	}

	/**
	 * Wrap raw {url, alt} rows in the stored-item shape expected by the repo.
	 *
	 * @param array<int, array<string, string>> $rows Raw rows.
	 * @return array<int, array<string, string>>
	 */
	private function to_url_items( array $rows ) {
		$out = array();
		foreach ( $rows as $row ) {
			if ( empty( $row['url'] ) ) {
				continue;
			}
			$out[] = array(
				'kind' => MCI_Galleries_Image::KIND_URL,
				'url'  => $row['url'],
				'alt'  => isset( $row['alt'] ) ? (string) $row['alt'] : '',
			);
		}
		return $out;
	}
}
