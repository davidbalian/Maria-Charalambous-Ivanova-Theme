<?php
/**
 * Registers WordPress hooks that invalidate the in-use ID transients.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MCI_Media_In_Use_Cache {

	private MCI_Media_In_Use_Detector $detector;

	public function __construct( MCI_Media_In_Use_Detector $detector ) {
		$this->detector = $detector;
	}

	public function register(): void {
		// Any post change that may alter in-use status.
		foreach ( array( 'save_post', 'deleted_post', 'attachment_updated', 'delete_attachment', 'add_attachment' ) as $action ) {
			add_action( $action, array( $this, 'flush_ids' ) );
		}

		// Post-meta changes — only for meta keys we care about.
		foreach ( array( 'updated_post_meta', 'added_post_meta', 'deleted_post_meta' ) as $action ) {
			add_action( $action, array( $this, 'maybe_flush_on_meta' ), 10, 3 );
		}

		// Theme changes may alter which files the scanner finds.
		add_action( 'switch_theme', array( $this, 'flush_theme' ) );
		add_action( 'upgrader_process_complete', array( $this, 'flush_theme' ) );
	}

	public function flush_ids(): void {
		$this->detector->flush();
	}

	public function flush_theme(): void {
		$this->detector->flush_theme();
		$this->detector->flush(); // Force recompute with new theme URLs included.
	}

	/**
	 * @param int    $meta_id
	 * @param int    $object_id
	 * @param string $meta_key
	 */
	public function maybe_flush_on_meta( $meta_id, $object_id, $meta_key ): void {
		$watched = array(
			'_thumbnail_id',
			MCI_Galleries_Constants::META_IMAGES,
		);

		if ( in_array( $meta_key, $watched, true ) ) {
			$this->detector->flush();
		}
	}
}
