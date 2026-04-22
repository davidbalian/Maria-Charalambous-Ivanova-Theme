<?php
/**
 * Home: The Clinic carousel (Galleries > Placements > home_clinic).
 *
 * @package Maria_Charalambous_Ivanova
 */

$items = MCI_Gallery_Repository::get_items_for_slot( 'home_clinic' );
if ( empty( $items ) ) {
	return;
}
?>
<section class="home-v2-clinic" aria-label="The Clinic gallery">
	<div class="container">
		<div class="home-v2-clinic__header">
			<div>
				<h2 class="home-v2-clinic__title fade-in fade-in-delay-0"><?php mci_te( 'The Clinic' ); ?></h2>
				<p class="home-v2-clinic__subtitle fade-in fade-in-delay-1"><?php mci_te( 'Step inside Dental Art Clinic Limassol.' ); ?></p>
			</div>
			<div class="home-v2-clinic__nav fade-in fade-in-delay-2" aria-label="Clinic gallery navigation">
				<button type="button" class="home-v2-clinic__button js-clinic-prev" aria-label="Previous clinic photos">
					<span aria-hidden="true">&#8592;</span>
				</button>
				<button type="button" class="home-v2-clinic__button js-clinic-next" aria-label="Next clinic photos">
					<span aria-hidden="true">&#8594;</span>
				</button>
			</div>
		</div>

		<div class="swiper home-v2-clinic__carousel js-clinic-swiper">
			<div class="swiper-wrapper">
				<?php foreach ( $items as $row ) : ?>
					<?php $src = ! empty( $row['thumb_url'] ) ? $row['thumb_url'] : $row['url']; ?>
					<div class="swiper-slide">
						<img
							src="<?php echo esc_url( $src ); ?>"
							alt="<?php echo esc_attr( $row['alt'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
