<?php
$hero_image_url = 'http://davidb1646.sg-host.com/wp-content/uploads/2026/02/dr-maria-charalambous-ivanova-portrait-08-e1771938361770.avif';
?>
<section class="home-hero">
	<div class="home-hero__container">
		<div class="home-hero__text-col">
			<div class="home-hero__inner">
				<div class="home-hero__content">
					<h1 class="home-hero__title fade-in fade-in-delay-0">Beautiful Smiles <span class="accent-font">Start Here</span></h1>
					<p class="home-hero__text fade-in fade-in-delay-1">Modern dentistry with personalized care.</p>
					<div class="home-hero__ctas fade-in fade-in-delay-2">
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book Appointment</a>
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline">Contact Us</a>
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
	<a href="#before-after" class="home-hero__scroll-down" aria-label="Scroll to next section">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
	</a>
</section>
