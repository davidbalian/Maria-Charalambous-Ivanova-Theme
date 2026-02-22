<?php
/**
 * Template Name: Gallery
 *
 * A page template for displaying before/after case study images.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">

	<section class="gallery-hero">
		<div class="container">
			<h1 class="gallery-hero__title">Gallery</h1>
			<p class="gallery-hero__subtitle">Browse our collection of before &amp; after transformations and clinic photos.</p>
		</div>
	</section>

	<section class="gallery-content">
		<div class="container">
			<h2 class="gallery-content__heading">Before &amp; After</h2>
			<div class="gallery-grid">
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery" title="">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" alt="Before and after at Dental Art Clinic Limassol" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery" title="">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" alt="Before and after at Dental Art Clinic Limassol" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery" title="">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" alt="Before and after at Dental Art Clinic Limassol" width="400" height="300">
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
