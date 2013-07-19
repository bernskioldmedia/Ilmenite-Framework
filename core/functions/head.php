<?php
/**
 * Header Functions
 *
 * Contains functions that hook into wp_head and/or output their content
 * to wp_head via other actions/hooks such as scripts and stylesheets.
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 **/

/**
 * Stylesheets
 *
 * Registeres and enqueues theme stylesheets.
 *
 * @since 1.0
 **/
function ilmenite_enqueue_styles() {

	// Register
	// wp_register_style( $handle, $src, $deps, $ver, $media );
	wp_register_style( 'base', THEME_CSS . '/layout.css', false, THEME_VERSION, 'all' );

	// Enqueue
	wp_enqueue_style( 'base' );

	// If we have a custom.css stylesheet, include that too. This makes it easier for
	// clients to modify the CSS quickly without having to know and use SASS.
	if( file_exists( THEME_CSS . '/custom.css' ) ) {
		wp_register_style( 'custom', THEME_CSS . '/custom.css', false, THEME_VERSION, 'all' );

		wp_enqueue_style( 'custom' );
	}

}

// Register Styles with WordPress
add_action( 'wp_enqueue_scripts', 'ilmenite_enqueue_styles' );

/**
 * Enqueue Scripts on public side
 *
 * @since Ilmenite Framework 1.0
 **/
function ilmenite_enqueue_scripts() {

	// Register
	// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
	wp_register_script( 'foundation', THEME_JS . '/foundation/foundation.min.js', array('jquery'), THEME_VERSION, false );
	wp_register_script( 'modernizr', THEME_JS . '/vendor/custom.modernizr.js', false, '2.6.2', false );

	// Enqueue
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'foundation' );

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
