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

// Formulaire d'inscription
function register_user_form() {
	echo '<form action="' . admin_url( 'admin-post.php?action=nouvel_utilisateur' ) . '" method="post" id="register-user">'.
		// Les champs requis
		'<p><label for="nom-user">Nom</label><input type="text" name="username" id="nom-user" required></p>'.
		'<p><label for="email-user">Email</label><input type="email" name="email" id="email-user" required></p>'.
		'<p><label for="pass-user">Mot de passe</label><input type="password" name="pass" id="pass-user" required><br>'.
		'<input type="checkbox" id="show-password"><label for="show-password">Voir le mot de passe</label></p>'.
	
		//Validation
		'<input type="submit" value="Créer mon compte">'.
	'</form>';


}

// Enregistrement de l'utilisateur
add_action( 'admin_post_nopriv_nouvel_utilisateur', 'ajouter_utilisateur' );
function ajouter_utilisateur() {
	// Vérifier le nonce (et n'exécuter l'action que s'il est valide)
	if( isset( $_POST['user-front'] ) && wp_verify_nonce( $_POST['user-front'], 'create-' . $_SERVER['REMOTE_ADDR'] ) ) {

		// Vérifier les champs requis
		if ( ! isset( $_POST['username'] ) || ! isset( $_POST['email'] ) || ! isset( $_POST['pass'] ) ) {
			wp_redirect( site_url( '/inscription/?message=not-user' ) );
			exit();
		}
		
		$nom = $_POST['username'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		// Vérifier que l'user (email ou nom) n'existe pas
		if ( is_email( $email ) && ! username_exists( $nom )  && ! email_exists( $email ) ) {
			// Création de l'utilisateur
	        $user_id = wp_create_user( $nom, $pass, $email );
	        $user = new WP_User( $user_id );
	        // On lui attribue un rôle
	        $user->set_role( 'subscriber' );
	        // Envoie un mail de notification au nouvel utilisateur
	        wp_new_user_notification( $user_id, $pass );
	    } else {
	    	wp_redirect( site_url( '/inscription/?message=already-registered' ) );
			exit();
	    }

		// Connecter automatiquement le nouvel utilisateur
	    $creds = array();
		$creds['user_login'] = $nom;
		$creds['user_password'] = $pass;
		$creds['remember'] = false;
		$user = wp_signon( $creds, false );

		// Redirection
		wp_redirect( site_url( '/?message=welcome' ) );
		exit();
	}
}

// Il faut register les scripts que notre formualire utilise
add_action( 'wp_enqueue_scripts', 'register_login_script' );
function register_login_script() {
	wp_register_script( 'inscription-front', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'message', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jquery' );

	// Ce script sera chargé sur toutes les pages du site, afin d'afficher les messages d'erreur
	wp_enqueue_script( 'message' );
}

add_action( 'wp_footer', 'show_user_registration_message' );
function show_user_registration_message() {
	if ( isset( $_GET['message'] ) ) {
		$wrapper = '<div class="message">%s</div>';
		switch ( $_GET['message'] ) {
			case 'already-registred':
				echo wp_sprintf( $wrapper, 'Un utilisateur possède la même adresse.' );
				break;
			case 'not-user':
				echo wp_sprintf( $wrapper, 'Votre inscription a échouée.' );
				break;
			case 'user-updated':
				echo wp_sprintf( $wrapper, 'Votre profil a été mis à jour.' );
				break;
			case 'need-email':
				echo wp_sprintf( $wrapper, 'Votre profil \'a pas été mis à jour. L\'email doit être renseignée.' );
				break;
			case 'email-exist':
				echo wp_sprintf( $wrapper, 'Votre profil \'a pas été mis à jour. L\'adresse email est déjà utilisée.' );
				break;
			case 'welcome':
				echo wp_sprintf( $wrapper, 'Votre compte a été créé. Vous allez recevoir un email de confirmation.' );
				break;
			default :
		}
	}
}

//interdire l'accès aux non admins
add_action( 'current_screen', 'redirect_non_authorized_user' );
function redirect_non_authorized_user() {
	// Si t'es pas admin, tu vires
	if ( is_user_logged_in() && ! current_user_can( 'manage_options' ) ) {
		wp_redirect( home_url( '/' ) );
		exit();
	}
}

//édition du profil non admin
function edit_user_form() {
	if ( is_user_logged_in() ) {
		$userdata = get_userdata( get_current_user_id() );
		echo '<form action="' . admin_url( 'admin-post.php?action=update_utilisateur' ) . '" method="post" id="update-utilisateur">'.

		// Pseudo (ne peut pas être changé)
		'<p><label for="pseudo-user">Username</label>'.
		'<input type="text" name="username" id="pseudo-user" value="' . $userdata->user_login . '" disabled></p>'.

		// Nom
		'<p><label for="nom-user">Nom</label>'.
		'<input type="text" name="nom" id="nom-user" value="' . $userdata->last_name . '"></p>'.

		// Prénom
		'<p><label for="prenom-user">Prénom</label>'.
		'<input type="text" name="prenom" id="prenom-user" value="' . $userdata->first_name . '"></p>'.

		// Nom d'affichage
		'<p><label for="display_name-user">Nom d\'affichage</label>'.
		'<input type="text" name="display_name" id="display_name-user" value="' . $userdata->display_name . '" required></p>'.

		// Biographie
		'<p><label for="nom-user">Description</label>'.
		'<textarea name="bio" id="bio-user">' . $userdata->user_description . '</textarea></p>'.
		
		// Site
		'<p><label for="site-user">Site web</label>'.
		'<input type="text" name="site" id="site-user" value="' . $userdata->user_url . '"></p>'.

		// Email
		'<p><label for="email-user">Email</label>'.
		'<input type="email" name="email" id="email-user" value="' . $userdata->user_email . '" required></p>'.

		// Mot de passe (Mis à jour uniquement si présent)
		'<p><label for="pass-user">Mot de passe</label>'.
		'<input type="password" name="pass" id="pass-user"><br>'.
		'<input type="checkbox" id="show-password"><label for="show-password">Voir le mot de passe</label></p>';

		// Nonce
		wp_nonce_field( 'update-' . get_current_user_id(), 'user-front' );

		//Validation
		echo '<input type="submit" value="Mettre à jour">'.
		'</form>';

		// Enqueue de scripts qui vont nous permettre de vérifier les champs
		wp_enqueue_script( 'inscription-front' );
	}
}

// Enregistrement de l'utilisateur
add_action( 'admin_post_update_utilisateur', 'update_utilisateur' );
function update_utilisateur() {
	// Vérifier le nonce
	if( isset( $_POST['user-front'] ) && wp_verify_nonce( $_POST['user-front'], 'update-' . get_current_user_id() ) ) {

		// Vérifier les champs requis
		if ( ! isset( $_POST['email'] ) || ! is_email( $_POST['email'] ) ) {
			wp_redirect( site_url( '/profile/?message=need-email' ) );
			exit();
		}

		// Si l'email change, alors on vérfie qu'elle n'est pas déjà utilisée
		if ( ( $emailuser = email_exists( $_POST['email'] ) ) && get_current_user_id() != $emailuser ) {
			wp_redirect( site_url( '/profile/?message=email-exist' ) );
			exit();
		}

		// Nouvelles valeurs
		$userdata = array(
		    'id' => get_current_user_id(),
			'first_name' => sanitize_text_field( $_POST['prenom'] ),
			'last_name' => sanitize_text_field( $_POST['nom'] ),
			'display_name' => sanitize_text_field( $_POST['display_name'] ),
			'description' => esc_textarea( $_POST['bio'] ),
			'user_email' => sanitize_email( $_POST['email'] ),
			'user_url' => sanitize_url( $_POST['url'] ),
		);

		// On ne met à jour le mot de passe que si un nouveau à été renseigné
		if ( isset( $_POST['pass'] ) && ! empty( $_POST['pass'] ) ) {
			$userdata[ 'user_pass' ] = trim( $_POST['pass'] );
		}

		// Mise à jour de l'utilisateur
		wp_update_user( $userdata );

		// Redirection
		wp_redirect( site_url( '/profile/?message=user-updated' ) );
		exit();
	}
}

?>