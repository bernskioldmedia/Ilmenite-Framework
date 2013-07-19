<?php
/**
 * Search Form
 *
 * Styles the default WordPress search form according
 * to the markup in this file.
 *
 * @since  1.0
 * @version  1.0
 * @package Ilmenite Framework
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input type="text" value="<?php echo strip_tags( $_GET['q'] ); ?>" name="s" id="s" placeholder="<?php _e('What are you looking for?', 'TEXTDOMAINTHEMENAME'); ?>" />
	<input type="submit" id="searchsubmit" value="<?php _e('Search', 'TEXTDOMAINTHEMENAME'); ?>" />
</form>