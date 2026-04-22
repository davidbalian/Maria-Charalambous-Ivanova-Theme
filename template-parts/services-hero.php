<?php
/**
 * Services page hero: full-bleed Swiper + overlay + heading.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads_02 = home_url( '/wp-content/uploads/2026/02/' );
$uploads_04 = home_url( '/wp-content/uploads/2026/04/' );

$services_hero_slides = array(
	array(
		'src' => $uploads_02 . 'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif',
		'alt' => 'Dental treatment room with chair and screens at Dental Art Clinic.',
	),
	array(
		'src' => $uploads_04 . 'porcelain-crowns-dental-lab-arch-view-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp',
		'alt' => 'Porcelain crowns dental lab arch view at Dental Art Clinic.',
	),
	array(
		'src' => $uploads_04 . 'porcelain-veneers-smile-profile-view-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp',
		'alt' => 'Smile in profile view showing porcelain veneers.',
	),
);
?>
<section class="services-hero">
	<div class="services-hero__media" aria-hidden="true">
		<div class="services-hero__slider-bleed">
			<div
				class="swiper services-hero__carousel js-hero-swiper"
				aria-label="<?php echo esc_attr( mci_t( 'Clinic photos' ) ); ?>"
			>
				<div class="swiper-wrapper">
					<?php foreach ( $services_hero_slides as $slide_i => $slide ) : ?>
						<?php
						$fetch_priority = ( 0 === $slide_i ) ? 'high' : 'low';
						?>
						<div class="swiper-slide">
							<div class="services-hero__slide">
								<img
									src="<?php echo esc_url( $slide['src'] ); ?>"
									alt="<?php echo esc_attr( $slide['alt'] ); ?>"
									loading="eager"
									decoding="async"
									fetchpriority="<?php echo esc_attr( $fetch_priority ); ?>"
								/>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="services-hero__overlay"></div>
	<div class="container services-hero__content">
		<h1 class="services-hero__title fade-in fade-in-delay-0"><?php mci_te( 'Our Services' ); ?></h1>
		<p class="services-hero__subtitle fade-in fade-in-delay-1"><?php mci_te( 'Comprehensive dental care with modern technology and evidence-based treatments for every patient.' ); ?></p>
		<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => 'fade-in fade-in-delay-2' ) ); ?>
	</div>
</section>
