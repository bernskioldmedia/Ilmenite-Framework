<?php
/**
 * Template for the Category Archives
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.1
 * @package Ilmenite Framework
 **/

get_header(); ?>
        
	<?php if ( have_posts() ) : ?>
    
		<h1 class="page-title category-heading">
			<?php printf( __( 'Category Archives: %s', 'TEXTDOMAINTHEMENAME' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		</h1> 
		
		<?php
			$cat_description = category_description();
			if ( ! empty( $cat_description ) )
				echo apply_filters( 'cat_archive_meta', '<div class="cat-archive-meta">' . $cat_description . '</div>' );
		?>
    
    		<?php while ( have_posts() ) : the_post(); ?>
    
			<?php get_template_part('content', get_post_format()); ?>
    
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
    	    
	<?php get_sidebar(); ?>
    
<?php get_footer(); ?>