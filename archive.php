<?php
/**
 * Template for displaying the post archives
 **/

get_header(); ?>

<main class="main" role="main">

	<?php if ( have_posts() ) : ?>

    	<h1 class="page-title archives-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'THEMETEXTDOMAIN' ),'<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'THEMETEXTDOMAIN' ); ?>
			<?php endif; ?>
		</h1>

    	<?php while ( have_posts() ) : the_post(); ?>

        	<?php get_template_part( 'content', get_post_format() ); ?>

 		<?php endwhile; ?>

		<?php  BernskioldMedia\ClientName\Theme\theme()->template->pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'content', '404' ); // Streamline and get the 404 content from a unified file. ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>