<?php
/**
 * The front page template.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<!-- Hero -->
	<section class="home-hero">
		<div class="container">
			<h1 class="home-hero__title">Transforming Smiles is a Work of Art.</h1>
			<p class="home-hero__subtitle">Creating a masterpiece in just one visit to give you the smile you have always dreamed of.</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book Your Consultation</a>
		</div>
	</section>

	<!-- Brand Philosophy -->
	<section class="home-philosophy">
		<div class="container">
			<h2 class="home-philosophy__title">An Artistic Approach to Dentistry</h2>
			<p class="home-philosophy__text">At Dental Art Clinic, every smile is treated as a unique work of art. Dr. Maria Charalambous-Ivanova combines clinical precision with an aesthetic eye, crafting results that look natural, feel comfortable, and inspire confidence &mdash; often in just one visit.</p>
		</div>
	</section>

	<!-- Featured Services -->
	<section class="home-services">
		<div class="container">
			<h2 class="home-services__title">Featured Services</h2>
			<div class="card-grid">
				<div class="card">
					<div class="card-image">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners.jpg' ); ?>" alt="Smilers Aligners" width="600" height="400">
					</div>
					<div class="card-body">
						<h3>Smilers Aligners</h3>
						<p>Discreet and tough dental aligners &mdash; ideal for correcting smiles invisibly while protecting your teeth.</p>
						<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-outline">Learn More</a>
					</div>
				</div>
				<div class="card">
					<div class="card-image">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cosmetic.jpg' ); ?>" alt="Cosmetic Transformations" width="600" height="400">
					</div>
					<div class="card-body">
						<h3>Cosmetic Transformations</h3>
						<p>Fast-track aesthetic dentistry to create &ldquo;Masterpiece&rdquo; smiles &mdash; solutions crafted for timeless elegance.</p>
						<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-outline">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Trust Indicators -->
	<section class="home-trust">
		<div class="container">
			<div class="home-trust__grid">
				<div class="home-trust__item">
					<span class="home-trust__number">2.6K+</span>
					<span class="home-trust__label">Community</span>
				</div>
				<div class="home-trust__item">
					<span class="home-trust__number">Limassol</span>
					<span class="home-trust__label">Cyprus</span>
				</div>
				<div class="home-trust__item">
					<span class="home-trust__number">1 Visit</span>
					<span class="home-trust__label">Transformations</span>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
