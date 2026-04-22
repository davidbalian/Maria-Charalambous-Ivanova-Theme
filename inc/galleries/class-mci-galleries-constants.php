<?php
/**
 * Shared constants for the Galleries feature.
 *
 * Centralises the post type slug, meta keys, nonce name, and capability so
 * other classes never hard-code these values.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MCI_Galleries_Constants
 */
final class MCI_Galleries_Constants {

	const POST_TYPE = 'mci_gallery';

	const META_LOCATION = '_mci_gallery_location';

	const META_IMAGES = '_mci_gallery_images';

	const NONCE_ACTION = 'mci_galleries_save';

	const NONCE_FIELD = 'mci_galleries_nonce';

	const SEED_OPTION = 'mci_galleries_seeded_v1';

	const SEED_MARK_META = '_mci_gallery_seeded';

	const ADMIN_HANDLE_JS = 'mci-admin-galleries';

	const ADMIN_HANDLE_CSS = 'mci-admin-galleries';

	const CAPABILITY = 'edit_posts';

	/**
	 * Prevent instantiation — this class is a constants holder only.
	 */
	private function __construct() {}
}
