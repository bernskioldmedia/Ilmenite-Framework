<?php
/**
 * 404 Page
 *
 * This template controls the WordPress 404 page that is
 * displayed when content cannot be found.
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-error" role="main" id="content">

	<section class=section" id="section-error-page">

		<h1 class="page-title error-title"><?php esc_html_e( 'Content Cannot Be Found', 'THEMETEXTDOMAIN' ); ?></h1>

		<div class="page-body error-body">

			<p><?php esc_html_e( 'Unfortunately the content you were looking for could not be found. Please check that the URL is correct or do a search using the form below.', 'THEMETEXTDOMAIN' ); ?></p>

			<?php get_search_form(); ?>

		</div>

	</section>

</main>

<?php get_footer(); ?>
