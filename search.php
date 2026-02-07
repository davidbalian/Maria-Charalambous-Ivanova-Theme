<?php
/**
 * The template for displaying search results.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">
	<header class="search-header">
		<h1 class="search-title">
			<?php printf( esc_html__( 'Search Results for: %s', 'maria-charalambous-ivanova' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
	</header>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
				</header>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
			</article>
		<?php endwhile; ?>
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No results found. Please try a different search.', 'maria-charalambous-ivanova' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
