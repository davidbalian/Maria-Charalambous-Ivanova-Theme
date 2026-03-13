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
			<p class="about-hero__subtitle">Welcome to our dental clinic, where your oral health and smile are our top priorities.</p>
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
			<h2>About the Clinic</h2>
			<p>Our dental clinic is dedicated to providing comprehensive dental care for patients of all ages. We focus on prevention, accurate diagnosis, and high-quality treatment to ensure the best possible results for every patient.</p>
			<p>We believe that visiting the dentist should be a comfortable and positive experience. For this reason, we create a friendly and relaxed environment while offering personalized care tailored to each patient's needs.</p>
			<p>Our priority is to build long-term relationships with our patients based on trust, professionalism, and excellent dental care.</p>
		</div>
	</section>

</main>

<?php get_footer(); ?>
