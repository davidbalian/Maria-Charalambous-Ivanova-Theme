<?php
/**
 * Home comprehensive services: Smilers row, first four grid items, CTA.
 *
 * @package Maria_Charalambous_Ivanova
 */

$comprehensive_services = array_slice( mci_get_services_data(), 0, 4 );

$stagger_delays = array( 2, 3, 4, 5 );
?>
<!-- Comprehensive Services Section -->
<section id="comprehensive-dental-care" class="home-v2-comprehensive">
	<div class="container">
		<h2 class="home-v2-comprehensive__title fade-in fade-in-delay-0"><?php echo mci_t_accent( 'Comprehensive Dental Care for {accent}Every Need{/accent}' ); ?></h2>
		<p class="home-v2-comprehensive__subtitle fade-in fade-in-delay-1"><?php mci_te( 'At our dental clinic, we are committed to providing high-quality dental care in a comfortable and welcoming environment. Our goal is to help patients maintain excellent oral health while enhancing the beauty and function of their smile.' ); ?></p>
	</div>

	<?php get_template_part( 'template-parts/services-smilers-row' ); ?>

	<div class="container">
		<div class="services-list__grid home-v2-comprehensive__services-grid">
			<?php foreach ( $comprehensive_services as $i => $service ) : ?>
				<div class="services-list__item fade-in fade-in-delay-<?php echo esc_attr( $stagger_delays[ $i ] ); ?>">
					<h3 class="services-list__title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="services-list__desc"><?php echo esc_html( $service['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="home-v2-comprehensive__cta fade-in fade-in-delay-6">
			<a href="<?php echo esc_url( mci_url( '/services/' ) ); ?>" class="btn btn-outline"><?php mci_te( 'View All Services' ); ?></a>
		</div>
	</div>
</section>
