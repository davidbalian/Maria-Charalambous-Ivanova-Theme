<?php
/**
 * Custom admin list-table columns for the Galleries post type.
 *
 * Adds a Location column and an Image count column so the list screen is
 * useful at a glance.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Admin_Columns
 */
final class MCI_Galleries_Admin_Columns {

	const COLUMN_LOCATION = 'mci_gallery_location';
	const COLUMN_IMAGES   = 'mci_gallery_images';

	/**
	 * Hook registration.
	 */
	public function register() {
		$cpt = MCI_Galleries_Constants::POST_TYPE;
		add_filter( "manage_{$cpt}_posts_columns", array( $this, 'register_columns' ) );
		add_action( "manage_{$cpt}_posts_custom_column", array( $this, 'render_column' ), 10, 2 );
	}

	/**
	 * Inject new columns after Title.
	 *
	 * @param array<string, string> $columns Existing columns.
	 * @return array<string, string>
	 */
	public function register_columns( $columns ) {
		$new = array();
		foreach ( $columns as $key => $label ) {
			$new[ $key ] = $label;
			if ( 'title' === $key ) {
				$new[ self::COLUMN_LOCATION ] = __( 'Location', 'maria-charalambous-ivanova' );
				$new[ self::COLUMN_IMAGES ]   = __( 'Images', 'maria-charalambous-ivanova' );
			}
		}
		return $new;
	}

	/**
	 * Render a custom column cell.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Current row post ID.
	 */
	public function render_column( $column, $post_id ) {
		if ( self::COLUMN_LOCATION === $column ) {
			$slug  = (string) get_post_meta( $post_id, MCI_Galleries_Constants::META_LOCATION, true );
			$label = MCI_Galleries_Locations::label( $slug );
			echo '' !== $label
				? esc_html( $label )
				: '<span style="color:#a7aaad">' . esc_html__( '— None —', 'maria-charalambous-ivanova' ) . '</span>';
			return;
		}

		if ( self::COLUMN_IMAGES === $column ) {
			echo esc_html( (string) MCI_Galleries_Repository::count_items( $post_id ) );
		}
	}
}
