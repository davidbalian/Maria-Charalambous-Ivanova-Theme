<!-- Consultation Section -->
<section class="home-v2-consultation" style="background-image: url('https://davidb1646.sg-host.com/wp-content/uploads/2026/02/dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif');">
	<div class="home-v2-consultation__overlay"></div>
	<div class="container">
		<div class="home-v2-consultation__grid">
			<div class="home-v2-consultation__info fade-in fade-in-delay-0">
				<h2>Ready to Transform Your Smile?</h2>
				<p>Book a consultation with Dr. Maria Charalambous-Ivanova and discover how scientific precision and aesthetic harmony can create the smile you've always wanted.</p>
				<p>Each case is treated individually with no standardized solutions — only the right solution for the specific patient, always focusing on long-term health, proper function, and aesthetic balance.</p>
			</div>
			<div class="home-v2-consultation__form fade-in fade-in-delay-1">
				<h3>Send Message</h3>
				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<?php wp_nonce_field( 'mci_contact_form_nonce', 'mci_contact_nonce' ); ?>
					<input type="hidden" name="action" value="mci_contact_form">
					
					<div class="form-group">
						<label for="consultation-name">Full Name</label>
						<input type="text" id="consultation-name" name="contact_name" placeholder="e.g. Maria Georgiou" required>
					</div>
					<div class="form-group">
						<label for="consultation-phone">Phone</label>
						<input type="tel" id="consultation-phone" name="contact_phone" placeholder="+357 99 123 456" required>
					</div>
					<div class="form-group">
						<label for="consultation-email">Email</label>
						<input type="email" id="consultation-email" name="contact_email" placeholder="your@email.com" required>
					</div>
					<div class="form-group">
						<label for="consultation-message">Message</label>
						<textarea id="consultation-message" name="contact_message" rows="4" placeholder="Tell us about your smile goals..."></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Send Message</button>
				</form>
			</div>
		</div>
	</div>
</section>
