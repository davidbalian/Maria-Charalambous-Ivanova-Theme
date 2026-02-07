<?php
/**
 * The sidebar template.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
