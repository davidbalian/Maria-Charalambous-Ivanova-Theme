<?php
/**
 * The front page template.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<?php get_template_part( 'template-parts/home-v2/hero' ); ?>

	<!-- Before & After -->
	<section class="home-cases">
		<div class="container">
			<h2 class="home-cases__title">Before &amp; After</h2>
			<div class="home-cases__grid">
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" class="glightbox home-cases__item" data-gallery="cases">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="400">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" class="glightbox home-cases__item" data-gallery="cases">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="400">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" class="glightbox home-cases__item" data-gallery="cases">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="400">
				</a>
			</div>
			<div class="home-cases__action">
				<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn-outline">View All</a>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/home-v2/gentle-touch' ); ?>
	
	<?php get_template_part( 'template-parts/home-v2/comprehensive-services' ); ?>
	
	<?php get_template_part( 'template-parts/home-v2/doctor' ); ?>

	<!-- The Clinic -->
	<section class="home-clinic">
		<div class="container">
			<h2 class="home-clinic__title">The Clinic</h2>
			<div class="home-clinic__grid home-clinic__grid--masonry">
				<?php
				$clinic_images = array(
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-bathroom-toilet-marble-sink-curtain.avif' => 'Dental Art Clinic bathroom',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-ceiling-lighting-tv-screen.avif' => 'Dental Art Clinic ceiling and TV',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif' => 'Dental Art Clinic mirror and orchid',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif' => 'Dental Art Clinic name and flowers',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif' => 'Dental Art Clinic logo emblem',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-mirror-orchid-artwork-screens.avif' => 'Dental Art Clinic mirror and screens',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-modern-bathroom-marble-sink.avif' => 'Dental Art Clinic modern bathroom',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-big-smiles-quote.avif' => 'Dental Art Clinic pink flowers and quote',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif' => 'Dental Art Clinic pink flowers and logo',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' => 'Dental Art Clinic reception marble counter',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif' => 'Dental Art Clinic reception desk',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels-alt.avif' => 'Dental Art Clinic reception wooden panels',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels.avif' => 'Dental Art Clinic reception desk wooden panels',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' => 'Dental Art Clinic reception lobby',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-marble-desk-flowers.avif' => 'Dental Art Clinic reception marble desk',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif' => 'Dental Art Clinic waiting area',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-3d-letters-closeup.avif' => 'Dental Art Clinic smile quote',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-quote-wall-text.avif' => 'Dental Art Clinic smile quote wall',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif' => 'Dental Art Clinic treatment room',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' => 'Dental Art Clinic treatment room dental chair',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair.avif' => 'Dental Art Clinic dental chair',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment-alt.avif' => 'Dental Art Clinic dental equipment',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment.avif' => 'Dental Art Clinic treatment equipment',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-desk-curtains.avif' => 'Dental Art Clinic treatment room desk',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-smile-quote-wall.avif' => 'Dental Art Clinic treatment room smile quote',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif' => 'Dental Art Clinic treatment room TV',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' => 'Dental Art Clinic treatment room wide angle',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-white-orchids-big-smiles-quote.avif' => 'Dental Art Clinic white orchids',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif' => 'Dental Art Clinic waiting room',
					'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-area-big-smiles-quote.avif' => 'Dental Art Clinic waiting area quote',
				);
				$clinic_base = 'http://davidb1646.sg-host.com/wp-content/uploads/2026/02/';
				foreach ( $clinic_images as $file => $alt ) :
					$url = $clinic_base . $file;
				?>
				<a href="<?php echo esc_url( $url ); ?>" class="glightbox home-clinic__item" data-gallery="clinic">
					<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy">
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Existing Reviews -->
	<section class="home-reviews">
		<div class="container">
			<h2 class="home-reviews__title">What Our Patients Say</h2>
			<p class="home-reviews__text">Real reviews from our community of patients in Limassol and beyond.</p>
			<div class="home-reviews__widget">
				<?php echo do_shortcode( '[trustindex no-registration=google]' ); ?>
			</div>
		</div>
	</section>

	<!-- Existing Contact -->
	<section class="home-contact">
		<div class="container">
			<div class="home-contact__grid">
				<div class="home-contact__info">
					<h2 class="home-contact__title">Get in Touch</h2>

					<div class="home-contact__detail">
						<h4>Phone</h4>
						<p><a href="tel:+35725123456">+357 25 123 456</a></p>
					</div>

					<div class="home-contact__detail">
						<h4>Email</h4>
						<p><a href="mailto:info@dentalartcliniclimassol.com">info@dentalartcliniclimassol.com</a></p>
					</div>

					<div class="home-contact__detail">
						<h4>Address</h4>
						<p>Limassol, Cyprus</p>
					</div>

					<div class="home-contact__detail">
						<h4>Hours</h4>
						<table class="contact-hours">
							<tr><td>Monday &ndash; Friday</td><td>9:00 &ndash; 18:00</td></tr>
							<tr><td>Saturday</td><td>9:00 &ndash; 13:00</td></tr>
							<tr><td>Sunday</td><td>Closed</td></tr>
						</table>
					</div>

					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Contact Us</a>
				</div>

				<div class="home-contact__map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52340.59498705129!2d33.00703!3d34.68406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14e733800000003b%3A0x3a8b0db0024c40d0!2sLimassol%2C%20Cyprus!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Dental Art Clinic location"></iframe>
				</div>
			</div>
		</div>
	</section>

	<!-- Existing CTA -->
	<section class="home-cta" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-at-dental-art-clinic-in-limassol.webp' ); ?>');">
		<div class="home-cta__overlay"></div>
		<div class="container home-cta__inner">
			<h2 class="home-cta__title">Ready to Transform Your Smile?</h2>
			<p class="home-cta__text">Schedule your appointment today and discover the Dental Art Clinic difference.</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book Your Appointment</a>
		</div>
	</section>

	<?php get_template_part( 'template-parts/home-v2/consultation' ); ?>

</main>

<?php get_footer(); ?>
