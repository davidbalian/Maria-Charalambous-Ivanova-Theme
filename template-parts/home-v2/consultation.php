<!-- Consultation Section -->
<section class="home-v2-consultation" style="background-image: url('https://davidb1646.sg-host.com/wp-content/uploads/2026/02/dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif');">
	<div class="home-v2-consultation__overlay"></div>
	<div class="container">
		<div class="home-v2-consultation__grid">
			<div class="home-v2-consultation__info fade-in fade-in-delay-0">
				<h2><?php mci_te( 'Ready to Transform Your Smile?' ); ?></h2>
				<p><?php mci_te( 'Book a consultation with Dr. Maria Charalambous-Ivanova and discover how scientific precision and aesthetic harmony can create the smile you\'ve always wanted.' ); ?></p>
				<p><?php mci_te( 'Each case is treated individually with no standardized solutions — only the right solution for the specific patient, always focusing on long-term health, proper function, and aesthetic balance.' ); ?></p>
			</div>
			<div class="home-v2-consultation__form fade-in fade-in-delay-1">
				<h3><?php mci_te( 'Send Message' ); ?></h3>
				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<?php wp_nonce_field( 'mci_contact_form_nonce', 'mci_contact_nonce' ); ?>
					<input type="hidden" name="action" value="mci_contact_form">
					<input type="hidden" name="mci_form_lang" value="<?php echo esc_attr( mci_get_current_lang() ); ?>">

					<div class="form-group">
						<label for="consultation-name"><?php mci_te( 'Full Name' ); ?></label>
						<input type="text" id="consultation-name" name="contact_name" placeholder="<?php echo esc_attr( mci_t( 'e.g. Maria Georgiou' ) ); ?>" required>
					</div>
					<div class="form-group">
						<label for="consultation-phone"><?php mci_te( 'Phone' ); ?></label>
						<input type="tel" id="consultation-phone" name="contact_phone" placeholder="<?php echo esc_attr( mci_t( '+357 99 123 456' ) ); ?>" required>
					</div>
					<div class="form-group">
						<label for="consultation-email"><?php mci_te( 'Email' ); ?></label>
						<input type="email" id="consultation-email" name="contact_email" placeholder="<?php echo esc_attr( mci_t( 'your@email.com' ) ); ?>" required>
					</div>
					<div class="form-group">
						<label for="consultation-message"><?php mci_te( 'Message' ); ?></label>
						<textarea id="consultation-message" name="contact_message" rows="4" placeholder="<?php echo esc_attr( mci_t( 'Tell us about your smile goals...' ) ); ?>"></textarea>
					</div>
					<button type="submit" class="btn btn-primary"><?php mci_te( 'Send Message' ); ?></button>
				</form>
			</div>
		</div>
	</div>
</section>
