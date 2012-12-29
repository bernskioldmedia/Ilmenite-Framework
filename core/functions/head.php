<?php
/**
 * Add items to the <head> section of WordPress for public and admin
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.2
 * @package Ilmenite Framework
 **/

/**
 * Enqueue Styles on public side
 *
 * @since Ilmenite Framework 1.1
 **/
function ilmenite_enqueue_styles() {

	// Register
	// wp_register_style( $handle, $src, $deps, $ver, $media );
	wp_register_style( 'base', THEME_CSS . '/base.css', false, THEME_VERSION, 'all' );
	wp_register_style( 'layout', THEME_CSS . '/layout.css', array('base'), THEME_VERSION, 'all' );

	wp_register_style( 'style', get_stylesheet_uri(), false, THEME_VERSION, 'all' );

	// Enqueue
	wp_enqueue_style( 'main-style' );

	if( get_stylesheet_directory() != get_template_directory() )
		wp_enqueue_style( 'style' );
	
}

// Register Styles with WordPress
add_action( 'wp_enqueue_scripts', 'ilmenite_enqueue_styles' );

/**
 * Enqueue Scripts on public side
 *
 * @since Ilmenite Framework 1.1
 **/
function ilmenite_enqueue_scripts() {
	
	// Register
	// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
	wp_register_script( 'foundation-framework', THEME_JS . '/framework.min.js', array('jquery'), THEME_VERSION, false );
	wp_register_script( 'modernizr', THEME_JS . '/foundation/modernizr.foundation.js', false, '2.6.2', false );
	
	// Enqueue
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'foundation-framework' );
	
	if ( is_singular() )
		wp_enqueue_script( 'comment-reply' );
	
}

// Register Scripts with WordPress
add_action('wp_enqueue_scripts', 'ilmenite_enqueue_scripts');

/**
 * Adds a favicon to the site
 *
 * Will load any favicon that is added into the
 * theme image directory.
 *
 * @since Ilmenite Framework 1.0
 **/
function ilmenite_favicon() {
	
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . THEME_IMAGES . '/favicon.ico">';

}

add_action('wp_head', 'ilmenite_favicon'); // Adds the favicon to frontend
add_action('admin_head', 'ilmenite_favicon'); // Adds the favicon to backend
