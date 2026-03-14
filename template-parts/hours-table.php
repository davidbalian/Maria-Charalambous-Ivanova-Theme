<?php
/**
 * Template Part: Hours Table
 *
 * @param array $args {
 *     @type bool   $show_status  Whether to show the open/closed indicator. Default true.
 *     @type string $modifier     CSS class modifier for the table (e.g. '--footer'). Default ''.
 *     @type string $heading_tag  HTML tag for the heading. Default 'h4'.
 *     @type string $heading_text Heading label. Default 'Hours'.
 *     @type string $heading_class Additional class on the heading element. Default ''.
 *     @type string $status_id    ID attribute for the status span. Default ''.
 * }
 */

$defaults = array(
	'show_status'   => true,
	'modifier'      => '',
	'heading_tag'   => 'h4',
	'heading_text'  => 'Hours',
	'heading_class' => '',
	'status_id'     => '',
);

$args = wp_parse_args( $args ?? array(), $defaults );

$tag           = tag_escape( $args['heading_tag'] );
$heading_class = $args['heading_class'] ? ' class="' . esc_attr( $args['heading_class'] ) . '"' : '';
$table_class   = 'contact-hours' . ( $args['modifier'] ? ' contact-hours' . esc_attr( $args['modifier'] ) : '' );
$status_id     = $args['status_id'] ? ' id="' . esc_attr( $args['status_id'] ) . '"' : '';
?>
<<?php echo $tag . $heading_class; ?>><?php echo esc_html( $args['heading_text'] ); ?><?php if ( $args['show_status'] ) : ?> <span class="js-clinic-status"<?php echo $status_id; ?>></span><?php endif; ?></<?php echo $tag; ?>>
<table class="<?php echo esc_attr( $table_class ); ?>">
<tr><td>Monday &ndash; Thursday</td><td>8:00 AM &ndash; 5:30 PM</td></tr>
<tr><td>Friday</td><td>8:00 AM &ndash; 1:00 PM</td></tr>
<tr><td>Saturday &ndash; Sunday</td><td>Closed</td></tr>
</table>
