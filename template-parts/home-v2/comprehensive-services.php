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

		<!-- Premium E.max Veneers -->
		<div class="home-v2-comprehensive__smilers home-v2-comprehensive__emax">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Aesthetic Dentistry' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Premium E.max Veneers' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Achieve a natural, confident smile with ultra-thin, high-quality veneers designed just for you.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'E.max veneers are one of the most advanced solutions in cosmetic dentistry. Crafted from high-strength ceramic, they offer exceptional durability while maintaining a completely natural look.' ); ?></p>
					<p class="fade-in fade-in-delay-4"><?php mci_te( 'Each smile is digitally designed to match your facial features, ensuring a result that looks beautiful, not artificial.' ); ?></p>
					<div class="fade-in fade-in-delay-5">
						<a href="<?php echo esc_url( mci_whatsapp_chat_url() ); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<picture>
						<source media="(max-width: 768px)" srcset="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/additional-hero-images-2-body-mobile.webp' ) ); ?>">
						<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/additional-hero-images-2.webp' ) ); ?>" alt="Emax veneers and crowns" width="560">
					</picture>
				</div>
			</div>
		</div>

		<!-- Smilers Aligners (same content as services page; transparent, constrained to .container) -->
		<?php
		$home_smilers_dual_items          = array_slice( MCI_Galleries_Repository::get_items_for_location( MCI_Galleries_Locations::SMILERS_DUAL ), 0, 2 );
		$home_smilers_dual_balanced_class = count( $home_smilers_dual_items ) >= 2 ? ' services-item__grid--smilers-dual-balanced' : '';
		?>
		<div class="home-v2-comprehensive__smilers services-item--reverse">
			<div class="services-item__grid<?php echo esc_attr( $home_smilers_dual_balanced_class ); ?>">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontic Clear Aligners' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet, durable aligners for modern lifestyles — a virtually invisible way to straighten teeth and correct your bite.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Correct your smile invisibly — Smilers let you go about your day with confidence while your teeth gently shift into place.' ); ?></p>
					<div class="fade-in fade-in-delay-4">
						<a href="<?php echo esc_url( mci_whatsapp_chat_url() ); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><?php mci_te( 'Book Appointment' ); ?></a>
					</div>
					<?php get_template_part( 'template-parts/services-smilers-dual-gallery', '', array( 'items' => $home_smilers_dual_items ) ); ?>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<picture>
						<source media="(max-width: 768px)" srcset="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5-body-mobile.webp' ) ); ?>">
						<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5.webp' ) ); ?>" alt="Smilers Aligners" width="560">
					</picture>
				</div>
			</div>
		</div>

		<div class="home-v2-comprehensive__cta fade-in fade-in-delay-5">
			<a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All Services' ); ?></a>
		</div>
	</div>
</section>
