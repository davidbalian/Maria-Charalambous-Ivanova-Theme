<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
	<noscript><link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet"></noscript>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
	<div class="site-top-bar">
		<div class="site-top-bar__inner">
			<div class="site-top-bar__contact">
				<a href="tel:+35725377757" class="site-top-bar__link">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
					+357 25 377757
				</a>
				<a href="mailto:info@dentalartcliniclimassol.com" class="site-top-bar__link site-top-bar__email">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
					info@dentalartcliniclimassol.com
				</a>
			</div>
			<a href="/book-appointment" class="site-top-bar__cta">BOOK APPOINTMENT</a>
		</div>
	</div>
	<div class="site-header__inner">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link">
				<img src="https://davidb1646.sg-host.com/wp-content/uploads/2026/02/horizontal-logo-gold.avif"
				     alt="<?php bloginfo( 'name' ); ?>"
				     class="site-logo site-logo--desktop"
				     width="200" height="40">
				<img src="https://davidb1646.sg-host.com/wp-content/uploads/2026/02/logomark.avif"
				     alt="<?php bloginfo( 'name' ); ?>"
				     class="site-logo site-logo--mobile"
				     width="31" height="32"
				     fetchpriority="high">
			</a>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<button type="button" class="mobile-nav-toggle press-feedback" aria-label="<?php esc_attr_e( 'Open menu', 'maria-charalambous-ivanova' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
			<span class="mobile-nav-toggle__line"></span>
			<span class="mobile-nav-toggle__line"></span>
			<span class="mobile-nav-toggle__line"></span>
		</button>
	</div>
</header>

<div id="mobile-nav" class="mobile-nav-overlay" aria-hidden="true">
	<div class="mobile-nav__content">
		<nav class="mobile-nav__menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'mobile-menu',
				'menu_class'     => 'mobile-nav__links',
				'container'      => false,
				'fallback_cb'    => false,
			) );
			?>
		</nav>
		<div class="mobile-nav__lang">EN</div>
	</div>
</div>
