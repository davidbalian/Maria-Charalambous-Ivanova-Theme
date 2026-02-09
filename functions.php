<?php
/**
 * Maria Charalambous-Ivanova Theme functions and definitions.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MCI_THEME_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function mci_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'automatic-feed-links' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'maria-charalambous-ivanova' ),
		'footer'  => __( 'Footer Menu', 'maria-charalambous-ivanova' ),
	) );
}
add_action( 'after_setup_theme', 'mci_theme_setup' );

/**
 * Enqueue styles and scripts.
 */
function mci_enqueue_assets() {
	wp_enqueue_style( 'mci-style', get_stylesheet_uri(), array(), MCI_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'mci_enqueue_assets' );
