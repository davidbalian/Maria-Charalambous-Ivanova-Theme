<?php
/**
 * The template for displaying comments.
 *
 * @package Maria_Charalambous_Ivanova
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			printf(
				esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'maria-charalambous-ivanova' ) ),
				get_comments_number()
			);
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'maria-charalambous-ivanova' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
