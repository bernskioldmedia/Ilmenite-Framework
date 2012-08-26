<?php
/**
 * 'Not Found Content'
 *
 * Included on the 404 page as well as when post content is not found.
 *
 * @since Ilmenite Framework 1.1
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 **/
?>

<article id="404-page">
   	
	<h2 class="page-title"><?php _e('404 - Content Cannot Be Found', 'TEXTDOMAINTHEMENAME'); ?></h2>
    
    <div class="page-content">
    	<p><?php _e('Unfortunately the content you were looking for could not be found. Please check that the URL is correct or do a search using the form below.', 'TEXTDOMAINTHEMENAME'); ?></p>
    	<?php get_search_form(); ?>
    </div>

</article>