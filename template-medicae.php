<?php
/**
 * Template Name: MediCae Demo
 * 
 * A demonstration template showcasing the MediCae dental clinic design mockup
 * with purple gradients and placeholder content.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main medicae-demo">

	<?php get_template_part( 'template-parts/medicae-demo/top-banner' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/hero' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/stats' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/services' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/gentle-touch' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/comprehensive-services' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/doctor' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/consultation' ); ?>
	
	<?php get_template_part( 'template-parts/medicae-demo/benefits' ); ?>

</main>

<?php get_footer(); ?>
