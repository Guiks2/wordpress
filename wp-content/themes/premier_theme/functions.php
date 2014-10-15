<?php

// Menu
add_action('init', 'theme_menu') ;
function theme_menu() {
	register_nav_menu('main_menu', 'Menu principal');
}

// Sidebars
add_action('widgets_init', 'theme_sidebars') ;
function theme_sidebars() {
	register_sidebar(array(
		'id' => 'zone_widget_gauche',
		'name' => 'Zone latérale gauche',
		'description' => 'Description',
		'before_widget' => '<aside>',
		'after_widget' =>'</aside>',
		'before_title' => '',
		'after_tile' => ''
	));
}
?>