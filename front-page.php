<?php
/**
 * The front page template.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<?php get_template_part( 'template-parts/home-v2/hero' ); ?>

	<?php get_template_part( 'template-parts/home-v2/comprehensive-services' ); ?>

	<?php get_template_part( 'template-parts/home-v2/welcome' ); ?>

	<?php get_template_part( 'template-parts/home-v2/doctor' ); ?>

	<?php get_template_part( 'template-parts/home-v2/benefits' ); ?>

	<?php get_template_part( 'template-parts/home-v2/gentle-touch' ); ?>

	<!-- Before & After -->
	<section id="before-after" class="home-cases">
		<div class="container">
			<h2 class="home-cases__title fade-in fade-in-delay-0"><?php echo mci_t( 'Before &amp; After' ); ?></h2>
			<div class="home-cases__grid">
				<div class="home-cases__item fade-in fade-in-delay-1">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/02/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ) ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="400" loading="lazy">
				</div>
				<div class="home-cases__item fade-in fade-in-delay-2">
					<img src="http://davidb1646.sg-host.com/wp-content/uploads/2026/04/dental-implants-bridge-before-after-missing-teeth-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp" alt="Before and after at Dental Art Clinic" width="400" height="400" loading="lazy">
				</div>
				<div class="home-cases__item fade-in fade-in-delay-3">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/02/before-and-after-at-dental-art-clinic-limassol-e1771955250456.webp' ) ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="400" loading="lazy">
				</div>
			</div>
			<div class="home-cases__action fade-in fade-in-delay-4">
				<a href="<?php echo esc_url( mci_url( '/gallery/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All' ); ?></a>
			</div>
		</div>
	</section>

	<!-- Existing Reviews -->
	<section id="reviews" class="home-reviews">
		<div class="container">
			<h2 class="home-reviews__title fade-in fade-in-delay-0"><?php mci_te( 'What Our Patients Say' ); ?></h2>
			<p class="home-reviews__text fade-in fade-in-delay-1"><?php mci_te( 'Real reviews from our community of patients in Limassol and beyond.' ); ?></p>
			<div class="home-reviews__widget fade-in fade-in-delay-2">
				<?php echo do_shortcode( '[trustindex no-registration=google]' ); ?>
			</div>
		</div>
	</section>

	<?php
	$clinic_image_base_url = home_url( '/wp-content/uploads/2026/02/' );
	$clinic_images = array(
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' => 'Dental Art Clinic treatment room wide angle',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' => 'Dental Art Clinic reception lobby',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-clinic-name-wall-flowers.avif' => 'Dental Art Clinic name and flowers',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' => 'Dental Art Clinic treatment room dental chair',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-view.avif' => 'Dental Art Clinic reception desk',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-logo-emblem-wall.avif' => 'Dental Art Clinic logo emblem',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair.avif' => 'Dental Art Clinic dental chair',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' => 'Dental Art Clinic reception marble counter',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif' => 'Dental Art Clinic pink flowers and logo',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-curtains-desk.avif' => 'Dental Art Clinic treatment room',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-marble-desk-flowers.avif' => 'Dental Art Clinic reception marble desk',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-big-smiles-quote.avif' => 'Dental Art Clinic pink flowers and quote',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-desk-curtains.avif' => 'Dental Art Clinic treatment room desk',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels.avif' => 'Dental Art Clinic reception desk wooden panels',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-white-orchids-big-smiles-quote.avif' => 'Dental Art Clinic white orchids',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment-alt.avif' => 'Dental Art Clinic dental equipment',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-desk-wooden-panels-alt.avif' => 'Dental Art Clinic reception wooden panels',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-ceiling-lighting-tv-screen.avif' => 'Dental Art Clinic ceiling and TV',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-equipment.avif' => 'Dental Art Clinic treatment equipment',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-waiting-area-curved-partitions.avif' => 'Dental Art Clinic waiting area',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif' => 'Dental Art Clinic mirror and orchid',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-smile-quote-wall.avif' => 'Dental Art Clinic treatment room smile quote',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif' => 'Dental Art Clinic waiting room',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-mirror-orchid-artwork-screens.avif' => 'Dental Art Clinic mirror and screens',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif' => 'Dental Art Clinic treatment room TV',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-area-big-smiles-quote.avif' => 'Dental Art Clinic waiting area quote',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-3d-letters-closeup.avif' => 'Dental Art Clinic smile quote',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-smile-quote-wall-text.avif' => 'Dental Art Clinic smile quote wall',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-bathroom-toilet-marble-sink-curtain.avif' => 'Dental Art Clinic bathroom',
		'dental-art-clinic-by-dr-maria-charalambous-ivanova-modern-bathroom-marble-sink.avif' => 'Dental Art Clinic modern bathroom',
	);
	?>

	<section class="home-v2-clinic" aria-label="The Clinic gallery">
		<div class="container">
			<div class="home-v2-clinic__header">
				<div>
					<h2 class="home-v2-clinic__title fade-in fade-in-delay-0"><?php mci_te( 'The Clinic' ); ?></h2>
					<p class="home-v2-clinic__subtitle fade-in fade-in-delay-1"><?php mci_te( 'Step inside Dental Art Clinic Limassol.' ); ?></p>
				</div>
				<div class="home-v2-clinic__nav fade-in fade-in-delay-2" aria-label="Clinic gallery navigation">
					<button type="button" class="home-v2-clinic__button js-clinic-prev" aria-label="Previous clinic photos">
						<span aria-hidden="true">&#8592;</span>
					</button>
					<button type="button" class="home-v2-clinic__button js-clinic-next" aria-label="Next clinic photos">
						<span aria-hidden="true">&#8594;</span>
					</button>
				</div>
			</div>

			<div class="swiper home-v2-clinic__carousel js-clinic-swiper">
				<div class="swiper-wrapper">
					<?php foreach ( $clinic_images as $filename => $alt_text ) : ?>
						<?php
						$clinic_image_url = preg_match( '#^https?://#i', $filename )
							? $filename
							: $clinic_image_base_url . $filename;
						?>
						<div class="swiper-slide">
							<img
								src="<?php echo esc_url( $clinic_image_url ); ?>"
								alt="<?php echo esc_attr( $alt_text ); ?>"
								loading="lazy"
								decoding="async"
							>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Existing Contact -->
	<section class="home-contact">
		<div class="container">
			<div class="home-contact__grid">
				<div class="home-contact__info">
					<h2 class="home-contact__title fade-in fade-in-delay-0"><?php mci_te( 'Contact Us' ); ?></h2>

					<div class="home-contact__detail fade-in fade-in-delay-1">
						<h3><?php mci_te( 'Phone' ); ?></h3>
						<p><a href="tel:+35725377757">+357 25 377757</a></p>
					</div>

					<div class="home-contact__detail fade-in fade-in-delay-2">
						<h3><?php mci_te( 'Email' ); ?></h3>
						<p><a href="mailto:info@dentalartcliniclimassol.com">info@dentalartcliniclimassol.com</a></p>
					</div>

					<div class="home-contact__detail fade-in fade-in-delay-3">
						<h3><?php mci_te( 'Address' ); ?></h3>
						<p>PRIMO AMARI, Walter Gropius 49-49,<br>Floor 1, Apt. 101, Limassol 3076, Cyprus</p>
					</div>

					<div class="home-contact__detail fade-in fade-in-delay-4">
						<?php get_template_part( 'template-parts/hours-table', null, array(
							'heading_tag' => 'h3',
							'status_id'   => 'clinic-open-status',
						) ); ?>
					</div>

					<div class="home-contact__actions">
						<div class="fade-in fade-in-delay-5">
							<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Contact Us' ); ?></a>
						</div>
						<div class="fade-in fade-in-delay-6">
							<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => '' ) ); ?>
						</div>
					</div>
				</div>

				<div class="home-contact__map fade-in fade-in-delay-2">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.5421916025243!2d33.02873507516838!3d34.69150218370725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14e7330f632d0d33%3A0x5cf67fad34f79431!2sDental%20Art%20Clinic%20by%20Dr.%20Maria%20Charalambous-Ivanova%20MSD!5e0!3m2!1sen!2s!4v1771914115199!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Dental Art Clinic location"></iframe>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/home-v2/consultation' ); ?>

</main>

<?php get_footer(); ?>
