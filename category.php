<?php
/**
 * Template for the Category Archives
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-category" role="main" id="content">

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title category-title">
			<?php single_cat_title( '' ); ?>
		</h1>

		<?php
		$cat_description = category_description();

		if ( ! empty( $cat_description ) ) {
			echo wp_kses( apply_filters( 'cat_archive_meta', '<div class="page-description category-description">' . $cat_description . '</div>' ), array(
				'div' => array(
					'class',
				),
			) );
		}
		?>

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
