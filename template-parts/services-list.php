<?php
/**
 * Template part for displaying the 11 dental services list.
 *
 * @package Maria_Charalambous_Ivanova
 */

$services = mci_get_services_data();
?>
<section class="services-list page-section page-section--background">
	<div class="container">
		<h2 class="services-list__heading fade-in fade-in-delay-0"><?php mci_te( 'Explore All Our Services' ); ?></h2>
		<div class="services-list__grid" data-fade-stagger>
			<?php
			$delay = 0;
			foreach ( $services as $service ) :
				$delay_class = 'fade-in-delay-' . min( $delay, 10 );
				$delay++;
				?>
				<div class="services-list__item fade-in <?php echo esc_attr( $delay_class ); ?>">
					<h3 class="services-list__title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="services-list__desc"><?php echo esc_html( $service['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
