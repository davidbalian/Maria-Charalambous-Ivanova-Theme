<?php
/**
 * Gallery page: The Clinic grid (Placements: page_clinic).
 *
 * @package Maria_Charalambous_Ivanova
 */

$items = MCI_Gallery_Repository::get_items_for_slot( 'page_clinic' );
if ( empty( $items ) ) {
	return;
}
?>
<section class="gallery-section page-section page-section--surface">
	<div class="container">
		<h2 class="gallery-section__heading fade-in fade-in-delay-0"><?php mci_te( 'The Clinic' ); ?></h2>
		<div class="gallery-grid" data-fade-stagger>
			<?php
			foreach ( $items as $row ) {
				$w = ! empty( $row['width'] ) ? (int) $row['width'] : 400;
				$h = ! empty( $row['height'] ) ? (int) $row['height'] : 300;
				$u = $row['url'];
				?>
				<a href="<?php echo esc_url( $u ); ?>" class="gallery-grid__item fade-in">
					<img
						src="<?php echo esc_url( $u ); ?>"
						alt="<?php echo esc_attr( $row['alt'] ); ?>"
						width="<?php echo esc_attr( (string) $w ); ?>"
						height="<?php echo esc_attr( (string) $h ); ?>"
						loading="lazy"
					>
				</a>
				<?php
			}
			?>
		</div>
	</div>
</section>
