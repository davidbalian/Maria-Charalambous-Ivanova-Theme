<?php
/**
 * Create Russian and Greek navigation menus.
 *
 * Usage:  wp eval-file bin/create-lang-menus.php
 * Re-run: Safe to re-run — deletes existing lang menus first.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	WP_CLI::error( 'Run this via WP-CLI: wp eval-file bin/create-lang-menus.php' );
}

/*
 * Menu items definition.
 * Keys   = English labels (used as-is for URL slug matching).
 * Values = [ slug, Russian label, Greek label ].
 *
 * The i18n URL-rewrite filter (mci_nav_menu_lang_urls) automatically
 * prefixes internal links with /ru/ or /el/, so we always point to
 * the base English URL.
 */
$primary_items = array(
	array( '/',                'Главная',   'Αρχική' ),
	array( '/about/',          'О нас',     'Σχετικά' ),
	array( '/services/',       'Услуги',    'Υπηρεσίες' ),
	array( '/gallery/',        'Галерея',   'Γκαλερί' ),
	array( '/contact/',        'Контакты',  'Επικοινωνία' ),
);

$footer_items = array(
	array( '/',                'Главная',   'Αρχική' ),
	array( '/about/',          'О нас',     'Σχετικά' ),
	array( '/services/',       'Услуги',    'Υπηρεσίες' ),
	array( '/gallery/',        'Галерея',   'Γκαλερί' ),
	array( '/contact/',        'Контакты',  'Επικοινωνία' ),
	array( '/privacy-policy/', 'Политика конфиденциальности', 'Πολιτική Απορρήτου' ),
);

/**
 * Definitions: [ menu_slug, menu_name, theme_location, items_array, lang_index ]
 * lang_index: 1 = Russian, 2 = Greek.
 */
$menus = array(
	array( 'primary-ru', 'Primary Menu (Russian)', 'primary-ru', $primary_items, 1 ),
	array( 'primary-el', 'Primary Menu (Greek)',   'primary-el', $primary_items, 2 ),
	array( 'footer-ru',  'Footer Menu (Russian)',  'footer-ru',  $footer_items,  1 ),
	array( 'footer-el',  'Footer Menu (Greek)',    'footer-el',  $footer_items,  2 ),
);

$home = untrailingslashit( home_url() );

foreach ( $menus as list( $slug, $name, $location, $items, $lang_idx ) ) {

	// Delete existing menu if present (makes re-runs safe).
	$existing = wp_get_nav_menu_object( $slug );
	if ( $existing ) {
		wp_delete_nav_menu( $existing->term_id );
		WP_CLI::log( "Deleted existing menu: {$slug}" );
	}

	$menu_id = wp_create_nav_menu( $name );
	if ( is_wp_error( $menu_id ) ) {
		WP_CLI::warning( "Could not create menu {$slug}: " . $menu_id->get_error_message() );
		continue;
	}

	// Rename the auto-generated slug to our desired slug.
	wp_update_term( $menu_id, 'nav_menu', array( 'slug' => $slug ) );

	$position = 0;
	foreach ( $items as $item ) {
		$position++;
		$url   = $home . $item[0];
		$title = $item[ $lang_idx ];

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $title,
			'menu-item-url'       => $url,
			'menu-item-status'    => 'publish',
			'menu-item-type'      => 'custom',
			'menu-item-position'  => $position,
		) );
	}

	WP_CLI::log( "Created menu: {$name} ({$position} items)" );

	// Assign to theme location.
	$locations              = get_theme_mod( 'nav_menu_locations', array() );
	$locations[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	WP_CLI::log( "  -> assigned to location: {$location}" );
}

WP_CLI::success( 'All language menus created and assigned.' );
