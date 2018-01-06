<?php
if ( ! class_exists( 'BM_Dashboard_RSS' ) ) :

	class BM_Dashboard_RSS {

		public function __construct() {

			// Register the dashboard widget
			add_action( 'wp_dashboard_setup', array( $this, 'dashboard_widget_config' ) );

		}

		/**
		 * Configure and the dashboard widget
		 **/
		function dashboard_widget_config() {

			global $wp_meta_boxes;

			// add a custom dashboard widget
			wp_add_dashboard_widget( 'dashboard_custom_feed', esc_html__( 'From the Bernskiold Media Academy', 'THEMETEXTDOMAIN' ), array(
				$this,
				'widget_output',
			) );
		}

		/**
		 * Control the Widget Output
		 *
		 * This function is referenced in the wp_add_dashboard_widget() function call above.
		 */
		public function widget_output() {

			echo '<div class="rss-widget">';

			wp_widget_rss_output( array(
				'url'          => _x( 'https://www.bernskioldmedia.com/en/feed/', 'bernskiold media rss feed url', 'THEMETEXTDOMAIN' ),
				'title'        => esc_html__( 'From the Bernskiold Media Academy', 'THEMETEXTDOMAIN' ),
				'items'        => 4,
				'show_summary' => 1,
				'show_author'  => 0,
				'show_date'    => 0,
			) );

			echo "</div>";

		}
	}

	new BM_Dashboard_RSS;

endif;
