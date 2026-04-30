<?php
/**
 * Template Name: Services
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$clinic_image_base  = home_url( '/wp-content/uploads/2026/02/' );
$services_blocks_base = home_url( '/wp-content/uploads/2026/04/' );
?>

<main id="main" class="site-main services-page">

	<!-- Hero with background image -->
	<section class="services-hero mci-parallax" style="--mci-parallax-bg: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' ); ?>');">
		<div class="services-hero__overlay"></div>
		<div class="container services-hero__content">
			<h1 class="services-hero__title fade-in fade-in-delay-0"><?php mci_te( 'Our Services' ); ?></h1>
			<p class="services-hero__subtitle fade-in fade-in-delay-1"><?php mci_te( 'Comprehensive dental care with modern technology and evidence-based treatments for every patient.' ); ?></p>
			<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => 'fade-in fade-in-delay-2' ) ); ?>
		</div>
	</section>

	<!-- Premium E.max Veneers — row 1: image LEFT -->
	<section class="services-item services-item--reverse page-section page-section--background">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Aesthetic Dentistry' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Premium E.max Veneers' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Achieve a natural, confident smile with ultra-thin, high-quality veneers designed just for you.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'E.max veneers are one of the most advanced solutions in cosmetic dentistry. Crafted from high-strength ceramic, they offer exceptional durability while maintaining a completely natural look.' ); ?></p>
					<p class="fade-in fade-in-delay-4"><?php mci_te( 'Each smile is digitally designed to match your facial features, ensuring a result that looks beautiful, not artificial.' ); ?></p>
					<div class="fade-in fade-in-delay-5">
						<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( $services_blocks_base . 'additional-hero-images-2.webp' ); ?>" alt="Emax veneers and crowns" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/services-smilers-row' ); ?>

	<!-- Cosmetic Masterpieces — row 3: image LEFT -->
	<section class="services-item services-item--reverse page-section page-section--surface">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Cosmetic' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Cosmetic Masterpieces' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Our cosmetic services go beyond simple fixes — crafted to create smiles that look natural, feel comfortable, and stand the test of time.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'From teeth whitening and veneers to full smile redesigns, every treatment is tailored to your unique features and personal goals.' ); ?></p>
					<div class="fade-in fade-in-delay-4">
						<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( $services_blocks_base . 'porcelain-veneers-natural-smile-side-angle-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp' ); ?>" alt="Cosmetic Masterpieces" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Preventative & Restorative Care — row 4: image RIGHT -->
	<section class="services-item page-section page-section--background">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'General Dentistry' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php echo mci_t( 'Preventative &amp; Restorative Care' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'A beautiful smile needs a healthy foundation. Our preventative and restorative services keep your teeth and gums in excellent condition — so your smile looks great and lasts a lifetime.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'From check-ups and cleanings to fillings and crowns, we provide comprehensive care with the attention to detail that defines everything we do.' ); ?></p>
					<div class="fade-in fade-in-delay-4">
						<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( $services_blocks_base . 'single-porcelain-veneer-macro-detail-dental-art-clinic-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Preventative and Restorative Care" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/services-list' ); ?>

	<!-- CTA Banner -->
	<section class="services-cta mci-parallax" style="--mci-parallax-bg: url('<?php echo esc_url( $clinic_image_base . 'dr-maria-charalambous-ivanova-portrait-09.webp' ); ?>');">
		<div class="services-cta__overlay"></div>
		<div class="container services-cta__content">
			<h2 class="fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Ready to Transform {accent}Your Smile?{/accent}' ); ?></h2>
			<p class="fade-in fade-in-delay-1"><?php mci_te( 'Book a consultation and discover the difference personalized care makes.' ); ?></p>
			<div class="services-cta__buttons fade-in fade-in-delay-2">
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				<a href="tel:+35725377757" class="btn btn-outline-light"><?php mci_te( 'Call +357 25 377757' ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
