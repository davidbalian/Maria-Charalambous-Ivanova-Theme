<?php
/**
 * Registers the Galleries custom post type.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Post_Type
 */
final class MCI_Galleries_Post_Type {

	/**
	 * Hook registration into WordPress.
	 */
	public function register() {
		add_action( 'init', array( $this, 'register_post_type' ) );
	}

	/**
	 * Register the `mci_gallery` post type.
	 */
	public function register_post_type() {
		$labels = array(
			'name'               => __( 'Galleries', 'maria-charalambous-ivanova' ),
			'singular_name'      => __( 'Gallery', 'maria-charalambous-ivanova' ),
			'menu_name'          => __( 'Galleries', 'maria-charalambous-ivanova' ),
			'add_new'            => __( 'Add New', 'maria-charalambous-ivanova' ),
			'add_new_item'       => __( 'Add New Gallery', 'maria-charalambous-ivanova' ),
			'edit_item'          => __( 'Edit Gallery', 'maria-charalambous-ivanova' ),
			'new_item'           => __( 'New Gallery', 'maria-charalambous-ivanova' ),
			'view_item'          => __( 'View Gallery', 'maria-charalambous-ivanova' ),
			'search_items'       => __( 'Search Galleries', 'maria-charalambous-ivanova' ),
			'not_found'          => __( 'No galleries found.', 'maria-charalambous-ivanova' ),
			'not_found_in_trash' => __( 'No galleries found in Trash.', 'maria-charalambous-ivanova' ),
			'all_items'          => __( 'All Galleries', 'maria-charalambous-ivanova' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'show_in_rest'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
			'menu_position'       => 22,
			'menu_icon'           => 'dashicons-format-gallery',
			'supports'            => array( 'title' ),
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
		);

		register_post_type( MCI_Galleries_Constants::POST_TYPE, $args );
	}
}
