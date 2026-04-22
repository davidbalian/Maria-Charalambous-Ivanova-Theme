<?php
/**
 * One-time seeder for default galleries and placements.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Seeder
 */
class MCI_Gallery_Seeder {

	/**
	 * Init hooks.
	 */
	public function __construct() {
		add_action( 'after_switch_theme', array( $this, 'maybe_seed' ) );
		add_action( 'admin_init', array( $this, 'maybe_seed' ), 5 );
	}

	/**
	 * Run the seed once per SEED_VERSION_NUMBER bump.
	 */
	public function maybe_seed() {
		$current = (int) get_option( MCI_Gallery_Constants::SEED_VERSION, 0 );
		if ( $current >= MCI_Gallery_Constants::SEED_VERSION_NUMBER ) {
			return;
		}
		$this->run();
		update_option( MCI_Gallery_Constants::SEED_VERSION, MCI_Gallery_Constants::SEED_VERSION_NUMBER );
	}

	/**
	 * Create default posts, seed their items, and write placements.
	 */
	public function run() {
		$definitions = MCI_Gallery_Default_Sources::get_definitions();
		$slot_to_id  = array();

		foreach ( $definitions as $slot => $def ) {
			$post_id = $this->get_or_create_post( $def['slug'], $def['title'] );
			if ( ! $post_id ) {
				continue;
			}
			$slot_to_id[ $slot ] = $post_id;

			if ( $this->post_already_has_items( $post_id ) ) {
				continue;
			}
			$items = $this->build_items( $def['source_items'] );
			update_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, wp_json_encode( $items ) );
		}

		$this->write_placements( $slot_to_id );
	}

	/**
	 * Whether the post already has any stored items.
	 *
	 * @param int $post_id Post ID.
	 * @return bool
	 */
	private function post_already_has_items( $post_id ) {
		$existing = get_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, true );
		$decoded  = is_string( $existing ) ? json_decode( $existing, true ) : array();
		return is_array( $decoded ) && ! empty( $decoded );
	}

	/**
	 * Merge default placements without overwriting a user's manual choice.
	 *
	 * @param array<string, int> $slot_to_id Map of slot => post ID.
	 */
	private function write_placements( $slot_to_id ) {
		$placements = get_option( MCI_Gallery_Constants::PLACEMENTS, array() );
		if ( ! is_array( $placements ) ) {
			$placements = array();
		}
		foreach ( MCI_Gallery_Repository::get_slot_keys() as $slot ) {
			if ( empty( $placements[ $slot ] ) && ! empty( $slot_to_id[ $slot ] ) ) {
				$placements[ $slot ] = (int) $slot_to_id[ $slot ];
			}
		}
		update_option( MCI_Gallery_Constants::PLACEMENTS, $placements );
	}

	/**
	 * Find a gallery by slug or create it. Republishes if it was trashed.
	 *
	 * @param string $slug  Post name (slug).
	 * @param string $title Post title.
	 * @return int
	 */
	private function get_or_create_post( $slug, $title ) {
		$found = get_posts(
			array(
				'post_type'      => MCI_Gallery_Constants::POST_TYPE,
				'name'           => $slug,
				'post_status'    => 'any',
				'posts_per_page' => 1,
			)
		);
		if ( ! empty( $found ) ) {
			$p = $found[0];
			if ( 'publish' !== $p->post_status ) {
				wp_update_post(
					array(
						'ID'          => $p->ID,
						'post_status' => 'publish',
					)
				);
			}
			return (int) $p->ID;
		}
		$pid = wp_insert_post(
			array(
				'post_type'   => MCI_Gallery_Constants::POST_TYPE,
				'post_status' => 'publish',
				'post_title'  => $title,
				'post_name'   => $slug,
			),
			true
		);
		return is_wp_error( $pid ) ? 0 : (int) $pid;
	}

	/**
	 * Build stored items from {url, alt} sources, resolving attachment IDs
	 * when the URL maps to an existing media library file.
	 *
	 * @param array<int, array{url:string, alt:string}> $sources Source rows.
	 * @return array<int, array{id:int, url:string, alt:string}>
	 */
	private function build_items( $sources ) {
		$out = array();
		foreach ( $sources as $row ) {
			if ( empty( $row['url'] ) ) {
				continue;
			}
			$url  = (string) $row['url'];
			$alt  = isset( $row['alt'] ) ? (string) $row['alt'] : '';
			$norm = MCI_Gallery_Repository::normalize_url( $url );
			$try  = $norm ? $norm : esc_url_raw( $url );
			$id   = $try ? (int) attachment_url_to_postid( $try ) : 0;
			if ( ! $id && $url !== $try ) {
				$id = (int) attachment_url_to_postid( esc_url_raw( $url ) );
			}
			$out[] = array(
				'id'  => $id,
				'url' => $id ? '' : ( $try ? $try : esc_url_raw( $url ) ),
				'alt' => $alt,
			);
		}
		return MCI_Gallery_Meta::sanitize_items_array( $out );
	}
}
