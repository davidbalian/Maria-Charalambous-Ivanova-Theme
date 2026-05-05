<?php
/**
 * Smilers Aligners featured row (services page).
 *
 * @package Maria_Charalambous_Ivanova
 */

$smilers_dual_items       = array_slice( MCI_Galleries_Repository::get_items_for_location( MCI_Galleries_Locations::SMILERS_DUAL ), 0, 2 );
$grid_smilers_dual_suffix = count( $smilers_dual_items ) >= 2 ? ' services-item__grid--smilers-dual-balanced' : '';
?>
<!-- Smilers Aligners -->
<section class="services-item services-item--smilers page-section page-section--surface">
	<div class="container">
		<div class="services-item__grid<?php echo esc_attr( $grid_smilers_dual_suffix ); ?>">
			<div class="services-item__content">
				<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontic Clear Aligners' ); ?></span>
				<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
				<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet and durable aligners built for modern lifestyles — Smilers offer a virtually invisible way to straighten your teeth and correct your bite, without the look or feel of traditional braces.' ); ?></p>
				<p class="fade-in fade-in-delay-3"><?php mci_te( 'Correct your smile invisibly — Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.' ); ?></p>
				<div class="fade-in fade-in-delay-4">
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
			</div>
			<div class="services-item__media-col">
				<div class="services-item__image fade-in fade-in-delay-2">
					<picture>
						<source media="(max-width: 768px)" srcset="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5-body-mobile.webp' ) ); ?>">
						<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/04/smilers-new-5.webp' ) ); ?>" alt="Smilers Aligners" width="560">
					</picture>
				</div>
				<?php get_template_part( 'template-parts/services-smilers-dual-gallery', null, array( 'mci_smilers_dual_gallery_rows' => $smilers_dual_items ) ); ?>
			</div>
		</div>
	</div>
</section>
