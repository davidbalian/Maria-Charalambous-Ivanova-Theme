<?php
/**
 * Ensures a Galleries CPT post exists for the Smilers companion slot.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Smilers_Dual_Slot_Bootstrap
 */
final class MCI_Galleries_Smilers_Dual_Slot_Bootstrap {

	/**
	 * Hook registration.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'admin_init', array( $this, 'maybe_create_slot' ), 25 );
	}

	/**
	 * Insert an empty published gallery post when none exists for smilers_dual.
	 *
	 * @return void
	 */
	public function maybe_create_slot() {
		if ( self::exists_for_location() ) {
			return;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => MCI_Galleries_Constants::POST_TYPE,
				'post_status' => 'publish',
				'post_title'  => __( 'Smilers row — companion images', 'maria-charalambous-ivanova' ),
			),
			true
		);

		if ( is_wp_error( $post_id ) || (int) $post_id <= 0 ) {
			return;
		}

		update_post_meta( $post_id, MCI_Galleries_Constants::META_LOCATION, MCI_Galleries_Locations::SMILERS_DUAL );
		update_post_meta( $post_id, MCI_Galleries_Constants::META_IMAGES, array() );
	}

	/**
	 * Whether any gallery post already claims this location.
	 *
	 * @return bool
	 */
	private static function exists_for_location() {
		$query = new WP_Query(
			array(
				'post_type'              => MCI_Galleries_Constants::POST_TYPE,
				'post_status'            => 'any',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_term_meta_cache' => false,
				'fields'                 => 'ids',
				'meta_query'             => array(
					array(
						'key'   => MCI_Galleries_Constants::META_LOCATION,
						'value' => MCI_Galleries_Locations::SMILERS_DUAL,
					),
				),
			)
		);

		return ! empty( $query->posts );
	}
}
