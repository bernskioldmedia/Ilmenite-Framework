<?php
/**
 * Displays Search Results
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-search" role="main" id="content">

	<?php get_search_form(); ?>

	<h1 class="page-title search-page-title">
		<?php
		/* Translators: 1. Search Query */
		printf( esc_html__( 'Search Results for: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_search_query() . '</span>' ); ?>
	</h1>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'components/post/content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php Template_Functions::pagination(); ?>

	<?php else : ?>

		<div class="not-found">
			<h1 class="page-title not-found-title"><?php esc_html_e( 'No Results Found', 'THEMETEXTDOMAIN' ); ?></h1>

			<p class="not-found-description"><?php esc_html_e( 'Unfortunately we could not find any results for your search. Please try again with another query.', 'THEMETEXTDOMAIN' ); ?></p>
		</div>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
