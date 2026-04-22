<?php
/**
 * Enqueues admin-side assets for the Galleries metabox.
 *
 * Loads wp.media, the admin JS/CSS, and the localised strings only on the
 * gallery edit screens.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Admin_Assets
 */
final class MCI_Galleries_Admin_Assets {

	/**
	 * Hook registration.
	 */
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue admin assets on the gallery edit screen.
	 *
	 * @param string $hook_suffix Current admin page.
	 */
	public function enqueue( $hook_suffix ) {
		if ( ! $this->is_gallery_screen( $hook_suffix ) ) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_style(
			MCI_Galleries_Constants::ADMIN_HANDLE_CSS,
			get_template_directory_uri() . '/assets/css/admin-mci-galleries.css',
			array(),
			MCI_THEME_VERSION
		);

		wp_enqueue_script(
			MCI_Galleries_Constants::ADMIN_HANDLE_JS,
			get_template_directory_uri() . '/assets/js/admin-mci-galleries.js',
			array( 'jquery', 'jquery-ui-sortable' ),
			MCI_THEME_VERSION,
			true
		);

		wp_localize_script(
			MCI_Galleries_Constants::ADMIN_HANDLE_JS,
			'mciGalleries',
			array(
				'modalTitle'  => __( 'Select images for this gallery', 'maria-charalambous-ivanova' ),
				'modalButton' => __( 'Add to gallery', 'maria-charalambous-ivanova' ),
				'urlLabel'    => __( 'URL', 'maria-charalambous-ivanova' ),
				'removeLabel' => __( 'Remove image', 'maria-charalambous-ivanova' ),
			)
		);
	}

	/**
	 * Whether the current admin screen is the galleries edit screen.
	 *
	 * @param string $hook_suffix Current admin page.
	 * @return bool
	 */
	private function is_gallery_screen( $hook_suffix ) {
		if ( ! in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true ) ) {
			return false;
		}
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		return $screen && MCI_Galleries_Constants::POST_TYPE === $screen->post_type;
	}
}
