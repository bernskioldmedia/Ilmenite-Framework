<?php
if ( ! class_exists( 'BM_Dashboard_Welcome' ) ) :

     class BM_Dashboard_Welcome {

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
              add_meta_box( 'dashboard_bm_welcome_widget', __( 'Welcome To Your Website', 'THEMETEXTDOMAIN' ), array( $this, 'widget_output' ), 'dashboard', 'side', 'high' );

          }

          /**
           * Control the Widget Output
           *
           * This function is referenced in the wp_add_dashboard_widget() function call above.
           */
          public function widget_output() {

            // Get Current User Data
            $current_user = wp_get_current_user();

            ob_start(); ?>

              <div class="welcome-panel-content">
                <p class="about-description"><?php _e( 'Your business dashboard shows you important and relevant information about your website available at your fingertips.', 'THEMETEXTDOMAIN' ); ?></p>
                <p><?php _e( 'If you ever need any support, just use the support widget here to send a message to our helpdesk which is available to answer your questions.', 'THEMETEXTDOMAIN' ); ?></p>
              </div>

            <?php
            echo ob_get_clean();

          }

     }

     new BM_Dashboard_Welcome;

endif;