<?php
/**
 * SEO functions — meta tags, Open Graph, Twitter Cards, JSON-LD structured data.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =========================================================================
   1. Business Data (Single Source of Truth)
   ========================================================================= */

/**
 * Return all NAP data, hours, coordinates, and image URLs for the clinic.
 */
function mci_seo_get_business_data() {
	$theme_uri = get_template_directory_uri();

	return array(
		'name'           => 'Dental Art Clinic Limassol',
		'legal_name'     => 'Dental Art Clinic',
		'url'            => home_url( '/' ),
		'phone'          => '+357 25 377757',
		'phone_raw'      => '+35725377757',
		'email'          => 'info@dentalartcliniclimassol.com',
		'street'         => 'PRIMO AMARI',
		'city'           => 'Limassol',
		'postal'         => '3076',
		'country'        => 'CY',
		'region'         => 'Limassol',
		'lat'            => 34.6841,
		'lng'            => 33.0379,
		'price_range'    => '€€',
		'founding_year'  => 2008,
		'doctor_name'    => 'Dr. Maria Charalambous-Ivanova',
		'doctor_title'   => 'DMD, MSD',
		'doctor_since'   => 2008,
		'doctor_alumni'  => 'Medical University of Sofia',
		'doctor_grad'    => 2007,
		'logo'           => home_url( '/wp-content/uploads/2026/02/horizontal-logo-gold.avif' ),
		// OG/Twitter images must be JPEG or PNG for broad social platform compatibility (AVIF/WebP often fail on LinkedIn, X, Discord, Slack).
		'image_clinic'   => home_url( '/wp-content/uploads/2026/03/dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment-1.png' ),
		'image_doctor'   => home_url( '/wp-content/uploads/2026/03/dr-maria-charalambous-ivanova-portrait-1.png' ),
		'image_gallery'  => home_url( '/wp-content/uploads/2026/03/before-and-after-at-dental-art-clinic-limassol-1-1.png' ),
		'maps_url'       => 'https://maps.app.goo.gl/JNcaT74bPoj6v4e57',
		'opening_hours'  => array(
			'Mo 08:00-17:30',
			'We 08:00-17:30',
			'Tu 08:30-17:30',
			'Th 08:30-17:30',
			'Fr 08:30-13:00',
		),
		'opening_spec'   => array(
			array( 'days' => array( 'Monday', 'Wednesday' ), 'opens' => '08:00', 'closes' => '17:30' ),
			array( 'days' => array( 'Tuesday', 'Thursday' ), 'opens' => '08:30', 'closes' => '17:30' ),
			array( 'days' => array( 'Friday' ), 'opens' => '08:30', 'closes' => '13:00' ),
		),
		'social'         => array(
			'facebook'  => 'https://www.facebook.com/dentalartcliniclimassol',
			'instagram' => 'https://www.instagram.com/dentalartcliniclimassol',
		),
		'languages'      => array( 'English', 'Russian', 'Greek' ),
		'medical_specialties' => array(
			'General Dentistry',
			'Cosmetic Dentistry',
			'Endodontics',
			'Prosthodontics',
			'Periodontics',
			'Orthodontics',
		),
	);
}

/* =========================================================================
   2. Shared Services Data (language-aware)
   ========================================================================= */

/**
 * Return the 11-service array used by both the template and JSON-LD.
 */
function mci_get_services_data() {
	return array(
		array(
			'title' => mci_t( 'General Dental Examination & Prevention' ),
			'desc'  => mci_t( 'Regular dental check-ups help detect potential problems early and maintain optimal oral health through preventive care and professional advice.' ),
		),
		array(
			'title' => mci_t( 'Professional Teeth Cleaning' ),
			'desc'  => mci_t( 'Removal of plaque, tartar, and stains to promote healthy gums and a brighter, healthier smile.' ),
		),
		array(
			'title' => mci_t( 'Dental Fillings' ),
			'desc'  => mci_t( 'Treatment of tooth decay using modern, aesthetic materials that restore both function and natural appearance.' ),
		),
		array(
			'title' => mci_t( 'Root Canal Treatment (Endodontics)' ),
			'desc'  => mci_t( 'Advanced treatment for infected or inflamed tooth nerves, allowing the natural tooth to be preserved and pain to be relieved.' ),
		),
		array(
			'title' => mci_t( 'Tooth Extractions' ),
			'desc'  => mci_t( 'Safe and gentle removal of teeth when they cannot be restored, always prioritizing patient comfort.' ),
		),
		array(
			'title' => mci_t( 'Cosmetic Dentistry' ),
			'desc'  => mci_t( 'A range of treatments designed to enhance the appearance of your smile, including teeth whitening and aesthetic restorations.' ),
		),
		array(
			'title' => mci_t( 'Crowns & Bridges' ),
			'desc'  => mci_t( 'Durable restorations used to repair damaged teeth or replace missing ones, improving both function and aesthetics.' ),
		),
		array(
			'title' => mci_t( 'Dental Implants' ),
			'desc'  => mci_t( 'A modern and long-lasting solution for replacing missing teeth, restoring both confidence and oral function.' ),
		),
		array(
			'title' => mci_t( 'Dentures' ),
			'desc'  => mci_t( 'Full or partial removable dentures designed to restore chewing ability, speech, and smile aesthetics.' ),
		),
		array(
			'title' => mci_t( 'Periodontal Treatment' ),
			'desc'  => mci_t( 'Diagnosis and treatment of gum diseases such as gingivitis and periodontitis to protect the health of your gums and supporting bone.' ),
		),
		array(
			'title' => mci_t( 'Emergency Dental Care' ),
			'desc'  => mci_t( 'Prompt care for dental emergencies including severe toothache, broken teeth, infections, or other urgent dental conditions.' ),
		),
	);
}

/* =========================================================================
   3. Helper — detect page by slug or template
   ========================================================================= */

function mci_seo_is_page( $slug ) {
	return is_page( $slug ) || is_page_template( 'page-' . $slug . '.php' );
}

/* =========================================================================
   4. Meta Titles — document_title_parts filter
   ========================================================================= */

function mci_seo_document_title_parts( $title_parts ) {
	$lang     = mci_get_current_lang();
	$site_tag = mci_t( 'seo_site_name' );
	// Fallback if key isn't translated.
	if ( $site_tag === 'seo_site_name' ) {
		$site_tag = 'Dental Art Clinic Limassol';
	}

	if ( is_front_page() ) {
		$t = mci_t( 'seo_title_home' );
		$title_parts['title'] = ( $t !== 'seo_title_home' )
			? $t
			: 'Dentist in Limassol | Dental Art Clinic by Dr. Maria Charalambous-Ivanova';
		unset( $title_parts['tagline'] );
		return $title_parts;
	}

	if ( mci_seo_is_page( 'about' ) ) {
		$t = mci_t( 'seo_title_about' );
		$title_parts['title'] = ( $t !== 'seo_title_about' ) ? $t : 'About Dr. Maria Charalambous-Ivanova';
		$title_parts['site']  = ( $lang !== 'en' ) ? $site_tag : 'Dentist in Limassol';
	} elseif ( mci_seo_is_page( 'services' ) ) {
		$t = mci_t( 'seo_title_services' );
		$title_parts['title'] = ( $t !== 'seo_title_services' ) ? $t : 'Dental Services in Limassol';
		$title_parts['site']  = $site_tag;
	} elseif ( mci_seo_is_page( 'gallery' ) ) {
		$t = mci_t( 'seo_title_gallery' );
		$title_parts['title'] = ( $t !== 'seo_title_gallery' ) ? $t : 'Smile Transformations Gallery';
		$title_parts['site']  = $site_tag;
	} elseif ( mci_seo_is_page( 'contact' ) ) {
		$t = mci_t( 'seo_title_contact' );
		$title_parts['title'] = ( $t !== 'seo_title_contact' ) ? $t : 'Contact & Book Appointment';
		$title_parts['site']  = $site_tag;
	} elseif ( mci_seo_is_page( 'privacy-policy' ) ) {
		$t = mci_t( 'seo_title_privacy' );
		$title_parts['title'] = ( $t !== 'seo_title_privacy' ) ? $t : 'Privacy Policy';
		$title_parts['site']  = $site_tag;
	} elseif ( is_404() ) {
		$title_parts['title'] = mci_t( 'Page Not Found' );
		$title_parts['site']  = $site_tag;
	} elseif ( is_search() ) {
		$title_parts['title'] = 'Search Results';
		$title_parts['site']  = $site_tag;
	} elseif ( is_singular() ) {
		$title_parts['site'] = $site_tag;
	} elseif ( is_archive() ) {
		$title_parts['site'] = $site_tag;
	}

	return $title_parts;
}

function mci_seo_document_title_separator( $sep ) {
	return '|';
}

/* =========================================================================
   5. Meta Descriptions — wp_head hook
   ========================================================================= */

function mci_seo_meta_description() {
	$desc = '';
	$lang = mci_get_current_lang();

	if ( is_front_page() ) {
		$t = mci_t( 'seo_desc_home' );
		$desc = ( $t !== 'seo_desc_home' ) ? $t : 'Dental Art Clinic Limassol — modern dental clinic by Dr. Maria Charalambous-Ivanova offering cosmetic dentistry, dental implants, veneers, aligners, and emergency dental care. Book your appointment today.';
	} elseif ( mci_seo_is_page( 'about' ) ) {
		$t = mci_t( 'seo_desc_about' );
		$desc = ( $t !== 'seo_desc_about' ) ? $t : 'Meet Dr. Maria Charalambous-Ivanova, DMD, MSD — founder of Dental Art Clinic in Limassol. Practicing since 2008, specializing in composite veneers, Emax veneers, and full mouth rehabilitation.';
	} elseif ( mci_seo_is_page( 'services' ) ) {
		$t = mci_t( 'seo_desc_services' );
		$desc = ( $t !== 'seo_desc_services' ) ? $t : 'Full range of dental services at Dental Art Clinic Limassol — general check-ups, teeth cleaning, cosmetic dentistry, dental implants, crowns, bridges, veneers, aligners, and emergency care.';
	} elseif ( mci_seo_is_page( 'gallery' ) ) {
		$t = mci_t( 'seo_desc_gallery' );
		$desc = ( $t !== 'seo_desc_gallery' ) ? $t : 'View before and after smile transformations and clinic photos from Dental Art Clinic Limassol. See results of our cosmetic dentistry, veneers, and smile makeover treatments.';
	} elseif ( mci_seo_is_page( 'contact' ) ) {
		$t = mci_t( 'seo_desc_contact' );
		$desc = ( $t !== 'seo_desc_contact' ) ? $t : 'Contact Dental Art Clinic Limassol to book an appointment. Call +357 25 377757 or visit us at PRIMO AMARI, Limassol 3076, Cyprus. Mon & Wed 8AM–5:30PM, Tue & Thu 8:30AM–5:30PM, Fri 8:30AM–1PM.';
	} elseif ( mci_seo_is_page( 'privacy-policy' ) ) {
		$t = mci_t( 'seo_desc_privacy' );
		$desc = ( $t !== 'seo_desc_privacy' ) ? $t : 'Privacy policy for Dental Art Clinic Limassol. How we collect, use, and protect your personal data in compliance with GDPR.';
	} elseif ( is_singular() && ! is_front_page() ) {
		$post = get_queried_object();
		if ( $post && has_excerpt( $post->ID ) ) {
			$desc = wp_strip_all_tags( get_the_excerpt( $post ) );
		} elseif ( $post ) {
			$desc = wp_trim_words( wp_strip_all_tags( $post->post_content ), 25, '…' );
		}
	} elseif ( is_archive() ) {
		$desc = 'Latest dental health articles and tips from Dental Art Clinic Limassol.';
	}

	if ( $desc ) {
		$desc = mb_substr( $desc, 0, 160 );
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	}
}

/* =========================================================================
   6. Canonical URLs — wp_head hook (language-aware)
   ========================================================================= */

function mci_seo_canonical() {
	if ( is_search() || is_404() ) {
		return;
	}

	$url = mci_seo_current_url();

	if ( $url ) {
		echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	}
}

/* =========================================================================
   7. Robots Meta — wp_head hook
   ========================================================================= */

function mci_seo_robots() {
	$noindex = false;

	if ( is_search() || is_404() ) {
		$noindex = true;
	}

	if ( is_paged() ) {
		$noindex = true;
	}

	if ( $noindex ) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	} else {
		echo '<meta name="robots" content="index, follow">' . "\n";
	}
}

/* =========================================================================
   8. Hreflang Tags — wp_head hook
   ========================================================================= */

function mci_seo_hreflang() {
	// Get the current path without language prefix.
	$uri      = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ), '/' );
	$segments = explode( '/', $uri );
	if ( ! empty( $segments[0] ) && in_array( $segments[0], array( 'ru', 'el' ), true ) ) {
		array_shift( $segments );
	}
	$clean_path = implode( '/', $segments );
	$suffix     = $clean_path ? $clean_path . '/' : '';

	$hreflang_map = array(
		'en' => 'en',
		'ru' => 'ru',
		'el' => 'el',
	);

	foreach ( $hreflang_map as $lang => $hreflang ) {
		$prefix = ( $lang === 'en' ) ? '' : $lang . '/';
		$href   = home_url( '/' . $prefix . $suffix );
		echo '<link rel="alternate" hreflang="' . esc_attr( $hreflang ) . '" href="' . esc_url( $href ) . '">' . "\n";
	}

	// x-default points to English.
	echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( home_url( '/' . $suffix ) ) . '">' . "\n";
}

/* =========================================================================
   9. Open Graph Tags — wp_head hook (language-aware)
   ========================================================================= */

function mci_seo_open_graph() {
	$biz  = mci_seo_get_business_data();
	$lang = mci_get_current_lang();

	$og_title = wp_get_document_title();

	ob_start();
	mci_seo_meta_description();
	$meta_tag = ob_get_clean();
	$og_desc  = '';
	if ( preg_match( '/content="([^"]*)"/', $meta_tag, $m ) ) {
		$og_desc = $m[1];
	}

	$og_url  = mci_seo_current_url();
	$og_type = is_singular( 'post' ) ? 'article' : 'website';
	$og_image = mci_seo_get_og_image( $biz );

	// Language → OG locale map.
	$locale_map = array(
		'en' => 'en_US',
		'ru' => 'ru_RU',
		'el' => 'el_GR',
	);
	$current_locale = isset( $locale_map[ $lang ] ) ? $locale_map[ $lang ] : 'en_US';

	echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
	if ( $og_desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $og_desc ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $og_url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $biz['name'] ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	if ( $og_image ) {
		echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
		echo '<meta property="og:image:width" content="1200">' . "\n";
		echo '<meta property="og:image:height" content="630">' . "\n";
		$og_image_alt = mci_seo_get_og_image_alt();
		echo '<meta property="og:image:alt" content="' . esc_attr( $og_image_alt ) . '">' . "\n";
	}
	echo '<meta property="og:locale" content="' . esc_attr( $current_locale ) . '">' . "\n";

	// Alternate locales.
	foreach ( $locale_map as $l => $locale ) {
		if ( $l !== $lang ) {
			echo '<meta property="og:locale:alternate" content="' . esc_attr( $locale ) . '">' . "\n";
		}
	}
}

/**
 * Get alt text for the OG image based on current page.
 */
function mci_seo_get_og_image_alt() {
	$biz = mci_seo_get_business_data();

	if ( is_singular() && has_post_thumbnail() ) {
		$alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
		return $alt ? $alt : $biz['name'];
	}

	if ( mci_seo_is_page( 'about' ) ) {
		return $biz['doctor_name'] . ' — ' . $biz['name'];
	}
	if ( mci_seo_is_page( 'gallery' ) ) {
		return mci_t( 'Smile Transformations Gallery' ) . ' — ' . $biz['name'];
	}

	return $biz['name'] . ' — ' . mci_t( 'Dentist in Limassol' );
}

/**
 * Pick the best OG image for the current page.
 */
function mci_seo_get_og_image( $biz ) {
	if ( is_singular() && has_post_thumbnail() ) {
		return get_the_post_thumbnail_url( null, 'large' );
	}

	if ( mci_seo_is_page( 'about' ) ) {
		return $biz['image_doctor'];
	}
	if ( mci_seo_is_page( 'gallery' ) ) {
		return $biz['image_gallery'];
	}

	return $biz['image_clinic'];
}

/* =========================================================================
   10. Twitter Card Tags — wp_head hook
   ========================================================================= */

function mci_seo_twitter_cards() {
	$og_title = wp_get_document_title();

	ob_start();
	mci_seo_meta_description();
	$meta_tag = ob_get_clean();
	$og_desc  = '';
	if ( preg_match( '/content="([^"]*)"/', $meta_tag, $m ) ) {
		$og_desc = $m[1];
	}

	$biz      = mci_seo_get_business_data();
	$og_image = mci_seo_get_og_image( $biz );

	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $og_title ) . '">' . "\n";
	if ( $og_desc ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $og_desc ) . '">' . "\n";
	}
	if ( $og_image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
		echo '<meta name="twitter:image:alt" content="' . esc_attr( mci_seo_get_og_image_alt() ) . '">' . "\n";
	}
}

/* =========================================================================
   11. JSON-LD Structured Data — wp_footer hook
   ========================================================================= */

function mci_seo_json_ld() {
	$biz   = mci_seo_get_business_data();
	$lang  = mci_get_current_lang();
	$graph = array();

	// Language code map for inLanguage field.
	$in_language_map = array(
		'en' => 'en-US',
		'ru' => 'ru',
		'el' => 'el',
	);
	$in_language = isset( $in_language_map[ $lang ] ) ? $in_language_map[ $lang ] : 'en-US';

	// --- Dentist / MedicalBusiness schema (every page) ---
	$dentist = array(
		'@type'           => array( 'Dentist', 'MedicalBusiness' ),
		'@id'             => $biz['url'] . '#dentist',
		'name'            => $biz['name'],
		'url'             => $biz['url'],
		'telephone'       => $biz['phone_raw'],
		'email'           => $biz['email'],
		'priceRange'      => $biz['price_range'],
		'foundingDate'    => (string) $biz['founding_year'],
		'logo'            => array(
			'@type'      => 'ImageObject',
			'url'        => $biz['logo'],
		),
		'image'           => $biz['image_clinic'],
		'address'         => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $biz['street'],
			'addressLocality' => $biz['city'],
			'postalCode'      => $biz['postal'],
			'addressRegion'   => $biz['region'],
			'addressCountry'  => $biz['country'],
		),
		'geo'             => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => $biz['lat'],
			'longitude' => $biz['lng'],
		),
		'hasMap'          => $biz['maps_url'],
		'openingHoursSpecification' => array(),
		'sameAs'          => array_values( $biz['social'] ),
		'areaServed'      => array(
			array(
				'@type' => 'City',
				'name'  => 'Limassol',
			),
			array(
				'@type' => 'Country',
				'name'  => 'Cyprus',
			),
		),
		'availableLanguage' => array_map( function( $lang_name ) {
			return array(
				'@type' => 'Language',
				'name'  => $lang_name,
			);
		}, $biz['languages'] ),
		'medicalSpecialty' => $biz['medical_specialties'],
	);

	foreach ( $biz['opening_spec'] as $spec ) {
		foreach ( $spec['days'] as $day ) {
			$dentist['openingHoursSpecification'][] = array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => $day,
				'opens'     => $spec['opens'],
				'closes'    => $spec['closes'],
			);
		}
	}

	// Add services to Dentist on services page.
	if ( mci_seo_is_page( 'services' ) ) {
		$services_data = mci_get_services_data();
		$available     = array();
		foreach ( $services_data as $svc ) {
			$available[] = array(
				'@type'       => 'MedicalProcedure',
				'name'        => $svc['title'],
				'description' => $svc['desc'],
			);
		}
		$dentist['availableService'] = $available;
	}

	$graph[] = $dentist;

	// --- Person schema (Dr. Maria) ---
	$graph[] = array(
		'@type'             => 'Person',
		'@id'               => $biz['url'] . '#doctor',
		'name'              => $biz['doctor_name'],
		'jobTitle'          => 'Dentist',
		'honorificSuffix'   => $biz['doctor_title'],
		'image'             => $biz['image_doctor'],
		'worksFor'          => array( '@id' => $biz['url'] . '#dentist' ),
		'memberOf'          => array(
			'@type' => 'Organization',
			'name'  => $biz['name'],
		),
		'alumniOf'          => array(
			'@type' => 'CollegeOrUniversity',
			'name'  => $biz['doctor_alumni'],
		),
		'knowsLanguage'     => array( 'en', 'ru', 'el', 'bg' ),
		'hasOccupation'     => array(
			'@type'            => 'Occupation',
			'name'             => 'Dentist',
			'occupationLocation' => array(
				'@type' => 'Country',
				'name'  => 'Cyprus',
			),
			'educationRequirements' => 'DMD, MSD',
		),
	);

	// --- WebSite schema ---
	$website = array(
		'@type'             => 'WebSite',
		'@id'               => $biz['url'] . '#website',
		'name'              => $biz['name'],
		'url'               => $biz['url'],
		'inLanguage'        => array( 'en-US', 'ru', 'el' ),
		'publisher'         => array( '@id' => $biz['url'] . '#dentist' ),
		'potentialAction'   => array(
			'@type'       => 'SearchAction',
			'target'      => $biz['url'] . '?s={search_term_string}',
			'query-input' => 'required name=search_term_string',
		),
	);
	$graph[] = $website;

	// --- WebPage schema ---
	$webpage_type = 'WebPage';
	if ( mci_seo_is_page( 'about' ) ) {
		$webpage_type = 'AboutPage';
	} elseif ( mci_seo_is_page( 'contact' ) ) {
		$webpage_type = 'ContactPage';
	} elseif ( mci_seo_is_page( 'services' ) ) {
		$webpage_type = 'MedicalWebPage';
	} elseif ( mci_seo_is_page( 'gallery' ) ) {
		$webpage_type = 'CollectionPage';
	}

	$current_url = mci_seo_current_url();

	// Get meta description for WebPage schema.
	ob_start();
	mci_seo_meta_description();
	$meta_tag_wp = ob_get_clean();
	$wp_desc     = '';
	if ( preg_match( '/content="([^"]*)"/', $meta_tag_wp, $wp_m ) ) {
		$wp_desc = $wp_m[1];
	}

	$webpage = array(
		'@type'      => $webpage_type,
		'@id'        => $current_url . '#webpage',
		'url'        => $current_url,
		'name'       => wp_get_document_title(),
		'inLanguage' => $in_language,
		'isPartOf'   => array( '@id' => $biz['url'] . '#website' ),
	);

	if ( $wp_desc ) {
		$webpage['description'] = $wp_desc;
	}

	$graph[] = $webpage;

	// --- BlogPosting schema (single posts) ---
	if ( is_singular( 'post' ) ) {
		$post = get_queried_object();
		$posting = array(
			'@type'         => 'BlogPosting',
			'headline'      => get_the_title( $post ),
			'url'           => get_permalink( $post ),
			'inLanguage'    => $in_language,
			'datePublished' => get_the_date( 'c', $post ),
			'dateModified'  => get_the_modified_date( 'c', $post ),
			'author'        => array( '@id' => $biz['url'] . '#doctor' ),
			'publisher'     => array( '@id' => $biz['url'] . '#dentist' ),
			'mainEntityOfPage' => array( '@id' => get_permalink( $post ) . '#webpage' ),
		);
		if ( has_post_thumbnail( $post ) ) {
			$posting['image'] = get_the_post_thumbnail_url( $post, 'large' );
		}
		$graph[] = $posting;
	}

	// --- BreadcrumbList schema (inner pages only) ---
	if ( ! is_front_page() ) {
		$breadcrumb_items = array(
			array(
				'@type'    => 'ListItem',
				'position' => 1,
				'name'     => mci_t( 'Home' ),
				'item'     => mci_url( '/' ),
			),
		);

		$current_name = wp_get_document_title();
		$current_name = preg_replace( '/\s*\|.*$/', '', $current_name );

		$breadcrumb_items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => $current_name,
			'item'     => $current_url,
		);

		$graph[] = array(
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $breadcrumb_items,
		);
	}

	$json_ld = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo '<script type="application/ld+json">' . "\n";
	echo wp_json_encode( $json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	echo "\n" . '</script>' . "\n";
}

/**
 * Get the current page URL for JSON-LD (language-aware).
 */
function mci_seo_current_url() {
	$lang = mci_get_current_lang();

	if ( is_front_page() ) {
		return mci_url( '/' );
	}
	if ( is_singular() ) {
		$permalink = get_permalink();
		if ( $lang !== 'en' ) {
			$home = untrailingslashit( home_url() );
			$path = substr( $permalink, strlen( $home ) );
			if ( ! preg_match( '#^/(ru|el)(/|$)#', $path ) ) {
				return $home . '/' . $lang . $path;
			}
		}
		return $permalink;
	}
	return home_url( $_SERVER['REQUEST_URI'] ?? '/' );
}

/* =========================================================================
   12. Hook Registration
   ========================================================================= */

/**
 * Output content-language meta tag for crawlers.
 */
function mci_seo_content_language() {
	$lang = mci_get_current_lang();
	$map  = array(
		'en' => 'en-US',
		'ru' => 'ru',
		'el' => 'el',
	);
	$content_lang = isset( $map[ $lang ] ) ? $map[ $lang ] : 'en-US';
	echo '<meta http-equiv="content-language" content="' . esc_attr( $content_lang ) . '">' . "\n";
}

// Meta tags — early priority.
add_action( 'wp_head', 'mci_seo_content_language', 1 );
add_action( 'wp_head', 'mci_seo_meta_description', 1 );
add_action( 'wp_head', 'mci_seo_canonical', 1 );
add_action( 'wp_head', 'mci_seo_robots', 1 );
add_action( 'wp_head', 'mci_seo_hreflang', 1 );

// Open Graph & Twitter Cards — priority 2.
add_action( 'wp_head', 'mci_seo_open_graph', 2 );
add_action( 'wp_head', 'mci_seo_twitter_cards', 2 );

// Title filters.
add_filter( 'document_title_parts', 'mci_seo_document_title_parts' );
add_filter( 'document_title_separator', 'mci_seo_document_title_separator' );

// JSON-LD in footer to avoid render-blocking.
add_action( 'wp_footer', 'mci_seo_json_ld', 20 );
