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

	// GLightbox.
	wp_enqueue_style( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/css/glightbox.min.css', array(), '3.3.0' );
	wp_enqueue_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/js/glightbox.min.js', array(), '3.3.0', true );

	// Home V2 CSS.
	if ( is_front_page() ) {
		wp_enqueue_style( 'mci-home-v2', get_template_directory_uri() . '/assets/css/home-v2.css', array( 'mci-style' ), MCI_THEME_VERSION );
	}

	// Theme main JS.
	wp_enqueue_script( 'mci-main', get_template_directory_uri() . '/assets/js/main.js', array( 'glightbox' ), MCI_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'mci_enqueue_assets' );

/**
 * Handle contact form submission.
 */
function mci_handle_contact_form() {
	if (
		! isset( $_POST['mci_contact_nonce'] ) ||
		! wp_verify_nonce( $_POST['mci_contact_nonce'], 'mci_contact_form_nonce' )
	) {
		wp_safe_redirect( home_url( '/contact/?contact=error' ) );
		exit;
	}

	$name    = sanitize_text_field( $_POST['contact_name'] ?? '' );
	$phone   = sanitize_text_field( $_POST['contact_phone'] ?? '' );
	$service = sanitize_text_field( $_POST['contact_service'] ?? '' );
	$message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

	$to      = 'info@dentalartcliniclimassol.com';
	$subject = 'New Appointment Request from ' . $name;
	$body    = "Name: {$name}\nPhone: {$phone}\nService: {$service}\n\nMessage:\n{$message}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	$status = $sent ? 'success' : 'error';
	wp_safe_redirect( home_url( '/contact/?contact=' . $status ) );
	exit;
}
add_action( 'admin_post_mci_contact_form', 'mci_handle_contact_form' );
add_action( 'admin_post_nopriv_mci_contact_form', 'mci_handle_contact_form' );
