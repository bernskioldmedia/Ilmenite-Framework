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
		wp_register_style( 'layout', Ilmenite_Theme()->get_theme_assets_uri() . '/css/layout.css', false, Ilmenite_Theme()->get_theme_version(), 'all' );

		// Enqueue
		wp_enqueue_style( 'layout' );

	}

	/**
	 * Enqueue Scripts on public side
	 **/
	public function scripts() {

		// Register
		wp_register_script( 'modernizr', Ilmenite_Theme()->get_theme_assets_uri() . '/js/src/vendor/modernizr.min.js', false, '2.8.3', false );
		wp_register_script( 'theme', Ilmenite_Theme()->get_theme_assets_uri() . '/js/theme.min.js', array( 'jquery' ), Ilmenite_Theme()->get_theme_version(), true );

		// Enqueue
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'theme' );

	}

}