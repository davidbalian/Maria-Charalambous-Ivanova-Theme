<?php
/**
 * Registers the Galleries post type.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Post_Type
 */
class MCI_Gallery_Post_Type {

	/**
	 * Register hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register' ) );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'disable_block_editor' ), 10, 2 );
	}

	/**
	 * Register post type mci_gallery.
	 */
	public function register() {
		$labels = array(
			'name'               => __( 'Galleries', 'maria-charalambous-ivanova' ),
			'singular_name'      => __( 'Gallery', 'maria-charalambous-ivanova' ),
			'add_new'            => __( 'Add New', 'maria-charalambous-ivanova' ),
			'add_new_item'       => __( 'Add New Gallery', 'maria-charalambous-ivanova' ),
			'edit_item'          => __( 'Edit Gallery', 'maria-charalambous-ivanova' ),
			'new_item'           => __( 'New Gallery', 'maria-charalambous-ivanova' ),
			'view_item'          => __( 'View Gallery', 'maria-charalambous-ivanova' ),
			'search_items'       => __( 'Search Galleries', 'maria-charalambous-ivanova' ),
			'not_found'          => __( 'No galleries found.', 'maria-charalambous-ivanova' ),
			'not_found_in_trash' => __( 'No galleries found in Trash.', 'maria-charalambous-ivanova' ),
		);

		register_post_type(
			MCI_Gallery_Constants::POST_TYPE,
			array(
				'labels'              => $labels,
				'public'              => false,
				'publicly_queryable'  => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 22,
				'menu_icon'           => 'dashicons-format-gallery',
				'capability_type'     => 'post',
				'map_meta_cap'        => true,
				'hierarchical'        => false,
				'supports'            => array( 'title' ),
				'has_archive'         => false,
				'rewrite'             => false,
				'query_var'           => false,
				'can_export'          => true,
			)
		);
	}

	/**
	 * Use classic editor + custom metabox for image ordering.
	 *
	 * @param bool   $use_block_editor Use block editor.
	 * @param string $post_type        Post type.
	 * @return bool
	 */
	public function disable_block_editor( $use_block_editor, $post_type ) {
		if ( MCI_Gallery_Constants::POST_TYPE === $post_type ) {
			return false;
		}
		return $use_block_editor;
	}
}
