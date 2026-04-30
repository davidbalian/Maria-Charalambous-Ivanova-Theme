<?php
/**
 * Multilingual support — language detection, URL rewriting, translation helpers.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =========================================================================
   1. Supported Languages
   ========================================================================= */

define( 'MCI_LANGUAGES', array( 'en', 'ru', 'el' ) );
define( 'MCI_DEFAULT_LANG', 'en' );

/* =========================================================================
   2. Language Detection
   ========================================================================= */

/**
 * Get the current language from the URL path.
 */
function mci_get_current_lang() {
	static $lang = null;
	if ( $lang !== null ) {
		return $lang;
	}

	// Check query var first (set by rewrite rules).
	$qv = get_query_var( 'lang', '' );
	if ( $qv && in_array( $qv, MCI_LANGUAGES, true ) ) {
		$lang = $qv;
		return $lang;
	}

	// Parse from REQUEST_URI as fallback.
	$path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );
	$segments = explode( '/', $path );
	if ( ! empty( $segments[0] ) && in_array( $segments[0], array( 'ru', 'el' ), true ) ) {
		$lang = $segments[0];
		return $lang;
	}

	$lang = MCI_DEFAULT_LANG;
	return $lang;
}

/* =========================================================================
   3. Query Var Registration
   ========================================================================= */

function mci_register_lang_query_var( $vars ) {
	$vars[] = 'lang';
	return $vars;
}
add_filter( 'query_vars', 'mci_register_lang_query_var' );

/* =========================================================================
   4. Rewrite Rules
   ========================================================================= */

function mci_i18n_rewrite_rules() {
	// Front page in alternate language.
	add_rewrite_rule(
		'^(ru|el)/?$',
		'index.php?lang=$matches[1]',
		'top'
	);

	// Inner pages in alternate language.
	add_rewrite_rule(
		'^(ru|el)/(.+?)/?$',
		'index.php?lang=$matches[1]&pagename=$matches[2]',
		'top'
	);
}
add_action( 'init', 'mci_i18n_rewrite_rules' );

/**
 * When lang is set but no pagename, serve the static front page.
 */
function mci_i18n_pre_get_posts( $query ) {
	if ( ! $query->is_main_query() || is_admin() ) {
		return;
	}

	$lang     = $query->get( 'lang' );
	$pagename = $query->get( 'pagename' );

	if ( $lang && ! $pagename ) {
		$front_page_id = (int) get_option( 'page_on_front' );
		if ( $front_page_id ) {
			$query->set( 'page_id', $front_page_id );
			$query->set( 'post_type', 'page' );
			$query->is_home = false;
			$query->is_page = true;
			$query->is_singular = true;
		}
	}
}
add_action( 'pre_get_posts', 'mci_i18n_pre_get_posts' );

/**
 * Flush rewrite rules on theme activation.
 */
function mci_i18n_flush_rewrites() {
	mci_i18n_rewrite_rules();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mci_i18n_flush_rewrites' );

/**
 * Auto-flush rewrite rules once when i18n version changes.
 * This ensures rules are registered even when the theme is already active.
 */
function mci_i18n_maybe_flush_rewrites() {
	if ( get_option( 'mci_i18n_rewrite_version' ) !== '1.0' ) {
		flush_rewrite_rules();
		update_option( 'mci_i18n_rewrite_version', '1.0' );
	}
}
add_action( 'init', 'mci_i18n_maybe_flush_rewrites', 20 );

/**
 * Prevent WordPress canonical redirect from sending /ru/ and /el/ URLs
 * back to their English equivalents.
 */
function mci_i18n_prevent_canonical_redirect( $redirect_url, $requested_url ) {
	$path = trim( parse_url( $requested_url, PHP_URL_PATH ), '/' );
	$segments = explode( '/', $path );

	if ( ! empty( $segments[0] ) && in_array( $segments[0], array( 'ru', 'el' ), true ) ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'mci_i18n_prevent_canonical_redirect', 10, 2 );

/* =========================================================================
   5. Translation Helpers
   ========================================================================= */

/**
 * Lazy-load and cache translations.
 */
function mci_get_translations( $lang ) {
	static $cache = array();

	if ( isset( $cache[ $lang ] ) ) {
		return $cache[ $lang ];
	}

	if ( $lang === MCI_DEFAULT_LANG ) {
		$cache[ $lang ] = array();
		return $cache[ $lang ];
	}

	$file = get_template_directory() . '/inc/translations/' . $lang . '.php';
	if ( file_exists( $file ) ) {
		$cache[ $lang ] = include $file;
	} else {
		$cache[ $lang ] = array();
	}

	return $cache[ $lang ];
}

/**
 * Translate a string. English key → translated value.
 * Returns the key itself for English or missing translations.
 */
function mci_t( $key ) {
	$lang = mci_get_current_lang();
	if ( $lang === MCI_DEFAULT_LANG ) {
		return $key;
	}

	$translations = mci_get_translations( $lang );
	return isset( $translations[ $key ] ) ? $translations[ $key ] : $key;
}

/**
 * Echo escaped translated string.
 */
function mci_te( $key ) {
	echo esc_html( mci_t( $key ) );
}

/**
 * Translate a string that contains {accent}...{/accent} markers.
 * Returns the translated string with the marked portion wrapped in
 * <span class="accent-font">...</span>.
 */
function mci_t_accent( $key ) {
	$text = mci_t( $key );
	return preg_replace(
		'/\{accent\}(.+?)\{\/accent\}/',
		'<span class="accent-font">$1</span>',
		$text
	);
}

/* =========================================================================
   6. Language-Aware URL Helpers
   ========================================================================= */

/**
 * Build a language-aware internal URL.
 * e.g. mci_url('/services/') → '/ru/services/' when current lang is Russian.
 */
function mci_url( $path = '/' ) {
	$lang = mci_get_current_lang();
	$path = '/' . ltrim( $path, '/' );

	if ( $lang === MCI_DEFAULT_LANG ) {
		return home_url( $path );
	}

	return home_url( '/' . $lang . $path );
}

/**
 * Get URL for the current page in a different language (for switcher).
 */
function mci_lang_url( $target_lang ) {
	$uri  = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );

	// Strip existing language prefix.
	$segments = explode( '/', $uri );
	if ( ! empty( $segments[0] ) && in_array( $segments[0], array( 'ru', 'el' ), true ) ) {
		array_shift( $segments );
	}
	$clean_path = implode( '/', $segments );

	if ( $target_lang === MCI_DEFAULT_LANG ) {
		return home_url( '/' . $clean_path . ( $clean_path ? '/' : '' ) );
	}

	return home_url( '/' . $target_lang . '/' . $clean_path . ( $clean_path ? '/' : '' ) );
}

/* =========================================================================
   7. Browser Detection Redirect (first visit only)
   ========================================================================= */

function mci_browser_language_redirect() {
	// Only on the root URL with no language prefix.
	$uri = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );
	if ( $uri !== '' ) {
		return;
	}

	// Don't redirect if cookie is already set.
	if ( isset( $_COOKIE['mci_lang'] ) ) {
		return;
	}

	// Don't redirect bots.
	$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
	if ( preg_match( '/bot|crawl|spider|slurp|googlebot|bingbot/i', $ua ) ) {
		return;
	}

	$accept = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
	if ( ! $accept ) {
		return;
	}

	// Parse Accept-Language header.
	$preferred = null;
	$langs = explode( ',', $accept );
	$best_q = 0;
	foreach ( $langs as $entry ) {
		$parts = explode( ';', trim( $entry ) );
		$code  = strtolower( trim( $parts[0] ) );
		$q     = 1.0;
		if ( isset( $parts[1] ) && preg_match( '/q=([\d.]+)/', $parts[1], $m ) ) {
			$q = (float) $m[1];
		}

		// Match ru or el (including variants like ru-RU, el-GR).
		$short = substr( $code, 0, 2 );
		if ( in_array( $short, array( 'ru', 'el' ), true ) && $q > $best_q ) {
			$best_q    = $q;
			$preferred = $short;
		}
	}

	if ( $preferred ) {
		setcookie( 'mci_lang', $preferred, time() + YEAR_IN_SECONDS, '/', '', is_ssl(), false );
		wp_safe_redirect( home_url( '/' . $preferred . '/' ) );
		exit;
	}

	// Default: set English cookie so we don't check again.
	setcookie( 'mci_lang', 'en', time() + YEAR_IN_SECONDS, '/', '', is_ssl(), false );
}
add_action( 'template_redirect', 'mci_browser_language_redirect' );

/* =========================================================================
   8. Cookie Persistence
   ========================================================================= */

function mci_update_lang_cookie() {
	$lang = mci_get_current_lang();
	if ( ! isset( $_COOKIE['mci_lang'] ) || $_COOKIE['mci_lang'] !== $lang ) {
		setcookie( 'mci_lang', $lang, time() + YEAR_IN_SECONDS, '/', '', is_ssl(), false );
	}
}
add_action( 'template_redirect', 'mci_update_lang_cookie', 20 );

/* =========================================================================
   9. HTML lang Attribute Override
   ========================================================================= */

function mci_override_language_attributes( $output ) {
	$lang = mci_get_current_lang();
	$map  = array(
		'en' => 'en-US',
		'ru' => 'ru',
		'el' => 'el',
	);

	$html_lang = isset( $map[ $lang ] ) ? $map[ $lang ] : 'en-US';
	return preg_replace( '/lang="[^"]*"/', 'lang="' . esc_attr( $html_lang ) . '"', $output );
}
add_filter( 'language_attributes', 'mci_override_language_attributes' );

/* =========================================================================
   10. Navigation Menu Language Support
   ========================================================================= */

/**
 * Dynamically rewrite menu item URLs with language prefix.
 */
function mci_nav_menu_lang_urls( $items ) {
	$lang = mci_get_current_lang();
	if ( $lang === MCI_DEFAULT_LANG ) {
		return $items;
	}

	$home      = untrailingslashit( home_url() );
	$home_norm = preg_replace( '#^https?://#', '', $home );

	foreach ( $items as &$item ) {
		// Normalise protocol so http/https mismatches don't break the check.
		$url_norm = preg_replace( '#^https?://#', '', $item->url );
		if ( strpos( $url_norm, $home_norm ) === 0 ) {
			$path = substr( $url_norm, strlen( $home_norm ) );
			// Don't double-prefix.
			if ( ! preg_match( '#^/(ru|el)(/|$)#', $path ) ) {
				$item->url = $home . '/' . $lang . $path;
			}
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'mci_nav_menu_lang_urls' );
