<?php
/**
 * Page Template: Fullwidth Page
 *
 * Fullwidth page template to create pages that does not include the sidebar.
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 *
 * Template Name: Fullwidth Page
 *
 **/

get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php get_template_part('content', 'page'); ?>

	<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('content', '404'); ?>

	<?php endif; ?>

<?php get_footer(); ?>