<?php
/**
 * Template Name: Services
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$clinic_image_base = 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/';
?>

<main id="main" class="site-main">

	<!-- Hero with background image -->
	<section class="services-hero" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' ); ?>');">
		<div class="services-hero__overlay"></div>
		<div class="container services-hero__content">
			<h1 class="services-hero__title fade-in fade-in-delay-0"><?php mci_te( 'Our Services' ); ?></h1>
			<p class="services-hero__subtitle fade-in fade-in-delay-1"><?php mci_te( 'Comprehensive dental care using modern technology and evidence-based treatments, tailored to every patient.' ); ?></p>
			<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-2"><?php mci_te( 'Book Appointment' ); ?></a>
		</div>
	</section>

	<?php get_template_part( 'template-parts/services-list' ); ?>

	<!-- Smilers Aligners -->
	<section class="services-item page-section page-section--surface">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontics' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet and tough dental aligners designed for modern lifestyles. Smilers offer a virtually invisible way to straighten your teeth and correct your bite — without the look and feel of traditional braces.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Ideal for protecting gutters and correcting smiles invisibly, Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.' ); ?></p>
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Smilers Aligners" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- One-Visit Transformations -->
	<section class="services-item services-item--reverse page-section page-section--background">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Aesthetic Dentistry' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'One-Visit Transformations' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Fast-track aesthetic dentistry at its finest. Using advanced materials and techniques, Dr. Maria can dramatically enhance your smile in a single appointment — creating a "Masterpiece" result you will love from day one.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Whether you need veneers, bonding, or a complete smile makeover, our one-visit approach saves you time without compromising on quality.' ); ?></p>
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="One-Visit Transformations" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Cosmetic Masterpieces -->
	<section class="services-item page-section page-section--surface">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Cosmetic' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Cosmetic Masterpieces' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Solutions crafted for timeless elegance. Our cosmetic services go beyond simple fixes — they are designed to create smiles that look natural, feel comfortable, and stand the test of time.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'From teeth whitening and porcelain veneers to full smile redesigns, every treatment is tailored to your unique features and personal goals.' ); ?></p>
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Cosmetic Masterpieces" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Preventative & Restorative Care -->
	<section class="services-item services-item--reverse page-section page-section--background">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'General Dentistry' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php echo mci_t( 'Preventative &amp; Restorative Care' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'A beautiful smile starts with a healthy foundation. Our preventative and restorative services ensure your teeth and gums stay in excellent condition — so your smile looks great and lasts a lifetime.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'From routine check-ups and professional cleanings to fillings and crowns, we provide comprehensive care with the same attention to detail that defines everything we do.' ); ?></p>
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Preventative and Restorative Care" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Banner -->
	<section class="services-cta" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dr-maria-charalambous-ivanova-portrait-09.webp' ); ?>');">
		<div class="services-cta__overlay"></div>
		<div class="container services-cta__content">
			<h2 class="fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Ready to Transform {accent}Your Smile?{/accent}' ); ?></h2>
			<p class="fade-in fade-in-delay-1"><?php mci_te( 'Book a consultation and discover the difference personalized dental care can make.' ); ?></p>
			<div class="services-cta__buttons fade-in fade-in-delay-2">
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				<a href="tel:+35725377757" class="btn btn-outline-light"><?php mci_te( 'Call +357 25 377757' ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
