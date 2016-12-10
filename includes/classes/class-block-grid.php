<?php
/**
 * Block Grid
 *
 * The block grid is a custom flexible page element that we use to
 * build and construct beautiful-looking pages.
 *
 * It relies on a number of ACF fields for the configurable settings,
 * which can be included on virtually any page templates via the ACF options.
 *
 * This class contains a number of preparing functions that are then
 * called in the template file for the grid, found in the partials/ directory.
 *
 * @package BernskioldMedia\ClientName\Theme
 */

namespace BernskioldMedia\ClientName\Theme;

/**
 * Class Block_Grid
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Block_Grid {

	/**
	 * Block Grid Options
	 *
	 * @var array
	 */
	protected $settings = array();

	/**
	 * Stored Block Grid Options for Output
	 *
	 * @var array
	 */
	protected $output_args = array();

	/**
	 * Block_Grid Constructor
	 */
	public function __construct() {
	}

	/**
	 * Prepare the block grid by loading settings.
	 *
	 * @param object|bool $post WP Post Object (optional).
	 */
	public function prepare( $post = false ) {

		// We'll use the explicit post object given to the function if we need to.
		// But if it is not specificed, we use the global one and assume that
		// we are indeed in the loop.
		if ( ! $post ) {
			global $post;
		}

		// Prepare the section settings.
		$this->do_section_settings();

		// Prepare the grid classes.
		$this->prepare_grid_class();

		// Prepare the bordered section.
		$this->prepare_bordered();

		// Prepare the fullwidth section.
		$this->prepare_fullwidth();

		// Prepare the equal height section.
		$this->prepare_equal_height();

	}

	/**
	 * Load The Section Settings
	 *
	 * Gets all the values from the ACF fields and stores them
	 * to the internal class settings array.
	 *
	 * @param object|bool $post WP Post Object (optional).
	 */
	protected function do_section_settings( $post = false ) {

		// We'll use the explicit post object given to the function if we need to.
		// But if it is not specificed, we use the global one and assume that
		// we are indeed in the loop.
		if ( ! $post ) {
			global $post;
		}

		// Get the grid column number.
		$this->set( 'setting', 'grid_columns', get_sub_field( 'grid_columns', $post ) );

		// Get the page section background.
		$this->set( 'setting', 'section_background', get_sub_field( 'section_background', $post ) );

		// Get the custom CSS classes.
		$this->set( 'setting', 'section_classes', get_sub_field( 'other_css_classes', $post ) );

		// Get the section ID.
		$this->set( 'setting', 'section_id', get_sub_field( 'section_id', $post ) );

		// Get the bordered option.
		$this->set( 'setting', 'is_bordered', get_sub_field( 'bordered_blocks', $post ) );

		// Get the equal height option.
		$this->set( 'setting', 'is_equal_height', get_sub_field( 'equal_height', $post ) );

		// Get the fullwidth option.
		$this->set( 'setting', 'is_fullwidth', get_sub_field( 'section_is_fullwidth', $post ) );

	}

	/**
	 * Prepare Grid Class
	 *
	 * Adds grid classes for the different grid column settings that
	 * are returned from the ACF settings field.
	 */
	protected function prepare_grid_class() {

		// Get the grid column setting.
		$grid_columns = $this->get( 'setting', 'grid_columns' );

		// Go through the options and map with the right class.
		switch ( $grid_columns ) {

			case '2' :
				$grid_class = 'col-2';
				break;

			case '3' :
				$grid_class = 'col-3';
				break;

			case '4' :
				$grid_class = 'col-4';
				break;

			case '2-3' :
				$grid_class = 'col-2-3';
				break;

			case '2-3i' :
				$grid_class = 'col-2-3 inverse';
				break;

			default:
				$grid_class = '';
				break;

		}

		// Set the grid class.
		$this->set( 'output', 'grid_cols', $grid_class );

	}

	/**
	 * Prepare Bordered Classes
	 *
	 * If the section should have itself and the block bordered,
	 * this function will add the right class to the section.
	 */
	protected function prepare_bordered() {

		// Get the bordered setting.
		$is_bordered = $this->get( 'setting', 'is_bordered' );

		if ( $is_bordered ) {
			$border_class = 'is-bordered';
		} else {
			$border_class = '';
		}

		// Set the border class.
		$this->set( 'output', 'border', $border_class );

	}

	/**
	 * Prepare Fullwidth
	 *
	 * If the section should span the full width of the page
	 * instead of being contained in the wrapper we need to
	 * add a class to the element for this. This class is
	 * what this function prepares.
	 */
	protected function prepare_fullwidth() {

		// Get the bordered setting.
		$is_bordered = $this->get( 'setting', 'is_fullwidth' );

		if ( $is_bordered ) {
			$border_class = 'is-fullwidth';
		} else {
			$border_class = '';
		}

		// Set the border class.
		$this->set( 'output', 'fullwidth', $border_class );

	}

	/**
	 * Output Section Classes
	 *
	 * Echoes all the section classes for use in an HTML class="" attribute.
	 */
	public function the_section_classes() {

		// Set up the array.
		$section_classes = array();

		// Add the base classes.
		$section_classes[] = 'block-grid';

		// Add evt. border classes.
		$section_classes[] = $this->get( 'output', 'border' );

		// Add evt. grid column classes.
		$section_classes[] = $this->get( 'output', 'grid_cols' );

		// Add evt. background class.
		$section_classes[] = $this->get( 'setting', 'section_background' );

		// Add evt. fullwidth class.
		$section_classes[] = $this->get( 'output', 'fullwidth' );

		// Get Equal Height class.
		$section_classes[] = $this->get( 'output', 'equal_height' );

		// Add evt. other custom classes.
		$section_classes[] = $this->get( 'setting', 'section_classes' );

		// Join together to a class string.
		$section_class_string = join( ' ', $section_classes );

		echo esc_attr( $section_class_string );

	}

	/**
	 * The Section ID
	 *
	 * Outputs the ID tag for the section.
	 */
	public function the_section_id() {

		// Get the ID.
		$section_id = $this->get( 'setting', 'section_id' );

		// Prepare the HTML Output.
		$id = 'id="' . $section_id . '"';

		echo wp_kses_post( $id );

	}

	/**
	 * Equal Height
	 */
	public function prepare_equal_height() {

		// Get the bordered setting.
		$is_equal_height = $this->get( 'setting', 'is_equal_height' );

		if ( $is_equal_height ) {
			$equal_height_class = 'is-equal-height';
		} else {
			$equal_height_class = '';
		}

		// Set the border class.
		$this->set( 'output', 'equal_height', $equal_height_class );

	}

	/**
	 * Save value to class options array.
	 *
	 * @param string $type  Settings Type.
	 * @param string $key   Option Name.
	 * @param string $value Option Value.
	 */
	protected function set( $type = 'setting', $key, $value ) {

		switch ( $type ) {

			case 'setting':
				$this->settings[ $key ] = $value;
				break;

			case 'output':
				$this->output_args[ $key ] = $value;
				break;

			default:
				break;

		}

	}

	/**
	 * Get Setting(s)
	 *
	 * Retrieve a specific setting, or the full list of settings
	 * from the internal class array.
	 *
	 * @param string $type Settings Type.
	 * @param bool   $key  Option Name.
	 *
	 * @return array|mixed
	 */
	protected function get( $type = 'setting', $key = false ) {

		switch ( $type ) {

			case 'setting':
				if ( $key ) {
					$value = $this->settings[ $key ];
				} else {
					$value = $this->settings;
				}

				break;

			case 'output':
				if ( $key ) {
					$value = $this->output_args[ $key ];
				} else {
					$value = $this->output_args;
				}
				break;

			default:
				$value = '';
				break;

		}

		return $value;

	}

	/**
	 * Block Classes
	 *
	 * Outputs a sanitized string of classes for the individual block,
	 * after walking through the settings and putting together
	 * all of the different classes.
	 *
	 * @param  object|bool $post WP Post Object (optional).
	 */
	public function the_block_classes( $post = false ) {

		if ( ! $post ) {
			global $post;
		}

		// Set up the array.
		$block_classes = array();

		// Add the base classes.
		$block_classes[] = 'block';

		// Add the block type class.
		$block_classes[] = $this->get_block_type_class( $post );

		// Add the background class.
		$block_classes[] = $this->get_block_background_class( $post );

		// Add the other block classes.
		$block_classes[] = $this->get_block_other_classes( $post );

		// Join together to a class string.
		$block_class_string = join( ' ', $block_classes );

		echo esc_attr( $block_class_string );

	}

	/**
	 * Get Block Type Class
	 *
	 * Gets the block type class from the ACF settings
	 * field used for the block.
	 *
	 * @param object $post WP Post Object.
	 *
	 * @return string
	 */
	protected function get_block_type_class( $post ) {

		// Get block type setting.
		$block_type = get_sub_field( 'block_type', $post );

		// Set block type class.
		if ( 'image' === $block_type ) {
			return 'is-image';
		} else {
			return 'is-text';
		}

	}

	/**
	 * Check Image Block
	 *
	 * Checks if the block we are currently in is an image block or not.
	 * The negative of this can, of course, be used to check for a text block.
	 *
	 * @param  object|bool $post WP Post Object (optional).
	 *
	 * @return bool true/false
	 */
	public function is_image_block( $post = false ) {

		if ( ! $post ) {
			global $post;
		}

		// Get block type setting.
		$block_type = get_sub_field( 'block_type', $post );

		if ( 'image' === $block_type ) {
			return true;
		}

		return false;

	}

	/**
	 * Get Block Background Class
	 *
	 * Retrieves the background class for the block
	 * from the ACF settings field.
	 *
	 * @param object $post WP Post Object.
	 *
	 * @return string
	 */
	protected function get_block_background_class( $post ) {

		// Get the background setting.
		$background = get_sub_field( 'block_background', $post );

		return $background;

	}

	/**
	 * Get Other Block Classes
	 *
	 * Gets the values for the other CSS classes
	 * as defined in the block settings via its
	 * proper ACF field.
	 *
	 * @param object $post WP Post Object.
	 *
	 * @return string
	 */
	protected function get_block_other_classes( $post ) {

		// Get the other classes from settings.
		$other_classes = get_sub_field( 'block_css_classes', $post );

		return $other_classes;

	}

	/**
	 * Get Block Image Object
	 *
	 * Gets the image object from the ACF setting for the
	 * block image (used only for image types).
	 *
	 * @param object $post WP Post Object.
	 *
	 * @return string
	 */
	protected function get_block_image_object( $post ) {

		// Get the block image.
		$image = get_sub_field( 'block_image', $post );

		return $image;

	}

	/**
	 * Block Image
	 *
	 * Outputs the block image styles for the block opening
	 * tag in HTML. It is created as a background image.
	 *
	 * @param object|bool $post WP Post Object (optional).
	 */
	public function the_block_image( $post = false ) {

		// We'll use the explicit post object given to the function if we need to.
		// But if it is not specificed, we use the global one and assume that
		// we are indeed in the loop.
		if ( ! $post ) {
			global $post;
		}

		if ( ! $this->is_image_block( $post ) ) {
			echo '';
			return;
		}

		// Get the block image.
		$image = $this->get_block_image_object( $post );

		if ( $image ) {

			// Get the image URL.
			$image_url = esc_url( $image['sizes']['large'] );

			$output = 'style="background-image: url(\'' . $image_url . '\');"';

		} else {
			$output = '';
		}

		echo wp_kses_post( $output );

	}

	/**
	 * Check Link Block
	 *
	 * Checks if the block in question is a link block,
	 * in which case we might want to do some other things
	 * in the block code, such as you know...actually
	 * making the block a link!
	 *
	 * @param  object|bool $post WP Post Object (optional).
	 *
	 * @return bool true/false
	 */
	public function is_link_block( $post = false ) {

		if ( ! $post ) {
			global $post;
		}

		// Get block type setting.
		$is_link = get_sub_field( 'block_is_link', $post );

		if ( $is_link ) {
			return true;
		}

		return false;

	}

	/**
	 * The Block Tag
	 *
	 * If we have a block that should be a complete
	 * clickable link, we want to echo the <a> tag instead
	 * of a div. This function checks for this, and
	 * echos the tag we want, depending on the tag position.
	 *
	 * @param string $position Opening|closing.
	 * @param bool   $post     WP Post Object (optional).
	 */
	public function the_block_tag( $position, $post = false ) {

		if ( ! $post ) {
			global $post;
		}

		if ( $this->is_link_block( $post ) ) {

			// Get the block link.
			$link = get_sub_field( 'block_link', $post );

			if ( ! empty( $link ) ) {

				// Set the starting tag.
				$starting = 'a href="' . $link . '"';

				// Set the closing tag.
				$closing = 'a';

			} else {

				// Set the starting tag.
				$starting = 'a href="#"';

				// Set the closing tag.
				$closing = 'a';

			}
		} else {

			// Set the starting tag.
			$starting = 'div';

			// Set the closing tag.
			$closing = 'div';

		}

		// If we want the closing position, echo it.
		if ( 'closing' === $position ) {
			echo esc_attr( $closing );
		}

		// If we want the opening position, echo it.
		if ( 'opening' === $position ) {
			echo esc_attr( $starting );
		}

	}
}