<?php
/**
 * Image value object for gallery rows.
 *
 * Templates consume a uniform row of url/thumb_url/alt/width/height regardless
 * of whether the source is an attachment ID or a raw URL entry.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Image
 */
final class MCI_Galleries_Image {

	const KIND_ATTACHMENT = 'attachment';
	const KIND_URL        = 'url';

	const THUMB_SIZE   = 'medium_large';
	const DISPLAY_SIZE = 'large';

	/**
	 * Convert a stored item into the template row.
	 *
	 * Returns null when the item is malformed or its attachment no longer
	 * resolves to an image.
	 *
	 * @param array<string, mixed> $item Stored meta item.
	 * @return array{url:string,thumb_url:string,alt:string,width:int,height:int}|null
	 */
	public static function row_from_item( $item ) {
		if ( ! is_array( $item ) || empty( $item['kind'] ) ) {
			return null;
		}

		if ( self::KIND_ATTACHMENT === $item['kind'] ) {
			return self::row_from_attachment( isset( $item['id'] ) ? (int) $item['id'] : 0 );
		}

		if ( self::KIND_URL === $item['kind'] ) {
			return self::row_from_url_item( $item );
		}

		return null;
	}

	/**
	 * Build a row from an attachment ID.
	 *
	 * @param int $attachment_id WP attachment ID.
	 * @return array{url:string,thumb_url:string,alt:string,width:int,height:int}|null
	 */
	private static function row_from_attachment( $attachment_id ) {
		if ( $attachment_id <= 0 ) {
			return null;
		}

		$full = wp_get_attachment_image_src( $attachment_id, self::DISPLAY_SIZE );
		if ( ! $full ) {
			return null;
		}

		$thumb     = wp_get_attachment_image_src( $attachment_id, self::THUMB_SIZE );
		$thumb_url = $thumb ? $thumb[0] : $full[0];
		$alt       = (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		return array(
			'url'       => (string) $full[0],
			'thumb_url' => (string) $thumb_url,
			'alt'       => $alt,
			'width'     => isset( $full[1] ) ? (int) $full[1] : 0,
			'height'    => isset( $full[2] ) ? (int) $full[2] : 0,
		);
	}

	/**
	 * Build a row from a `{kind:url, url, alt}` item.
	 *
	 * @param array<string, mixed> $item Stored meta item.
	 * @return array{url:string,thumb_url:string,alt:string,width:int,height:int}|null
	 */
	private static function row_from_url_item( $item ) {
		$url = isset( $item['url'] ) ? esc_url_raw( (string) $item['url'] ) : '';
		if ( '' === $url ) {
			return null;
		}

		return array(
			'url'       => $url,
			'thumb_url' => $url,
			'alt'       => isset( $item['alt'] ) ? (string) $item['alt'] : '',
			'width'     => 0,
			'height'    => 0,
		);
	}

	/**
	 * Prevent instantiation.
	 */
	private function __construct() {}
}
