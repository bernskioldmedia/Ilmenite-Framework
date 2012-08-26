<?php
/**
 * Displays Search Results
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 **/

get_header();

?>
      
   	<?php if ( have_posts() ) : ?>
   	
   	<h1 class="page-title search-heading"><?php printf( __( 'Search Results for: %s', 'TEXTDOMAINTHEMENAME' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
   	
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
    	    
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>