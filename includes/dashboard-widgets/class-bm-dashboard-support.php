<?php
if ( ! class_exists( 'BM_Dashboard_Support' ) ) :

     class BM_Dashboard_Support {

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
               add_meta_box( 'dashboard_bm_support_widget', __( 'Are you having problems?', 'THEMETEXTDOMAIN' ), array( $this, 'widget_output' ), 'dashboard', 'side', 'high' );
          }

          /**
           * Control the Widget Output
           *
           * This function is referenced in the wp_add_dashboard_widget() function call above.
           */
          public function widget_output() {

            $processed = $this->process_form();

            // Get Current User Data
            $current_user = wp_get_current_user();

            ob_start(); ?>

              <p><?php _e( '<strong>Your problems are our problems!</strong> Our <a href="https://www.bernskioldmedia.com/en/helpdesk/">website helpdesk</a> is available to help you with any questions and problems you might have. Regardless of whether you have a support plan or not, our helpdesk is available on a case-by-case consulting basis per our current rates.', 'THEMETEXTDOMAIN' ); ?></p>

              <?php if ( ! $processed ) : ?>

                <form action="" method="post" accept-charset="utf-8">

                  <div class="input-text-wrap">
                    <label for="name">
                      <?php _e( 'Your Name', 'THEMETEXTDOMAIN' ); ?>
                      <input type="text" class="regular-text" name="name" id="name" value="<?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?>">
                    </label>
                  </div>

                  <div class="input-text-wrap">
                    <label for="email">
                      <?php _e( 'Your E-Mail', 'THEMETEXTDOMAIN' ); ?>
                      <input type="text" class="regular-text" name="email" id="email" value="<?php echo $current_user->user_email; ?>">
                    </label>
                  </div>

                  <div class="textarea-text-wrap">
                    <label for="question">
                      <?php _e( 'What Do You Need Help With?', 'THEMETEXTDOMAIN' ); ?><br/>
                      <textarea name="question" id="question" rows="3" cols="20" class="large-text"></textarea>
                    </label>
                  </div>

                  <div class="textarea-text-wrap">
                    <label for="mood">
                      <?php _e( 'How are you feeling right now?', 'THEMETEXTDOMAIN' ); ?><br/>
                      <select name="mood" id="mood">
                        <option value="<?php _e( 'Awesome', 'THEMETEXTDOMAIN' ); ?>"><?php _e( 'Awesome', 'THEMETEXTDOMAIN' ); ?></option>
                        <option value="<?php _e( 'Curious', 'THEMETEXTDOMAIN' ); ?>"><?php _e( 'Curious', 'THEMETEXTDOMAIN' ); ?></option>
                        <option value="<?php _e( 'Confused', 'THEMETEXTDOMAIN' ); ?>"><?php _e( 'Confused', 'THEMETEXTDOMAIN' ); ?></option>
                        <option value="<?php _e( 'Worried', 'THEMETEXTDOMAIN' ); ?>"><?php _e( 'Worried', 'THEMETEXTDOMAIN' ); ?></option>
                        <option value="<?php _e( 'Panicked', 'THEMETEXTDOMAIN' ); ?>"><?php _e( 'Panicked', 'THEMETEXTDOMAIN' ); ?></option>
                        <option value="<?php _e( 'Unsure', 'THEMETEXTDOMAIN' ); ?>"><?php _e( 'Unsure', 'THEMETEXTDOMAIN' ); ?></option>
                      </select>
                    </label>
                  </div>

                  <p>
                    <input type="submit" name="submit" id="submit-question" class="button button-primary" value="<?php _e( 'Send Question', 'THEMETEXTDOMAIN' ); ?>">
                  </p>

                </form>

              <?php else : ?>

                <div class="updated">
                  <p><?php _e( 'Your support message has been successfully sent.', 'THEMETEXTDOMAIN' ); ?></p>
                </div>

              <?php endif; ?>

            <?php
            echo ob_get_clean();

          }

          public function process_form() {

            if ( $_POST ) {

              $name     = ( ! empty ( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '' );
              $email    = ( ! empty ( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '' );
              $question = ( ! empty ( $_POST['question'] ) ? sanitize_text_field( $_POST['question'] ) : '' );
              $mood     = ( ! empty ( $_POST['mood'] ) ? sanitize_text_field( $_POST['mood'] ) : '' );

              $site_name = get_bloginfo( 'name' );
              $site_url  = get_bloginfo( 'url' );

              $message = "This is a new support request from $site_name ($site_url).\n\n

              Name: $name \n
              E-mail: $email \n

              My Question:\n
              $question

              I'm currently feeling: $mood.";

              wp_mail( 'erik@bernskioldmedia.com', __( 'Website Support Enquiry', 'THEMETEXTDOMAIN' ), $message );

              return true;

            } else {
              return false;
            }

          }

     }

     new BM_Dashboard_Support;

endif;