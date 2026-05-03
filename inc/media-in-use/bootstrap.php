<?php
/**
 * Bootstraps the Media In Use feature.
 *
 * Loads class files and wires each component's WordPress hooks. Kept tiny —
 * every collaborator lives in its own file and is responsible for a single
 * concern.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/class-mci-media-in-use-constants.php';
require_once __DIR__ . '/class-mci-media-in-use-detector.php';
require_once __DIR__ . '/class-mci-media-in-use-cache.php';
require_once __DIR__ . '/class-mci-media-in-use-admin.php';

function mci_media_in_use_bootstrap(): void {
	$detector = new MCI_Media_In_Use_Detector();

	$cache = new MCI_Media_In_Use_Cache( $detector );
	$cache->register();

	$admin = new MCI_Media_In_Use_Admin( $detector );
	$admin->register();
}
mci_media_in_use_bootstrap();
