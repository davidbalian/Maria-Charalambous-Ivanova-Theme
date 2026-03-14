<footer id="colophon" class="site-footer">
	<div class="site-footer__inner">
		<div class="site-footer__col site-footer__col--logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo-link">
				<img src="https://davidb1646.sg-host.com/wp-content/uploads/2026/02/horizontal-logo-gold.avif"
				     alt="<?php bloginfo( 'name' ); ?>"
				     class="site-footer__logo"
				     width="200" height="40"
				     loading="lazy">
			</a>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading">Navigation</h4>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'footer-primary-menu',
				'container'      => 'nav',
				'container_class'=> 'footer-navigation',
				'fallback_cb'    => false,
			) );
			?>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading">Services</h4>
			<nav class="footer-navigation">
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Composite Veneers</a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Emax Veneers</a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Dental Implants</a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Orthodontics</a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Endodontics</a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Full Mouth Rehabilitation</a></li>
				</ul>
			</nav>
		</div>

		<div class="site-footer__col">
			<h4 class="site-footer__heading">Contact</h4>
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
		<p>&copy; <?php echo date( 'Y' ); ?> Dental Art Clinic. All rights reserved.</p>
		<p>Website designed and developed by <a href="https://balian.cy" target="_blank" rel="noopener noreferrer">Balian Web Dev Co.</a></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
