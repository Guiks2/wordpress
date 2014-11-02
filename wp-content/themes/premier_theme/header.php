<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
 
	<title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<!-- leave this for stats -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /><?php wp_head(); ?>
 
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
 
</head>
<body>
	
	<?php
	// Formulaire de connexion
	if ( ! is_user_logged_in() ) {
		wp_login_form( array(
	        'redirect'       => site_url( '/' ), // par défaut renvoie vers la page courante
	        'label_username' => 'Login',
	        'label_password' => 'Mot de passe',
	        'label_remember' => 'Se souvenir de moi',
	        'label_log_in'   => 'Se connecter',
	        'form_id'        => 'login-form',
	        'id_username'    => 'user-login',
	        'id_password'    => 'user-pass',
	        'id_remember'    => 'rememberme',
	        'id_submit'      => 'wp-submit',
	        'remember'       => true, //afficher l'option se souvenir de moi
	        'value_remember' => false //se souvenir par défaut ?
		) );
		
		/* 
		 * Recherche de la page servant à l'inscription
		 * On cherche donc une page avec comme template "inscription.php"
		 */
		$sql = 'SELECT ID '.
		'FROM wp_posts '.
		'INNER JOIN wp_postmeta ON wp_postmeta.post_id=wp_posts.ID '.
		'WHERE wp_postmeta.meta_value="inscription.php" '.
			'AND wp_postmeta.meta_key="_wp_page_template"'; 
		$id_page = $wpdb->get_var($sql);
		
		echo '<input type="submit" class="button-primary" onClick="window.location=\'?page_id='.$id_page.'\'"\'" value="S\'inscrire">';
	} else {
		if (current_user_can( 'manage_options' )){
			echo '<a href="' . admin_url( 'user-edit.php?user_id='. get_current_user_id() ) .'">Accès au profil</a>';
		} else {
			$sql = 'SELECT ID '.
			'FROM wp_posts '.
			'INNER JOIN wp_postmeta ON wp_postmeta.post_id=wp_posts.ID '.
			'WHERE wp_postmeta.meta_value="edit_profil.php" '.
				'AND wp_postmeta.meta_key="_wp_page_template"'; 
			$id_page = $wpdb->get_var($sql);
			
			echo '<a href="?page_id='.$id_page.'">Accès au profil</a>';
		}
		
		echo '<a href="' . wp_logout_url( site_url( '/' ) ) .'">Se déconnecter</a>';
	}
	?>

	<div id="header">
		<h1>
			<a href="<?php bloginfo('url'); ?>">
				<?php bloginfo('name'); ?>
			</a>
		</h1>
		<?php bloginfo('description'); ?>
	</div>
	
	
	<div id="page">

