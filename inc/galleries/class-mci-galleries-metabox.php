<?php
/**
 * Coordinator that registers the Galleries metaboxes and delegates
 * rendering/saving to dedicated classes.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Metabox
 */
final class MCI_Galleries_Metabox {

	/**
	 * Renderer for the metabox bodies.
	 *
	 * @var MCI_Galleries_Metabox_Renderer
	 */
	private $renderer;

	/**
	 * Saver for form submissions.
	 *
	 * @var MCI_Galleries_Metabox_Saver
	 */
	private $saver;

	/**
	 * Inject dependencies.
	 *
	 * @param MCI_Galleries_Metabox_Renderer $renderer Renderer.
	 * @param MCI_Galleries_Metabox_Saver    $saver    Saver.
	 */
	public function __construct( MCI_Galleries_Metabox_Renderer $renderer, MCI_Galleries_Metabox_Saver $saver ) {
		$this->renderer = $renderer;
		$this->saver    = $saver;
	}

	/**
	 * Hook registration into WordPress.
	 */
	public function register() {
		add_action( 'add_meta_boxes_' . MCI_Galleries_Constants::POST_TYPE, array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post_' . MCI_Galleries_Constants::POST_TYPE, array( $this->saver, 'save' ), 10, 2 );
	}

	/**
	 * Register both metaboxes.
	 */
	public function add_meta_boxes() {
		add_meta_box(
			'mci_gallery_location',
			__( 'Location', 'maria-charalambous-ivanova' ),
			array( $this->renderer, 'render_location_box' ),
			MCI_Galleries_Constants::POST_TYPE,
			'side',
			'high'
		);

		add_meta_box(
			'mci_gallery_images',
			__( 'Images', 'maria-charalambous-ivanova' ),
			array( $this->renderer, 'render_images_box' ),
			MCI_Galleries_Constants::POST_TYPE,
			'normal',
			'high'
		);
	}
}
