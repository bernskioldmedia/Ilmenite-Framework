<?php
/**
 * Cleanup WordPress stuff
 *
 * Some things added to WordPress are not things we need.
 * These are cleanup and tweaks functions.
 */
namespace BernskioldMedia\ClientName\Theme;

class Theme_Cleanup {

	public function __construct() {

		// Clean up wp_head().
		add_action( 'init', array( $this, 'wp_head_cleanup' ) );

		// Make oembed responsive.
		add_filter( 'embed_oembed_html', array( $this, 'wrap_oembed' ), 10, 4 );

		// Remove WordPress Version from RSS Feeds.
		add_filter('the_generator', '__return_false');

		// Rewrites the search URL.
		add_action( 'template_redirect', array( $this, 'nice_search_url' ) );

		// Blank Search Query Fix.
		add_filter( 'request', array( $this, 'blank_search_fix' ) );

	}

	/**
	 * Clean up wp_head() from uncessecary bloat.
	 *
	 * Remove unnecessary <link>'s
	 */
	public function wp_head_cleanup() {

		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

		// all actions related to emojis.
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// filter to remove TinyMCE emojis.
		add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );

	}

	/**
	 * Wrap content embedded using oembed in div
	 *
	 * This can be styled using media queries etc.
	 *
	 * @link https://gist.github.com/965956
	 */
	public function wrap_oembed( $cache, $url, $attr = '', $post_ID = '' ) {

		return '<div class="flex-video widescreen">' . $cache . '</div>';

	}

	/**
	 * Redirects search results from /?s=query to /search/query/, converts %20 to +
	 *
	 * @link http://txfx.net/wordpress-plugins/nice-search/
	 * @link https://github.com/roots/roots/blob/master/lib/cleanup.php
	 */
	public function nice_search_url() {

		global $wp_rewrite;

		if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() )
			return;

		$search_base = $wp_rewrite->search_base;

		if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
			wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var('s') ) ) );
			exit();
		}

	}

	/**
	 * Fix for empty search queries redirecting to home page
	 *
	 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
	 * @link http://core.trac.wordpress.org/ticket/11330
	 * @link https://github.com/roots/roots/blob/master/lib/cleanup.php
	 */
	public function blank_search_fix( $query_vars ) {

		if ( isset($_GET['s'] ) && empty( $_GET['s'] ) && ! is_admin() ) {
			$query_vars['s'] = ' ';
		}

		return $query_vars;
	}

}