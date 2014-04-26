<?php
/**
 * Default WordPress functions.php file
 * Loads and configures the theme.
 **/

/**
 * Include and Set Up Framework
 ***********************************************/

require_once locate_template( '/core/theme.php' );

$theme = new Ilmenite_Framework();

/**
 * Defines content width
 **/

if ( ! isset($content_width ) )
	$content_width = 640; // Let this to the proper content width