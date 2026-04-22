<?php
/**
 * Gallery page: The Clinic grid.
 *
 * Driven by the Galleries CPT (location = page_clinic).
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = MCI_Galleries_Repository::get_items_for_location( MCI_Galleries_Locations::PAGE_CLINIC );
if ( empty( $items ) ) {
	return;
}
?>
<section class="gallery-section page-section page-section--surface">
	<div class="container">
		<h2 class="gallery-section__heading fade-in fade-in-delay-0"><?php mci_te( 'The Clinic' ); ?></h2>
		<div class="gallery-grid" data-fade-stagger>
			<?php foreach ( $items as $row ) : ?>
				<?php
				$width  = $row['width'] > 0 ? (int) $row['width'] : 400;
				$height = $row['height'] > 0 ? (int) $row['height'] : 300;
				$src    = '' !== $row['thumb_url'] ? $row['thumb_url'] : $row['url'];
				?>
				<a href="<?php echo esc_url( $row['url'] ); ?>" class="gallery-grid__item fade-in">
					<img
						src="<?php echo esc_url( $src ); ?>"
						alt="<?php echo esc_attr( $row['alt'] ); ?>"
						width="<?php echo esc_attr( (string) $width ); ?>"
						height="<?php echo esc_attr( (string) $height ); ?>"
						loading="lazy"
						decoding="async"
					>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
