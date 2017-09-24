<?php
/**
 * Displays Search Results
 **/
namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main" role="main">

	<?php get_search_form(); ?>

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title search-page-title">
			<?php printf( esc_html__( 'Search Results for: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'components/post/content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php theme()->template->pagination(); ?>

	<?php else : ?>

		<h1 class="page-title search-page-title"><?php esc_html_e( 'No Reults Found', 'THEMETEXTDOMAIN' ); ?></h1>

		<p><?php esc_html_e( 'Unfortuantely we could not find any results for your search query. Please try again with another query.', 'THEMETEXTDOMAIN' ); ?></p>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
