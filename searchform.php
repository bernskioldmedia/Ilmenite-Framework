<?php
/**
 * Search Form
 *
 * Styles the default WordPress search form according
 * to the markup in this file.
 */

if ( isset( $_GET['s'] ) ) {
	$value = wp_strip_all_tags( $_GET['s'] );
} else {
	$value = '';
}
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input type="text" value="<?php echo $value; ?>" name="s" id="s" placeholder="<?php _e('What are you looking for?', 'TEXTDOMAINTHEMENAME'); ?>" />
	<input type="submit" id="searchsubmit" value="<?php _e('Search', 'TEXTDOMAINTHEMENAME'); ?>" />
</form>