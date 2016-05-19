<?php
/**
 * Customizes the wp-login.php
 *
 * @package BernskioldMedia\Ilmenite_Theme
 */
namespace BernskioldMedia\Ilmenite_Theme;

/**
 * Class Theme_Login
 *
 * @package BernskioldMedia\Ilmenite_Theme
 */
class Theme_Login {

	/**
	 * Theme Login Class Constructor
	 */
	public function __construct() {

		// Customize Logo URL
		add_filter( 'login_headerurl', array( $this, 'logo_url' ) );

		// Custom Login Stylesheet
		add_action( 'login_enqueue_scripts', array ( $this, 'stylesheet' ) );

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
		wp_enqueue_style( 'custom-login', Ilmenite_Theme()->get_theme_assets_uri() . '/css/style-login.css' );
	}

}