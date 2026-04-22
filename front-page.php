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

	<?php get_template_part( 'template-parts/gallery/section-home-before-after' ); ?>

	<?php get_template_part( 'template-parts/home-v2/gentle-touch' ); ?>

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

	<?php get_template_part( 'template-parts/gallery/section-home-clinic' ); ?>

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
