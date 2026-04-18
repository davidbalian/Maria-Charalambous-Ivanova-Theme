<?php
/**
 * Template Name: About
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$clinic_image_base = home_url( '/wp-content/uploads/2026/02/' );
?>

<main id="main" class="site-main">

	<!-- Hero with background image -->
	<section class="about-hero" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' ); ?>');">
		<div class="about-hero__overlay"></div>
		<div class="container about-hero__content">
			<h1 class="about-hero__title fade-in fade-in-delay-0"><?php mci_te( 'About the Clinic' ); ?></h1>
			<p class="about-hero__subtitle fade-in fade-in-delay-1"><?php mci_te( 'Where your oral health and smile are our top priorities.' ); ?></p>
			<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => 'fade-in fade-in-delay-2' ) ); ?>
		</div>
	</section>

	<!-- Mission -->
	<section class="about-mission page-section page-section--surface">
		<div class="container">
			<div class="about-mission__header">
				<h2 class="fade-in fade-in-delay-0"><?php mci_te( 'The Masterpiece Philosophy' ); ?></h2>
				<p class="fade-in fade-in-delay-1"><?php mci_te( 'At DENTAL ART CLINIC LIMASSOL, dentistry combines scientific precision, strategic planning, and aesthetic harmony — the natural evolution of a career built on trust, consistency, and excellence.' ); ?></p>
			</div>
			<div class="about-mission__images fade-in fade-in-delay-2">
				<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' ); ?>" alt="Dental Art Clinic reception area" width="560" height="380" loading="lazy">
				<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' ); ?>" alt="Dental Art Clinic treatment room" width="560" height="380" loading="lazy">
			</div>
		</div>
	</section>

	<!-- Doctor Profile -->
	<section class="about-doctor page-section page-section--background">
		<div class="container">
			<div class="about-doctor__grid">
				<div class="about-doctor__image fade-in fade-in-delay-0">
					<img src="<?php echo esc_url( 'http://davidb1646.sg-host.com/wp-content/uploads/2026/02/dr-maria-charalambous-ivanova-portrait-05.webp' ); ?>" alt="Dr. Maria Charalambous-Ivanova" width="560" height="700">
				</div>
				<div class="about-doctor__bio">
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Dr. Maria Charalambous-Ivanova' ); ?></h2>
					<p class="about-doctor__subtitle fade-in fade-in-delay-2"><?php echo mci_t( 'DMD, MSD | Founder &amp; Clinical Director' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Dr. Maria Charalambous-Ivanova graduated from the University of Sofia in 2007 and has practiced since 2008. Through ongoing participation in international congresses and advanced training, she remains at the forefront of modern dental techniques.' ); ?></p>
					<p class="fade-in fade-in-delay-4"><?php mci_te( 'Composite and Emax veneers form the foundation of her aesthetic philosophy. She also undertakes complex full mouth rehabilitation cases requiring functional analysis, precise diagnosis, and structured treatment planning.' ); ?></p>
					<p class="fade-in fade-in-delay-5"><?php mci_te( 'Every case is treated individually — no standardized solutions, only the right approach for each patient, focusing on long-term health, proper function, and aesthetic balance.' ); ?></p>
					<p class="fade-in fade-in-delay-6"><?php mci_te( 'Collaboration with skilled partners ensures optimal, natural, and harmoniously balanced results.' ); ?></p>
					<div class="about-doctor__philosophy fade-in fade-in-delay-7">
						<div class="about-doctor__philosophy-item"><?php mci_te( 'Scientific precision' ); ?></div>
						<div class="about-doctor__philosophy-divider"></div>
						<div class="about-doctor__philosophy-item"><?php mci_te( 'Strategic treatment planning' ); ?></div>
						<div class="about-doctor__philosophy-divider"></div>
						<div class="about-doctor__philosophy-item"><?php mci_te( 'Pain-free experience' ); ?></div>
						<div class="about-doctor__philosophy-divider"></div>
						<div class="about-doctor__philosophy-item"><?php mci_te( 'Absolute transparency and trust' ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Clinic Experience -->
	<section class="about-experience page-section page-section--surface">
		<div class="container">
			<div class="about-experience__grid">
				<div class="about-experience__content">
					<h2 class="fade-in fade-in-delay-0"><?php mci_te( 'The Clinic Experience' ); ?></h2>
					<p class="fade-in fade-in-delay-1"><?php mci_te( 'Our clinic provides comprehensive dental care for patients of all ages, focusing on prevention, accurate diagnosis, and high-quality treatment for the best possible results.' ); ?></p>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'We believe dental visits should be comfortable and positive. We create a friendly, relaxed environment with personalized care tailored to each patient\'s needs.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Our priority is long-term patient relationships built on trust, professionalism, and excellent dental care.' ); ?></p>
				</div>
				<div class="about-experience__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif' ); ?>" alt="Dental Art Clinic waiting room" width="560" height="420" loading="lazy">
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Banner -->
	<section class="about-cta" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>');">
		<div class="about-cta__overlay"></div>
		<div class="container about-cta__content">
			<h2 class="fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Ready to Transform {accent}Your Smile?{/accent}' ); ?></h2>
			<p class="fade-in fade-in-delay-1"><?php mci_te( 'Book a consultation and discover the difference personalized care makes.' ); ?></p>
			<div class="about-cta__buttons fade-in fade-in-delay-2">
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				<a href="tel:+35725377757" class="btn btn-outline-light"><?php mci_te( 'Call +357 25 377757' ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
