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
 * @author Bernskiold Media <info@bernskioldmedia.com>
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
	 * Theme Author Name
	 *
	 * @var string
	 */
	protected $theme_author = '';

	/**
	 * Theme Author URL
	 *
	 * @var string
	 */
	protected $theme_author_url = '';

	/**
	 * Theme URL
	 *
	 * @var string
	 */
	protected $theme_url = '';

	/**
	 * Theme Directory Path
	 *
	 * @var string
	 */
	protected $theme_dir = '';

	/**
	 * Theme Version Number
	 *
	 * @var string
	 */
	protected $theme_version = '';

	/**
	 * Theme Name
	 *
	 * @var string
	 */
	protected $theme_name = '';

	/**
	 * Theme Slug
	 *
	 * @var string
	 */
	protected $theme_slug = '';

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
	 * Transient Queries Class Instance
	 *
	 * @var object
	 */
	public $transient;

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

		// Theme Version.
		$this->theme_version = wp_get_theme()->get( 'Version' );

		// Theme Name.
		$this->theme_name = wp_get_theme()->get( 'Name' );

		// Theme Slug.
		$this->theme_slug = wp_get_theme()->get( 'TextDomain' );

		// Theme Author Name + URL.
		$this->theme_author = wp_get_theme()->get( 'Author' );
		$this->theme_author_url = wp_get_theme()->get( 'AuthorURI' );

		// Theme Directory.
		$this->theme_dir = get_template_directory();

		// Theme URL.
		$this->theme_url = get_template_directory_uri();

		// Run the actions.
		$this->actions();

		// Load Sidebars.
		require_once( $this->get_theme_path( 'includes/sidebars.php' ) );

	}

	/**
	 * Hooks into and runs actions
	 * used in the setup of the theme.
	 */
	public function actions() {

		// Add WordPress default add_theme_support.
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

		// Load functions.
		add_action( 'init', array( $this, 'classes' ) );

		// Load custom dashboard widgets.
		add_action( 'admin_init', array( $this, 'dashboard_widgets' ) );

		// Remove non-necessary dashboard widgets.
		add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );

		// Add custom image sizes.
		add_action( 'after_setup_theme', array( $this, 'custom_image_sizes' ) );

		// Add navigation menus.
		add_action( 'after_setup_theme', array( $this, 'register_navigation_menus' ) );

		// Customize Admin.
		add_filter( 'admin_footer_text', array( $this, 'change_admin_footer_text' ) );
		add_action( 'admin_menu', array( $this, 'admin_no_footer_version' ) );

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

			// Add theme support for custom CSS in the TinyMCE visual editor
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

		}

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
		require_once( $this->get_theme_path( 'includes/classes/class-cleanup.php' ) );
		new Cleanup;

		// Helper functions.
		require_once( $this->get_theme_path( 'includes/classes/class-helper-functions.php' ) );
		$this->helper = new Helpers;

		// Transient Queries.
		require_once( $this->get_theme_path( 'includes/classes/class-transient-queries.php' ) );
		$this->transient = new Transient_Queries;

		// Load scripts, styles etc.
		require_once( $this->get_theme_path( 'includes/classes/class-scripts-styles.php' ) );
		new Script_Styles;

		// UI Element Functions.
		require_once( $this->get_theme_path( 'includes/classes/class-template-functions.php' ) );
		$this->template = new Template_Functions;

		// WP Login Customization.
		require_once( $this->get_theme_path( 'includes/classes/class-wp-login.php' ) );
		new Login_Page;

	}

	/**
	 * Loads admin dashboard widgets
	 **/
	public function dashboard_widgets() {

		// RSS Widget Showing Agency Blog Posts.
		require_once( $this->get_theme_path( 'includes/dashboard-widgets/class-bm-dashboard-rss.php' ) );

	}


	/**
	 * Remove Dashboard Widgets
	 *
	 * @return void
	 */
	public function remove_dashboard_widgets() {

		global $wp_meta_boxes;

		// Hide Some Default Dashboard Widgets.
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );

	}

	/**
	 * Change Admin Footer Text
	 *
	 * @return void
	 */
	public function change_admin_footer_text() {

		$text = sprintf(
			__( '%1$s Website Admin Panel. Website developed by <a href="%3$s">%2$s</a>.', 'THEMETEXTDOMAIN' ),
			get_bloginfo( 'name' ),
			$this->get_theme_author(),
			$this->get_theme_author_url()
		);

		echo wp_kses_post( $text );

	}

	/**
	 * Admin No Footer Version
	 *
	 * @return void
	 */
	public function admin_no_footer_version() {
	    remove_filter( 'update_footer', 'core_update_footer' );
	}

	/**
	 * Get Theme URI
	 *
	 * @param string $file_name File Name.
	 *
	 * @return string
	 */
	public static function get_theme_url( $file_name = '' ) {
		return $this->theme_url . '/' . $file_name;
	}

	/**
	 * Get Theme Path
	 *
	 * @param string $file_name File Name.
	 *
	 * @return string
	 */
	public static function get_theme_path( $file_name = '' ) {
		return $this->theme_dir . '/' . $file_name;
	}

	/**
	 * Get Theme Version
	 *
	 * @return string
	 */
	public static function get_theme_version() {
		return $this->theme_version;
	}

	/**
	 * Get Theme Author
	 *
	 * @return string
	 */
	public static function get_theme_author() {
		return $this->theme_author;
	}

	/**
	 * Get Theme Author URL
	 *
	 * @return string
	 */
	public static function get_theme_author_url() {
		return $this->theme_author_url;
	}

	/**
	 * Get Theme Assets URI
	 *
	 * @param string $path Asset File Name.
	 *
	 * @return string
	 */
	public static function get_theme_assets_uri( $asset_file = '' ) {
		return $this->theme_url . '/assets/' . $asset_file;
	}

	/**
	 * Get Theme Images URI
	 *
	 * @param string $image_file Image File Name.
	 *
	 * @return string
	 */
	public static function get_theme_images_uri( $image_file = '' ) {
		return $this->theme_url . '/assets/images/' . $image_file;
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