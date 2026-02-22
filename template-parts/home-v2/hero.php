<!-- Hero Section: One container with two columns — text | image -->
<?php
$hero_image_url = 'http://davidb1646.sg-host.com/wp-content/uploads/2026/02/dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif';
?>
<div class="home-hero-wrapper">
	<div class="home-hero home-hero__grid">
		<div class="home-hero__text-col">
			<div class="home-hero__inner">
				<div class="home-hero__content">
					<h1 class="home-hero__title">Excellence in Dentistry Is Designed — Not Accidental</h1>
					<p class="home-hero__text">At Dental Art Clinic Limassol, dentistry is approached as a combination of scientific precision, strategic planning, and aesthetic harmony.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book a Consultation</a>
				</div>

				<div class="home-hero__divider"></div>

				<div class="home-hero__stats">
					<div class="home-hero__stat">
						<div class="home-hero__stat-number">From 2008</div>
						<div class="home-hero__stat-text">And still going</div>
					</div>
					<div class="home-hero__stat-divider"></div>
					<div class="home-hero__stat">
						<div class="home-hero__stat-number">2 Clinics</div>
						<div class="home-hero__stat-text">Based in Limassol</div>
					</div>
					<div class="home-hero__stat-divider"></div>
					<div class="home-hero__stat">
						<div class="home-hero__stat-number">Full Mouth</div>
						<div class="home-hero__stat-text">Rehabilitation Specialist</div>
					</div>
				</div>
			</div>
		</div>
		<div class="home-hero__image-col">
			<div class="home-hero__image">
				<img src="<?php echo esc_url( $hero_image_url ); ?>" alt="Dental Art Clinic treatment room with TV screen and dental work." width="800" height="600" />
			</div>
		</div>
	</div>
</div>
