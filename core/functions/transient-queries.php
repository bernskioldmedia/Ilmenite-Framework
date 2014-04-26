<?php
/**
 * Transient Queries
 *
 * These queries are saved to transients, ie. are cached
 * for a given number of seconds to increase performance.
 *
 * Queries in here are used throughout the various
 * parts of the site.
 */

if ( ! function_exists( 'ilmenite_clean_post_transients' ) ) :

	/**
	 *	Delete Post Query Transients
	 *
	 * Delete the post query transients when a new post is published.
	 */
	function ilmenite_clean_post_transients( $post_id ) {

		$post_type = get_post_type( $post_id );

		// Add support here for deleting transients on publish action
		// Also uncomment add_action just below.

	}

	// add_action( 'publish_post', 'ilmenite_clean_post_transients' );

endif;

if ( ! function_exists( 'ilmenite_get_transient_query' ) ) :

	/**
	 * Transients Query Function
	 *
	 * General function that saves a query as a transient.
	 *
	 * @param  string $transient_name The name of the transient that will be saved.
	 * @param  array  $query_args     The arguments for the custom query.
	 * @param  int 	$transient_time A time for how long the data should be cached.
	 */
	function ilmenite_get_transient_query( $transient_name, $query_args, $transient_time = HOUR_IN_SECONDS ) {

		// Get the transient
		$results = get_transient( $transient_name );

		// If the transient doesn't exist, set it
		if ( false === $results ) {

			// Create the query
			$results = new WP_Query( $query_args );

			if ( $transient_time ) {

				// Save the query to a transient with expiration time
				set_transient( $transient_name, $results, $transient_time );

			} else {

				// Save the query to a transient that doesn't have an expiration time
				// In this case, we clean with action hooks.
				set_transient( $transient_name, $results );

			}

		}

		// Return the query
		return $results;

	}

endif;

if ( ! function_exists( 'ilmenite_get_transient_posts' ) ) :

	/**
	 * Transients Get Posts Function
	 *
	 * General function that saves a get_posts call as a transient.
	 *
	 * @param  string $transient_name The name of the transient that will be saved.
	 * @param  array  $query_args     The arguments for the custom query.
	 * @param  int 	$transient_time A time for how long the data should be cached.
	 */
	function ilmenite_get_transient_posts( $transient_name, $query_args, $transient_time = HOUR_IN_SECONDS ) {

		// Get the transient
		$results = get_transient( $transient_name );

		// If the transient doesn't exist, set it
		if ( false === $results ) {

			// Create the query
			$results = get_posts( $query_args );

			// Save the query to a transient
			set_transient( $transient_name, $results, $transient_time );

		}

		// Return the query
		return $results;

	}

endif;

if ( ! function_exists( 'ilmenite_get_transient_terms' ) ) :

	function ilmenite_get_transient_terms( $transient_name, $taxonomy_name, $taxonomy_args = '', $transient_time = HOUR_IN_SECONDS ) {

		// Get the transient
		$results = get_transient( $transient_name );

		// If the transient doesn't exist, set it
		if ( false === $results ) {

			// Get the terms
			$results = get_terms( $taxonomy_name, $taxonomy_args );

			// Save the terms to a transient
			set_transient( $transient_name, $results, $transient_time );

		}

		return $results;

	}

endif;