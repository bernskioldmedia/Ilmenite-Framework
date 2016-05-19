<?php
/**
 * Content Template for Single Posts
 **/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-item' ); ?>>

	<h1 class="post-title"><?php the_title(); ?></h1>

	<div class="post-body">
		<?php the_content(); ?>
	</div>

</article>