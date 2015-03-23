<?php
/**
 * Script and Style Functions
 *
 * Handles the loading of scripts and styles for the
 * theme through the proper enqueuing methods.
 **/

if ( ! function_exists( 'ilmenite_enqueue_styles' ) ) :

	/**
	 * Stylesheets
	 *
	 * Registers and enqueues theme stylesheets.
	 **/
	function ilmenite_enqueue_styles() {

		// Register
		// wp_register_style( $handle, $src, $deps, $ver, $media );
		wp_register_style( 'layout', THEME_CSS_URI . '/layout.css', false, THEME_VERSION, 'all' );

		// Enqueue
		wp_enqueue_style( 'layout' );

	}

	add_action( 'wp_enqueue_scripts', 'ilmenite_enqueue_styles' );

endif;

if ( ! function_exists( 'ilmenite_enqueue_scripts' ) ) :

	/**
	 * Enqueue Scripts on public side
	 **/
	function ilmenite_enqueue_scripts() {

		// Register
		// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
		wp_register_script( 'iconic', THEME_JS_URI . '/plugins/iconic.min.js', '0.4.2', true );
		wp_register_script( 'foundation', THEME_JS_URI . '/plugins/foundation/foundation.js', array( 'jquery' ), THEME_VERSION, true );
		wp_register_script( 'modernizr', THEME_JS_URI . '/vendor/modernizr.min.js', false, '2.8.3', false );
		wp_register_script( 'main-scripts', THEME_JS_URI . '/main.min.js', array( 'jquery', 'foundation' ), THEME_VERSION, true );

		// Enqueue
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'main-scripts' );

	}

	add_action('wp_enqueue_scripts', 'ilmenite_enqueue_scripts');

endif;

if ( ! function_exists( 'ilmenite_favicon' ) ) :

	/**
	 * Adds a favicon to the site
	 *
	 * Will load any favicon that is added into the
	 * theme image directory.
	 **/
	function ilmenite_favicon() {

		echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . THEME_IMAGES_URI . '/favicon.ico">';

	}

	add_action('wp_head', 'ilmenite_favicon'); // Adds the favicon to frontend
	add_action('admin_head', 'ilmenite_favicon'); // Adds the favicon to backend

endif;