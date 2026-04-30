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
					<p class="home-hero__text fade-in fade-in-delay-1"><?php mci_te( '5-star rated dental clinic in Limassol. Natural-looking E.max veneers & smile transformations.' ); ?></p>
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
		'src' => '/wp-content/uploads/2026/04/additional-hero-images-1.webp',
		'alt' => 'Dental Art Clinic additional hero image 1',
	),
	array(
		'src' => '/wp-content/uploads/2026/04/porcelain-veneers-smile-profile-view-dental-art-clinic-dr-maria-charalambous-ivanova-scaled.webp',
		'alt' => 'Porcelain veneers smile profile view at Dental Art Clinic',
	),
	array(
		'src' => '/wp-content/uploads/2026/04/additional-hero-images-3.webp',
		'alt' => 'Dental Art Clinic additional hero image 3',
	),
);

// Inject "-mobile" before the extension to derive the mobile-cropped variant filename.
$mci_hero_to_mobile = static function ( $src ) {
	return (string) preg_replace( '/(\.[a-z0-9]+)$/i', '-mobile$1', $src, 1 );
};
?>
<section class="home-hero">
	<div class="home-hero__slider-bleed">
		<div class="swiper home-hero__carousel js-hero-swiper" aria-label="<?php echo esc_attr( mci_t( 'Clinic photos' ) ); ?>">
			<div class="swiper-wrapper">
				<?php foreach ( $hero_slider_images as $hero_slide_index => $hero_slide ) : ?>
					<?php
					// All eager: native lazy-load was decoding mid-fade and looked abrupt.
					// First slide = high; second slide = auto so the first crossfade has a ready bitmap; rest = low.
					if ( 0 === $hero_slide_index ) {
						$hero_fetch_priority = 'high';
					} elseif ( 1 === $hero_slide_index ) {
						$hero_fetch_priority = 'auto';
					} else {
						$hero_fetch_priority = 'low';
					}
					?>
					<?php
					$hero_desktop_src = home_url( $hero_slide['src'] );
					$hero_mobile_src  = home_url( $mci_hero_to_mobile( $hero_slide['src'] ) );
					?>
					<div class="swiper-slide">
						<div class="home-hero__slide">
							<picture>
								<source media="(max-width: 768px)" srcset="<?php echo esc_url( $hero_mobile_src ); ?>" />
								<img
									src="<?php echo esc_url( $hero_desktop_src ); ?>"
									alt="<?php echo esc_attr( $hero_slide['alt'] ); ?>"
									loading="eager"
									decoding="async"
									fetchpriority="<?php echo esc_attr( $hero_fetch_priority ); ?>"
									<?php if ( 0 === $hero_slide_index ) : ?>style="object-position: 30% center;"<?php endif; ?>
								/>
							</picture>
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
					<p class="home-hero__text fade-in fade-in-delay-1"><?php mci_te( '5-star rated dental clinic in Limassol. Natural-looking E.max veneers & smile transformations.' ); ?></p>
					<div class="home-hero__ctas">
						<div class="fade-in fade-in-delay-2">
							<?php get_template_part( 'template-parts/whatsapp-cta', null, array( 'extra_class' => '' ) ); ?>
						</div>
						<div class="fade-in fade-in-delay-3">
							<a
								href="<?php echo esc_url( 'tel:+' . mci_whatsapp_phone_digits() ); ?>"
								class="btn btn-outline home-hero__services-cta"
							><?php echo esc_html( mci_t( 'Call Now' ) ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="#comprehensive-dental-care" class="home-hero__scroll-down js-home-hero-scroll-next" aria-label="<?php echo esc_attr( mci_t( 'Scroll to next section' ) ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
		</a>
	</div>
</section>
