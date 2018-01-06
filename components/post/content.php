<?php
/**
 * Content Template for General Posts
 *
 * @package BernskioldMedia\ClientName\Theme
 **/

namespace BernskioldMedia\ClientName\Theme;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>

	<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<div class="post-body">
		<?php the_content(); ?>
	</div>

</article>
