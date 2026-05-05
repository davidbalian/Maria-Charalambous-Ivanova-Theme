<?php
/**
 * Bootstraps the Galleries feature.
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

require_once __DIR__ . '/class-mci-galleries-constants.php';
require_once __DIR__ . '/class-mci-galleries-locations.php';
require_once __DIR__ . '/class-mci-galleries-image.php';
require_once __DIR__ . '/class-mci-galleries-repository.php';
require_once __DIR__ . '/class-mci-galleries-post-type.php';
require_once __DIR__ . '/class-mci-galleries-metabox-renderer.php';
require_once __DIR__ . '/class-mci-galleries-metabox-saver.php';
require_once __DIR__ . '/class-mci-galleries-metabox.php';
require_once __DIR__ . '/class-mci-galleries-admin-assets.php';
require_once __DIR__ . '/class-mci-galleries-admin-columns.php';
require_once __DIR__ . '/class-mci-galleries-default-data.php';
require_once __DIR__ . '/class-mci-galleries-seeder.php';
require_once __DIR__ . '/class-mci-galleries-smilers-dual-slot-bootstrap.php';

/**
 * Register Galleries components on theme load.
 */
function mci_galleries_bootstrap() {
	$post_type = new MCI_Galleries_Post_Type();
	$post_type->register();

	$renderer = new MCI_Galleries_Metabox_Renderer();
	$saver    = new MCI_Galleries_Metabox_Saver();
	$metabox  = new MCI_Galleries_Metabox( $renderer, $saver );
	$metabox->register();

	$assets = new MCI_Galleries_Admin_Assets();
	$assets->register();

	$columns = new MCI_Galleries_Admin_Columns();
	$columns->register();

	$seeder = new MCI_Galleries_Seeder();
	$seeder->register();

	$smilers_dual_slot = new MCI_Galleries_Smilers_Dual_Slot_Bootstrap();
	$smilers_dual_slot->register();
}
mci_galleries_bootstrap();
