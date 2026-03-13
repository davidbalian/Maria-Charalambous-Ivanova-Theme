<?php
/**
 * Template Name: Services
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'title'    => 'Our Services',
			'subtitle' => 'At our dental clinic, we are committed to providing high-quality dental care in a comfortable and welcoming environment. Our goal is to help patients maintain excellent oral health while enhancing the beauty and function of their smile. Using modern technology and evidence-based treatments, we offer personalized dental care tailored to the needs of every patient.',
		)
	);
	?>

	<?php get_template_part( 'template-parts/services-list' ); ?>

	<!-- Smilers Aligners -->
	<section class="services-item page-section page-section--surface">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-primary fade-in fade-in-delay-0">Orthodontics</span>
					<h2 class="fade-in fade-in-delay-1">Smilers Aligners</h2>
					<p class="fade-in fade-in-delay-2">Discreet and tough dental aligners designed for modern lifestyles. Smilers offer a virtually invisible way to straighten your teeth and correct your bite &mdash; without the look and feel of traditional braces.</p>
					<p class="fade-in fade-in-delay-3">Ideal for protecting gutters and correcting smiles invisibly, Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4">Book Appointment</a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Smilers Aligners" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- One-Visit Transformations -->
	<section class="services-item services-item--reverse page-section page-section--background">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-secondary fade-in fade-in-delay-0">Aesthetic Dentistry</span>
					<h2 class="fade-in fade-in-delay-1">One-Visit Transformations</h2>
					<p class="fade-in fade-in-delay-2">Fast-track aesthetic dentistry at its finest. Using advanced materials and techniques, Dr. Maria can dramatically enhance your smile in a single appointment &mdash; creating a &ldquo;Masterpiece&rdquo; result you will love from day one.</p>
					<p class="fade-in fade-in-delay-3">Whether you need veneers, bonding, or a complete smile makeover, our one-visit approach saves you time without compromising on quality.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4">Book Appointment</a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="One-Visit Transformations" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Cosmetic Masterpieces -->
	<section class="services-item page-section page-section--surface">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-primary fade-in fade-in-delay-0">Cosmetic</span>
					<h2 class="fade-in fade-in-delay-1">Cosmetic Masterpieces</h2>
					<p class="fade-in fade-in-delay-2">Solutions crafted for timeless elegance. Our cosmetic services go beyond simple fixes &mdash; they are designed to create smiles that look natural, feel comfortable, and stand the test of time.</p>
					<p class="fade-in fade-in-delay-3">From teeth whitening and porcelain veneers to full smile redesigns, every treatment is tailored to your unique features and personal goals.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4">Book Appointment</a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Cosmetic Masterpieces" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

	<!-- Preventative & Restorative Care -->
	<section class="services-item services-item--reverse page-section page-section--background">
		<div class="container">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-secondary fade-in fade-in-delay-0">General Dentistry</span>
					<h2 class="fade-in fade-in-delay-1">Preventative &amp; Restorative Care</h2>
					<p class="fade-in fade-in-delay-2">A beautiful smile starts with a healthy foundation. Our preventative and restorative services ensure your teeth and gums stay in excellent condition &mdash; so your smile looks great and lasts a lifetime.</p>
					<p class="fade-in fade-in-delay-3">From routine check-ups and professional cleanings to fillings and crowns, we provide comprehensive care with the same attention to detail that defines everything we do.</p>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4">Book Appointment</a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Preventative and Restorative Care" width="560" height="420">
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
