<?php
/**
 * Script and Style Functions
 *
 * Handles the loading of scripts and styles for the
 * theme through the proper enqueuing methods.
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Scripts_Styles Class
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Scripts_Styles {

	/**
	 * Scripts_Styles Constructor
	 */
	public function __construct() {

		// Styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );

		// Scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

	}

	/**
	 * Stylesheets
	 *
	 * Registers and enqueues theme stylesheets.
	 **/
	public function styles() {

		// Register Main Stylesheet.
		wp_register_style( 'main', Ilmenite::get_theme_assets_url( '/css/main.css' ), false, Ilmenite::get_theme_version(), 'all' );

		// Enqueue.
		wp_enqueue_style( 'main' );

	}

	/**
	 * Enqueue Scripts on public side
	 **/
	public function scripts() {

		// Register Main Theme Scripts.
		wp_register_script( 'theme', Ilmenite::get_theme_assets_url( '/js/theme.min.js' ), array( 'jquery' ), Ilmenite::get_theme_version(), true );

		// Enqueue.
		wp_enqueue_script( 'theme' );

	}
}
