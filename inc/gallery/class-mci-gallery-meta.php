<?php
/**
 * Post meta for gallery items (ordered attachment + alt + optional URL fallback).
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Gallery_Meta
 */
class MCI_Gallery_Meta {

	/**
	 * Register post meta and hooks.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_meta' ) );
	}

	/**
	 * Register mci_gallery_items as a single JSON string.
	 */
	public function register_meta() {
		register_post_meta(
			MCI_Gallery_Constants::POST_TYPE,
			MCI_Gallery_Constants::ITEMS_META,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => false,
				'auth_callback'     => function () {
					return current_user_can( 'edit_posts' );
				},
				'sanitize_callback' => array( $this, 'sanitize_raw_items' ),
			)
		);
	}

	/**
	 * Sanitize a stored JSON string into the canonical JSON representation.
	 *
	 * @param string $value Raw JSON or empty.
	 * @return string
	 */
	public function sanitize_raw_items( $value ) {
		$items = is_string( $value ) ? json_decode( $value, true ) : array();
		$out   = self::sanitize_items_array( is_array( $items ) ? $items : array() );
		return wp_json_encode( $out );
	}

	/**
	 * Sanitize an items array to the canonical shape.
	 *
	 * Each item: { id:int, url:string, alt:string }. Items missing both id and
	 * url are dropped.
	 *
	 * @param array $items List of item arrays.
	 * @return array
	 */
	public static function sanitize_items_array( $items ) {
		if ( ! is_array( $items ) ) {
			return array();
		}
		$out = array();
		foreach ( $items as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}
			$id  = isset( $row['id'] ) ? absint( $row['id'] ) : 0;
			$alt = isset( $row['alt'] ) ? sanitize_text_field( $row['alt'] ) : '';
			$url = isset( $row['url'] ) ? esc_url_raw( $row['url'] ) : '';
			if ( ! $id && ! $url ) {
				continue;
			}
			$out[] = array(
				'id'  => $id,
				'url' => $url,
				'alt' => $alt,
			);
		}
		return $out;
	}
}
