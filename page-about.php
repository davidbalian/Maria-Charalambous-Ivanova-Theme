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
			<p class="about-hero__subtitle">Excellence in Dentistry Is Designed &mdash; Not Accidental.</p>
		</div>
	</section>

	<!-- Mission -->
	<section class="about-mission">
		<div class="container">
			<h2>The Masterpiece Philosophy</h2>
			<p>At DENTAL ART CLINIC LIMASSOL, dentistry is approached as a combination of scientific precision, strategic planning, and aesthetic harmony. The establishment and expansion of the second clinic represent the natural evolution of a career built on trust, consistency, and a commitment to excellence.</p>
			<blockquote>
				<p>&ldquo;Because a smile is not just about appearance. It is function. It is balance. It is confidence. It is quality of life.&rdquo;</p>
			</blockquote>
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
					<h2>Dr. Maria Charalambous-Ivanova <span class="text-light">DMD, MSD</span></h2>
					<p>Dr. Maria Charalambous-Ivanova graduated from the University of Sofia in 2007 and has been practicing since 2008, building a dynamic and continuously evolving professional career. Through constant participation in international congresses and advanced training programs, she remains at the forefront of modern dental techniques.</p>
					<p>Her specialization in <strong>composite veneers</strong> and <strong>Emax veneers</strong> forms the foundation of her aesthetic philosophy. In addition, she undertakes complex and full mouth rehabilitation cases requiring comprehensive functional analysis, precise diagnosis, and carefully structured treatment planning.</p>
					<p>Each case is treated individually. There are no standardized solutions &mdash; only the right solution for the specific patient, always focusing on long-term health, proper function, and aesthetic balance.</p>
					<p>Collaboration with highly skilled and specialized partners ensures optimal, natural, and harmoniously balanced results.</p>
					<ul class="about-doctor__philosophy">
						<li>Scientific precision</li>
						<li>Strategic treatment planning</li>
						<li>Pain-free experience</li>
						<li>Absolute transparency and trust</li>
					</ul>
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
