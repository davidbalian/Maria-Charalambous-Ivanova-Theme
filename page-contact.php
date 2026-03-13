<?php
/**
 * Template Name: Contact
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<!-- Hero -->
	<section class="contact-hero">
		<div class="container">
			<h1 class="contact-hero__title">Contact Us</h1>
			<p class="contact-hero__subtitle">If you would like to schedule an appointment or need more information about our dental services, please feel free to contact us.</p>
			<p class="contact-hero__intro">Our team will be happy to assist you and help you achieve a healthy and beautiful smile. You can also fill out the contact form on our website and we will get back to you as soon as possible.</p>
		</div>
	</section>

	<!-- Contact Layout -->
	<section class="contact-content">
		<div class="container">

			<?php if ( isset( $_GET['contact'] ) && $_GET['contact'] === 'success' ) : ?>
				<div class="alert alert-success">
					<strong>Thank you!</strong> Your message has been sent. We will get back to you shortly.
				</div>
			<?php elseif ( isset( $_GET['contact'] ) && $_GET['contact'] === 'error' ) : ?>
				<div class="alert alert-warning">
					<strong>Something went wrong.</strong> Please try again or contact us directly by phone.
				</div>
			<?php endif; ?>

			<div class="contact-layout">

				<!-- Contact Info -->
				<div class="contact-info">
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
						<h4>Operating Hours</h4>
						<table class="contact-hours">
							<tr>
								<td>Monday &ndash; Thursday</td>
								<td>8:00 AM &ndash; 5:30 PM</td>
							</tr>
							<tr>
								<td>Friday</td>
								<td>8:00 AM &ndash; 1:00 PM</td>
							</tr>
							<tr>
								<td>Saturday &ndash; Sunday</td>
								<td>Closed</td>
							</tr>
						</table>
					</div>
				</div>

				<!-- Appointment Form -->
				<div class="contact-form-wrap">
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
							<label for="contact-service">Service</label>
							<select id="contact-service" name="contact_service" required>
								<option value="" disabled selected>Select a service</option>
								<option value="General Dental Examination & Prevention">General Dental Examination &amp; Prevention</option>
								<option value="Professional Teeth Cleaning">Professional Teeth Cleaning</option>
								<option value="Dental Fillings">Dental Fillings</option>
								<option value="Root Canal Treatment">Root Canal Treatment (Endodontics)</option>
								<option value="Tooth Extractions">Tooth Extractions</option>
								<option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
								<option value="Crowns & Bridges">Crowns &amp; Bridges</option>
								<option value="Dental Implants">Dental Implants</option>
								<option value="Dentures">Dentures</option>
								<option value="Periodontal Treatment">Periodontal Treatment</option>
								<option value="Emergency Dental Care">Emergency Dental Care</option>
								<option value="Smilers Aligners">Smilers Aligners</option>
								<option value="One-Visit Transformations">One-Visit Transformations</option>
								<option value="General Inquiry">General Inquiry</option>
							</select>
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
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.5!2d33.04!3d34.68!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sLimassol%2C+Cyprus!5e0!3m2!1sen!2s!4v1"
			width="100%"
			height="450"
			style="border:0;"
			allowfullscreen=""
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"
			title="Dental Art Clinic Location">
		</iframe>
	</section>

</main>

<?php get_footer(); ?>
