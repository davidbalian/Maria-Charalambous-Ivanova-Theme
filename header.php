<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
	<div class="site-header__inner">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link">
				<img src="http://davidb1646.sg-host.com/wp-content/uploads/2026/02/horizontal-logo-gold.avif" 
				     alt="<?php bloginfo( 'name' ); ?>" 
				     class="site-logo site-logo--desktop">
				<img src="http://davidb1646.sg-host.com/wp-content/uploads/2026/02/logomark.avif" 
				     alt="<?php bloginfo( 'name' ); ?>" 
				     class="site-logo site-logo--mobile">
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

		<button type="button" class="mobile-nav-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'maria-charalambous-ivanova' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
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
