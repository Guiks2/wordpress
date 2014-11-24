<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
  
    <title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &raquo; <?php _e('Not Found') ?><?php elseif ( is_home() ) : ?> &raquo; <?php bloginfo('description') ?><?php else : ?><?php wp_title() ?><?php endif ?></title>
 
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
    <!-- leave this for stats -->
    <link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /><?php wp_head(); ?>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_enqueue_script("jquery"); ?> 
	<?php wp_head(); ?>
 	
    <script>
		jQuery(document).ready(function() {
			jQuery('.sidebar #menu div .menu-item > ul').hide();
			jQuery('#menu-button').click(function() {
				jQuery("#hidden-menu").slideToggle(400);
				return false;
			});
			jQuery('li a').click(function(event) {
				event.stopPropagation();
				var url = jQuery(this).attr("href");
				window.location.href = url;
			});
			jQuery('.menu-item').click(function() {
				var ul = jQuery("ul:first", this);
				jQuery(ul).slideToggle(400);
				return false;
			});
		});
	</script>
</head>
<body>
    <div id="header">
    	<div id="hidden-menu">
        	<li id="menu"><?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => 'menu' ) ); ?></li>
        </div>
    	<div id="menu-button"></div>
        <div id="title">
            <h1>
                <a href="<?php bloginfo('url'); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
            <?php bloginfo('description'); ?>
        </div>
        <?php 
        echo do_shortcode( '[wp-members page="login"]');
        if ( is_user_logged_in() ) {
            $sql = 'SELECT ID '.
            'FROM wp_posts '.
            'INNER JOIN wp_postmeta ON wp_postmeta.post_id=wp_posts.ID '.
            'WHERE wp_postmeta.meta_value="edit_profil.php" '.
                'AND wp_postmeta.meta_key="_wp_page_template"'; 
            $id_page = $wpdb->get_var($sql);
             
            echo '<a href="?page_id='.$id_page.'">Accès au profil</a>';
        }
        ?>
    </div>
    <div style="height: 30px;"></div>

<?php
/*
 * Fonction d'upload
 * Ajouter une vérif sur la taille du fichier et sur l'extension
 * Ajouter une vérif sur l'uploader (ou pas, le blocage des droits de la page devrait suffire)
 * Lors de l'ajout dans la BDD, mettre le logiciel en pending
 * Déplacer cette fonction une fois le site crée
 *
if (isset($_FILES['fichier']) AND $_FILES['fichier']['error'] == 0)
{
    $nom = md5(uniqid(rand(), true));;
    $resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],"wp-content/themes/premier_theme/upload/".$nom);
    if ($resultat) echo "Transfert réussi";
     
    /*
     * 
     *
    $sql = "INSERT INTO upload_file(upload_code, upload_filesize, upload_name, upload_title, upload_description, upload_date, upload_id_owner, upload_isPending)".
    " VALUES ('".$nom."', '".$_FILES['fichier']['size']."', '".$_FILES['fichier']['name']."', '".$_POST['titre']."', '".$_POST['description']."', CURDATE(), '".get_current_user_id()."', true);";
    $wpdb->query($sql);
}
*/
?>
<!--<form method="post" enctype="multipart/form-data" action="<?php bloginfo('home'); ?>/">
     <label for="fichier">Fichier :</label><br />
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input type="file" name="fichier" id="fichier" /><br />
     <label for="titre">Titre du fichier :</label><br />
     <input type="text" name="titre" value="Titre du fichier" id="titre" /><br />
     <label for="description">Description du fichier :</label><br />
     <textarea name="description" id="description"></textarea><br />
     <input type="submit" name="submit" value="Envoyer" />
</form>-->
 
<?php
         
    $sql = 'SELECT * '.
    'FROM upload_file '.
    'WHERE upload_id_owner='.get_current_user_id();
    $files = $wpdb->get_results($sql);
 
    $i=0;
    while(isset($files[$i])){
        echo('<a download="'.$files[$i]->upload_name.'" href="wp-content/themes/premier_theme/upload/'.$files[$i]->upload_code.'">'.$files[$i]->upload_title.'</a><br/>');
        $i++;
    }
?>
    <div id="page">

