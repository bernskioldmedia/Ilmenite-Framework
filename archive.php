<?php
/**
 * Template for displaying the post archives
 **/

get_header(); ?>

	<?php if ( have_posts() ) : ?>

    	<h1 class="page-title archives-title">
			<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'TEXTDOMAINTHEMENAME' ),'<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'TEXTDOMAINTHEMENAME' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'TEXTDOMAINTHEMENAME' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
			<?php else : ?>
				<?php _e( 'Blog Archives', 'TEXTDOMAINTHEMENAME' ); ?>
			<?php endif; ?>
		</h1>

    		<?php while ( have_posts() ) : the_post(); ?>

        		<?php get_template_part('content', get_post_format()); ?>

 			<?php endwhile; ?>

		<?php
			if(function_exists('wp_pagenavi')) :
				wp_pagenavi(); // Add support for the WP-Pagenavi plugin if it is installed. Otherwise use the default.
			else :
				BernskioldMedia\Ilmenite_Theme\theme()->template->pagination();
			endif;
		?>

	<?php else : ?>

		<?php get_template_part( 'content', '404' ); // Streamline and get the 404 content from a unified file. ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>