<?php
/**
 * Smilers row: two companion images from Galleries CPT (location smilers_dual).
 *
 * Expects `items` in scope (via get_template_part $args). Renders nothing when empty.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $items ) || ! is_array( $items ) ) {
	return;
}

$items_with_src = array();

foreach ( array_slice( $items, 0, 2 ) as $row ) {
	if ( ! is_array( $row ) ) {
		continue;
	}

	$src = ( isset( $row['thumb_url'] ) && '' !== $row['thumb_url'] )
		? $row['thumb_url']
		: ( isset( $row['url'] ) ? $row['url'] : '' );

	if ( '' === $src ) {
		continue;
	}

	$items_with_src[] = $row;
}

if ( empty( $items_with_src ) ) {
	return;
}
?>
<div class="services-item__smilers-dual fade-in fade-in-delay-5" role="group" aria-label="<?php echo esc_attr__( 'Smilers gallery', 'maria-charalambous-ivanova' ); ?>">
	<?php foreach ( $items_with_src as $row ) : ?>
		<?php
		$width  = isset( $row['width'] ) && (int) $row['width'] > 0 ? (int) $row['width'] : 320;
		$height = isset( $row['height'] ) && (int) $row['height'] > 0 ? (int) $row['height'] : 320;
		$src    = ( isset( $row['thumb_url'] ) && '' !== $row['thumb_url'] )
			? $row['thumb_url']
			: ( isset( $row['url'] ) ? $row['url'] : '' );
		?>
		<div class="services-item__smilers-dual-item">
			<img
				src="<?php echo esc_url( $src ); ?>"
				alt="<?php echo isset( $row['alt'] ) ? esc_attr( (string) $row['alt'] ) : ''; ?>"
				width="<?php echo esc_attr( (string) $width ); ?>"
				height="<?php echo esc_attr( (string) $height ); ?>"
				loading="lazy"
				decoding="async"
			>
		</div>
	<?php endforeach; ?>
</div>
