<?php
/**
 * Smilers Aligners featured row (services page).
 *
 * @package Maria_Charalambous_Ivanova
 */
?>
<!-- Smilers Aligners -->
<section class="services-item services-item--smilers page-section page-section--surface">
	<div class="container">
		<div class="services-item__grid">
			<div class="services-item__content">
				<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontics' ); ?></span>
				<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
				<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet and durable aligners built for modern lifestyles — Smilers offer a virtually invisible way to straighten your teeth and correct your bite, without the look or feel of traditional braces.' ); ?></p>
				<p class="fade-in fade-in-delay-3"><?php mci_te( 'Correct your smile invisibly — Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.' ); ?></p>
				<div class="fade-in fade-in-delay-4">
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
			</div>
			<div class="services-item__image fade-in fade-in-delay-2">
				<picture>
					<source media="(max-width: 768px)" srcset="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5-body-mobile.webp' ) ); ?>">
					<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5.webp' ) ); ?>" alt="Smilers Aligners" width="560">
				</picture>
			</div>
		</div>
	</div>
</section>
