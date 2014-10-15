<?php

// Menu
add_action('init', 'theme_menu') ;
function theme_menu() {
	register_nav_menu('main_menu', 'Menu principal');
}

// logo d'en-tête personnalisable
add_theme_support('custom_header') ;
function theme_sidebars() {
	register_sidebar(array(
		'id' => 'zone_widget_gauche',
		'name' => 'Zone latérale gauche',
		'description' => 'Description',
		'before_widget' => '<aside>',
		'after_widget' =>'</aside>',
		'before_title' => '<h1>',
		'after_tile' => '</h1>'
	));
}

// Mot de passe perdu
add_filter( 'login_form_bottom', 'lien_mot_de_passe_perdu' );
function lien_mot_de_passe_perdu( $formbottom ) {
	$formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu ?</a>';
	return $formbottom;
}
?>