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
	<div class="row collapse">
		<div class="small-18 medium-16 large-18 columns">
			<input type="text" value="<?php echo $value; ?>" name="s" id="s" placeholder="<?php _e( 'What are you looking for?', 'TEXTDOMAINTHEMENAME' ); ?>" />
		</div>
		<div class="small-6 medium-8 large-6 columns">
			<input type="submit" id="searchsubmit" class="button postfix" value="<?php _e( 'Search', 'TEXTDOMAINTHEMENAME' ); ?>" />
		</div>
	</div>
</form>