<?php
/**
 * Customizes the wp-login.php
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Login_Page
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Login_Page {

	/**
	 * Login_Page constructor.
	 */
	public static function init() {

		// Customize Logo URL.
		add_filter( 'login_headerurl', array( __CLASS__, 'get_logo_url' ) );

		// Custom Login Stylesheet.
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'load_stylesheet' ) );

	}

	/**
	 * Custom Link for Login Page Logo
	 *
	 * @return string Login URL.
	 */
	public static function get_logo_url() {
		return home_url();
	}

	/**
	 * Custom Login Page Stylesheet
	 *
	 * @return void
	 */
	public function load_stylesheet() {
		wp_enqueue_style( 'custom-login', Theme::get_assets_url( '/css/style-login.css' ), array(), Theme::get_version(), 'all' );
	}

}

Login_Page::init();
