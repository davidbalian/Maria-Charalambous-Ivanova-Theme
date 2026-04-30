<?php
/**
 * Recreate primary navigation menus for all languages.
 *
 * Run from the WordPress root directory:
 *   wp eval-file wp-content/themes/maria-charalambous-ivanova/setup-menus.php
 *
 * Safe to run multiple times — deletes and rebuilds the menus each time.
 */

defined( 'ABSPATH' ) || exit( 'Run via WP-CLI: wp eval-file path/to/setup-menus.php' . PHP_EOL );

// Main page slugs to include in every primary menu, in order.
$nav_slugs = array( 'about', 'services', 'gallery', 'contact' );

// Menu locations to build (location slug => menu display name).
$menus_to_build = array(
	'primary'    => 'Primary Menu',
	'primary-el' => 'Primary Menu (Greek)',
	'primary-ru' => 'Primary Menu (Russian)',
);

// -------------------------------------------------------------------------
// 1. Delete any existing menus currently assigned to these locations.
// -------------------------------------------------------------------------
$existing_locations = get_nav_menu_locations();

foreach ( $menus_to_build as $location => $label ) {
	if ( ! empty( $existing_locations[ $location ] ) ) {
		$old = wp_get_nav_menu_object( $existing_locations[ $location ] );
		if ( $old ) {
			wp_delete_nav_menu( $old->term_id );
			echo "Deleted old menu: {$old->name}\n";
		}
	}
}

// -------------------------------------------------------------------------
// 2. Resolve page IDs from slugs once (shared across all menus).
// -------------------------------------------------------------------------
$page_ids = array();
foreach ( $nav_slugs as $slug ) {
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	if ( $page ) {
		$page_ids[ $slug ] = $page->ID;
	} else {
		echo "WARNING: page not found for slug '{$slug}' — skipping.\n";
	}
}

// -------------------------------------------------------------------------
// 3. Build each menu and assign it to its location.
// -------------------------------------------------------------------------
$location_map = $existing_locations; // preserve other unrelated locations

foreach ( $menus_to_build as $location => $label ) {
	$menu_id = wp_create_nav_menu( $label );

	if ( is_wp_error( $menu_id ) ) {
		echo "ERROR creating '{$label}': " . $menu_id->get_error_message() . "\n";
		continue;
	}

	echo "\nCreated: {$label} (ID: {$menu_id})\n";

	foreach ( $page_ids as $slug => $page_id ) {
		$item_id = wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-object-id' => $page_id,
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
		) );

		if ( is_wp_error( $item_id ) ) {
			echo "  ERROR adding {$slug}: " . $item_id->get_error_message() . "\n";
		} else {
			echo "  + {$slug} (page ID: {$page_id}, item ID: {$item_id})\n";
		}
	}

	$location_map[ $location ] = $menu_id;
}

set_theme_mod( 'nav_menu_locations', $location_map );

echo "\nAll done. Menus assigned to locations.\n";
echo "If you use an object cache, run: wp cache flush\n";
