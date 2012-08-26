<?php
/**
 * Content Template for Single Posts
 *
 * @since Ilmenite Framework 1.1
 * @author XLD Studios
 * @version 1.0
 * @package Ilmenite Framework
 **/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="post-title"><?php the_title(); ?></h1>
	
	<ul class="post-meta">
		<li>Posted by <?php the_author(); ?> on <?php the_time('F j, Y'); ?></li>
		<li><?php the_category(' / '); ?></li>
		<li>
		<?php
			comments_popup_link( __('No Comments', 'TEXTDOMAINTHEMENAME'), __('1 Comment', 'TEXTDOMAINTHEMENAME'), __('% Comments', 'TEXTDOMAINTHEMENAME'), 'comments-link', __('Comments Closed', 'TEXTDOMAINTHEMENAME') );
		?>
		</li>
	</ul>
	
	<div class="post-body">
		<?php the_content( __('Continue Reading &raquo;', 'TEXTDOMAINTHEMENAME') ); ?>
	</div>

</article>