<?php
/**
 * Renders the Galleries metabox bodies.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Metabox_Renderer
 */
final class MCI_Galleries_Metabox_Renderer {

	/**
	 * Render the location select box.
	 *
	 * @param WP_Post $post Current post.
	 */
	public function render_location_box( $post ) {
		wp_nonce_field( MCI_Galleries_Constants::NONCE_ACTION, MCI_Galleries_Constants::NONCE_FIELD );
		$current = (string) get_post_meta( $post->ID, MCI_Galleries_Constants::META_LOCATION, true );
		?>
		<p class="description" style="margin-top:0">
			<?php esc_html_e( 'Choose which section of the site displays this gallery. Only one gallery is shown per location — the most recently published one wins.', 'maria-charalambous-ivanova' ); ?>
		</p>
		<p>
			<label for="mci-gallery-location" class="screen-reader-text">
				<?php esc_html_e( 'Location', 'maria-charalambous-ivanova' ); ?>
			</label>
			<select id="mci-gallery-location" name="mci_gallery_location" style="width:100%">
				<option value=""><?php esc_html_e( '— None —', 'maria-charalambous-ivanova' ); ?></option>
				<?php foreach ( MCI_Galleries_Locations::all() as $slug => $label ) : ?>
					<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $current, $slug ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Render the images manager box.
	 *
	 * @param WP_Post $post Current post.
	 */
	public function render_images_box( $post ) {
		$items = get_post_meta( $post->ID, MCI_Galleries_Constants::META_IMAGES, true );
		$items = is_array( $items ) ? $items : array();
		$views = array();
		foreach ( $items as $item ) {
			$view = $this->item_to_view( $item );
			if ( null !== $view ) {
				$views[] = $view;
			}
		}
		$json = wp_json_encode( $items, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		if ( false === $json ) {
			$json = '[]';
		}
		?>
		<div class="mci-galleries-metabox" data-mci-galleries>
			<p>
				<button type="button" class="button button-primary" data-mci-galleries-add>
					<?php esc_html_e( 'Add Images', 'maria-charalambous-ivanova' ); ?>
				</button>
				<span class="description" style="margin-left:8px">
					<?php esc_html_e( 'Drag thumbnails to reorder. Click × to remove.', 'maria-charalambous-ivanova' ); ?>
				</span>
			</p>
			<ul class="mci-galleries-grid" data-mci-galleries-list>
				<?php foreach ( $views as $view ) : ?>
					<li
						class="mci-galleries-item"
						data-mci-galleries-item
						data-kind="<?php echo esc_attr( $view['kind'] ); ?>"
						<?php if ( 'attachment' === $view['kind'] ) : ?>
							data-id="<?php echo esc_attr( (string) $view['id'] ); ?>"
						<?php else : ?>
							data-url="<?php echo esc_attr( $view['url'] ); ?>"
							data-alt="<?php echo esc_attr( $view['alt'] ); ?>"
						<?php endif; ?>
					>
						<img src="<?php echo esc_url( $view['thumb'] ); ?>" alt="" />
						<?php if ( '' !== $view['meta'] ) : ?>
							<span class="mci-galleries-item__meta"><?php echo esc_html( $view['meta'] ); ?></span>
						<?php endif; ?>
						<button type="button" class="mci-galleries-item__remove" aria-label="<?php esc_attr_e( 'Remove image', 'maria-charalambous-ivanova' ); ?>">&times;</button>
					</li>
				<?php endforeach; ?>
			</ul>
			<p class="mci-galleries-empty" <?php echo empty( $views ) ? '' : 'style="display:none"'; ?>>
				<?php esc_html_e( 'No images yet. Click "Add Images" to get started.', 'maria-charalambous-ivanova' ); ?>
			</p>
			<input
				type="hidden"
				name="mci_gallery_images"
				data-mci-galleries-input
				value="<?php echo esc_attr( $json ); ?>"
			/>
		</div>
		<?php
	}

	/**
	 * Convert a stored item into a view model for the grid.
	 *
	 * @param array<string, mixed> $item Stored item.
	 * @return array{kind:string,id:int,url:string,alt:string,thumb:string,meta:string}|null
	 */
	private function item_to_view( $item ) {
		$row = MCI_Galleries_Image::row_from_item( $item );
		if ( null === $row ) {
			return null;
		}

		$kind = isset( $item['kind'] ) ? (string) $item['kind'] : '';
		$meta = '';
		$id   = 0;
		$url  = '';
		$alt  = '';

		if ( MCI_Galleries_Image::KIND_ATTACHMENT === $kind ) {
			$id = isset( $item['id'] ) ? (int) $item['id'] : 0;
		} elseif ( MCI_Galleries_Image::KIND_URL === $kind ) {
			$url  = isset( $item['url'] ) ? (string) $item['url'] : '';
			$alt  = isset( $item['alt'] ) ? (string) $item['alt'] : '';
			$meta = __( 'URL', 'maria-charalambous-ivanova' );
		}

		return array(
			'kind'  => $kind,
			'id'    => $id,
			'url'   => $url,
			'alt'   => $alt,
			'thumb' => $row['thumb_url'],
			'meta'  => $meta,
		);
	}
}
