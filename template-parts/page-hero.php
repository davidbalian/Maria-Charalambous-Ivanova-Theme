<?php
/**
 * Template part for displaying a page hero (title, subtitle, optional intro).
 *
 * @package Maria_Charalambous_Ivanova
 *
 * @param string $title    Page title (required).
 * @param string $subtitle Optional subtitle.
 * @param string $intro    Optional intro paragraph (e.g. for Contact page).
 */

$title    = isset( $title ) ? $title : '';
$subtitle = isset( $subtitle ) ? $subtitle : '';
$intro    = isset( $intro ) ? $intro : '';
?>
<section class="page-hero">
	<div class="container">
		<?php if ( $title ) : ?>
			<h1 class="page-hero__title fade-in fade-in-delay-0"><?php echo esc_html( $title ); ?></h1>
		<?php endif; ?>
		<?php if ( $subtitle ) : ?>
			<p class="page-hero__subtitle fade-in fade-in-delay-1"><?php echo esc_html( $subtitle ); ?></p>
		<?php endif; ?>
		<?php if ( $intro ) : ?>
			<p class="page-hero__intro fade-in fade-in-delay-2"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>
	</div>
</section>
