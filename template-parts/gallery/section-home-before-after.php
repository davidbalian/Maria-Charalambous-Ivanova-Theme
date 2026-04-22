<?php
/**
 * Home: Before & After grid.
 *
 * Driven by the Galleries CPT (location = home_before_after).
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = MCI_Galleries_Repository::get_items_for_location( MCI_Galleries_Locations::HOME_BEFORE_AFTER );
if ( empty( $items ) ) {
	return;
}
?>
<section id="before-after" class="home-cases">
	<div class="container">
		<h2 class="home-cases__title fade-in fade-in-delay-0"><?php echo mci_t( 'Before &amp; After' ); ?></h2>
		<div class="home-cases__grid">
			<?php foreach ( $items as $index => $row ) : ?>
				<?php
				$width  = $row['width'] > 0 ? (int) $row['width'] : 400;
				$height = $row['height'] > 0 ? (int) $row['height'] : 400;
				$delay  = min( ( $index % 3 ) + 1, 3 );
				$src    = '' !== $row['thumb_url'] ? $row['thumb_url'] : $row['url'];
				?>
				<div class="home-cases__item fade-in fade-in-delay-<?php echo esc_attr( (string) $delay ); ?>">
					<img
						src="<?php echo esc_url( $src ); ?>"
						alt="<?php echo esc_attr( $row['alt'] ); ?>"
						width="<?php echo esc_attr( (string) $width ); ?>"
						height="<?php echo esc_attr( (string) $height ); ?>"
						loading="lazy"
						decoding="async"
					>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="home-cases__action fade-in fade-in-delay-4">
			<a href="<?php echo esc_url( mci_url( '/gallery/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All' ); ?></a>
		</div>
	</div>
</section>
