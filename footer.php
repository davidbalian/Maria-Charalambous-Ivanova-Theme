<footer id="colophon" class="site-footer">
	<nav class="footer-navigation">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'footer',
			'menu_id'        => 'footer-menu',
			'fallback_cb'    => false,
		) );
		?>
	</nav>
	<div class="site-info">
		<p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
