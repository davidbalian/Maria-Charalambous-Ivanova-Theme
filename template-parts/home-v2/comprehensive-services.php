<?php
/**
 * Home comprehensive services: Emax row, Smilers row, CTA.
 *
 * @package Maria_Charalambous_Ivanova
 */
?>
<!-- Comprehensive Services Section -->
<section id="comprehensive-dental-care" class="home-v2-comprehensive">
	<div class="container">
		<h2 class="home-v2-comprehensive__title fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Comprehensive Dental Care for {accent}Every Need{/accent}' ); ?></h2>
		<p class="home-v2-comprehensive__subtitle fade-in fade-in-delay-1"><?php mci_te( 'High-quality dental care in a welcoming environment — helping patients maintain oral health while enhancing their smile.' ); ?></p>

		<!-- Emax Veneers & Crowns -->
		<div class="home-v2-comprehensive__smilers home-v2-comprehensive__emax">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Aesthetic Dentistry' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Emax Veneers & Crowns' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Emax is the gold standard in aesthetic restorations — ultra-thin, layered ceramic that captures the natural translucency, light play, and character of real enamel.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Whether refining shape, shade, or symmetry, Emax delivers strength and beauty that last for years — a restoration indistinguishable from your own teeth.' ); ?></p>
					<div class="fade-in fade-in-delay-4">
						<a href="<?php echo esc_url( mci_whatsapp_chat_url() ); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/additional-hero-images-2.webp' ) ); ?>" alt="Emax veneers and crowns" width="560">
				</div>
			</div>
		</div>

		<!-- Smilers Aligners (same content as services page; transparent, constrained to .container) -->
		<div class="home-v2-comprehensive__smilers">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontics' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet, durable aligners for modern lifestyles — a virtually invisible way to straighten teeth and correct your bite.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Correct your smile invisibly — Smilers let you go about your day with confidence while your teeth gently shift into place.' ); ?></p>
					<div class="fade-in fade-in-delay-4">
						<a href="<?php echo esc_url( mci_whatsapp_chat_url() ); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5.webp' ) ); ?>" alt="Smilers Aligners" width="560">
				</div>
			</div>
		</div>

		<div class="home-v2-comprehensive__cta fade-in fade-in-delay-5">
			<a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All Services' ); ?></a>
		</div>
	</div>
</section>
