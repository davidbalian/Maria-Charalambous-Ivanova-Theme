<?php
/**
 * Template part for displaying the 11 dental services list.
 *
 * @package Maria_Charalambous_Ivanova
 */

$services = array(
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
?>
<section class="services-list page-section page-section--surface">
	<div class="container">
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
