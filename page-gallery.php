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
$theme_image_base  = get_template_directory_uri() . '/assets/images/';
?>

<main id="main" class="site-main">

	<!-- Hero with background image -->
	<section class="gallery-hero" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' ); ?>');">
		<div class="gallery-hero__overlay"></div>
		<div class="container gallery-hero__content">
			<h1 class="gallery-hero__title fade-in fade-in-delay-0"><?php mci_te( 'Gallery' ); ?></h1>
			<p class="gallery-hero__subtitle fade-in fade-in-delay-1"><?php echo mci_t( 'Browse our collection of before &amp; after transformations and clinic photos.' ); ?></p>
			<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-2"><?php mci_te( 'Book Appointment' ); ?></a>
		</div>
	</section>

	<!-- Before & After -->
	<section class="gallery-section page-section page-section--background">
		<div class="container">
			<h2 class="gallery-section__heading fade-in fade-in-delay-0"><?php echo mci_t( 'Before &amp; After' ); ?></h2>
			<div class="gallery-grid" id="page-gallery" data-fade-stagger>
				<a href="<?php echo esc_url( $theme_image_base . 'before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $theme_image_base . 'before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" alt="Before and after smile transformation" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $theme_image_base . 'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $theme_image_base . 'before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" alt="Before and after smile transformation" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $theme_image_base . 'before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $theme_image_base . 'before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" alt="Before and after smile transformation" width="400" height="300" loading="lazy">
				</a>
			</div>
		</div>
	</section>

	<!-- Clinic Photos -->
	<section class="gallery-section page-section page-section--surface">
		<div class="container">
			<h2 class="gallery-section__heading fade-in fade-in-delay-0"><?php mci_te( 'The Clinic' ); ?></h2>
			<div class="gallery-grid" data-fade-stagger>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' ); ?>" alt="Reception lobby" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' ); ?>" alt="Reception area marble counter" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif' ); ?>" alt="Waiting room marble interior" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' ); ?>" alt="Treatment room with dental chair and screens" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>" alt="Treatment room wide angle" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif' ); ?>" alt="Clinic name wall with flowers" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif' ); ?>" alt="Reception desk" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif' ); ?>" alt="Logo emblem on wall" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif' ); ?>" alt="Pink flowers and clinic logo" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif' ); ?>" alt="Treatment room with curtains" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif' ); ?>" alt="Circular mirror and orchid artwork" width="400" height="300" loading="lazy">
				</a>
				<a href="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif' ); ?>" class="gallery-grid__item fade-in">
					<img src="<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif' ); ?>" alt="Waiting area with curved partitions" width="400" height="300" loading="lazy">
				</a>
			</div>
		</div>
	</section>

	<!-- CTA Banner -->
	<section class="gallery-cta" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>');">
		<div class="gallery-cta__overlay"></div>
		<div class="container gallery-cta__content">
			<h2 class="fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Ready to Transform {accent}Your Smile?{/accent}' ); ?></h2>
			<p class="fade-in fade-in-delay-1"><?php mci_te( 'Book a consultation and discover the difference personalized dental care can make.' ); ?></p>
			<div class="gallery-cta__buttons fade-in fade-in-delay-2">
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				<a href="tel:+35725377757" class="btn btn-outline-light"><?php mci_te( 'Call +357 25 377757' ); ?></a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
