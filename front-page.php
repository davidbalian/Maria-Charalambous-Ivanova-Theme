<?php
/**
 * The front page template.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<!-- 1. Hero -->
	<section class="home-hero" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-package-and-dr-maria-charalambous-ivanova-at-dental-art-clinic-limassol.webp' ); ?>');">
		<div class="home-hero__overlay"></div>
		<div class="container home-hero__inner">
			<h1 class="home-hero__title">Your Smile, Our Masterpiece</h1>
			<p class="home-hero__text">Experience world-class dental care in the heart of Limassol. Dr. Maria Charalambous-Ivanova combines clinical precision with an artistic eye to craft smiles that inspire confidence.</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book a Consultation</a>
		</div>
	</section>

	<!-- 2. Services -->
	<section class="home-services">
		<div class="container">
			<h2 class="home-services__title">Our Services</h2>
			<div class="home-services__grid">

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a5 5 0 0 1 5 5c0 2-1.5 3.5-3 4.5V14H10v-2.5C8.5 10.5 7 9 7 7a5 5 0 0 1 5-5z"/><rect x="10" y="14" width="4" height="4" rx="0.5"/><path d="M10 18h4v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/></svg>
					</div>
					<h3 class="home-services__card-title">Preventative Dentistry</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20c2-4 4-14 8-14s6 10 8 14"/><path d="M4 20h16"/><path d="M8 6V4"/><path d="M16 6V4"/><path d="M12 6V2"/></svg>
					</div>
					<h3 class="home-services__card-title">Braces &amp; Orthodontic Treatment</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2a5 5 0 0 1 3 9l-1.5 1v2h-4v-2l-1.5-1a5 5 0 0 1 3-9h1z"/><rect x="10" y="14" width="4" height="3" rx="0.5"/><path d="M10 17h4v2.5a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5V17z"/><path d="M8 7h8"/></svg>
					</div>
					<h3 class="home-services__card-title">Operative Dentistry</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a5 5 0 0 1 5 5c0 2-1.5 3.5-3 4.5V14H10v-2.5C8.5 10.5 7 9 7 7a5 5 0 0 1 5-5z"/><path d="M10 14h4v7a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-7z"/><circle cx="12" cy="5.5" r="1"/></svg>
					</div>
					<h3 class="home-services__card-title">Prosthetic Dentistry</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a5 5 0 0 1 5 5c0 2-1.5 3.5-3 4.5V14H10v-2.5C8.5 10.5 7 9 7 7a5 5 0 0 1 5-5z"/><path d="M10 14h4v7a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-7z"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="8" y1="22" x2="16" y2="22"/></svg>
					</div>
					<h3 class="home-services__card-title">Implants</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v2"/><path d="M12 16v2"/><path d="M8 12H6"/><path d="M18 12h-2"/><circle cx="12" cy="12" r="3"/></svg>
					</div>
					<h3 class="home-services__card-title">Dental Diagnosis</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a5 5 0 0 1 5 5c0 2-1.5 3.5-3 4.5V14H10v-2.5C8.5 10.5 7 9 7 7a5 5 0 0 1 5-5z"/><path d="M10 14h4v7a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-7z"/><path d="M7 4l1.5 1.5"/><path d="M17 4l-1.5 1.5"/><path d="M14.5 7h2"/></svg>
					</div>
					<h3 class="home-services__card-title">Cosmetic Dentistry</h3>
				</a>

				<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="home-services__card">
					<div class="home-services__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a5 5 0 0 1 5 5c0 2-1.5 3.5-3 4.5V14H10v-2.5C8.5 10.5 7 9 7 7a5 5 0 0 1 5-5z"/><path d="M10 14h4v7a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-7z"/><path d="M9 7l3 3 3-3"/></svg>
					</div>
					<h3 class="home-services__card-title">Endodontics &mdash; Root Canal Treatments</h3>
				</a>

			</div>
		</div>
	</section>

	<!-- 3. About -->
	<section class="home-about">
		<div class="container">
			<div class="home-about__inner">
				<div class="home-about__content">
					<h2 class="home-about__title">An Artistic Approach to Dentistry</h2>
					<p class="home-about__text">At Dental Art Clinic, every smile is treated as a unique work of art. Dr. Maria Charalambous-Ivanova combines clinical precision with an aesthetic eye, crafting results that look natural, feel comfortable, and inspire confidence &mdash; often in just one visit.</p>
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-outline">Learn More About Us</a>
				</div>
				<div class="home-about__image">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/dr-maria-charalambous-ivanova-dental-clinic-in-limassol.webp' ); ?>" alt="Dr. Maria Charalambous-Ivanova at Dental Art Clinic Limassol" width="560" height="400">
				</div>
			</div>
		</div>
	</section>

	<!-- 4. The Clinic -->
	<section class="home-clinic">
		<div class="container">
			<h2 class="home-clinic__title">The Clinic</h2>
			<div class="home-clinic__grid">
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" class="glightbox home-clinic__item" data-gallery="clinic">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Smilers aligners at Dental Art Clinic" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-at-dental-art-clinic-in-limassol.webp' ); ?>" class="glightbox home-clinic__item" data-gallery="clinic">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-at-dental-art-clinic-in-limassol.webp' ); ?>" alt="Smilers at Dental Art Clinic in Limassol" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/dr-maria-charalambous-ivanova-dental-clinic-in-limassol.webp' ); ?>" class="glightbox home-clinic__item" data-gallery="clinic">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/dr-maria-charalambous-ivanova-dental-clinic-in-limassol.webp' ); ?>" alt="Dr. Maria Charalambous-Ivanova at Dental Art Clinic" width="400" height="300">
				</a>
			</div>
		</div>
	</section>

	<!-- 5. Reviews -->
	<section class="home-reviews">
		<div class="container">
			<h2 class="home-reviews__title">What Our Patients Say</h2>
			<p class="home-reviews__text">Real reviews from our community of patients in Limassol and beyond.</p>
			<div class="home-reviews__widget">
				<?php echo do_shortcode( '[trustindex no-registration=google]' ); ?>
			</div>
		</div>
	</section>

	<!-- 6. Case Studies -->
	<section class="home-cases">
		<div class="container">
			<h2 class="home-cases__title">Before &amp; After</h2>
			<div class="home-cases__grid">
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" class="glightbox home-cases__item" data-gallery="cases">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" class="glightbox home-cases__item" data-gallery="cases">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" class="glightbox home-cases__item" data-gallery="cases">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" alt="Before and after at Dental Art Clinic" width="400" height="300">
				</a>
			</div>
			<div class="home-cases__action">
				<a href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>" class="btn btn-outline">View All</a>
			</div>
		</div>
	</section>

	<!-- 7. Contact -->
	<section class="home-contact">
		<div class="container">
			<div class="home-contact__grid">
				<div class="home-contact__info">
					<h2 class="home-contact__title">Get in Touch</h2>

					<div class="home-contact__detail">
						<h4>Phone</h4>
						<p><a href="tel:+35725123456">+357 25 123 456</a></p>
					</div>

					<div class="home-contact__detail">
						<h4>Email</h4>
						<p><a href="mailto:info@dentalartcliniclimassol.com">info@dentalartcliniclimassol.com</a></p>
					</div>

					<div class="home-contact__detail">
						<h4>Address</h4>
						<p>Limassol, Cyprus</p>
					</div>

					<div class="home-contact__detail">
						<h4>Hours</h4>
						<table class="contact-hours">
							<tr><td>Monday &ndash; Friday</td><td>9:00 &ndash; 18:00</td></tr>
							<tr><td>Saturday</td><td>9:00 &ndash; 13:00</td></tr>
							<tr><td>Sunday</td><td>Closed</td></tr>
						</table>
					</div>

					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Contact Us</a>
				</div>

				<div class="home-contact__map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52340.59498705129!2d33.00703!3d34.68406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14e733800000003b%3A0x3a8b0db0024c40d0!2sLimassol%2C%20Cyprus!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Dental Art Clinic location"></iframe>
				</div>
			</div>
		</div>
	</section>

	<!-- 8. CTA -->
	<section class="home-cta" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-at-dental-art-clinic-in-limassol.webp' ); ?>');">
		<div class="home-cta__overlay"></div>
		<div class="container home-cta__inner">
			<h2 class="home-cta__title">Ready to Transform Your Smile?</h2>
			<p class="home-cta__text">Schedule your appointment today and discover the Dental Art Clinic difference.</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Book Your Appointment</a>
		</div>
	</section>

</main>

<?php get_footer(); ?>
