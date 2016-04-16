<?php
/**
 * Template Name: Fullwidth
 **/

_x( 'Fullwidth', 'frontpage page template name', 'ilmenite' );

get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php get_template_part('content', 'page'); ?>

	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('content', '404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>