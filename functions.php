<?php
/**
 * Maria Charalambous-Ivanova Theme functions and definitions.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MCI_THEME_VERSION', '1.6.16' );

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
		'primary'    => __( 'Primary Menu', 'maria-charalambous-ivanova' ),
		'footer'     => __( 'Footer Menu', 'maria-charalambous-ivanova' ),
		'primary-ru' => __( 'Primary Menu (Russian)', 'maria-charalambous-ivanova' ),
		'primary-el' => __( 'Primary Menu (Greek)', 'maria-charalambous-ivanova' ),
		'footer-ru'  => __( 'Footer Menu (Russian)', 'maria-charalambous-ivanova' ),
		'footer-el'  => __( 'Footer Menu (Greek)', 'maria-charalambous-ivanova' ),
	) );
}
add_action( 'after_setup_theme', 'mci_theme_setup' );

/**
 * Multilingual support — must load before SEO so translations are available.
 */
require get_template_directory() . '/inc/i18n.php';

/**
 * WhatsApp chat URLs and display helpers.
 */
require get_template_directory() . '/inc/whatsapp.php';

/**
 * Editable image galleries (CPT + location-driven rendering).
 */
require get_template_directory() . '/inc/galleries/bootstrap.php';

/**
 * SEO — meta tags, Open Graph, Twitter Cards, JSON-LD structured data.
 */
require get_template_directory() . '/inc/seo.php';

/**
 * Multilingual XML sitemap served at /sitemap.xml with hreflang annotations.
 */
require get_template_directory() . '/inc/sitemap.php';

/**
 * llms.txt — guidance file for AI crawlers, served at /llms.txt.
 */
require get_template_directory() . '/inc/llms.php';

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

	// Home V2 CSS + Swiper (hero + clinic carousels).
	if ( is_front_page() ) {
		wp_enqueue_style( 'mci-home-v2', get_template_directory_uri() . '/assets/css/home-v2.css', array( 'mci-style', 'mci-animations' ), MCI_THEME_VERSION );
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '12.1.4' );
		wp_enqueue_style( 'mci-home-v2-clinic-slider', get_template_directory_uri() . '/assets/css/home-v2-clinic-slider.css', array( 'mci-home-v2', 'swiper' ), MCI_THEME_VERSION );
		wp_enqueue_style( 'mci-home-v2-hero-slider', get_template_directory_uri() . '/assets/css/home-v2-hero-slider.css', array( 'mci-home-v2-clinic-slider' ), MCI_THEME_VERSION );

		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '12.1.4', true );
		wp_enqueue_script( 'mci-home-hero-slider', get_template_directory_uri() . '/assets/js/home-hero-slider.js', array( 'swiper' ), MCI_THEME_VERSION, true );
		wp_enqueue_script( 'mci-clinic-slider', get_template_directory_uri() . '/assets/js/clinic-slider.js', array( 'swiper' ), MCI_THEME_VERSION, true );
	}

	// Services page — hero Swiper (same script as home hero; see template-parts/services-hero.php).
	if ( is_page_template( 'page-services.php' ) ) {
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '12.1.4' );
		wp_enqueue_style(
			'mci-services-hero-slider',
			get_template_directory_uri() . '/assets/css/services-hero-slider.css',
			array( 'mci-style', 'swiper' ),
			MCI_THEME_VERSION
		);
		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '12.1.4', true );
		wp_enqueue_script( 'mci-home-hero-slider', get_template_directory_uri() . '/assets/js/home-hero-slider.js', array( 'swiper' ), MCI_THEME_VERSION, true );
	}

	// Theme main JS — no dependencies (vanilla JS).
	wp_enqueue_script( 'mci-main', get_template_directory_uri() . '/assets/js/main.js', array(), MCI_THEME_VERSION, true );
	wp_localize_script( 'mci-main', 'mciAjax', array(
		'url'     => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'mci_contact_form_nonce' ),
		'lang'    => mci_get_current_lang(),
		'strings' => array(
			'sent'       => mci_t( 'Sent!' ),
			'failed'     => mci_t( 'Failed!' ),
			'open_now'   => mci_t( 'OPEN NOW' ),
			'closed_now' => mci_t( 'CLOSED NOW' ),
		),
	) );
}
add_action( 'wp_enqueue_scripts', 'mci_enqueue_assets' );

/**
 * Dequeue jQuery and jQuery Migrate on front-end when not needed.
 * Theme scripts are vanilla JS; keep jQuery on the gallery page for plugin compatibility.
 */
function mci_dequeue_jquery() {
	if ( is_admin() ) {
		return;
	}
	if ( ! is_page( 'gallery' ) ) {
		wp_dequeue_script( 'jquery' );
		wp_deregister_script( 'jquery' );
		wp_dequeue_script( 'jquery-migrate' );
		wp_deregister_script( 'jquery-migrate' );
	}
}
add_action( 'wp_enqueue_scripts', 'mci_dequeue_jquery', 20 );

/**
 * Preload first hero image on homepage to improve LCP.
 */
function mci_preload_hero_image() {
	if ( ! is_front_page() ) {
		return;
	}
	$desktop = home_url( '/wp-content/uploads/2026/04/dr-maria-charalambous-ivanova-portrait-hd.webp' );
	$mobile  = home_url( '/wp-content/uploads/2026/04/dr-maria-charalambous-ivanova-portrait-hd-mobile.webp' );
	?>
	<link rel="preload" as="image" href="<?php echo esc_url( $mobile ); ?>" media="(max-width: 768px)" fetchpriority="high">
	<link rel="preload" as="image" href="<?php echo esc_url( $desktop ); ?>" media="(min-width: 769px)" fetchpriority="high">
	<?php
}
add_action( 'wp_head', 'mci_preload_hero_image', 1 );

/**
 * Add defer attribute to non-critical scripts.
 */
function mci_defer_scripts( $tag, $handle, $src ) {
	$defer_handles = array( 'swiper', 'mci-home-hero-slider', 'mci-clinic-slider', 'lightgallery', 'lg-thumbnail', 'lg-zoom' );
	if ( in_array( $handle, $defer_handles, true ) ) {
		return str_replace( ' src=', ' defer src=', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'mci_defer_scripts', 10, 3 );

/**
 * Load non-critical CSS asynchronously to remove render-blocking requests.
 * Uses the rel="preload" + onload pattern with a <noscript> fallback.
 * style.css and home-v2.css stay blocking — they contain above-the-fold styles.
 */
function mci_async_styles( $html, $handle ) {
	$async_handles = array(
		'mci-animations',
		'swiper',
		'mci-home-v2-clinic-slider',
		'mci-home-v2-hero-slider',
		'mci-services-hero-slider',
		'lightgallery',
	);
	if ( in_array( $handle, $async_handles, true ) ) {
		$async = str_replace( "rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html );
		return $async . '<noscript>' . $html . '</noscript>';
	}
	return $html;
}
add_filter( 'style_loader_tag', 'mci_async_styles', 10, 2 );

/**
 * Handle contact form submission.
 */
function mci_handle_contact_form() {
	$is_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;

	if (
		! isset( $_POST['mci_contact_nonce'] ) ||
		! wp_verify_nonce( $_POST['mci_contact_nonce'], 'mci_contact_form_nonce' )
	) {
		if ( $is_ajax ) {
			wp_send_json_error( 'Invalid nonce.' );
		}
		wp_safe_redirect( home_url( '/contact/?contact=error' ) );
		exit;
	}

	$name    = sanitize_text_field( $_POST['contact_name'] ?? '' );
	$phone   = sanitize_text_field( $_POST['contact_phone'] ?? '' );
	$email   = sanitize_email( $_POST['contact_email'] ?? '' );
	$message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

	// Email 1: Admin notification (plain-text).
	$admin_headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $email ) {
		$admin_headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	$admin_body = "Name: {$name}\nPhone: {$phone}\nEmail: {$email}\n\nMessage:\n{$message}";
	$admin_sent = wp_mail(
		array( 'david@balian.cy', 'info@dentalartcliniclimassol.com' ),
		'Dental Art Clinic Has a New Form Submission',
		$admin_body,
		$admin_headers
	);

	// Email 2: User confirmation (HTML).
	$user_sent = false;
	if ( $email ) {
		$esc_name    = esc_html( $name );
		$esc_phone   = esc_html( $phone );
		$esc_email   = esc_html( $email );
		$esc_message = nl2br( esc_html( $message ) );

		$html_body = '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background-color:#f5f5f7;font-family:\'Manrope\',\'Helvetica Neue\',Arial,sans-serif;color:#1d1d1f;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f5f7;">
<tr><td align="center" style="padding:40px 20px;">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);">

<!-- Gold accent line -->
<tr><td style="height:4px;background-color:#a89377;font-size:0;line-height:0;">&nbsp;</td></tr>

<!-- Logo -->
<tr><td align="center" style="padding:32px 40px 24px;">
<div style="display:inline-block;background-color:#ffffff;border-radius:8px;padding:12px 16px;">
<img src="' . esc_url( home_url( '/wp-content/uploads/2026/02/horizontal-logo-gold.avif' ) ) . '" alt="Dental Art Clinic" width="220" style="display:block;max-width:220px;height:auto;" />
</div>
</td></tr>

<!-- Greeting & body -->
<tr><td style="padding:0 40px 24px;">
<p style="margin:0 0 16px;font-size:16px;line-height:1.6;color:#1d1d1f;">Dear ' . $esc_name . ',</p>
<p style="margin:0 0 24px;font-size:16px;line-height:1.6;color:#1d1d1f;">Thank you for reaching out to Dental Art Clinic. We have received your message and will get back to you as soon as possible.</p>
</td></tr>

<!-- Submitted details -->
<tr><td style="padding:0 40px 24px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e5e5e7;border-radius:8px;overflow:hidden;">
<tr><td style="padding:16px 20px 12px;border-bottom:1px solid #e5e5e7;background-color:#fafafa;">
<p style="margin:0;font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#6e6e73;">Your Submission</p>
</td></tr>
<tr><td style="padding:16px 20px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0">
<tr><td style="padding:4px 0;font-size:14px;color:#6e6e73;width:80px;vertical-align:top;">Name</td><td style="padding:4px 0;font-size:14px;color:#1d1d1f;">' . $esc_name . '</td></tr>
<tr><td style="padding:4px 0;font-size:14px;color:#6e6e73;vertical-align:top;">Phone</td><td style="padding:4px 0;font-size:14px;color:#1d1d1f;">' . $esc_phone . '</td></tr>
<tr><td style="padding:4px 0;font-size:14px;color:#6e6e73;vertical-align:top;">Email</td><td style="padding:4px 0;font-size:14px;color:#1d1d1f;">' . $esc_email . '</td></tr>
<tr><td style="padding:8px 0 4px;font-size:14px;color:#6e6e73;vertical-align:top;">Message</td><td style="padding:8px 0 4px;font-size:14px;color:#1d1d1f;line-height:1.5;">' . $esc_message . '</td></tr>
</table>
</td></tr>
</table>
</td></tr>

<!-- Contact info -->
<tr><td style="padding:0 40px 32px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-top:1px solid #e5e5e7;padding-top:20px;">
<tr><td style="padding-top:20px;">
<p style="margin:0 0 8px;font-size:14px;line-height:1.6;color:#6e6e73;">If you need to reach us directly:</p>
<p style="margin:0 0 4px;font-size:14px;color:#3d342f;">&#128222; +357 25 377757</p>
<p style="margin:0 0 4px;font-size:14px;color:#3d342f;">&#9993; info@dentalartcliniclimassol.com</p>
<p style="margin:0;font-size:14px;color:#3d342f;">&#128205; PRIMO AMARI, Walter Gropius 49-49, Floor 1, Apt. 101, Limassol 3076, Cyprus</p>
</td></tr>
</table>
</td></tr>

<!-- Footer -->
<tr><td style="padding:20px 40px;background-color:#fafafa;border-top:1px solid #e5e5e7;">
<p style="margin:0;font-size:12px;color:#6e6e73;text-align:center;">Dental Art Clinic &mdash; Limassol, Cyprus</p>
</td></tr>

</table>
</td></tr>
</table>
</body>
</html>';

		$user_headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: Dental Art Clinic <info@dentalartcliniclimassol.com>',
		);

		$user_sent = wp_mail(
			$email,
			'Thank you for contacting Dental Art Clinic',
			$html_body,
			$user_headers
		);
	}

	$success = $admin_sent && ( $user_sent || ! $email );

	if ( $is_ajax ) {
		$success ? wp_send_json_success() : wp_send_json_error();
	}

	$status    = $success ? 'success' : 'error';
	$form_lang = sanitize_text_field( $_POST['mci_form_lang'] ?? 'en' );
	$prefix    = ( $form_lang && $form_lang !== 'en' ) ? '/' . $form_lang : '';
	wp_safe_redirect( home_url( $prefix . '/contact/?contact=' . $status ) );
	exit;
}
add_action( 'admin_post_mci_contact_form', 'mci_handle_contact_form' );
add_action( 'admin_post_nopriv_mci_contact_form', 'mci_handle_contact_form' );
add_action( 'wp_ajax_mci_contact_form', 'mci_handle_contact_form' );
add_action( 'wp_ajax_nopriv_mci_contact_form', 'mci_handle_contact_form' );

/**
 * One-time menu setup. Runs once on next admin load, then disables itself.
 * Delete the 'mci_menus_built' option to re-run.
 */
function mci_setup_menus_once() {
	if ( get_option( 'mci_menus_built' ) === '3' ) {
		return;
	}

	// Translated nav labels per language.
	$labels = array(
		'en' => array(
			'about'   => 'About',
			'services' => 'Services',
			'gallery' => 'Gallery',
			'contact' => 'Contact',
		),
		'el' => array(
			'about'   => 'Σχετικά',
			'services' => 'Υπηρεσίες',
			'gallery' => 'Γκαλερί',
			'contact' => 'Επικοινωνία',
		),
		'ru' => array(
			'about'   => 'О клинике',
			'services' => 'Услуги',
			'gallery' => 'Галерея',
			'contact' => 'Контакты',
		),
	);

	// Menu locations to build: location slug => [ display name, language ].
	$menus_to_build = array(
		'primary'    => array( 'name' => 'Primary Menu',          'lang' => 'en' ),
		'primary-el' => array( 'name' => 'Primary Menu (Greek)',   'lang' => 'el' ),
		'primary-ru' => array( 'name' => 'Primary Menu (Russian)', 'lang' => 'ru' ),
		'footer'     => array( 'name' => 'Footer Menu',            'lang' => 'en' ),
		'footer-el'  => array( 'name' => 'Footer Menu (Greek)',    'lang' => 'el' ),
		'footer-ru'  => array( 'name' => 'Footer Menu (Russian)',  'lang' => 'ru' ),
	);

	$existing_locations = get_nav_menu_locations();

	// Delete any menus currently assigned to these locations.
	foreach ( $menus_to_build as $location => $config ) {
		if ( ! empty( $existing_locations[ $location ] ) ) {
			$old = wp_get_nav_menu_object( $existing_locations[ $location ] );
			if ( $old ) {
				wp_delete_nav_menu( $old->term_id );
			}
		}
	}

	// Resolve page IDs once (slugs are the same across all languages).
	$page_ids = array();
	foreach ( array_keys( $labels['en'] ) as $slug ) {
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $page ) {
			$page_ids[ $slug ] = $page->ID;
		}
	}

	$location_map = $existing_locations;

	foreach ( $menus_to_build as $location => $config ) {
		$menu_id = wp_create_nav_menu( $config['name'] );
		if ( is_wp_error( $menu_id ) ) {
			continue;
		}

		$lang         = $config['lang'];
		$lang_labels  = $labels[ $lang ];

		foreach ( $page_ids as $slug => $page_id ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-object-id' => $page_id,
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-title'     => $lang_labels[ $slug ],
				'menu-item-status'    => 'publish',
			) );
		}

		$location_map[ $location ] = $menu_id;
	}

	set_theme_mod( 'nav_menu_locations', $location_map );
	update_option( 'mci_menus_built', '3' );
}
add_action( 'admin_init', 'mci_setup_menus_once' );
