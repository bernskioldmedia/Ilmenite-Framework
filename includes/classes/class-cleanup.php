<?php
/**
 * Cleanup WordPress Output
 *
 * Some things added to WordPress are not things we need.
 * These are cleanup and tweaks functions.
 *
 * @package BernskioldMedia\ClientName\Theme
 */

namespace BernskioldMedia\ClientName\Theme;

/**
 * Class Cleanup
 */
class Cleanup {

	/**
	 * Cleanup constructor.
	 */
	public function __construct() {

		// Clean up wp_head().
		$this->wp_head_cleanup();

		// Make oEmbed responsive.
		add_filter( 'embed_oembed_html', array( $this, 'wrap_oembed' ), 10, 2 );

		// Remove WordPress Version from RSS Feeds.
		add_filter( 'the_generator', '__return_false' );

		// Rewrites the search URL.
		add_action( 'template_redirect', array( $this, 'nice_search_url' ) );

		// Blank Search Query Fix.
		add_filter( 'request', array( $this, 'blank_search_fix' ) );

		// Remove non-necessary dashboard widgets.
		add_action( 'wp_dashboard_setup', array( $this, 'remove_dashboard_widgets' ) );

		// Customize Admin.
		add_filter( 'admin_footer_text', array( $this, 'change_admin_footer_text' ) );
		add_action( 'admin_menu', array( $this, 'admin_no_footer_version' ) );

	}

	/**
	 * Clean up wp_head() from unnecessary bloat.
	 *
	 * Remove unnecessary <link>'s
	 */
	public function wp_head_cleanup() {

		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );

		// all actions related to emojis.
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// filter to remove TinyMCE emojis.
		add_filter( 'tiny_mce_plugins', array( $this, 'disable_emojicons_tinymce' ) );

	}

	/**
	 * Disable Emojis in TincyMCE
	 *
	 * @param  array $plugins Active Plugins Array.
	 *
	 * @return array
	 */
	public function disable_emojicons_tinymce( $plugins ) {

		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}

	}

	/**
	 * Wrap content embedded using oembed in div
	 *
	 * This can be styled using media queries etc.
	 *
	 * @param string $cache Cache.
	 * @param string $url   Embed URL.
	 *
	 * @return string
	 */
	public function wrap_oembed( $cache, $url ) {

		return '<div class="responsive-embed widescreen" data-url="' . esc_attr( $url ) . '">' . $cache . '</div>';

	}

	/**
	 * Redirects search results from /?s=query to /search/query/, converts %20 to +
	 *
	 * @link http://txfx.net/wordpress-plugins/nice-search/
	 * @link https://github.com/roots/roots/blob/master/lib/cleanup.php
	 */
	public function nice_search_url() {

		global $wp_rewrite;

		if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() ) {
			return;
		}

		$search_base = $wp_rewrite->search_base;

		if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
			wp_safe_redirect( home_url( "/{$search_base}/" . rawurlencode( get_query_var( 's' ) ) ) );
			exit();
		}

	}

	/**
	 * Fix for empty search queries redirecting to home page
	 *
	 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
	 * @link http://core.trac.wordpress.org/ticket/11330
	 * @link https://github.com/roots/roots/blob/master/lib/cleanup.php
	 *
	 * @param array $query_vars Query Vars.
	 *
	 * @return array
	 */
	public function blank_search_fix( $query_vars ) {

		if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && ! is_admin() ) {
			$query_vars['s'] = ' ';
		}

		return $query_vars;

	}

	/**
	 * Change Admin Footer Text
	 *
	 * @return void
	 */
	public function change_admin_footer_text() {

		/* translators: 1. Website Name 2. Theme Author Name 3. Theme Author URL */
		$text = sprintf( __( '%1$s Website Admin Panel. Website developed by <a href="%3$s">%2$s</a>.', 'THEMETEXTDOMAIN' ), get_bloginfo( 'name' ), Ilmenite::get_theme_author(), Ilmenite::get_theme_author_url() );

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

}
