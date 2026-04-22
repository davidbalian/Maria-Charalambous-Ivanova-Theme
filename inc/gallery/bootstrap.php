<?php
/**
 * Load the gallery feature (CPT, placements, seeder, repository).
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require __DIR__ . '/class-mci-gallery-constants.php';
require __DIR__ . '/class-mci-gallery-post-type.php';
require __DIR__ . '/class-mci-gallery-meta.php';
require __DIR__ . '/class-mci-gallery-repository.php';
require __DIR__ . '/class-mci-gallery-admin-metabox.php';
require __DIR__ . '/class-mci-gallery-placements.php';
require __DIR__ . '/class-mci-gallery-default-sources.php';
require __DIR__ . '/class-mci-gallery-seeder.php';

new MCI_Gallery_Post_Type();
new MCI_Gallery_Meta();
new MCI_Gallery_Admin_Metabox();
new MCI_Gallery_Placements();
new MCI_Gallery_Seeder();
