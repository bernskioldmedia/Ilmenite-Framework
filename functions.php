<?php

/**
 * Default WordPress functions.php file
 * Loads and configures the theme.
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 **/


/**
 * Include and Set Up Ilmenite Framework Class
 ***********************************************/

require_once( get_template_directory() . '/core/theme.php'); // Includes Ilmenite Framework

$ilmenite = new Ilmenite_Framework();

$ilmenite->init(array(
	'theme_name' => 'YOUR THEME NAME', // Change this to the name of the theme.
	'theme_slug' => 'YOUR THEME SLUG', // Create a custom slug for the theme.
	'theme_version' => '1.0'
));

/**
 * Add Theme-Specific Stuff Below Here
 *****************************************/

/**
 * Defines content width
 **/

if (!isset($content_width)) {
	$content_width = 900; // Let this to the proper content width
}