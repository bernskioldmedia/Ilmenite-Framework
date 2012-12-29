<?php
/**
 * Outputs Site Header
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.2
 * @package Ilmenite Framework
 **/
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
		<!-- Set correct charset  -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

		<!-- Set the viewport width to device width for mobile -->
       		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<!-- Page Title  -->
		<title><?php wp_title(''); ?></title>
		
		<?php wp_head(); ?>
		
	</head>
	<body <?php body_class(); ?>>
				
		<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => 'nav', 'container_id' => 'primary-navigation')); ?>