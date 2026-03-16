<?php
/**
 * Services data shared with services-list template.
 *
 * @package Maria_Charalambous_Ivanova
 */

$comprehensive_services = mci_get_services_data();

$stagger_delays = array( 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10 );
?>
<!-- Comprehensive Services Section -->
<section class="home-v2-comprehensive">
	<div class="container">
		<h2 class="home-v2-comprehensive__title fade-in fade-in-delay-0"><?php echo mci_t( 'Comprehensive Dental Care for' ); ?> <span class="accent-font"><?php mci_te( 'Every Need' ); ?></span></h2>
		<p class="home-v2-comprehensive__subtitle fade-in fade-in-delay-1"><?php mci_te( 'At our dental clinic, we are committed to providing high-quality dental care in a comfortable and welcoming environment. Our goal is to help patients maintain excellent oral health while enhancing the beauty and function of their smile.' ); ?></p>
		<div class="services-list__grid home-v2-comprehensive__services-grid">
			<?php foreach ( $comprehensive_services as $i => $service ) : ?>
				<div class="services-list__item fade-in fade-in-delay-<?php echo esc_attr( $stagger_delays[ $i ] ); ?>">
					<h3 class="services-list__title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="services-list__desc"><?php echo esc_html( $service['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="home-v2-comprehensive__cta fade-in fade-in-delay-10">
			<a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All Services' ); ?></a>
		</div>
	</div>
</section>
