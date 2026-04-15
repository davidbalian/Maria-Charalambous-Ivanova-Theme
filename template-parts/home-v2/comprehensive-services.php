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

		<!-- Smilers Aligners (same content as services page; transparent, constrained to .container) -->
		<div class="home-v2-comprehensive__smilers">
			<div class="services-item__grid">
				<div class="services-item__content">
					<span class="badge badge-gold fade-in fade-in-delay-0"><?php mci_te( 'Orthodontics' ); ?></span>
					<h2 class="fade-in fade-in-delay-1"><?php mci_te( 'Smilers Aligners' ); ?></h2>
					<p class="fade-in fade-in-delay-2"><?php mci_te( 'Discreet and tough dental aligners designed for modern lifestyles. Smilers offer a virtually invisible way to straighten your teeth and correct your bite — without the look and feel of traditional braces.' ); ?></p>
					<p class="fade-in fade-in-delay-3"><?php mci_te( 'Ideal for protecting gutters and correcting smiles invisibly, Smilers Aligners let you go about your day with complete confidence while your teeth gently move into place.' ); ?></p>
					<a href="<?php echo esc_url( mci_url( '/contact/' ) ); ?>" class="btn btn-primary fade-in fade-in-delay-4"><?php mci_te( 'Book Appointment' ); ?></a>
				</div>
				<div class="services-item__image fade-in fade-in-delay-2">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/smilers-aligners-at-dental-art-clinic-by-dr-maria-charalambous-ivanova.webp' ); ?>" alt="Smilers Aligners" width="560" height="420">
				</div>
			</div>
		</div>

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
