<?php
/**
 * Displays Post Index Page
 **/

get_header(); ?>

	<main class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

		   	<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		   <?php
				if(function_exists('wp_pagenavi')) :
					wp_pagenavi(); // Add support for the WP-Pagenavi plugin if it is installed. Otherwise use the default.
				else :
					ilmenite_pagination();
				endif;
		   ?>

		<?php else : ?>

		    <?php get_template_part('content', '404'); // Streamline and get the 404 content from a unified file. ?>

		<?php endif; ?>

	</main>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>