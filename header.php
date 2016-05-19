<?php
/**
 * Outputs Site Header
 **/
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'THEMETEXTDOMAIN' ); ?></a>

		<?php wp_nav_menu(array(
			'theme_location' 	=> 'primary-menu',
			'container'      	=> 'nav',
			'container_class'   => 'primary-navigation',
		)); ?>
