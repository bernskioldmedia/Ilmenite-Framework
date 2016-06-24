<?php
/**
 * Template for the Category Archives
 **/

get_header(); ?>

<main class="main" role="main">

	<?php if ( have_posts() ) : ?>

		<h1 class="page-title category-title">
			<?php single_cat_title( '' ); ?>
		</h1>

		<?php
			$cat_description = category_description();

			if ( ! empty( $cat_description ) )
				echo apply_filters( 'cat_archive_meta', '<div class="page-description category-description">' . $cat_description . '</div>' );
		?>

    	<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php theme()->template->pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'content', '404' ); // Streamline and get the 404 content from a unified file. ?>

	<?php endif; ?>

	<?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
