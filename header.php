<?php
/**
 * Outputs Site Header
 *
 * @since Ilmenite Framework 1.0
 * @author XLD Studios
 * @version 1.1
 * @package Ilmenite Framework
 **/
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Set correct charset  -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
		<!-- Include modernizr script -->
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/modernizr.js"></script>
		
		<!-- Page Title  -->
		<title><?php wp_title(''); ?></title>
		
		<?php wp_head(); ?>
		
	</head>
	<body <?php body_class(); ?>>
				
		<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'container' => 'nav', 'container_id' => 'primary-navigation')); ?>