<!-- Consultation Section -->
<section class="home-v2-consultation">
	<div class="container">
		<div class="home-v2-consultation__grid">
			<div class="home-v2-consultation__info">
				<h2>Ready to Transform Your Smile?</h2>
				<p>Book a consultation with Dr. Maria Charalambous-Ivanova and discover how scientific precision and aesthetic harmony can create the smile you've always wanted.</p>
				<p>Each case is treated individually with no standardized solutions — only the right solution for the specific patient, always focusing on long-term health, proper function, and aesthetic balance.</p>
			</div>
			<div class="home-v2-consultation__form">
				<h3>Book Your Consultation</h3>
				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<?php wp_nonce_field( 'mci_contact_nonce', 'mci_contact_nonce' ); ?>
					<input type="hidden" name="action" value="mci_contact_form">
					
					<div class="form-group">
						<label for="contact-name">Full Name</label>
						<input type="text" id="contact-name" name="contact_name" required>
					</div>
					<div class="form-group">
						<label for="contact-phone">Phone</label>
						<input type="tel" id="contact-phone" name="contact_phone" required>
					</div>
					<div class="form-group">
						<label for="contact-service">Service Interested In</label>
						<select id="contact-service" name="contact_service" required>
							<option value="">Select a service</option>
							<option value="Composite Veneers">Composite Veneers</option>
							<option value="Emax Veneers">Emax Veneers</option>
							<option value="Dental Implants">Dental Implants</option>
							<option value="Orthodontics">Orthodontics</option>
							<option value="Full Mouth Rehabilitation">Full Mouth Rehabilitation</option>
							<option value="General Consultation">General Consultation</option>
						</select>
					</div>
					<div class="form-group">
						<label for="contact-message">Message</label>
						<textarea id="contact-message" name="contact_message" rows="4"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</section>
