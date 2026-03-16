<?php
/**
 * The template for displaying 404 pages.
 *
 * @package Maria_Charalambous_Ivanova
 */

get_header(); ?>

<main id="main" class="site-main">
	<article class="error-404 not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php mci_te( 'Page Not Found' ); ?></h1>
		</header>
		<div class="entry-content">
			<p><?php mci_te( 'The page you are looking for could not be found. Try searching or return to the homepage.' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>
</main>

<?php get_footer(); ?>
