<?php
/**
 * Services data shared with services-list template.
 *
 * @package Maria_Charalambous_Ivanova
 */

$comprehensive_services = array(
	array(
		'title' => 'General Dental Examination & Prevention',
		'desc'  => 'Regular dental check-ups help detect potential problems early and maintain optimal oral health through preventive care and professional advice.',
	),
	array(
		'title' => 'Professional Teeth Cleaning',
		'desc'  => 'Removal of plaque, tartar, and stains to promote healthy gums and a brighter, healthier smile.',
	),
	array(
		'title' => 'Dental Fillings',
		'desc'  => 'Treatment of tooth decay using modern, aesthetic materials that restore both function and natural appearance.',
	),
	array(
		'title' => 'Root Canal Treatment (Endodontics)',
		'desc'  => 'Advanced treatment for infected or inflamed tooth nerves, allowing the natural tooth to be preserved and pain to be relieved.',
	),
	array(
		'title' => 'Tooth Extractions',
		'desc'  => 'Safe and gentle removal of teeth when they cannot be restored, always prioritizing patient comfort.',
	),
	array(
		'title' => 'Cosmetic Dentistry',
		'desc'  => 'A range of treatments designed to enhance the appearance of your smile, including teeth whitening and aesthetic restorations.',
	),
	array(
		'title' => 'Crowns & Bridges',
		'desc'  => 'Durable restorations used to repair damaged teeth or replace missing ones, improving both function and aesthetics.',
	),
	array(
		'title' => 'Dental Implants',
		'desc'  => 'A modern and long-lasting solution for replacing missing teeth, restoring both confidence and oral function.',
	),
	array(
		'title' => 'Dentures',
		'desc'  => 'Full or partial removable dentures designed to restore chewing ability, speech, and smile aesthetics.',
	),
	array(
		'title' => 'Periodontal Treatment',
		'desc'  => 'Diagnosis and treatment of gum diseases such as gingivitis and periodontitis to protect the health of your gums and supporting bone.',
	),
	array(
		'title' => 'Emergency Dental Care',
		'desc'  => 'Prompt care for dental emergencies including severe toothache, broken teeth, infections, or other urgent dental conditions.',
	),
);

$stagger_delays = array( 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10 );
?>
<!-- Comprehensive Services Section -->
<section class="home-v2-comprehensive">
	<div class="container">
		<h2 class="home-v2-comprehensive__title fade-in fade-in-delay-0">Comprehensive Dental Care for <span class="accent-font">Every Need</span></h2>
		<p class="home-v2-comprehensive__subtitle fade-in fade-in-delay-1">At our dental clinic, we are committed to providing high-quality dental care in a comfortable and welcoming environment. Our goal is to help patients maintain excellent oral health while enhancing the beauty and function of their smile.</p>
		<div class="services-list__grid home-v2-comprehensive__services-grid">
			<?php foreach ( $comprehensive_services as $i => $service ) : ?>
				<div class="services-list__item fade-in fade-in-delay-<?php echo esc_attr( $stagger_delays[ $i ] ); ?>">
					<h3 class="services-list__title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="services-list__desc"><?php echo esc_html( $service['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="home-v2-comprehensive__cta fade-in fade-in-delay-10">
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-outline">View All Services</a>
		</div>
	</div>
</section>
