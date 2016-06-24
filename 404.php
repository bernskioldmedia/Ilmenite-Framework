<?php
/**
 * Template for the 404 page
 **/
namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main" role="main">

	<section id="error-404-page">

		<h1 class="page-title"><?php esc_html_e( 'Content Cannot Be Found', 'THEMETEXTDOMAIN' ); ?></h1>

	    <div class="page-content">

	    	<p><?php esc_html_e( 'Unfortunately the content you were looking for could not be found. Please check that the URL is correct or do a search using the form below.', 'THEMETEXTDOMAIN' ); ?></p>
	    	<?php get_search_form(); ?>

	    </div>

	</section>

</main>

<?php get_footer(); ?>
