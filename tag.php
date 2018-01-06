<?php
/**
 * Displays Tag Archives
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;

get_header(); ?>

<main class="main main-tag" role="main" id="content">

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title tag-title">
			<?php single_tag_title( '' ); ?>
		</h1>

		<?php
		$tag_description = tag_description();
		if ( ! empty( $tag_description ) ) {
			echo wp_kses( apply_filters( 'tag_archive_meta', '<div class="page-description tag-description">' . $tag_description . '</div>' ), array(
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
