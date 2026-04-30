<?php
/**
 * llms.txt — guidance file for AI crawlers / LLMs.
 * Served dynamically at the WordPress root — /llms.txt — via rewrite rules.
 * Spec: https://llmstxt.org/
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =========================================================================
   1. Rewrite rule — /llms.txt
   ========================================================================= */

function mci_llms_register_rewrite() {
	add_rewrite_rule( '^llms\.txt$', 'index.php?mci_llms=1', 'top' );
}
add_action( 'init', 'mci_llms_register_rewrite' );

function mci_llms_query_vars( $vars ) {
	$vars[] = 'mci_llms';
	return $vars;
}
add_filter( 'query_vars', 'mci_llms_query_vars' );

/**
 * Flush rewrite rules when the theme is activated so /llms.txt resolves immediately.
 */
function mci_llms_flush_on_activation() {
	mci_llms_register_rewrite();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mci_llms_flush_on_activation' );

/* =========================================================================
   2. Request handler
   ========================================================================= */

function mci_llms_template_redirect() {
	if ( ! get_query_var( 'mci_llms' ) ) {
		return;
	}
	mci_llms_output();
	exit;
}
add_action( 'template_redirect', 'mci_llms_template_redirect' );

/* =========================================================================
   3. Output
   ========================================================================= */

function mci_llms_output() {
	header( 'Content-Type: text/markdown; charset=UTF-8' );
	header( 'X-Robots-Tag: index, follow' );

	$biz       = mci_seo_get_business_data();
	$services  = mci_get_services_data();
	$home      = untrailingslashit( home_url() );

	$out  = "# {$biz['name']}\n\n";
	$out .= "> Modern dental clinic in {$biz['city']}, Cyprus, founded and led by {$biz['doctor_name']} ({$biz['doctor_title']}). Specialising in cosmetic dentistry, premium E.max veneers, Smilers clear aligners, dental implants, crowns and bridges, endodontics, and full mouth rehabilitation. Practising since {$biz['founding_year']}.\n\n";

	$out .= "## About the clinic\n\n";
	$out .= "- **Lead dentist:** {$biz['doctor_name']}, {$biz['doctor_title']} — graduate of {$biz['doctor_alumni']} ({$biz['doctor_grad']}), practising since {$biz['doctor_since']}.\n";
	$out .= "- **Address:** {$biz['street']}, {$biz['city']} {$biz['postal']}, Cyprus.\n";
	$out .= "- **Phone:** {$biz['phone']}\n";
	$out .= "- **Email:** {$biz['email']}\n";
	$out .= "- **Languages spoken:** " . implode( ', ', $biz['languages'] ) . ", Bulgarian.\n";
	$out .= "- **Founded:** {$biz['founding_year']}\n";
	$out .= "- **Map:** {$biz['maps_url']}\n\n";

	$out .= "### Opening hours\n\n";
	foreach ( $biz['opening_spec'] as $spec ) {
		$days = implode( ' & ', $spec['days'] );
		$out .= "- **{$days}:** {$spec['opens']}–{$spec['closes']}\n";
	}
	$out .= "\n";

	$out .= "## Pages\n\n";
	$pages = array(
		array( 'slug' => '',               'title' => 'Home',           'desc' => 'Overview of the clinic, the doctor, hero photos, services summary, before/after gallery preview, and consultation booking.' ),
		array( 'slug' => 'about',          'title' => 'About',          'desc' => "Background, qualifications, and treatment philosophy of {$biz['doctor_name']}." ),
		array( 'slug' => 'services',       'title' => 'Services',       'desc' => 'Full list of dental services with detailed descriptions of each treatment offered at the clinic.' ),
		array( 'slug' => 'gallery',        'title' => 'Gallery',        'desc' => 'Before-and-after smile transformation photos plus images of the clinic interior and equipment.' ),
		array( 'slug' => 'contact',        'title' => 'Contact',        'desc' => 'Booking form, address, phone, email, opening hours, and Google Maps location.' ),
		array( 'slug' => 'privacy-policy', 'title' => 'Privacy Policy', 'desc' => 'How patient and visitor data is collected, used, and protected under GDPR.' ),
	);
	foreach ( $pages as $page ) {
		$url = $page['slug'] ? "{$home}/{$page['slug']}/" : "{$home}/";
		$out .= "- [{$page['title']}]({$url}): {$page['desc']}\n";
	}
	$out .= "\n";

	$out .= "## Languages\n\n";
	$out .= "The site is available in three languages with full content parity. URLs are prefixed with the language code (English uses no prefix).\n\n";
	$out .= "- [English](" . $home . "/) — default\n";
	$out .= "- [Russian]({$home}/ru/) — `/ru/`\n";
	$out .= "- [Greek]({$home}/el/) — `/el/`\n\n";
	$out .= "Every page has `hreflang` alternates and an entry in [the sitemap]({$home}/sitemap.xml).\n\n";

	$out .= "## Services offered\n\n";
	foreach ( $services as $svc ) {
		$out .= "- **{$svc['title']}** — {$svc['desc']}\n";
	}
	$out .= "- **Premium E.max Veneers** — Ultra-thin, high-strength ceramic veneers digitally designed to match facial features. Cosmetic flagship treatment at the clinic.\n";
	$out .= "- **Smilers Aligners** — Discreet, virtually invisible clear aligners for orthodontic correction without traditional braces.\n\n";

	$out .= "## Specialities\n\n";
	$out .= "- " . implode( "\n- ", $biz['medical_specialties'] ) . "\n\n";

	$out .= "## Optional\n\n";
	$out .= "- [XML Sitemap]({$home}/sitemap.xml): Machine-readable list of all pages with `hreflang` annotations across the three languages.\n";
	$out .= "- [Facebook]({$biz['social']['facebook']}): Clinic Facebook page.\n";
	$out .= "- [Instagram]({$biz['social']['instagram']}): Clinic Instagram page with case photos.\n";

	echo $out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- markdown body served as text/markdown.
}
