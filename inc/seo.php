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
		'logo'           => 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/horizontal-logo-gold.avif',
		'image_clinic'   => 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/clinic-reception.avif',
		'image_doctor'   => 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/dr-maria-portrait.avif',
		'image_gallery'  => 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/smile-transformation.avif',
		'opening_hours'  => array(
			'Mo-Th 08:00-17:30',
			'Fr 08:00-13:00',
		),
		'opening_spec'   => array(
			array( 'days' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday' ), 'opens' => '08:00', 'closes' => '17:30' ),
			array( 'days' => array( 'Friday' ), 'opens' => '08:00', 'closes' => '13:00' ),
		),
		'social'         => array(
			'facebook'  => 'https://www.facebook.com/dentalartcliniclimassol',
			'instagram' => 'https://www.instagram.com/dentalartcliniclimassol',
		),
	);
}

/* =========================================================================
   2. Shared Services Data
   ========================================================================= */

/**
 * Return the 11-service array used by both the template and JSON-LD.
 */
function mci_get_services_data() {
	return array(
		array(
			'title' => 'General Dental Examination & Prevention',
			'desc'  => 'Regular dental check-ups help detect potential problems early and maintain optimal oral health through preventive care and professional advice.',
		),
		array(
			'title' => 'Professional Teeth Cleaning',
			'desc'  => 'Removal of plaque, tartar, and stains to promote healthy gums and a brighter, healthier smile.',
		),
		array(
			'title' => 'Dental Fillings',
			'desc'  => 'Treatment of tooth decay using modern, aesthetic materials that restore both function and natural appearance.',
		),
		array(
			'title' => 'Root Canal Treatment (Endodontics)',
			'desc'  => 'Advanced treatment for infected or inflamed tooth nerves, allowing the natural tooth to be preserved and pain to be relieved.',
		),
		array(
			'title' => 'Tooth Extractions',
			'desc'  => 'Safe and gentle removal of teeth when they cannot be restored, always prioritizing patient comfort.',
		),
		array(
			'title' => 'Cosmetic Dentistry',
			'desc'  => 'A range of treatments designed to enhance the appearance of your smile, including teeth whitening and aesthetic restorations.',
		),
		array(
			'title' => 'Crowns & Bridges',
			'desc'  => 'Durable restorations used to repair damaged teeth or replace missing ones, improving both function and aesthetics.',
		),
		array(
			'title' => 'Dental Implants',
			'desc'  => 'A modern and long-lasting solution for replacing missing teeth, restoring both confidence and oral function.',
		),
		array(
			'title' => 'Dentures',
			'desc'  => 'Full or partial removable dentures designed to restore chewing ability, speech, and smile aesthetics.',
		),
		array(
			'title' => 'Periodontal Treatment',
			'desc'  => 'Diagnosis and treatment of gum diseases such as gingivitis and periodontitis to protect the health of your gums and supporting bone.',
		),
		array(
			'title' => 'Emergency Dental Care',
			'desc'  => 'Prompt care for dental emergencies including severe toothache, broken teeth, infections, or other urgent dental conditions.',
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
	$site_tag = 'Dental Art Clinic Limassol';

	if ( is_front_page() ) {
		$title_parts['title'] = 'Dentist in Limassol | Dental Art Clinic by Dr. Maria Charalambous-Ivanova';
		unset( $title_parts['tagline'] );
		return $title_parts;
	}

	if ( mci_seo_is_page( 'about' ) ) {
		$title_parts['title'] = 'About Dr. Maria Charalambous-Ivanova';
		$title_parts['site']  = 'Dentist in Limassol';
	} elseif ( mci_seo_is_page( 'services' ) ) {
		$title_parts['title'] = 'Dental Services in Limassol';
		$title_parts['site']  = $site_tag;
	} elseif ( mci_seo_is_page( 'gallery' ) ) {
		$title_parts['title'] = 'Smile Transformations Gallery';
		$title_parts['site']  = $site_tag;
	} elseif ( mci_seo_is_page( 'contact' ) ) {
		$title_parts['title'] = 'Contact & Book Appointment';
		$title_parts['site']  = $site_tag;
	} elseif ( mci_seo_is_page( 'privacy-policy' ) ) {
		$title_parts['title'] = 'Privacy Policy';
		$title_parts['site']  = $site_tag;
	} elseif ( is_404() ) {
		$title_parts['title'] = 'Page Not Found';
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

	if ( is_front_page() ) {
		$desc = 'Dental Art Clinic Limassol — modern dental clinic by Dr. Maria Charalambous-Ivanova offering cosmetic dentistry, dental implants, veneers, aligners, and emergency dental care. Book your appointment today.';
	} elseif ( mci_seo_is_page( 'about' ) ) {
		$desc = 'Meet Dr. Maria Charalambous-Ivanova, DMD, MSD — founder of Dental Art Clinic in Limassol. Practicing since 2008, specializing in composite veneers, Emax veneers, and full mouth rehabilitation.';
	} elseif ( mci_seo_is_page( 'services' ) ) {
		$desc = 'Full range of dental services at Dental Art Clinic Limassol — general check-ups, teeth cleaning, cosmetic dentistry, dental implants, crowns, bridges, veneers, aligners, and emergency care.';
	} elseif ( mci_seo_is_page( 'gallery' ) ) {
		$desc = 'View before and after smile transformations and clinic photos from Dental Art Clinic Limassol. See results of our cosmetic dentistry, veneers, and smile makeover treatments.';
	} elseif ( mci_seo_is_page( 'contact' ) ) {
		$desc = 'Contact Dental Art Clinic Limassol to book an appointment. Call +357 25 377757 or visit us at PRIMO AMARI, Limassol 3076, Cyprus. Mon–Thu 8AM–5:30PM, Fri 8AM–1PM.';
	} elseif ( mci_seo_is_page( 'privacy-policy' ) ) {
		$desc = 'Privacy policy for Dental Art Clinic Limassol. How we collect, use, and protect your personal data in compliance with GDPR.';
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
   6. Canonical URLs — wp_head hook
   ========================================================================= */

function mci_seo_canonical() {
	if ( is_search() || is_404() ) {
		return;
	}

	$url = '';

	if ( is_front_page() ) {
		$url = home_url( '/' );
	} elseif ( is_singular() ) {
		$url = get_permalink();
	} elseif ( is_archive() || is_home() ) {
		$url = get_pagenum_link();
	}

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
   8. Open Graph Tags — wp_head hook
   ========================================================================= */

function mci_seo_open_graph() {
	$biz = mci_seo_get_business_data();

	// Determine OG title — reuse the document title logic.
	$og_title = wp_get_document_title();

	// Determine OG description.
	ob_start();
	mci_seo_meta_description();
	$meta_tag = ob_get_clean();
	$og_desc  = '';
	if ( preg_match( '/content="([^"]*)"/', $meta_tag, $m ) ) {
		$og_desc = $m[1];
	}

	// Determine OG URL.
	if ( is_front_page() ) {
		$og_url = home_url( '/' );
	} elseif ( is_singular() ) {
		$og_url = get_permalink();
	} else {
		$og_url = get_pagenum_link();
	}

	// Determine OG type.
	$og_type = is_singular( 'post' ) ? 'article' : 'website';

	// Determine OG image.
	$og_image = mci_seo_get_og_image( $biz );

	echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
	if ( $og_desc ) {
		echo '<meta property="og:description" content="' . esc_attr( $og_desc ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $og_url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $biz['name'] ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	if ( $og_image ) {
		echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
	}
	echo '<meta property="og:locale" content="en_US">' . "\n";
}

/**
 * Pick the best OG image for the current page.
 */
function mci_seo_get_og_image( $biz ) {
	// Singular with featured image.
	if ( is_singular() && has_post_thumbnail() ) {
		return get_the_post_thumbnail_url( null, 'large' );
	}

	// Per-template defaults.
	if ( mci_seo_is_page( 'about' ) ) {
		return $biz['image_doctor'];
	}
	if ( mci_seo_is_page( 'gallery' ) ) {
		return $biz['image_gallery'];
	}

	// Fallback: clinic reception image.
	return $biz['image_clinic'];
}

/* =========================================================================
   9. Twitter Card Tags — wp_head hook
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
	}
}

/* =========================================================================
   10. JSON-LD Structured Data — wp_footer hook
   ========================================================================= */

function mci_seo_json_ld() {
	$biz   = mci_seo_get_business_data();
	$graph = array();

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
		'openingHoursSpecification' => array(),
		'sameAs'          => array_values( $biz['social'] ),
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
		'@type'       => 'Person',
		'@id'         => $biz['url'] . '#doctor',
		'name'        => $biz['doctor_name'],
		'jobTitle'    => 'Dentist',
		'honorificSuffix' => $biz['doctor_title'],
		'image'       => $biz['image_doctor'],
		'worksFor'    => array( '@id' => $biz['url'] . '#dentist' ),
		'memberOf'    => array(
			'@type' => 'Organization',
			'name'  => $biz['name'],
		),
	);

	// --- WebSite schema ---
	$graph[] = array(
		'@type'     => 'WebSite',
		'@id'       => $biz['url'] . '#website',
		'name'      => $biz['name'],
		'url'       => $biz['url'],
		'publisher' => array( '@id' => $biz['url'] . '#dentist' ),
	);

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

	$webpage = array(
		'@type'      => $webpage_type,
		'@id'        => mci_seo_current_url() . '#webpage',
		'url'        => mci_seo_current_url(),
		'name'       => wp_get_document_title(),
		'isPartOf'   => array( '@id' => $biz['url'] . '#website' ),
	);

	$graph[] = $webpage;

	// --- BlogPosting schema (single posts) ---
	if ( is_singular( 'post' ) ) {
		$post = get_queried_object();
		$posting = array(
			'@type'         => 'BlogPosting',
			'headline'      => get_the_title( $post ),
			'url'           => get_permalink( $post ),
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
				'name'     => 'Home',
				'item'     => $biz['url'],
			),
		);

		$current_name = wp_get_document_title();
		// Strip the site suffix for breadcrumb name.
		$current_name = preg_replace( '/\s*\|.*$/', '', $current_name );

		$breadcrumb_items[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => $current_name,
			'item'     => mci_seo_current_url(),
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
 * Get the current page URL for JSON-LD.
 */
function mci_seo_current_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		return get_permalink();
	}
	return home_url( $_SERVER['REQUEST_URI'] ?? '/' );
}

/* =========================================================================
   11. Hook Registration
   ========================================================================= */

// Meta tags — early priority.
add_action( 'wp_head', 'mci_seo_meta_description', 1 );
add_action( 'wp_head', 'mci_seo_canonical', 1 );
add_action( 'wp_head', 'mci_seo_robots', 1 );

// Open Graph & Twitter Cards — priority 2.
add_action( 'wp_head', 'mci_seo_open_graph', 2 );
add_action( 'wp_head', 'mci_seo_twitter_cards', 2 );

// Title filters.
add_filter( 'document_title_parts', 'mci_seo_document_title_parts' );
add_filter( 'document_title_separator', 'mci_seo_document_title_separator' );

// JSON-LD in footer to avoid render-blocking.
add_action( 'wp_footer', 'mci_seo_json_ld', 20 );
