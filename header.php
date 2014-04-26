<?php
/**
 * Outputs Site Header
 **/
?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php wp_nav_menu(array(
			'theme_location' => 'primary-menu',
			'container'      => 'nav',
			'container_id'   => 'primary-navigation',
		)); ?>