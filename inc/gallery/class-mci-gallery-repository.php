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
	 * Public slot keys and admin labels.
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
	 * Normalized site URL for attachment lookup.
	 *
	 * @param string $url Any image URL.
	 * @return string
	 */
	public static function normalize_url( $url ) {
		$url = trim( (string) $url );
		if ( '' === $url ) {
			return '';
		}
		$legacy = 'http://davidb1646.sg-host.com';
		$https  = 'https://davidb1646.sg-host.com';
		if ( 0 === strpos( $url, $legacy ) ) {
			$url = home_url( (string) wp_parse_url( $url, PHP_URL_PATH ) );
		} elseif ( 0 === strpos( $url, $https ) ) {
			$url = home_url( (string) wp_parse_url( $url, PHP_URL_PATH ) );
		}
		return esc_url_raw( $url );
	}

	/**
	 * Items for a placement slot, ready for templates.
	 *
	 * Each item has:
	 *   url       — full-size URL (use for lightbox href)
	 *   thumb_url — medium/large size (use for <img src>); same as url for URL-only items
	 *   alt, width, height, id
	 *
	 * @param string $slot One of MCI_Gallery_Repository::get_slot_keys().
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
	 * @param array $row Item row.
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
			// Use wp_get_attachment_url as the most reliable full-size URL for any attachment type.
			$raw = wp_get_attachment_url( $id );
			if ( $raw ) {
				$url = $raw;
				// Try to get a medium/large thumbnail for grid display.
				$medium = wp_get_attachment_image_url( $id, 'large' );
				if ( ! $medium ) {
					$medium = wp_get_attachment_image_url( $id, 'medium_large' );
				}
				if ( ! $medium ) {
					$medium = wp_get_attachment_image_url( $id, 'medium' );
				}
				$thumb_url = $medium ? $medium : $url;
				// Dimensions from metadata.
				$meta = wp_get_attachment_metadata( $id );
				if ( is_array( $meta ) ) {
					$w = isset( $meta['width'] ) ? (int) $meta['width'] : 0;
					$h = isset( $meta['height'] ) ? (int) $meta['height'] : 0;
				}
				if ( '' === $alt ) {
					$alt = (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
				}
			}
		}

		// Fall back to stored URL when no attachment ID or attachment URL empty.
		if ( ! $url && $fb_url ) {
			$url = self::normalize_url( $fb_url );
		}
		if ( ! $thumb_url ) {
			$thumb_url = $url;
		}

		$url       = $url ? esc_url( $url ) : '';
		$thumb_url = $thumb_url ? esc_url( $thumb_url ) : '';

		return array(
			'url'       => $url,
			'thumb_url' => $thumb_url,
			'alt'       => $alt,
			'width'     => $w,
			'height'    => $h,
			'id'        => $id,
		);
	}
}
