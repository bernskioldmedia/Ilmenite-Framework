<?php
/**
 * Template Name: Fullwidth
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

_x( 'Fullwidth', 'fullwidth page template name', 'THEMETEXTDOMAIN' );

get_header(); ?>

<main class="main main-fullwidth" role="main" id="content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
