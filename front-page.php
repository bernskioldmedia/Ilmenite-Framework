<?php
/**
 * Frontpage Page Template
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-frontpage" role="main" id="content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'components/page/content-page' ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
