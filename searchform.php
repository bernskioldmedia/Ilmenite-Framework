<?php
/**
 * Search Form
 *
 * Styles the default WordPress search form according
 * to the markup in this file.
 */

if ( get_search_query() ) {
	$value = get_search_query();
} else {
	$value = '';
}
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>">

	<div class="input-group">

		<input type="text" value="<?php echo esc_attr( $value ); ?>" name="s" id="s" placeholder="<?php esc_html_e( 'What are you looking for?', 'TEXTDOMAINTHEMENAME' ); ?>" class="input-group-field">

		<div class="input-group-button">
			<input type="submit" id="searchsubmit" class="button" value="<?php esc_html_e( 'Search', 'TEXTDOMAINTHEMENAME' ); ?>" />
		</div>

	</div>

</form>