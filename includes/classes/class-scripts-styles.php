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
	public static function init() {

		// Styles.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'styles' ) );

		// Scripts.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );

	}

	/**
	 * Stylesheets
	 *
	 * Registers and enqueues theme stylesheets.
	 **/
	public static function styles() {

		// Register Main Stylesheet.
		wp_register_style( 'main', Theme::get_assets_url( 'css/main.css' ), false, Theme::get_version(), 'all' );

		// Enqueue.
		wp_enqueue_style( 'main' );

	}

	/**
	 * Enqueue Scripts on public side
	 **/
	public static function scripts() {

		// Register Main Theme Scripts.
		wp_register_script( 'theme', Theme::get_assets_url( 'js/theme.min.js' ), array( 'jquery' ), Theme::get_version(), true );

		// Enqueue.
		wp_enqueue_script( 'theme' );

	}
}

Scripts_Styles::init();
