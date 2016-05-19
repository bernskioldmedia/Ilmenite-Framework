<?php
/**
 * Registers Sidebars
 */
if ( function_exists( 'register_sidebar' ) ) {

	// Sets up a default sidebar.
	register_sidebar( array(
		'id'            => 'sidebar',
		'name'          => esc_html__( 'Sidebar', 'THEMETEXTDOMAIN' ),
		'before_widget' => '<div class="sidebar-block">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="sidebar-block-title">',
		'after_title'   => '</h2>',
	) );

}