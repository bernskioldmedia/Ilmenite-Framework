<?php
/**
 * Displays Tag Archives
 **/

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title tag-title">
			<?php single_tag_title( '' ); ?>
		</h1>

		<?php
			$tag_description = tag_description();
			if ( ! empty( $tag_description ) )
				echo apply_filters( 'tag_archive_meta', '<div class="page-description tag-description">' . $tag_description . '</div>' );
		?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php
	    	if(function_exists('wp_pagenavi')) :
	    		wp_pagenavi(); // Add support for the WP-Pagenavi plugin if it is installed. Otherwise use the default.
	    	else :
	    		BernskioldMedia\Ilmenite_Theme\theme()->template->pagination();
	    	endif;
		?>

	<?php else : ?>

		<?php get_template_part('content', '404'); // Streamline and get the 404 content from a unified file. ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>