<?php
/**
 * Homepage hero: full-bleed Swiper carousel + text band.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Legacy two-column hero (kept for easy restore).
if ( false ) :
	$hero_image_url = home_url( '/wp-content/uploads/2026/02/dr-maria-charalambous-ivanova-portrait-08-e1771938361770.avif' );
	?>
<section class="home-hero">
	<div class="home-hero__container">
		<div class="home-hero__text-col">
			<div class="home-hero__inner">
				<div class="home-hero__content">
					<h1 class="home-hero__title fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Beautiful Smiles {accent}Start Here{/accent}' ); ?></h1>
					<p class="home-hero__text fade-in fade-in-delay-1"><?php mci_te( 'Professional dental care with modern technology, personalized treatment, and a focus on long-term oral health.' ); ?></p>
					<div class="home-hero__ctas">
						<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => 'fade-in fade-in-delay-2' ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="home-hero__image-col">
			<div class="home-hero__image fade-in fade-in-delay-5">
				<img src="<?php echo esc_url( $hero_image_url ); ?>" alt="Dental Art Clinic treatment room with TV screen and dental work." width="800" height="600" />
			</div>
		</div>
	</div>
	<a href="#comprehensive-dental-care" class="home-hero__scroll-down" aria-label="Scroll to next section">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
	</a>
</section>
	<?php
endif;

$hero_slider_images = array(
	array(
		'src' => '/wp-content/uploads/2026/04/dr-maria-charalambous-ivanova-portrait-hd.webp',
		'alt' => 'Dr. Maria Charalambous-Ivanova',
	),
	array(
		'src' => '/wp-content/uploads/2026/04/dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment-1.webp',
		'alt' => 'Dental Art Clinic treatment room wide angle',
	),
);
shuffle( $hero_slider_images );
?>
<section class="home-hero">
	<div class="home-hero__slider-bleed">
		<div class="swiper home-hero__carousel js-home-hero-swiper" aria-label="<?php echo esc_attr( mci_t( 'Clinic photos' ) ); ?>">
			<div class="swiper-wrapper">
				<?php foreach ( $hero_slider_images as $hero_slide_index => $hero_slide ) : ?>
					<?php
					// Both eager: native lazy-load was decoding mid-fade and looked abrupt.
					$hero_fetch_priority = ( 0 === $hero_slide_index ) ? 'high' : 'low';
					?>
					<div class="swiper-slide">
						<div class="home-hero__slide">
							<img
								src="<?php echo esc_url( home_url( $hero_slide['src'] ) ); ?>"
								alt="<?php echo esc_attr( $hero_slide['alt'] ); ?>"
								loading="eager"
								decoding="async"
								fetchpriority="<?php echo esc_attr( $hero_fetch_priority ); ?>"
							/>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="home-hero__bottom">
		<div class="home-hero__text-band">
			<div class="home-hero__inner">
				<div class="home-hero__content">
					<h1 class="home-hero__title fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Beautiful Smiles {accent}Start Here{/accent}' ); ?></h1>
					<p class="home-hero__text fade-in fade-in-delay-1"><?php mci_te( 'Professional dental care with modern technology, personalized treatment, and a focus on long-term oral health.' ); ?></p>
					<div class="home-hero__ctas">
						<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => 'fade-in fade-in-delay-2' ) ); ?>
						<a
							href="#comprehensive-dental-care"
							class="btn btn-outline home-hero__services-cta js-home-hero-scroll-next fade-in fade-in-delay-3"
						><?php echo esc_html( mci_t( 'Services' ) ); ?></a>
					</div>
				</div>
			</div>
		</div>
		<a href="#comprehensive-dental-care" class="home-hero__scroll-down js-home-hero-scroll-next" aria-label="<?php echo esc_attr( mci_t( 'Scroll to next section' ) ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
		</a>
	</div>
</section>
