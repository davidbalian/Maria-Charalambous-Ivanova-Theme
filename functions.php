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
	wp_enqueue_style(
		'mci-google-fonts',
<<<<<<< HEAD
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;0,900;1,400&display=swap',
=======
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700;800;900&display=swap',
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
		array(),
		null
	);

	wp_enqueue_style( 'mci-style', get_stylesheet_uri(), array( 'mci-google-fonts' ), MCI_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'mci_enqueue_assets' );

<<<<<<< HEAD
=======
/**
 * Customizer: Design Tokens.
 */
>>>>>>> aa42d112f83445055c1b69dd5262da5f7b31815b
require get_template_directory() . '/inc/customizer.php';
