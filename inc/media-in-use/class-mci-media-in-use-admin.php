<?php
/**
 * Wires the media library UI hooks for the "in use" indicator.
 *
 * Covers:
 *   - Grid view + media modal: wp_prepare_attachment_for_js injects mciInUse
 *     into each attachment's JS data object, consumed by the Backbone view.
 *   - List view: a custom "Used" column with a green dot and an inline script
 *     that stamps data-mci-in-use="1" on the table row.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MCI_Media_In_Use_Admin {

	private MCI_Media_In_Use_Detector $detector;

	public function __construct( MCI_Media_In_Use_Detector $detector ) {
		$this->detector = $detector;
	}

	public function register(): void {
		add_filter( 'wp_prepare_attachment_for_js', array( $this, 'inject_in_use' ) );
		add_filter( 'manage_media_columns', array( $this, 'add_column' ) );
		add_action( 'manage_media_custom_column', array( $this, 'render_column' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Inject mciInUse boolean into each attachment's JS payload.
	 * This feeds grid tiles, the modal picker sidebar, and the attachment details pane.
	 */
	public function inject_in_use( array $response ): array {
		$id                  = isset( $response['id'] ) ? (int) $response['id'] : 0;
		$response['mciInUse'] = $id > 0 && $this->detector->is_in_use( $id );
		return $response;
	}

	/** Add "Used" column to the media list table. */
	public function add_column( array $columns ): array {
		$columns['mci_in_use'] = __( 'Used', 'maria-charalambous-ivanova' );
		return $columns;
	}

	/**
	 * Render the "Used" column cell.
	 *
	 * Also emits a tiny inline script that stamps data-mci-in-use="1" on the
	 * parent <tr id="post-{ID}"> — WP's media list table offers no row-class
	 * filter, so this is the simplest approach that avoids over-engineering.
	 */
	public function render_column( string $column_name, int $post_id ): void {
		if ( 'mci_in_use' !== $column_name ) {
			return;
		}

		if ( ! $this->detector->is_in_use( $post_id ) ) {
			return;
		}

		echo '<span class="mci-in-use-dot" aria-label="' . esc_attr__( 'In use', 'maria-charalambous-ivanova' ) . '" title="' . esc_attr__( 'In use', 'maria-charalambous-ivanova' ) . '"></span>';
		echo '<script>document.getElementById("post-' . (int) $post_id . '").setAttribute("data-mci-in-use","1");</script>';
	}

	public function enqueue( string $hook_suffix ): void {
		$screens = array( 'upload.php', 'post.php', 'post-new.php' );

		if ( ! in_array( $hook_suffix, $screens, true ) ) {
			return;
		}

		wp_enqueue_style(
			MCI_Media_In_Use_Constants::ADMIN_HANDLE_CSS,
			get_template_directory_uri() . '/assets/css/admin-media-in-use.css',
			array(),
			MCI_THEME_VERSION
		);

		wp_enqueue_script(
			MCI_Media_In_Use_Constants::ADMIN_HANDLE_JS,
			get_template_directory_uri() . '/assets/js/admin-media-in-use.js',
			array( 'jquery', 'wp-media-views' ),
			MCI_THEME_VERSION,
			true
		);
	}
}
