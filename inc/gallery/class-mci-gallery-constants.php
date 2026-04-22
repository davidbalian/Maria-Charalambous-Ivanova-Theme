<?php
/**
 * Central constants for the gallery feature.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post type, meta, and options keys.
 */
class MCI_Gallery_Constants {

	public const POST_TYPE     = 'mci_gallery';
	public const ITEMS_META    = 'mci_gallery_items';
	public const PLACEMENTS    = 'mci_gallery_placements';
	public const SEED_VERSION  = 'mci_gallery_seed_version';
	public const SEED_VERSION_NUMBER = 2;
}
