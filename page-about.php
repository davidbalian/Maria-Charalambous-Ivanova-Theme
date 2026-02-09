<?php
/**
 * Template Name: About
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<!-- Hero -->
	<section class="about-hero">
		<div class="container">
			<h1 class="about-hero__title">About the Clinic</h1>
			<p class="about-hero__subtitle">Where clinical excellence meets artistic vision &mdash; in the heart of Limassol.</p>
		</div>
	</section>

	<!-- Mission -->
	<section class="about-mission">
		<div class="container">
			<h2>The Masterpiece Philosophy</h2>
			<p>At Dental Art Clinic, we believe that a beautiful smile is more than straight, white teeth &mdash; it is a reflection of who you are. Our philosophy centres on treating each patient as an individual, designing results that complement their features and express their personality.</p>
			<blockquote>
				<p>&ldquo;Every smile we create is a unique masterpiece &mdash; crafted with precision, care, and an artist&rsquo;s eye for detail.&rdquo;</p>
			</blockquote>
			<p>From the first consultation to the final reveal, we combine advanced dental techniques with a deep commitment to aesthetics, ensuring results that are both clinically sound and naturally beautiful.</p>
		</div>
	</section>

	<!-- Doctor Profile -->
	<section class="about-doctor">
		<div class="container">
			<div class="about-doctor__grid">
				<div class="about-doctor__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/dr-maria-charalambous-ivanova-dental-clinic-in-limassol.webp' ); ?>" alt="Dr. Maria Charalambous-Ivanova" width="560" height="700">
				</div>
				<div class="about-doctor__bio">
					<h2>Dr. Maria Charalambous-Ivanova <span class="text-light">MSD</span></h2>
					<p>Dr. Maria is a dedicated dental professional with a passion for aesthetic excellence. Holding a Master of Science in Dentistry, she brings years of clinical experience and a meticulous artistic sensibility to every procedure.</p>
					<p>Her approach blends the latest in dental technology with a personal touch, ensuring every patient feels confident and cared for throughout their journey to a new smile.</p>
					<p>Whether performing a single-visit cosmetic transformation or guiding a patient through orthodontic treatment with Smilers Aligners, Dr. Maria treats every case as an opportunity to create something truly special.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Clinic Experience -->
	<section class="about-experience">
		<div class="container">
			<h2>The Clinic Experience</h2>
			<p>Located in Limassol, Cyprus, Dental Art Clinic offers a modern, welcoming environment designed to put patients at ease. From the moment you step through our doors, you will experience a space where comfort meets cutting-edge dental care.</p>
			<p>Our clinic is equipped with the latest technology, allowing us to deliver precise diagnoses and exceptional results. We take pride in creating an atmosphere where every visit feels personal, professional, and reassuring.</p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
