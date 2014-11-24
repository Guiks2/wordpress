<?php 
/*
Template Name: Projets
*/
				get_header();
				echo '<div id="all">';
				get_sidebar(); 
				echo '<div id="content">';

/*
 * Fonction d'upload
 * Ajouter une vérif sur la taille du fichier et sur l'extension
 * Ajouter une vérif sur l'uploader (ou pas, le blocage des droits de la page devrait suffire)
 */
 
if (isset($_FILES['fichier']) AND $_FILES['fichier']['error'] == 0)
{
    $nom = md5(uniqid(rand(), true));;
    $resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],"wp-content/themes/premier_theme/upload/".$nom);
    if ($resultat) echo "Transfert réussi";

    $sql = "INSERT INTO upload_file(upload_code, upload_filesize, upload_name, upload_title, upload_description, upload_date, upload_id_owner, upload_isPending)".
    " VALUES ('".$nom."', '".$_FILES['fichier']['size']."', '".$_FILES['fichier']['name']."', '".$_POST['titre']."', '".$_POST['description']."', CURDATE(), '".get_current_user_id()."', true);";
    $wpdb->query($sql);
} else if ($_FILES['fichier']['error'] == 2 || $_FILES['fichier']['error'] == 1){
	echo('Le fichier est trop gros.');
}

?>
<form method="post" enctype="multipart/form-data" action="<?php the_permalink(); ?>">
     <label for="fichier">Fichier :</label><br />
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input type="file" name="fichier" id="fichier" /><br />
     <label for="titre">Titre du fichier :</label><br />
     <input type="text" name="titre" value="Titre du fichier" id="titre" /><br />
     <label for="description">Description du fichier :</label><br />
     <textarea name="description" id="description"></textarea><br />
     <input type="submit" name="submit" value="Envoyer" />
</form>
 
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
				echo '</div></div>';
				get_footer();
?>
		</div>
	</body>
</html>