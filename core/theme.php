<?php

/**
 * Container for all theme specific includes and classes.
 *
 * This framework contains only what is installed on every site.
 * Custom post types, extra menus and similar should be added
 * to the theme functions.php file instead for each theme.
 * This ensures that the framework can be overwritten at any
 * time with a new version.
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 **/

if(!class_exists('Ilmenite_Framework')) :

/**
 * Used to hold all framework options
 *
 * @since Ilmenite Framework 1.0
 **/
class Ilmenite_Framework {

	/**
	 * Initializes theme framework. Load required files and
	 * call necessary functions.
	 *
	 * @since Ilmenite Framework 1.0
	 **/
	function init($options) {

		// Define theme constants
		$this->constants($options);

		// Add WordPress default add_theme_support
		add_action('after_setup_theme', array(&$this, 'theme_support'));

		// Add localization support
		add_action('init', array(&$this, 'language'));

		// Load Ilmenite functions
		$this->functions();

		// Load custom dashboard widgets
		$this->dashboard_widgets();

		// Load various fixes
		require_once(THEME_FIXES . '/general_fixes.php');
	}

	/**
	 * Defines constants: paths etc. for use in the theme
	 *
	 * @since Ilmenite Framework 1.0
	 **/
	function constants($options) {
		// Theme Constants
		define('THEME_NAME', $options['theme_name']); // Name of the theme
		define('THEME_SLUG', $options['theme_slug']); // Slug of the theme
		define('THEME_VERSION', $options['theme_version']); // Slug of the theme

		// Theme Main Directory Constants
		define('THEME_DIR', get_template_directory()); // Path to theme directory
		define('THEME_URI', get_template_directory_uri()); // URI to theme directory

		// Framework Constants
		define('THEME_FRAMEWORK', THEME_DIR . '/core'); // Path to framework folder
		define('THEME_ADMIN', THEME_FRAMEWORK . '/admin'); // Path to framework admin folder

		define('THEME_ADMIN_URI', THEME_URI . '/core/admin'); // URI to framework admin folder

		// Constants for Sub-folders in the framework folder
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets'); // Path to custom widgets
		define('THEME_DASHBOARD_WIDGETS', THEME_FRAMEWORK . '/dashboard-widgets'); // Path to custom dashboard widgets
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions'); // Path to theme functions
		define('THEME_SHORTCODES', THEME_FRAMEWORK . '/shortcodes'); // Path to shortcodes
		define('THEME_FIXES', THEME_FRAMEWORK . '/fixes'); // Path to fixes

		// Constants for Theme Admin Panel
		define('THEME_ADMIN_METABOXES', THEME_ADMIN . '/metaboxes'); // Path to metaboxes
		define('THEME_ADMIN_DOCS', THEME_ADMIN . '/docs'); // Path to theme docs
		define('THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options'); // Path to theme options files
		define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions'); // Path to theme admin functions

		define('THEME_ADMIN_ASSETS_URI', THEME_ADMIN . '/assets'); // Path to admin panel assets

		// Theme Style Constants
		define('THEME_INCLUDES', THEME_URI . '/inc'); // URI to theme inc folder
		define('THEME_IMAGES', THEME_URI . '/images'); // URI to theme images folder
		define('THEME_CSS', THEME_URI . '/stylesheets'); // URI to css folder
		define('THEME_JS', THEME_URI . '/javascripts'); // URI to javascripts folder
	}

	/**
	 * Add theme support for: add_theme_support variables
	 * Also registers default sidebar
	 *
	 * @since Ilmenite Framework 1.0
	 **/
	function theme_support() {

		if(function_exists('add_theme_support')) {

			// Post thumbnails are added.
			add_theme_support('post-thumbnails');

			// Enable Built-in Navigation menus
			add_theme_support('menus');

			// Register one default navigation menu
			register_nav_menus(array(
				'primary-menu' => __('Main Navigation', 'TEXTDOMAINTHEMENAME')
			));

			// Adds post and comment RSS feeds into the <head> auomatically
			add_theme_support('automatic-feed-links');

			// Add support for custom editor style
			add_editor_style();

			// Adds support for post formats
			// add_theme_support( 'post-formats', array( 'aside' ) ); // aside, gallery, link, image, quote, status, video, audio, chat
		}

		if(function_exists('register_sidebar')) {

			// Sets up a default sidebar.
			register_sidebar(array(
				'id' => 'sidebar',
				'name' => __('Sidebar', 'TEXTDOMAINTHEMENAME'),
				'before_widget' => '<div class="sidebar-block">',
			 	'after_widget' => '</div>',
			 	'before_title' => '<h5 class="sidebar-block-title">',
			 	'after_title' => '</h5>',
			));

			// More sidebars can be added here!

		}
	}

	/**
	 * Loads core ilmenite functions.
	 *
	 * @since Ilmenite Framework 1.0
	 **/
	function functions() {

		// Helpers functions
		require_once( THEME_FUNCTIONS . '/common.php' );

		// Functions that print UI elements
		require_once( THEME_FUNCTIONS . '/ui.php' );

		// Scripts, styles, favicon etc. that generally hooks into wp_head
		require_once( THEME_FUNCTIONS . '/head.php' );

		// Functions affecting the admin panel.
		// require_once(THEME_FUNCTIONS . '/admin.php');
	}

	/**
	 * Loads admin dashboard widgets
	 *
	 * @since Ilmenite Framework 1.0
	 **/
	function dashboard_widgets() {
		require_once(THEME_DASHBOARD_WIDGETS . '/xld-blog-rss.php'); // XLD Studios blog RSS widget.
	}

	/**
	 * Makes theme available for the built-in localization
	 *
	 * @since Ilmenite Framework 1.0
	 **/
	function language(){

		$locale = get_locale();

		load_theme_textdomain( 'TEXTDOMAINTHEMENAME', THEME_DIR . '/languages' );
		$locale_file = THEME_DIR . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ){
			require_once( $locale_file );
		}

	}

} // End: class Theme() {}

endif; // End: if(!class_exists('Theme') :