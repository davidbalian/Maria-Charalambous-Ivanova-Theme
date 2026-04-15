<?php
/**
 * Smilers Aligners featured row (services page and home comprehensive section).
 *
 * @package Maria_Charalambous_Ivanova
 */
?>
<!-- Smilers Aligners -->
<section class="services-item page-section page-section--surface">
	<div class="container">
		<div class="services-item__grid">
			<div class="services-item__content">
				<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontics' ); ?></span>
				<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
				<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet and tough dental aligners designed for modern lifestyles. Smilers offer a virtually invisible way to straighten your teeth and correct your bite — without the look and feel of traditional braces.' ); ?></p>
				<p class="fade-in fade-in-delay-3"><?php mci_te( 'Ideal for protecting gutters and correcting smiles invisibly, Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.' ); ?></p>
				<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4"><?php mci_te( 'Book Appointment' ); ?></a>
			</div>
			<div class="services-item__image fade-in fade-in-delay-2">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Smilers Aligners" width="560" height="420">
			</div>
		</div>
	</div>
</section>
