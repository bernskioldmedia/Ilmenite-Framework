<?php
/**
 * Script and Style Functions
 *
 * Handles the loading of scripts and styles for the
 * theme through the proper enqueuing methods.
 **/

/**
 * Stylesheets
 *
 * Registers and enqueues theme stylesheets.
 **/
function ilmenite_enqueue_styles() {

	// Register
	// wp_register_style( $handle, $src, $deps, $ver, $media );
	wp_register_style( 'layout', THEME_CSS . '/layout.css', false, THEME_VERSION, 'all' );

	// Enqueue
	wp_enqueue_style( 'layout' );

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
	wp_register_script( 'foundation', THEME_JS . '/foundation/foundation.min.js', array( 'jquery' ), THEME_VERSION, false );
	wp_register_script( 'zepto', THEME_JS . '/vendor/zepto.js', false, '1.0.1', false );
	wp_register_script( 'modernizr', THEME_JS . '/vendor/custom.modernizr.js', false, '2.6.2', false );
	wp_register_script( 'scripts', THEME_JS . '/scripts.min.js', array( 'jquery', 'foundation' ), '2.6.2', false );


	// Enqueue
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'foundation' );
	wp_enqueue_script( 'zepto' );
	wp_enqueue_script( 'scripts' );

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
