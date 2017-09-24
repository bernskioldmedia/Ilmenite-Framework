<?php
/**
 * Template for displaying the post archives
 **/
namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main" role="main">

	<?php if ( have_posts() ) : ?>

    	<h1 class="page-title archives-title">
			<?php if ( is_day() ) : ?>
				<?php printf( esc_html__( 'Daily Archives: %s', 'THEMETEXTDOMAIN' ),'<span>' . get_the_date() . '</span>' ); ?>
			<?php elseif ( is_month() ) : ?>
				<?php printf( esc_html__( 'Monthly Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
			<?php elseif ( is_year() ) : ?>
				<?php printf( esc_html__( 'Yearly Archives: %s', 'THEMETEXTDOMAIN' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
			<?php else : ?>
				<?php esc_html_e( 'Blog Archives', 'THEMETEXTDOMAIN' ); ?>
			<?php endif; ?>
		</h1>

    	<?php while ( have_posts() ) : the_post(); ?>

        	<?php get_template_part( 'components/post/content', get_post_format() ); ?>

 		<?php endwhile; ?>

		<?php theme()->template->pagination(); ?>

	<?php else : ?>

		<h1><?php esc_html_e( 'Content Not Found', 'THEMETEXTDOMAIN' ); ?></h1>
		<p class="intro"><?php esc_html_e( 'Unfortunately there is no content to display for this view.', 'THEMETEXTDOMAIN' ); ?></p>

	<?php endif; ?>

	<?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
