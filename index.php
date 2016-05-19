<?php
/**
 * Displays Post Index Page
 **/

get_header(); ?>

<main class="main" role="main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

	   		<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

	   <?php BernskioldMedia\ClientName\Theme\theme()->template->pagination(); ?>

	<?php else : ?>

	    <?php get_template_part( 'content', '404' ); // Streamline and get the 404 content from a unified file. ?>

	<?php endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>