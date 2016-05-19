<?php
/**
 * Transient Queries
 *
 * These queries are saved to transients, ie. are cached
 * for a given number of seconds to increase performance.
 *
 * Queries in here are used throughout the various
 * parts of the site.
 *
 * @package BernskioldMedia\ClientName\Theme
 */
namespace BernskioldMedia\ClientName\Theme;

/**
 * Class Transient_Queries
 *
 * @package BernskioldMedia\ClientName\Theme
 */
class Transient_Queries {

	/**
	 * Class Transient_Queries Constructor
	 */
	public function __construct() {

		// Hook the cleaning to save post.
		// add_action( 'save_post', array( $this, 'cleaning' ) );

	}

	/**
	 * Run Cleaning Functions for the Transient Queries
	 *
	 * The funciton is hooked to save post in the constructor above.
	 */
	public function cleaning() {

	}

	/**
	 * Transients Query Function
	 *
	 * General function that saves a query as a transient.
	 *
	 * @param  string $transient_name The name of the transient that will be saved.
	 * @param  array  $query_args     The arguments for the custom query.
	 * @param  int 	$transient_time A time for how long the data should be cached.
	 */
	public function get_query( $transient_name, $query_args, $transient_time = HOUR_IN_SECONDS ) {

		// Get the transient.
		$results = get_transient( $transient_name );

		// If the transient doesn't exist, set it.
		if ( false === $results ) {

			// Create the query.
			$results = new \WP_Query( $query_args );

			if ( $transient_time ) {

				// Save the query to a transient with expiration time.
				set_transient( $transient_name, $results, $transient_time );

			} else {

				// Save the query to a transient that doesn't have an expiration time
				// In this case, we clean with action hooks.
				set_transient( $transient_name, $results );

			}

		}

		// Return the query.
		return $results;

	}

	function get_terms( $transient_name, $taxonomy_name, $taxonomy_args = '', $transient_time = HOUR_IN_SECONDS ) {

		// Get the transient.
		$results = get_transient( $transient_name );

		// If the transient doesn't exist, set it.
		if ( false === $results ) {

			// Get the terms.
			$results = get_terms( $taxonomy_name, $taxonomy_args );

			// Save the terms to a transient.
			set_transient( $transient_name, $results, $transient_time );

		}

		return $results;

	}
}
