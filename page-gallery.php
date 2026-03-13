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

	<?php
	get_template_part(
		'template-parts/page-hero',
		null,
		array(
			'title'    => 'Gallery',
			'subtitle' => 'Browse our collection of before &amp; after transformations and clinic photos.',
		)
	);
	?>

	<section class="gallery-content page-section page-section--background">
		<div class="container">
			<h2 class="gallery-content__heading fade-in fade-in-delay-0">Before &amp; After</h2>
			<div class="gallery-grid" id="page-gallery" data-fade-stagger>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" class="gallery-grid__item fade-in fade-in-delay-1">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol.webp' ); ?>" alt="Before and after at Dental Art Clinic Limassol" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" class="gallery-grid__item fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-1.jpg.webp' ); ?>" alt="Before and after at Dental Art Clinic Limassol" width="400" height="300">
				</a>
				<a href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" class="gallery-grid__item fade-in fade-in-delay-3">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/before-and-after-at-dental-art-clinic-limassol-2.webp' ); ?>" alt="Before and after at Dental Art Clinic Limassol" width="400" height="300">
				</a>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
