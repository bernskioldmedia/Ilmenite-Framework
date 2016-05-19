<?php
/**
 * Content Template for Single Posts
 **/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="post-title"><?php the_title(); ?></h1>

	<ul class="post-meta">
		<li>Posted by <?php the_author(); ?> on <?php the_time('F j, Y'); ?></li>
		<li><?php the_category(' / '); ?></li>
		<li>
		<?php
			comments_popup_link( __('No Comments', 'THEMETEXTDOMAIN'), __('1 Comment', 'THEMETEXTDOMAIN'), __('% Comments', 'THEMETEXTDOMAIN'), 'comments-link', __('Comments Closed', 'THEMETEXTDOMAIN') );
		?>
		</li>
	</ul>

	<div class="post-body">
		<?php the_content( __('Continue Reading &raquo;', 'THEMETEXTDOMAIN') ); ?>
	</div>

</article>