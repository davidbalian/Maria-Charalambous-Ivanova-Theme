<?php
/**
 * Template Name: Contact
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header();

$clinic_image_base = 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/';
?>

<main id="main" class="site-main">

	<!-- Hero with background image -->
	<section class="contact-hero" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' ); ?>');">
		<div class="contact-hero__overlay"></div>
		<div class="container contact-hero__content">
			<h1 class="contact-hero__title fade-in fade-in-delay-0">Contact Us</h1>
			<p class="contact-hero__subtitle fade-in fade-in-delay-1">We would love to hear from you. Reach out to schedule an appointment or learn more about our services.</p>
			<a href="tel:+35725377757" class="btn btn-primary fade-in fade-in-delay-2">Call +357 25 377757</a>
		</div>
	</section>

	<!-- Contact Layout -->
	<section class="contact-content page-section page-section--background">
		<div class="container">

			<?php if ( isset( $_GET['contact'] ) && $_GET['contact'] === 'success' ) : ?>
				<div class="alert alert-success fade-in fade-in-delay-0">
					<strong>Thank you!</strong> Your message has been sent. We will get back to you shortly.
				</div>
			<?php elseif ( isset( $_GET['contact'] ) && $_GET['contact'] === 'error' ) : ?>
				<div class="alert alert-warning fade-in fade-in-delay-0">
					<strong>Something went wrong.</strong> Please try again or contact us directly by phone.
				</div>
			<?php endif; ?>

			<div class="contact-layout">

				<!-- Contact Info -->
				<div class="contact-info contact-card fade-in fade-in-delay-0">
					<h2>Contact Information</h2>

					<div class="contact-info__item">
						<h4>Phone</h4>
						<p><a href="tel:+35725377757">+357 25 377757</a></p>
					</div>

					<div class="contact-info__item">
						<h4>Email</h4>
						<p><a href="mailto:info@dentalartcliniclimassol.com">info@dentalartcliniclimassol.com</a></p>
					</div>

					<div class="contact-info__item">
						<h4>Address</h4>
						<p>PRIMO AMARI, Walter Gropius 49-49,<br>Floor 1, Apt. 101, Limassol 3076, Cyprus</p>
					</div>

					<div class="contact-info__item">
						<?php get_template_part( 'template-parts/hours-table', null, array(
							'heading_text' => 'Operating Hours',
							'status_id'    => 'contact-clinic-status',
						) ); ?>
					</div>
				</div>

				<!-- Appointment Form -->
				<div class="contact-form-wrap contact-card fade-in fade-in-delay-1">
					<h2>Book an Appointment</h2>
					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<input type="hidden" name="action" value="mci_contact_form">
						<?php wp_nonce_field( 'mci_contact_form_nonce', 'mci_contact_nonce' ); ?>

						<div class="form-group">
							<label for="contact-name">Name</label>
							<input type="text" id="contact-name" name="contact_name" placeholder="Your full name" required>
						</div>

						<div class="form-group">
							<label for="contact-phone">Phone</label>
							<input type="tel" id="contact-phone" name="contact_phone" placeholder="+357 ..." required>
						</div>

						<div class="form-group">
							<label for="contact-email">Email</label>
							<input type="email" id="contact-email" name="contact_email" placeholder="your@email.com" required>
						</div>

						<div class="form-group">
							<label for="contact-message">Message</label>
							<textarea id="contact-message" name="contact_message" rows="5" placeholder="Tell us how we can help..."></textarea>
						</div>

						<button type="submit" class="btn btn-primary">Send Message</button>
					</form>
				</div>

			</div>
		</div>
	</section>

	<!-- Map -->
	<section class="contact-map">
		<div class="fade-in fade-in-delay-0">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.5421916025243!2d33.02873507516838!3d34.69150218370725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14e7330f632d0d33%3A0x5cf67fad34f79431!2sDental%20Art%20Clinic%20by%20Dr.%20Maria%20Charalambous-Ivanova%20MSD!5e0!3m2!1sen!2s!4v1771914115199!5m2!1sen!2s"
				width="100%"
				height="450"
				style="border:0;"
				allowfullscreen=""
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				title="Dental Art Clinic Location">
			</iframe>
		</div>
	</section>

	<!-- CTA Banner -->
	<section class="contact-cta" style="background-image: url('<?php echo esc_url( $clinic_image_base . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' ); ?>');">
		<div class="contact-cta__overlay"></div>
		<div class="container contact-cta__content">
			<h2 class="fade-in fade-in-delay-0">Ready to Transform <span class="accent-font">Your Smile?</span></h2>
			<p class="fade-in fade-in-delay-1">Book a consultation and discover the difference personalized dental care can make.</p>
			<div class="contact-cta__buttons fade-in fade-in-delay-2">
				<a href="tel:+35725377757" class="btn btn-primary">Call +357 25 377757</a>
				<a href="mailto:info@dentalartcliniclimassol.com" class="btn btn-outline-light">Email Us</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
