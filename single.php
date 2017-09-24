<?php
/**
 * Displays Single Post
 **/
namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main" role="main">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-item' ); ?>>

				<h1 class="post-title"><?php the_title(); ?></h1>

				<div class="post-body">
					<?php the_content(); ?>
				</div>

			</article>

			<?php comments_template(); ?>

		<?php endwhile; ?>

	<?php else : ?>

		<h1><?php esc_html_e( 'Content Not Found', 'THEMETEXTDOMAIN' ); ?></h1>
		<p class="intro"><?php esc_html_e( 'Unfortunately there is no content to display for this view.', 'THEMETEXTDOMAIN' ); ?></p>

	<?php endif; ?>

	<?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
