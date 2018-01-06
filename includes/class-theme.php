<?php
/**
 * Ilmenite Theme Class
 *
 * This file is responsible for setting up the theme class, loading features,
 * functions and extensions which are typically placed in other classes and
 * files and then loaded in via this.
 *
 * We do this as opposed to using a functions.php approach because it makes our
 * code more modular and easy to maintain and use.
 *
 * @author  Bernskiold Media <info@bernskioldmedia.com>
 * @package BernskioldMedia\ClientName\Theme
 */

namespace BernskioldMedia\ClientName\Theme;

/**
 * Class Ilmenite
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Ilmenite {

	/**
	 * Helper Functions Class Instance
	 *
	 * @var object
	 */
	public $helper;

	/**
	 * Template Functions Class Instance
	 *
	 * @var object
	 */
	public $template;

	/**
	 * The single instance of the class
	 *
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Class Instance
	 *
	 * @return object Instance Object.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initializes theme framework. Load required files and
	 * call necessary functions.
	 **/
	public function __construct() {

		// Run the actions.
		$this->actions();

		// Setup the classes.
		$this->classes();

	}

	/**
	 * Hooks into and runs actions
	 * used in the setup of the theme.
	 */
	public function actions() {

		// Add WordPress default add_theme_support.
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

		// Add custom image sizes.
		add_action( 'after_setup_theme', array( $this, 'custom_image_sizes' ) );

		// Add navigation menus.
		add_action( 'after_setup_theme', array( $this, 'register_navigation_menus' ) );

	}

	/**
	 * Add theme support for: add_theme_support variables
	 * Also registers default sidebar
	 **/
	public function theme_support() {

		if ( function_exists( 'add_theme_support' ) ) {

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			// Add theme support for custom CSS in the TinyMCE visual editor.
			add_editor_style( '/assets/css/editor-style.css' );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

		} // End if().

		/*
		 * Make the theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( wp_get_theme()->get( 'TextDomain' ), get_template_directory() . '/languages' );

	}

	/**
	 * Set up Custom Image Sizes
	 */
	public function custom_image_sizes() {

		// Example Code.
		// add_image_size( 'large', 1024, '', true );

	}

	/**
	 * Register Navigation Menus
	 */
	public function register_navigation_menus() {

		if ( ! function_exists( 'register_navigation_menus' ) ) {

			$locations = array(
				'primary-menu' => esc_html__( 'Main Navigation', 'THEMETEXTDOMAIN' ),
			);

			register_nav_menus( $locations );

		}

	}

	/**
	 * Loads Core Functions and Classes
	 **/
	public function classes() {

		// Cleanup Functions.
		require_once( 'classes/class-cleanup.php' );
		new Cleanup;

		// Helper functions.
		require_once( 'classes/class-helpers.php' );
		$this->helper = new Helpers;

		// Login Page Customization.
		require_once( 'classes/class-login-page.php' );
		new Login_Page;

		// Load scripts, styles etc.
		require_once( 'classes/class-scripts-styles.php' );
		new Scripts_Styles;

		// UI Element Functions.
		require_once( 'classes/class-template-functions.php' );
		$this->template = new Template_Functions;

		// Load scripts, styles etc.
		require_once( 'classes/class-widget-areas.php' );
		new Widget_Areas();

	}

	/**
	 * Get Theme URI
	 *
	 * @param string $file_name File Name.
	 *
	 * @return string
	 */
	public static function get_theme_url( $file_name = '' ) {
		return trailingslashit( get_template_directory_uri() . '/' . $file_name );
	}

	/**
	 * Get Theme Path
	 *
	 * @param string $file_name File Name.
	 *
	 * @return string
	 */
	public static function get_theme_path( $file_name = '' ) {
		return trailingslashit( get_template_directory() . '/' . $file_name );
	}

	/**
	 * Get Theme Assets URI
	 *
	 * @param string $asset_file Asset File Name.
	 *
	 * @return string
	 */
	public static function get_theme_assets_url( $asset_file = '' ) {
		return trailingslashit( self::get_theme_url() . '/assets/' . $asset_file );
	}

	/**
	 * Get Theme Images URI
	 *
	 * @param string $image_file Image File Name.
	 *
	 * @return string
	 */
	public static function get_theme_images_uri( $image_file = '' ) {
		return self::get_theme_assets_url() . '/images/' . $image_file;
	}

	/**
	 * Get Theme Version
	 *
	 * @return false[string
	 */
	public static function get_theme_version() {
		return wp_get_theme()->get( 'Version' );
	}

	/**
	 * Get Theme Name
	 *
	 * @return false|string
	 */
	public static function get_theme_name() {
		return wp_get_theme()->get( 'Name' );
	}

	/**
	 * Get Theme Slug
	 *
	 * @return false|string
	 */
	public static function get_theme_slug() {
		return wp_get_theme()->get( 'TextDomain' );
	}

	/**
	 * Get Theme Author
	 *
	 * @return string
	 */
	public static function get_theme_author() {
		return wp_get_theme()->get( 'Author' );
	}

	/**
	 * Get Theme Author URL
	 *
	 * @return string
	 */
	public static function get_theme_author_url() {
		return wp_get_theme()->get( 'AuthorURI' );
	}

}

/**
 * Theme Function
 *
 * The theme function is used to that we can easily call the methods
 * on this class without having to redefine the Theme class
 * over and over again in our theme code.
 *
 * @return object
 */
function Ilmenite() {
	return Ilmenite::instance();
}

// Initialize the class instance only once,
// because we need it to run right away.
Ilmenite();
