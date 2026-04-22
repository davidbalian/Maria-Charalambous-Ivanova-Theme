<?php
/**
 * Resolves slot placements to front-end image rows.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Repository
 */
class MCI_Gallery_Repository {

	/**
	 * Slot keys and admin labels.
	 *
	 * @return array<string, string>
	 */
	public static function get_slot_labels() {
		return array(
			'home_before_after' => __( 'Home — Before & After', 'maria-charalambous-ivanova' ),
			'home_clinic'       => __( 'Home — The Clinic (carousel)', 'maria-charalambous-ivanova' ),
			'page_before_after' => __( 'Gallery page — Before & After', 'maria-charalambous-ivanova' ),
			'page_clinic'       => __( 'Gallery page — The Clinic (grid)', 'maria-charalambous-ivanova' ),
		);
	}

	/**
	 * Slot key list.
	 *
	 * @return string[]
	 */
	public static function get_slot_keys() {
		return array_keys( self::get_slot_labels() );
	}

	/**
	 * Rewrite legacy staging host URLs to the current site host so attachment
	 * lookups succeed against the live media library.
	 *
	 * @param string $url Any image URL.
	 * @return string
	 */
	public static function normalize_url( $url ) {
		$url = trim( (string) $url );
		if ( '' === $url ) {
			return '';
		}
		$legacy_hosts = array(
			'http://davidb1646.sg-host.com',
			'https://davidb1646.sg-host.com',
		);
		foreach ( $legacy_hosts as $host ) {
			if ( 0 === strpos( $url, $host ) ) {
				$path = (string) wp_parse_url( $url, PHP_URL_PATH );
				$url  = home_url( $path );
				break;
			}
		}
		return esc_url_raw( $url );
	}

	/**
	 * Resolved items for a placement slot, ready for templates.
	 *
	 * @param string $slot One of get_slot_keys().
	 * @return array<int, array{url:string, thumb_url:string, alt:string, width:int, height:int, id:int}>
	 */
	public static function get_items_for_slot( $slot ) {
		if ( ! in_array( $slot, self::get_slot_keys(), true ) ) {
			return array();
		}
		$placements = get_option( MCI_Gallery_Constants::PLACEMENTS, array() );
		$post_id    = isset( $placements[ $slot ] ) ? absint( $placements[ $slot ] ) : 0;
		if ( ! $post_id || 'publish' !== get_post_status( $post_id ) ) {
			return array();
		}
		$raw = get_post_meta( $post_id, MCI_Gallery_Constants::ITEMS_META, true );
		if ( ! is_string( $raw ) || '' === $raw ) {
			return array();
		}
		$rows = json_decode( $raw, true );
		if ( ! is_array( $rows ) ) {
			return array();
		}
		$out = array();
		foreach ( $rows as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}
			$resolved = self::resolve_item_row( $row );
			if ( $resolved['url'] ) {
				$out[] = $resolved;
			}
		}
		return $out;
	}

	/**
	 * Build one output row from stored meta.
	 *
	 * @param array $row Item row from storage.
	 * @return array{url:string, thumb_url:string, alt:string, width:int, height:int, id:int}
	 */
	private static function resolve_item_row( $row ) {
		$id     = isset( $row['id'] ) ? absint( $row['id'] ) : 0;
		$alt    = isset( $row['alt'] ) ? sanitize_text_field( $row['alt'] ) : '';
		$fb_url = isset( $row['url'] ) ? esc_url_raw( $row['url'] ) : '';

		$url       = '';
		$thumb_url = '';
		$w         = 0;
		$h         = 0;

		if ( $id ) {
			$full = wp_get_attachment_url( $id );
			if ( $full ) {
				$url       = $full;
				$thumb_url = self::pick_display_size( $id, $full );
				$meta      = wp_get_attachment_metadata( $id );
				if ( is_array( $meta ) ) {
					$w = isset( $meta['width'] ) ? (int) $meta['width'] : 0;
					$h = isset( $meta['height'] ) ? (int) $meta['height'] : 0;
				}
				if ( '' === $alt ) {
					$alt = (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
				}
			}
		}

		if ( ! $url && $fb_url ) {
			$url = self::normalize_url( $fb_url );
		}
		if ( ! $thumb_url ) {
			$thumb_url = $url;
		}

		return array(
			'url'       => $url ? esc_url( $url ) : '',
			'thumb_url' => $thumb_url ? esc_url( $thumb_url ) : '',
			'alt'       => $alt,
			'width'     => $w,
			'height'    => $h,
			'id'        => $id,
		);
	}

	/**
	 * Choose the best mid-sized URL for grid/slider display.
	 *
	 * @param int    $id       Attachment ID.
	 * @param string $fallback Full-size URL.
	 * @return string
	 */
	private static function pick_display_size( $id, $fallback ) {
		foreach ( array( 'large', 'medium_large', 'medium' ) as $size ) {
			$src = wp_get_attachment_image_url( $id, $size );
			if ( $src ) {
				return $src;
			}
		}
		return $fallback;
	}
}
