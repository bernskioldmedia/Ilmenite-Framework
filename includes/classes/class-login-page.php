<?php
/**
 * Customizes the wp-login.php
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

/**
 * Class Login_Page
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Login_Page {

	/**
	 * Login_Page constructor.
	 */
	public function __construct() {

		// Customize Logo URL.
		add_filter( 'login_headerurl', array( $this, 'logo_url' ) );

		// Custom Login Stylesheet.
		add_action( 'login_enqueue_scripts', array( $this, 'stylesheet' ) );

	}

	/**
	 * Custom Link for Login Page Logo
	 *
	 * @return string Login URL.
	 */
	public function logo_url() {
		return home_url();
	}

	/**
	 * Custom Login Page Stylesheet
	 *
	 * @return void
	 */
	public function stylesheet() {
		wp_enqueue_style( 'custom-login', Ilmenite()->get_theme_assets_uri() . '/css/style-login.css', array(), Ilmenite()->get_theme_version(), 'all' );
	}
}
