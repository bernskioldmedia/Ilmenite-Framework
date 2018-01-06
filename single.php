<?php
/**
 * Displays Single Post
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-single-post" role="main" id="content">

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

		<?php get_template_part( 'components/not-found' ); ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
