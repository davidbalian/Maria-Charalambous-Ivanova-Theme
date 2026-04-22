<?php
/**
 * Home: Before & After grid (driven by Galleries > Placements > home_before_after).
 *
 * @package Maria_Charalambous_Ivanova
 */

$items = MCI_Gallery_Repository::get_items_for_slot( 'home_before_after' );
if ( empty( $items ) ) {
	return;
}
?>
<section id="before-after" class="home-cases">
	<div class="container">
		<h2 class="home-cases__title fade-in fade-in-delay-0"><?php echo mci_t( 'Before &amp; After' ); ?></h2>
		<div class="home-cases__grid">
			<?php
			foreach ( $items as $i => $row ) {
				$w = ! empty( $row['width'] ) ? (int) $row['width'] : 400;
				$h = ! empty( $row['height'] ) ? (int) $row['height'] : 400;
				$d = (int) min( ( $i % 3 ) + 1, 3 );
				?>
				<div class="home-cases__item fade-in fade-in-delay-<?php echo esc_attr( (string) $d ); ?>">
					<img
						src="<?php echo esc_url( $row['url'] ); ?>"
						alt="<?php echo esc_attr( $row['alt'] ); ?>"
						width="<?php echo esc_attr( (string) $w ); ?>"
						height="<?php echo esc_attr( (string) $h ); ?>"
						loading="lazy"
					>
				</div>
				<?php
			}
			?>
		</div>
		<div class="home-cases__action fade-in fade-in-delay-4">
			<a href="<?php echo esc_url( mci_url( '/gallery/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All' ); ?></a>
		</div>
	</div>
</section>
