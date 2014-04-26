<?php
/**
 * Content Template for Pages
 **/
?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="page-title"><?php the_title(); ?></h1>

	<div class="page-body">
		<?php the_content(); ?>
	</div>

</article>