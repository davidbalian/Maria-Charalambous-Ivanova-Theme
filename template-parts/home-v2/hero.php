<?php
$hero_image_url = 'https://davidb1646.sg-host.com/wp-content/uploads/2026/02/dr-maria-charalambous-ivanova-portrait-08-e1771938361770.avif';
?>
<section class="home-hero">
	<div class="home-hero__container">
		<div class="home-hero__text-col">
			<div class="home-hero__inner">
				<div class="home-hero__content">
					<h1 class="home-hero__title fade-in fade-in-delay-0"><?php echo mci_t( 'Beautiful Smiles' ); ?> <span class="accent-font"><?php mci_te( 'Start Here' ); ?></span></h1>
					<p class="home-hero__text fade-in fade-in-delay-1"><?php mci_te( 'Professional dental care with modern technology, personalized treatment, and a focus on long-term oral health.' ); ?></p>
					<div class="home-hero__ctas fade-in fade-in-delay-2">
						<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
						<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'Contact Us' ); ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="home-hero__image-col">
			<div class="home-hero__image fade-in fade-in-delay-5">
				<img src="<?php echo esc_url( $hero_image_url ); ?>" alt="Dental Art Clinic treatment room with TV screen and dental work." width="800" height="600" />
			</div>
		</div>
	</div>
	<a href="#welcome" class="home-hero__scroll-down" aria-label="Scroll to next section">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
	</a>
</section>
