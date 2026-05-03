<?php
/**
 * Shared constants for the Media In Use feature.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class MCI_Media_In_Use_Constants {

	const TRANSIENT_IDS   = 'mci_media_in_use_ids';
	const TRANSIENT_THEME = 'mci_media_in_use_theme_ids';

	const ADMIN_HANDLE_CSS = 'mci-admin-media-in-use';
	const ADMIN_HANDLE_JS  = 'mci-admin-media-in-use';

	const CSS_CLASS   = 'mci-attachment-in-use';
	const BORDER_COLOR = '#7fbf7f';

	const TTL_IDS   = 43200; // 12 hours
	const TTL_THEME = 86400; // 1 day

	private function __construct() {}
}
