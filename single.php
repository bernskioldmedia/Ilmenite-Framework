<?php
/**
 * Displays Single Post
 **/

get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('content', 'single'); ?>

			<?php comments_template(); ?>

		<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('content', '404'); ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>