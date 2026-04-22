<?php
/**
 * Admin metabox: ordered gallery images on the CPT edit screen.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Admin_Metabox
 */
class MCI_Gallery_Admin_Metabox {

	/**
	 * Init hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post_' . MCI_Gallery_Constants::POST_TYPE, array( $this, 'save' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Register the metabox.
	 */
	public function add_metabox() {
		add_meta_box(
			'mci_gallery_items_box',
			__( 'Gallery images', 'maria-charalambous-ivanova' ),
			array( $this, 'render' ),
			MCI_Gallery_Constants::POST_TYPE,
			'normal',
			'high'
		);
	}

	/**
	 * Enqueue wp.media + our admin JS on the gallery edit screen only.
	 *
	 * @param string $hook Current admin page hook.
	 */
	public function enqueue( $hook ) {
		if ( ! $this->is_gallery_edit_screen( $hook ) ) {
			return;
		}
		wp_enqueue_media();
		$path = get_template_directory() . '/assets/js/admin-mci-gallery.js';
		$ver  = file_exists( $path ) ? filemtime( $path ) : MCI_THEME_VERSION;
		wp_enqueue_script(
			'mci-admin-gallery',
			get_template_directory_uri() . '/assets/js/admin-mci-gallery.js',
			array( 'jquery', 'media-editor' ),
			$ver,
			true
		);
		$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : 0;
		wp_localize_script(
			'mci-admin-gallery',
			'mciAdminGallery',
			array(
				'thumbs'      => $post_id ? $this->get_thumbnail_map_for_post( $post_id ) : array(),
				'placeholder' => 'data:image/svg+xml,' . rawurlencode( '<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"><rect width="100%" height="100%" fill="#e5e5e5"/></svg>' ),
				'addTitle'    => __( 'Select images', 'maria-charalambous-ivanova' ),
				'strings'     => array(
					'moveUp'   => __( 'Move up', 'maria-charalambous-ivanova' ),
					'moveDown' => __( 'Move down', 'maria-charalambous-ivanova' ),
					'remove'   => __( 'Remove', 'maria-charalambous-ivanova' ),
					'altPh'    => __( 'Alt text', 'maria-charalambous-ivanova' ),
				),
			)
		);
	}

	/**
	 * Determine whether the current admin screen is our gallery editor.
	 *
	 * @param string $hook Hook suffix.
	 * @return bool
	 */
	private function is_gallery_edit_screen( $hook ) {
		if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return false;
		}
		if ( 'post-new.php' === $hook && isset( $_GET['post_type'] ) && MCI_Gallery_Constants::POST_TYPE === $_GET['post_type'] ) {
			return true;
		}
		if ( 'post.php' === $hook && isset( $_GET['post'] ) ) {
			$p = get_post( (int) $_GET['post'] );
			if ( $p && MCI_Gallery_Constants::POST_TYPE === $p->post_type ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * id => thumbnail URL map so the admin UI can render stored items.
	 *
	 * @param int $post_id Post ID.
	 * @return array<string, string>
	 */
	private function get_thumbnail_map_for_post( $post_id ) {
		$raw = get_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, true );
		if ( ! is_string( $raw ) || '' === $raw ) {
			return array();
		}
		$items = json_decode( $raw, true );
		if ( ! is_array( $items ) ) {
			return array();
		}
		$map = array();
		foreach ( $items as $row ) {
			$id = isset( $row['id'] ) ? (int) $row['id'] : 0;
			if ( $id ) {
				$src = wp_get_attachment_image_url( $id, 'thumbnail' );
				if ( $src ) {
					$map[ (string) $id ] = $src;
					continue;
				}
			}
			if ( ! empty( $row['url'] ) ) {
				$key         = $id ? (string) $id : 'u:' . md5( (string) $row['url'] );
				$map[ $key ] = (string) $row['url'];
			}
		}
		return $map;
	}

	/**
	 * Metabox content.
	 *
	 * @param WP_Post $post Post.
	 */
	public function render( $post ) {
		wp_nonce_field( 'mci_gallery_items_save', 'mci_gallery_items_nonce' );
		$raw   = get_post_meta( $post->ID, MCI_Gallery_Constants::ITEMS_META, true );
		$value = is_string( $raw ) && '' !== $raw ? $raw : '[]';
		?>
		<p class="description">
			<?php esc_html_e( 'Add images from the Media Library, drag order with the arrows, and set alt text for accessibility.', 'maria-charalambous-ivanova' ); ?>
		</p>
		<p>
			<button type="button" class="button button-primary mci-gallery-items__add">
				<?php esc_html_e( 'Add images from Media Library', 'maria-charalambous-ivanova' ); ?>
			</button>
		</p>
		<input type="hidden" name="mci_gallery_items" id="mci_gallery_items" value="<?php echo esc_attr( $value ); ?>" />
		<ul class="mci-gallery-items__list"></ul>
		<style>
			.mci-gallery-items__list { list-style: none; margin: 0; padding: 0; max-width: 720px; }
			.mci-gallery-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; padding: 8px; border: 1px solid #ccd0d4; background: #fff; border-radius: 4px; }
			.mci-gallery-item__thumb { flex: 0 0 60px; }
			.mci-gallery-item__thumb img { display: block; width: 60px; height: 60px; object-fit: cover; border-radius: 2px; }
			.mci-gallery-item__alt { flex: 1; min-width: 0; }
			.mci-gallery-item__actions { display: flex; gap: 4px; flex: 0 0 auto; }
		</style>
		<?php
	}

	/**
	 * Save the hidden JSON input back to post meta.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post.
	 */
	public function save( $post_id, $post ) {
		if ( ! isset( $_POST['mci_gallery_items_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mci_gallery_items_nonce'] ) ), 'mci_gallery_items_save' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$json  = isset( $_POST['mci_gallery_items'] ) ? wp_unslash( $_POST['mci_gallery_items'] ) : '[]';
		$items = json_decode( $json, true );
		$items = MCI_Gallery_Meta::sanitize_items_array( is_array( $items ) ? $items : array() );
		if ( ! empty( $items ) ) {
			update_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, wp_json_encode( $items ) );
		} else {
			delete_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META );
		}
	}
}
