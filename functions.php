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
 * SEO — meta tags, Open Graph, Twitter Cards, JSON-LD structured data.
 */
require get_template_directory() . '/inc/seo.php';

/**
 * Enqueue styles and scripts.
 */
function mci_enqueue_assets() {
	wp_enqueue_style( 'mci-style', get_stylesheet_uri(), array(), MCI_THEME_VERSION );
	wp_enqueue_style( 'mci-animations', get_template_directory_uri() . '/assets/css/animations.css', array( 'mci-style' ), MCI_THEME_VERSION );

	// lightGallery — only on pages that use it (gallery page and front page before/after).
	if ( is_page_template( 'page-gallery.php' ) || is_page( 'gallery' ) ) {
		wp_enqueue_style( 'lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery@2.9.0/css/lightgallery-bundle.min.css', array(), '2.9.0' );
		wp_enqueue_script( 'lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery@2.9.0/lightgallery.umd.js', array(), '2.9.0', true );
		wp_enqueue_script( 'lg-thumbnail', 'https://cdn.jsdelivr.net/npm/lightgallery@2.9.0/plugins/thumbnail/lg-thumbnail.umd.js', array( 'lightgallery' ), '2.9.0', true );
		wp_enqueue_script( 'lg-zoom', 'https://cdn.jsdelivr.net/npm/lightgallery@2.9.0/plugins/zoom/lg-zoom.umd.js', array( 'lightgallery' ), '2.9.0', true );
	}

	// Home V2 CSS + Slick carousel (clinic section).
	if ( is_front_page() ) {
		wp_enqueue_style( 'mci-home-v2', get_template_directory_uri() . '/assets/css/home-v2.css', array( 'mci-style', 'mci-animations' ), MCI_THEME_VERSION );
		wp_enqueue_style( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css', array(), '1.8.1' );
		wp_enqueue_style( 'slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.min.css', array( 'slick' ), '1.8.1' );
		wp_enqueue_style( 'mci-home-v2-clinic-slider', get_template_directory_uri() . '/assets/css/home-v2-clinic-slider.css', array( 'mci-home-v2', 'slick-theme' ), MCI_THEME_VERSION );

		wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), '1.8.1', true );
		wp_enqueue_script( 'mci-clinic-slider', get_template_directory_uri() . '/assets/js/clinic-slider.js', array( 'slick' ), MCI_THEME_VERSION, true );
	}

	// Theme main JS — no dependencies (vanilla JS).
	wp_enqueue_script( 'mci-main', get_template_directory_uri() . '/assets/js/main.js', array(), MCI_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'mci_enqueue_assets' );

/**
 * Dequeue jQuery and jQuery Migrate on front-end when not needed.
 * Slick (front page) still needs jQuery, so only dequeue on non-front pages
 * that don't have other jQuery dependencies.
 */
function mci_dequeue_jquery() {
	if ( is_admin() ) {
		return;
	}
	if ( ! is_front_page() && ! is_page( 'gallery' ) ) {
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );
		wp_dequeue_script( 'jquery-migrate' );
		wp_deregister_script( 'jquery-migrate' );
	}
}
add_action( 'wp_enqueue_scripts', 'mci_dequeue_jquery', 20 );

/**
 * Add defer attribute to non-critical scripts.
 */
function mci_defer_scripts( $tag, $handle, $src ) {
	$defer_handles = array( 'slick', 'mci-clinic-slider', 'lightgallery', 'lg-thumbnail', 'lg-zoom' );
	if ( in_array( $handle, $defer_handles, true ) ) {
		return str_replace( ' src=', ' defer src=', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'mci_defer_scripts', 10, 3 );

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
	$email   = sanitize_email( $_POST['contact_email'] ?? '' );
	$message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

	$to      = 'info@dentalartcliniclimassol.com';
	$subject = 'New Appointment Request from ' . $name;
	$body    = "Name: {$name}\nPhone: {$phone}\nEmail: {$email}\n\nMessage:\n{$message}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

	if ( $email ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}

	$sent = wp_mail( $to, $subject, $body, $headers );

	$status = $sent ? 'success' : 'error';
	wp_safe_redirect( home_url( '/contact/?contact=' . $status ) );
	exit;
}
add_action( 'admin_post_mci_contact_form', 'mci_handle_contact_form' );
add_action( 'admin_post_nopriv_mci_contact_form', 'mci_handle_contact_form' );
