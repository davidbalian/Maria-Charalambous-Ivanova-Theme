<?php
/**
 * XML sitemap with multilingual hreflang annotations.
 * Served dynamically at the WordPress root — /sitemap.xml — via rewrite rules.
 * No physical file is written.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =========================================================================
   1. Disable WordPress's built-in /wp-sitemap.xml to avoid duplication
   ========================================================================= */

add_filter( 'wp_sitemaps_enabled', '__return_false' );

/* =========================================================================
   2. Rewrite rules — /sitemap.xml and /sitemap.xsl
   ========================================================================= */

function mci_sitemap_register_rewrite() {
	add_rewrite_rule( '^sitemap\.xml$', 'index.php?mci_sitemap=1', 'top' );
	add_rewrite_rule( '^sitemap\.xsl$', 'index.php?mci_sitemap=xsl', 'top' );
}
add_action( 'init', 'mci_sitemap_register_rewrite' );

function mci_sitemap_query_vars( $vars ) {
	$vars[] = 'mci_sitemap';
	return $vars;
}
add_filter( 'query_vars', 'mci_sitemap_query_vars' );

/**
 * Flush rewrite rules when the theme is activated so /sitemap.xml resolves immediately.
 */
function mci_sitemap_flush_on_activation() {
	mci_sitemap_register_rewrite();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mci_sitemap_flush_on_activation' );

/* =========================================================================
   3. Request handler
   ========================================================================= */

function mci_sitemap_template_redirect() {
	$type = get_query_var( 'mci_sitemap' );
	if ( ! $type ) {
		return;
	}

	if ( 'xsl' === $type ) {
		mci_sitemap_output_xsl();
	} else {
		mci_sitemap_output_xml();
	}
	exit;
}
add_action( 'template_redirect', 'mci_sitemap_template_redirect' );

/* =========================================================================
   4. Page list — single source of truth
   ========================================================================= */

/**
 * Pages to include in the sitemap with priority and changefreq hints.
 * Empty slug = front page.
 */
function mci_sitemap_pages() {
	return array(
		array( 'slug' => '',               'priority' => '1.0', 'changefreq' => 'weekly' ),
		array( 'slug' => 'about',          'priority' => '0.8', 'changefreq' => 'monthly' ),
		array( 'slug' => 'services',       'priority' => '0.9', 'changefreq' => 'monthly' ),
		array( 'slug' => 'gallery',        'priority' => '0.8', 'changefreq' => 'monthly' ),
		array( 'slug' => 'contact',        'priority' => '0.8', 'changefreq' => 'monthly' ),
		array( 'slug' => 'privacy-policy', 'priority' => '0.3', 'changefreq' => 'yearly' ),
	);
}

/**
 * Resolve the modified-date of a page by slug. Falls back to current time if not found.
 */
function mci_sitemap_lastmod_for_slug( $slug ) {
	if ( '' === $slug ) {
		$front_id = (int) get_option( 'page_on_front' );
		if ( $front_id ) {
			$ts = get_post_modified_time( 'c', false, $front_id );
			if ( $ts ) {
				return $ts;
			}
		}
	} else {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$ts = get_post_modified_time( 'c', false, $page );
			if ( $ts ) {
				return $ts;
			}
		}
	}
	return current_time( 'c' );
}

/**
 * Build a fully-qualified URL for a page slug in a specific language.
 */
function mci_sitemap_build_url( $slug, $lang ) {
	$home   = untrailingslashit( home_url() );
	$prefix = ( 'en' === $lang ) ? '' : '/' . $lang;
	$suffix = '' === $slug ? '/' : '/' . $slug . '/';
	return $home . $prefix . $suffix;
}

/* =========================================================================
   5. XML output
   ========================================================================= */

function mci_sitemap_output_xml() {
	header( 'Content-Type: application/xml; charset=UTF-8' );
	header( 'X-Robots-Tag: noindex, follow' );

	$pages    = mci_sitemap_pages();
	$langs    = array( 'en', 'ru', 'el' );
	$xsl_href = home_url( '/sitemap.xsl' );

	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<?xml-stylesheet type="text/xsl" href="' . esc_url( $xsl_href ) . '"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

	foreach ( $pages as $page ) {
		$lastmod = mci_sitemap_lastmod_for_slug( $page['slug'] );

		foreach ( $langs as $lang ) {
			$loc = mci_sitemap_build_url( $page['slug'], $lang );

			echo "\t<url>\n";
			echo "\t\t<loc>" . esc_url( $loc ) . "</loc>\n";

			// hreflang alternates — every URL block lists every language variant.
			foreach ( $langs as $alt_lang ) {
				$alt_loc = mci_sitemap_build_url( $page['slug'], $alt_lang );
				echo "\t\t" . '<xhtml:link rel="alternate" hreflang="' . esc_attr( $alt_lang ) . '" href="' . esc_url( $alt_loc ) . '" />' . "\n";
			}

			// x-default → English version.
			$xdefault_loc = mci_sitemap_build_url( $page['slug'], 'en' );
			echo "\t\t" . '<xhtml:link rel="alternate" hreflang="x-default" href="' . esc_url( $xdefault_loc ) . '" />' . "\n";

			echo "\t\t<lastmod>" . esc_html( $lastmod ) . "</lastmod>\n";
			echo "\t\t<changefreq>" . esc_html( $page['changefreq'] ) . "</changefreq>\n";
			echo "\t\t<priority>" . esc_html( $page['priority'] ) . "</priority>\n";
			echo "\t</url>\n";
		}
	}

	echo '</urlset>' . "\n";
}

/* =========================================================================
   6. XSL stylesheet — human-friendly view
   ========================================================================= */

function mci_sitemap_output_xsl() {
	header( 'Content-Type: application/xslt+xml; charset=UTF-8' );
	header( 'X-Robots-Tag: noindex, follow' );

	$site_name = get_bloginfo( 'name' );

	?><?php // phpcs:ignore -- raw XSL output below ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xhtml="http://www.w3.org/1999/xhtml"
	xmlns="http://www.w3.org/1999/xhtml">
	<xsl:output method="html" encoding="UTF-8" indent="yes" doctype-system="about:legacy-compat" />
	<xsl:template match="/">
		<html lang="en">
			<head>
				<meta charset="UTF-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1" />
				<meta name="robots" content="noindex, follow" />
				<title>XML Sitemap — <xsl:value-of select="'<?php echo esc_html( $site_name ); ?>'" /></title>
				<style>
					* { box-sizing: border-box; }
					body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; margin: 0; padding: 0; color: #1a1a1a; background: #fafaf7; }
					.wrap { max-width: 1100px; margin: 0 auto; padding: 2rem 1.25rem 4rem; }
					h1 { font-size: 1.75rem; margin: 0 0 .5rem; color: #1a5c6b; }
					.intro { color: #555; margin: 0 0 1.5rem; line-height: 1.55; max-width: 65ch; }
					.intro a { color: #1a5c6b; }
					.meta { color: #777; font-size: .85rem; margin-bottom: 1.5rem; }
					table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 1px 2px rgba(0,0,0,.04); border-radius: 6px; overflow: hidden; }
					th, td { padding: .65rem .9rem; text-align: left; font-size: .9rem; vertical-align: top; }
					th { background: #1a5c6b; color: #fff; font-weight: 600; letter-spacing: .02em; }
					tbody tr { border-top: 1px solid #eee; }
					tbody tr:nth-child(even) { background: #fafafa; }
					tbody tr:hover { background: #f1f7f8; }
					a { color: #1a5c6b; text-decoration: none; word-break: break-all; }
					a:hover { text-decoration: underline; }
					.lang { display: inline-block; padding: .15rem .5rem; border-radius: 999px; font-size: .72rem; font-weight: 600; background: #c9a84c; color: #fff; text-transform: uppercase; letter-spacing: .05em; }
					.alts { display: flex; flex-wrap: wrap; gap: .25rem; }
					.alts .lang { background: #e6e2d4; color: #4a3f1a; }
					.num { color: #999; font-variant-numeric: tabular-nums; width: 3rem; }
					code { font-family: ui-monospace, "SF Mono", Menlo, monospace; background: #eef0f0; padding: .1rem .35rem; border-radius: 3px; font-size: .82rem; }
					@media (max-width: 700px) {
						th:nth-child(4), td:nth-child(4), th:nth-child(5), td:nth-child(5) { display: none; }
					}
				</style>
			</head>
			<body>
				<div class="wrap">
					<h1>XML Sitemap</h1>
					<p class="intro">
						This is a multilingual XML sitemap for search engines. Each URL is annotated with <code>hreflang</code> alternates so Google understands the language relationships between pages. Submit just <code>/sitemap.xml</code> to Google Search Console — there is no need to submit a separate sitemap per language.
					</p>
					<p class="meta">
						<xsl:value-of select="count(sitemap:urlset/sitemap:url)" /> URLs total.
					</p>
					<table>
						<thead>
							<tr>
								<th>#</th>
								<th>Lang</th>
								<th>URL</th>
								<th>Last modified</th>
								<th>Priority</th>
								<th>Alternates</th>
							</tr>
						</thead>
						<tbody>
							<xsl:for-each select="sitemap:urlset/sitemap:url">
								<tr>
									<td class="num"><xsl:number value="position()" /></td>
									<td>
										<xsl:variable name="loc" select="sitemap:loc" />
										<xsl:choose>
											<xsl:when test="contains($loc, '/ru/')">
												<span class="lang">RU</span>
											</xsl:when>
											<xsl:when test="contains($loc, '/el/')">
												<span class="lang">EL</span>
											</xsl:when>
											<xsl:otherwise>
												<span class="lang">EN</span>
											</xsl:otherwise>
										</xsl:choose>
									</td>
									<td>
										<a href="{sitemap:loc}">
											<xsl:value-of select="sitemap:loc" />
										</a>
									</td>
									<td>
										<xsl:value-of select="substring(sitemap:lastmod, 1, 10)" />
									</td>
									<td>
										<xsl:value-of select="sitemap:priority" />
									</td>
									<td>
										<div class="alts">
											<xsl:for-each select="xhtml:link">
												<span class="lang">
													<xsl:value-of select="@hreflang" />
												</span>
											</xsl:for-each>
										</div>
									</td>
								</tr>
							</xsl:for-each>
						</tbody>
					</table>
				</div>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
<?php
}
