<?php
/**
 * Displays Post Index Page
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-index" role="main" id="content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'components/post/content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php Template_Functions::pagination(); ?>

	<?php else : ?>

		<h1><?php esc_html_e( 'Content Not Found', 'THEMETEXTDOMAIN' ); ?></h1>
		<p class="intro"><?php esc_html_e( 'Unfortunately there is no content to display for this view.', 'THEMETEXTDOMAIN' ); ?></p>

	<?php endif; ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
