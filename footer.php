<?php
$mci_lang = mci_get_current_lang();
$mci_footer_menu = 'primary';
if ( $mci_lang !== 'en' ) {
	$lang_menu = 'primary-' . $mci_lang;
	if ( has_nav_menu( $lang_menu ) ) {
		$mci_footer_menu = $lang_menu;
	}
}
?>
<footer id="colophon" class="site-footer">
	<div class="site-footer__inner">
		<div class="site-footer__col site-footer__col--logo">
			<a href="<?php echo esc_url( mci_url( '/' ) ); ?>" class="site-footer__logo-link">
				<img src="https://davidb1646.sg-host.com/wp-content/uploads/2026/02/horizontal-logo-gold.avif"
				     alt="<?php bloginfo( 'name' ); ?>"
				     class="site-footer__logo"
				     width="200" height="40"
				     loading="lazy">
			</a>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php mci_te( 'Navigation' ); ?></h4>
			<?php
			wp_nav_menu( array(
				'theme_location' => $mci_footer_menu,
				'menu_id'        => 'footer-primary-menu',
				'container'      => 'nav',
				'container_class'=> 'footer-navigation',
				'fallback_cb'    => false,
			) );
			?>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php mci_te( 'Services' ); ?></h4>
			<nav class="footer-navigation">
				<ul>
					<li><a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>"><?php mci_te( 'Composite Veneers' ); ?></a></li>
					<li><a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>"><?php mci_te( 'Emax Veneers' ); ?></a></li>
					<li><a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>"><?php mci_te( 'Dental Implants' ); ?></a></li>
					<li><a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>"><?php mci_te( 'Orthodontics' ); ?></a></li>
					<li><a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>"><?php mci_te( 'Endodontics' ); ?></a></li>
					<li><a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>"><?php mci_te( 'Full Mouth Rehabilitation' ); ?></a></li>
				</ul>
			</nav>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading"><?php mci_te( 'Contact' ); ?></h4>
			<ul class="site-footer__contact">
				<li>
					<a href="tel:+35725377757">+357 25 377757</a>
				</li>
				<li>
					<a href="https://maps.google.com/?q=Dental+Art+Clinic+by+Dr.+Maria+Charalambous-Ivanova+MSD" target="_blank" rel="noopener noreferrer" class="site-footer__address">
						PRIMO AMARI, Walter Gropius 49-49, Floor 1, Apt. 101, Limassol 3076, Cyprus
					</a>
				</li>
			</ul>
			<?php get_template_part( 'template-parts/hours-table', null, array(
				'modifier'      => '--footer',
				'heading_class' => 'site-footer__subheading',
				'status_id'     => 'footer-clinic-status',
			) ); ?>
		</div>
	</div>

	<div class="site-footer__bottom">
		<p>&copy; <?php echo date( 'Y' ); ?> Dental Art Clinic. <?php mci_te( 'All rights reserved.' ); ?></p>
		<p><?php mci_te( 'Website designed and developed by' ); ?> <a href="https://balian.cy" target="_blank" rel="noopener noreferrer">Balian Web Dev Co.</a></p>
	</div>
</footer>

<!-- Cookie Banner -->
<div id="mci-cookie-banner" class="cookie-banner" role="dialog" aria-label="Cookie consent" hidden>
	<p class="cookie-banner__text"><?php echo esc_html( mci_t( 'We use cookies to analyse site traffic and improve your experience. By continuing, you agree to our' ) ); ?> <a href="<?php echo esc_url( mci_url( '/privacy-policy/' ) ); ?>"><?php mci_te( 'Privacy Policy' ); ?></a>.</p>
	<div class="cookie-banner__actions">
		<button type="button" class="cookie-banner__accept btn btn-primary"><?php mci_te( 'Accept' ); ?></button>
		<button type="button" class="cookie-banner__close" aria-label="Dismiss cookie banner">&times;</button>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
