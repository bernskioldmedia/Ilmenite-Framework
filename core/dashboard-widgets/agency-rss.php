<?php
if ( ! function_exists( 'ilmenite_dashboard_widget_blog' ) ) :

     /**
      * Displays Blog Articles from a chosen RSS feed
      **/
     function ilmenite_dashboard_widget_blog() {

          global $wp_meta_boxes;

          // add a custom dashboard widget
          wp_add_dashboard_widget( 'dashboard_custom_feed', __('From the XLD Studios Blog', 'TEXTDOMAINTHEMENAME'), 'ilmenite_dashboard_widget_blog_output' ); //add new RSS feed output
     }

     add_action( 'wp_dashboard_setup', 'ilmenite_dashboard_widget_blog' );

     function ilmenite_dashboard_widget_blog_output() {

          echo '<div class="rss-widget">';

               wp_widget_rss_output(array(
                    'url'          => __( 'http://www.xldstudios.com/feed', 'TEXTDOMAINTHEMENAME' ),
                    'title'        => __('The Latest from XLD Studios', 'TEXTDOMAINTHEMENAME'),
                    'items'        => 2,
                    'show_summary' => 1,
                    'show_author'  => 0,
                    'show_date'    => 1
               ));

          echo "</div>";
     }

endif;