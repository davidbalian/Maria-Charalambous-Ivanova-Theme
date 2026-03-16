<?php
/**
 * The template for displaying 404 pages.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">
	<section class="error-404-hero">
		<img
			src="https://davidb1646.sg-host.com/wp-content/uploads/2026/02/dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif"
			alt="Dental Art Clinic Limassol"
			class="error-404-hero__bg"
			fetchpriority="high"
		>
		<div class="error-404-hero__overlay"></div>
		<div class="error-404-hero__content">
			<span class="error-404-hero__code">404</span>
			<h1 class="error-404-hero__title"><?php mci_te( 'Page Not Found' ); ?></h1>
			<p class="error-404-hero__text"><?php mci_te( 'The page you are looking for does not exist or has been moved.' ); ?></p>
			<a href="<?php echo esc_url( mci_url( '/' ) ); ?>" class="btn btn-primary error-404-hero__btn">
				<?php mci_te( 'Return to Homepage' ); ?>
			</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
