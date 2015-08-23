<?php
if ( ! class_exists( 'Ilmenite_Framework' ) ) :

	class Ilmenite_Framework {

		/**
		 * Initializes theme framework. Load required files and
		 * call necessary functions.
		 **/
		function __construct() {

			// Define theme constants
			$this->constants();

			// Add WordPress default add_theme_support
			add_action( 'after_setup_theme', array( $this, 'theme_support' ) );

			// Load functions
			add_action( 'init', array( $this, 'functions' ) );

			// Load custom dashboard widgets
			add_action( 'admin_init', array( $this, 'dashboard_widgets' ) );

			// Add custom image sizes
			add_action( 'after_setup_theme', array( $this, 'custom_image_sizes' ) );

			// Add navigation menus
			add_action( 'after_setup_theme', array( $this, 'register_navigation_menus' ) );

		}

		/**
		 * Defines constants: paths etc. for use in the theme
		 **/
		function constants() {

			// Theme Constants
			define( 'THEME_NAME', 'THEMENAMEHERE' ); // Name of the theme
			define( 'THEME_SLUG', 'THEMESLUGHERE' ); // Slug of the theme
			define( 'THEME_VERSION', '1.6.0' ); // Version of the theme

			// Theme Main Directory Constants
			define( 'THEME_DIR', get_template_directory() ); // Path to theme directory
			define( 'THEME_URI', get_template_directory_uri() ); // URI to theme directory

			// Framework Constants
			define( 'THEME_FRAMEWORK', THEME_DIR . '/core' ); // Path to framework folder

			// Constants for Sub-folders in the framework folder
			define( 'THEME_DASHBOARD_WIDGETS', THEME_FRAMEWORK . '/dashboard-widgets'); // Path to custom dashboard widgets
			define( 'THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions'); // Path to theme functions

			// Theme Asset Constants
			define( 'THEME_ASSETS_URI', THEME_URI . '/assets'); // URI to theme inc folder
			define( 'THEME_IMAGES_URI', THEME_ASSETS_URI . '/images'); // URI to theme images folder
			define( 'THEME_CSS_URI', THEME_ASSETS_URI . '/css'); // URI to css folder
			define( 'THEME_JS_URI', THEME_ASSETS_URI . '/js'); // URI to javascripts folder
			define( 'THEME_ICONS', THEME_ASSETS_URI . '/icons'); // URI to theme svg icons folder
		}

		/**
		 * Add theme support for: add_theme_support variables
		 * Also registers default sidebar
		 **/
		function theme_support() {

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
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on Ilmenite, use a find and replace
			 * to change 'ilmenite' to the name of your theme in all the template files
			 */
			load_theme_textdomain( 'ilmenite', get_template_directory() . '/languages' );

		}

		/**
		 * Set up Custom Image Sizes
		 */
		function custom_image_sizes() {

			// Set standard sizes
			add_image_size( 'large', 1024, '', true ); // Large Thumbnail
			add_image_size( 'medium', 640, '', true ); // Medium Thumbnail
			add_image_size( 'small', 300, '', true ); // Small Thumbnail

			// Custom Image Declaration
			// add_image_size( $name, $width, $height, $crop );

		}

		/**
		 * Register Navigation Menus
		 */
		function register_navigation_menus() {

			if ( ! function_exists( 'register_navigation_menus' ) ) {

				$locations = array(
					'primary-menu' => __( 'Main Navigation', 'TEXTDOMAINTHEMENAME' ),
				);

				register_nav_menus( $locations );

			}

		}

		/**
		 * Loads core ilmenite functions.
		 **/
		function functions() {

			// Cleanup Functions
			require_once( THEME_FUNCTIONS . '/cleanup.php' );
			new Theme_Cleanup;

			// Helper functions
			require_once( THEME_FUNCTIONS . '/common.php' );

			// Transient Queries
			require_once( THEME_FUNCTIONS . '/transient-queries.php' );

			// Load scripts, styles etc.
			require_once( THEME_FUNCTIONS . '/scripts-styles.php' );
			new Theme_Scripts_Styles;

			// Sidebars
			require_once( THEME_FUNCTIONS . '/sidebars.php' );

			// UI Element Functions
			require_once( THEME_FUNCTIONS . '/template-tags.php' );

		}

		/**
		 * Loads admin dashboard widgets
		 **/
		function dashboard_widgets() {

			// RSS Widget Showing Agency Blog Posts
			require_once( THEME_DASHBOARD_WIDGETS . '/agency-rss.php' );

		}

	}

endif;