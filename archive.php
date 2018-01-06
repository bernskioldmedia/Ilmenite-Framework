<?php
/**
 * Template for displaying the post archives
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main" role="main" id="content">

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title archives-title">
			<?php if ( is_day() ) : ?>
				<?php
				/* translators: 1. Date */
				printf( esc_html__( 'Daily Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php
				/* translators: Month and Year */
				printf( esc_html__( 'Monthly Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php
				/* translators: Year */
				printf( esc_html__( 'Yearly Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
			<?php else : ?>
				<?php esc_html_e( 'Blog Archives', 'THEMETEXTDOMAIN' ); ?>
			<?php endif; ?>
		</h1>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'components/post/content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php Template_Functions::pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'components/not-found' ); ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
