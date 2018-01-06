<?php
/**
 * Widget_Areas
 *
 * Registers the widget areas for the theme.
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Widget_Areas
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Widget_Areas {

	/**
	 * Widget Areas
	 *
	 * @var array
	 */
	protected $widget_areas = array();

	/**
	 * Widget_Areas constructor.
	 */
	public function __construct() {

		$this->setup();

		// Register all the widget areas.
		add_action( 'init', array( $this, '_register' ) );

	}

	/**
	 * Initialize
	 *
	 * This is where you add your own widget areas.
	 */
	protected function setup() {

		/**
		 * Add Main Sidebar
		 */
		$this->add( array(
			'id'   => 'sidebar',
			'name' => esc_html__( 'Sidebar', 'THEMETEXTDOMAIN' ),
		) );

	}

	/**
	 * Add Widget Area
	 *
	 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
	 *
	 * @param array $args Arguments.
	 */
	public function add( $args = array() ) {

		$args = array_merge( array(
			'id'            => '',
			'name'          => '',
			'before_widget' => '<div class="sidebar-block">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="sidebar-block-title">',
			'after_title'   => '</h2>',
		), $args );

		$this->widget_areas[ $args['id'] ] = $args;

	}

	/**
	 * Register Widget Areas
	 */
	public function _register() {

		// Get widget areas.
		$widget_areas = $this->get_widget_areas();

		if ( ! empty( $widget_areas ) ) {
			foreach ( $widget_areas as $id => $args ) {
				register_sidebar( $args );
			}
		}

	}

	/**
	 * Get Widget_Areas
	 *
	 * @return array
	 */
	protected function get_widget_areas() {
		return $this->widget_areas;
	}

}
