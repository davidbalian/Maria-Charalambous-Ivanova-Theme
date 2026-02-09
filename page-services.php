<?php
/**
 * Template Name: Services
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<!-- Hero -->
	<section class="services-hero">
		<div class="container">
			<h1 class="services-hero__title">Our Services</h1>
			<p class="services-hero__subtitle">From invisible aligners to single-visit transformations &mdash; discover what we can do for your smile.</p>
		</div>
	</section>

	<!-- Smilers Aligners -->
	<section class="services-item">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-primary">Orthodontics</span>
					<h2>Smilers Aligners</h2>
					<p>Discreet and tough dental aligners designed for modern lifestyles. Smilers offer a virtually invisible way to straighten your teeth and correct your bite &mdash; without the look and feel of traditional braces.</p>
					<p>Ideal for protecting gutters and correcting smiles invisibly, Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book a Consultation</a>
				</div>
				<div class="services-item__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners.jpg' ); ?>" alt="Smilers Aligners" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- One-Visit Transformations -->
	<section class="services-item services-item--reverse">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-secondary">Aesthetic Dentistry</span>
					<h2>One-Visit Transformations</h2>
					<p>Fast-track aesthetic dentistry at its finest. Using advanced materials and techniques, Dr. Maria can dramatically enhance your smile in a single appointment &mdash; creating a &ldquo;Masterpiece&rdquo; result you will love from day one.</p>
					<p>Whether you need veneers, bonding, or a complete smile makeover, our one-visit approach saves you time without compromising on quality.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book a Consultation</a>
				</div>
				<div class="services-item__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/one-visit.jpg' ); ?>" alt="One-Visit Transformations" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Cosmetic Masterpieces -->
	<section class="services-item">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-primary">Cosmetic</span>
					<h2>Cosmetic Masterpieces</h2>
					<p>Solutions crafted for timeless elegance. Our cosmetic services go beyond simple fixes &mdash; they are designed to create smiles that look natural, feel comfortable, and stand the test of time.</p>
					<p>From teeth whitening and porcelain veneers to full smile redesigns, every treatment is tailored to your unique features and personal goals.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book a Consultation</a>
				</div>
				<div class="services-item__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/cosmetic.jpg' ); ?>" alt="Cosmetic Masterpieces" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Preventative & Restorative Care -->
	<section class="services-item services-item--reverse">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-secondary">General Dentistry</span>
					<h2>Preventative &amp; Restorative Care</h2>
					<p>A beautiful smile starts with a healthy foundation. Our preventative and restorative services ensure your teeth and gums stay in excellent condition &mdash; so your smile looks great and lasts a lifetime.</p>
					<p>From routine check-ups and professional cleanings to fillings and crowns, we provide comprehensive care with the same attention to detail that defines everything we do.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book a Consultation</a>
				</div>
				<div class="services-item__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/restorative.jpg' ); ?>" alt="Preventative and Restorative Care" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
