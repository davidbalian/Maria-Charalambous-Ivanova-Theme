<?php
/**
 * Seeds the default gallery posts on first run.
 *
 * Uses per-location idempotency: each location is seeded at most once, tracked
 * via an option. If the legacy global flag is already set, the original four
 * locations are marked as seeded without re-creating their posts.
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

	const SEEDED_LOCATIONS_OPTION = 'mci_galleries_seeded_locations_v1';

	/**
	 * Hook registration.
	 */
	public function register() {
		add_action( 'admin_init', array( $this, 'maybe_seed' ) );
	}

	/**
	 * Seed any unseeded gallery locations.
	 */
	public function maybe_seed() {
		$seeded = (array) get_option( self::SEEDED_LOCATIONS_OPTION, array() );

		// Migration: treat the original four locations as already seeded on sites
		// where the legacy global flag is set, so their posts aren't recreated.
		if ( get_option( MCI_Galleries_Constants::SEED_OPTION ) && empty( $seeded ) ) {
			$seeded = array(
				MCI_Galleries_Locations::HOME_BEFORE_AFTER,
				MCI_Galleries_Locations::HOME_CLINIC,
				MCI_Galleries_Locations::PAGE_BEFORE_AFTER,
				MCI_Galleries_Locations::PAGE_CLINIC,
			);
		}

		foreach ( MCI_Galleries_Default_Data::definitions() as $location_slug => $definition ) {
			if ( in_array( $location_slug, $seeded, true ) ) {
				continue;
			}
			if ( $this->location_has_post( $location_slug ) ) {
				$seeded[] = $location_slug;
				continue;
			}
			if ( $this->create_gallery_post( $location_slug, $definition ) > 0 ) {
				$seeded[] = $location_slug;
			}
		}

		update_option( self::SEEDED_LOCATIONS_OPTION, array_values( array_unique( $seeded ) ), false );
	}

	/**
	 * Whether any gallery post (any non-trash status) already claims this location.
	 *
	 * @param string $location_slug Location slug.
	 * @return bool
	 */
	private function location_has_post( $location_slug ) {
		$query = new WP_Query(
			array(
				'post_type'              => MCI_Galleries_Constants::POST_TYPE,
				'post_status'            => 'any',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
				'fields'                 => 'ids',
				'meta_query'             => array(
					array(
						'key'   => MCI_Galleries_Constants::META_LOCATION,
						'value' => $location_slug,
					),
				),
			)
		);

		return ! empty( $query->posts );
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
