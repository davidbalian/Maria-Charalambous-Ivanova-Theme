<?php
/**
 * Homepage hero: full-bleed Slick carousel + text band.
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

$hero_slider_base_url = home_url( '/wp-content/uploads/2026/02/' );
$hero_slider_images   = array(
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-wide-angle-equipment.avif' => 'Dental Art Clinic treatment room wide angle',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-lobby-clinic-name.avif' => 'Dental Art Clinic reception lobby',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-dental-chair-screens.avif' => 'Dental Art Clinic treatment room dental chair',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-waiting-room-marble-interior.avif' => 'Dental Art Clinic waiting room',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-reception-area-marble-counter.avif' => 'Dental Art Clinic reception marble counter',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-pink-flowers-clinic-logo.avif' => 'Dental Art Clinic pink flowers and logo',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-circular-mirror-orchid-artwork-smile.avif' => 'Dental Art Clinic mirror and orchid',
	'dental-art-clinic-by-dr-maria-charalambous-ivanova-treatment-room-tv-screen-dental-work.avif' => 'Dental Art Clinic treatment room TV',
);
$hero_slider_keys = array_keys( $hero_slider_images );
shuffle( $hero_slider_keys );
?>
<section class="home-hero">
	<div class="home-hero__slider-bleed">
		<div class="home-hero__carousel js-home-hero-slick" aria-label="<?php echo esc_attr( mci_t( 'Clinic photos' ) ); ?>">
			<?php foreach ( $hero_slider_keys as $hero_slide_index => $filename ) : ?>
				<?php
				$alt_text         = $hero_slider_images[ $filename ];
				$hero_slider_item = $hero_slider_base_url . $filename;
				$hero_img_loading = ( 0 === $hero_slide_index ) ? 'eager' : 'lazy';
				?>
				<div class="home-hero__slide">
					<img
						src="<?php echo esc_url( $hero_slider_item ); ?>"
						alt="<?php echo esc_attr( $alt_text ); ?>"
						loading="<?php echo esc_attr( $hero_img_loading ); ?>"
						decoding="async"
					/>
				</div>
			<?php endforeach; ?>
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
					</div>
				</div>
			</div>
		</div>
		<a href="#comprehensive-dental-care" class="home-hero__scroll-down" aria-label="<?php echo esc_attr( mci_t( 'Scroll to next section' ) ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
		</a>
	</div>
</section>
