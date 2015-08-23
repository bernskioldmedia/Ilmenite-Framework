<?php
/**
 * Script and Style Functions
 *
 * Handles the loading of scripts and styles for the
 * theme through the proper enqueuing methods.
 **/
class Theme_Scripts_Styles {

	public function __construct() {

		// Styles
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );

		// Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

	}

	/**
	 * Stylesheets
	 *
	 * Registers and enqueues theme stylesheets.
	 **/
	public function styles() {

		// Register
		// wp_register_style( $handle, $src, $deps, $ver, $media );
		wp_register_style( 'layout', THEME_CSS_URI . '/layout.css', false, THEME_VERSION, 'all' );

		// Enqueue
		wp_enqueue_style( 'layout' );

	}

	/**
	 * Enqueue Scripts on public side
	 **/
	public function scripts() {

		// Register
		// wp_register_script( $handle, $src, $deps, $ver, $in_footer );
		// wp_register_script( 'iconic', THEME_JS_URI . '/plugins/iconic.min.js', '0.4.2', true );
		// wp_register_script( 'foundation', THEME_JS_URI . '/plugins/foundation/foundation.js', array( 'jquery' ), THEME_VERSION, true );
		wp_register_script( 'modernizr', THEME_JS_URI . '/src/vendor/modernizr.min.js', false, '2.8.3', false );
		wp_register_script( 'theme', THEME_JS_URI . '/theme.min.js', array( 'jquery' ), THEME_VERSION, true );

		// Enqueue
		wp_enqueue_script( 'modernizr' );
		// wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'theme' );

	}

}