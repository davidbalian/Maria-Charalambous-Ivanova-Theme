<?php
/**
 * Template Name: Gallery
 *
 * A page template for displaying before/after case study images and clinic photos.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$clinic_image_base = home_url( '/wp-content/uploads/2026/02/' );
?>

<main id="main" class="site-main">

	<!-- Hero with background image -->
	<section class="gallery-hero mci-parallax" style="--mci-parallax-bg: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' ); ?>');">
		<div class="gallery-hero__overlay"></div>
		<div class="container gallery-hero__content">
			<h1 class="gallery-hero__title fade-in fade-in-delay-0"><?php mci_te( 'Gallery' ); ?></h1>
			<p class="gallery-hero__subtitle fade-in fade-in-delay-1"><?php echo mci_t( 'Browse our before &amp; after transformations and clinic photos.' ); ?></p>
			<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => 'fade-in fade-in-delay-2' ) ); ?>
		</div>
	</section>

	<?php get_template_part( 'template-parts/gallery/section-page-before-after' ); ?>

	<?php get_template_part( 'template-parts/gallery/section-page-clinic' ); ?>

	<!-- CTA Banner -->
	<section class="gallery-cta mci-parallax" style="--mci-parallax-bg: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>');">
		<div class="gallery-cta__overlay"></div>
		<div class="container gallery-cta__content">
			<h2 class="fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Ready to Transform {accent}Your Smile?{/accent}' ); ?></h2>
			<p class="fade-in fade-in-delay-1"><?php mci_te( 'Book a consultation and discover the difference personalized care makes.' ); ?></p>
			<div class="gallery-cta__buttons fade-in fade-in-delay-2">
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				<a href="tel:+35725377757" class="btn btn-outline-light"><?php mci_te( 'Call +357 25 377757' ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
