<?php
/**
 * Template Functions
 *
 * These template functions are small functions to include various
 * types of template code in the theme, abstracted and re-usable.
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Template_Functions
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Template_Functions {

	/**
	 * Pagination
	 *
	 * @param  boolean $arrows Display arrows.
	 * @param  boolean $ends   Ends.
	 * @param  integer $pages  How many pages to show.
	 *
	 * @return void
	 */
	public static function pagination( $arrows = true, $ends = true, $pages = 2 ) {

		if ( is_singular() ) {
			return;
		}

		global $wp_query, $paged;

		$pagination = '';

		$max_page = $wp_query->max_num_pages;

		if ( 1 === $max_page ) {
			return;
		}

		if ( empty( $paged ) ) {
			$paged = 1;
		}

		if ( $arrows ) {
			$pagination .= self::pagination_link( $paged - 1, 'pagination-previous' . ( ( $paged <= 1 ) ? ' disabled' : '' ), esc_html__( 'Previous', 'THEMETEXTDOMAIN' ), esc_html__( 'Previous Page', 'THEMETEXTDOMAIN' ) );
		}

		if ( $ends && $paged > $pages + 1 ) {
			$pagination .= self::pagination_link( 1 );
		}

		if ( $ends && $paged > $pages + 2 ) {
			$pagination .= self::pagination_link( 1, 'disabled', '&nbsp;' );
		}

		for ( $i = $paged - $pages; $i <= $paged + $pages; $i ++ ) {

			if ( $i > 0 && $i <= $max_page ) {
				$pagination .= self::pagination_link( $i, ( $i === $paged ) ? 'current' : '' );
			}
		}

		if ( $ends && $paged < $max_page - $pages - 1 ) {
			$pagination .= self::pagination_link( $max_page, 'ellipsis', '&nbsp;' );
		}

		if ( $ends && $paged < $max_page - $pages ) {
			$pagination .= self::pagination_link( $max_page );
		}

		if ( $arrows ) {
			$pagination .= self::pagination_link( $paged + 1, 'pagination-next' . ( ( $paged >= $max_page ) ? ' disabled' : '' ), esc_html__( 'Next', 'THEMETEXTDOMAIN' ), esc_html__( 'Next Page', 'THEMETEXTDOMAIN' ) );
		}

		$pagination = '<ul class="pagination text-center" role="menu">' . $pagination . '</ul>';

		echo wp_kses_post( $pagination );
	}

	/**
	 * Pagination Link
	 *
	 * Creates the special pagination link that is then used in the
	 * main pagination function above.
	 *
	 * @param int    $page    Page Number.
	 * @param string $class   Class Name.
	 * @param string $content Content.
	 * @param string $title   Title.
	 *
	 * @return string
	 */
	public static function pagination_link( $page, $class = '', $content = '', $title = '' ) {

		$id = sanitize_title_with_dashes( 'pagination-page-' . $page . ' ' . $class );

		$href = ( strrpos( $class, 'disabled' ) === false && strrpos( $class, 'current' ) === false ) ? get_pagenum_link( $page ) : '';

		$class   = empty( $class ) ? $class : " class=\"$class\"";
		$content = ! empty( $content ) ? $content : $page;

		/* Translators: 1: Page Number */
		$title = ! empty( $title ) ? $title : sprintf( esc_html__( 'Page %s', 'THEMETEXTDOMAIN' ), $page );

		if ( ! empty( $href ) ) {
			return "<li$class><a id=\"$id\" href=\"$href\" title=\"$title\">$content</a></li>\n";
		} else {
			return "<li$class>$content</li>\n";
		}

	}

	/**
	 * Get Text Excerpt
	 *
	 * Gets an excerpt of a provided text, or the post excerpt if
	 * none is provided. The amount of chars are set in the function.
	 *
	 * @param  int    $limit Amount of words to allow.
	 * @param  string $text  Text to truncate.
	 *
	 * @return string
	 */
	public static function get_excerpt( $limit = 50, $text = null ) {

		// If we haven't got text given, try loading the current excerpt.
		if ( ! $text ) {
			global $post;
			$text = get_the_excerpt( $post );
		}

		// Explode the string on every word.
		$excerpt = explode( ' ', $text, $limit );

		// Check the length.
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( ' ', $excerpt ) . '...';
		} else {
			$excerpt = implode( ' ', $excerpt );
		}

		$excerpt = strip_tags( preg_replace( '`\[[^\]]*\]`', '', $excerpt ) );

		return wp_kses_post( $excerpt );

	}
}
