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
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-1.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-1.webp' ); ?>" alt="Before and after case study 1" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-2.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-2.webp' ); ?>" alt="Before and after case study 2" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-3.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-3.webp' ); ?>" alt="Before and after case study 3" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-4.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-4.webp' ); ?>" alt="Before and after case study 4" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-5.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-5.webp' ); ?>" alt="Before and after case study 5" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-6.webp' ); ?>" class="glightbox gallery-grid__item" data-gallery="gallery">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/case-study-6.webp' ); ?>" alt="Before and after case study 6" width="400" height="300">
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
