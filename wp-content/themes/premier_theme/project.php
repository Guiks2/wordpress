<?php 
/*
Template Name: Projets
*/
				get_header();
				echo '<div id="all">';
				get_sidebar(); 
				echo '<div id="content">';
	
	// Création des tables si elles n'existent pas
	$sql="CREATE TABLE IF NOT EXISTS upload_file (
		  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
		  `upload_code` varchar(50) NOT NULL,
		  `upload_filesize` int(11) NOT NULL,
		  `upload_name` varchar(255) NOT NULL,
		  `upload_title` varchar(255) NOT NULL,
		  `upload_description` varchar(1024) DEFAULT NULL,
		  `upload_date` date NOT NULL,
		  `upload_id_category` int(11) NOT NULL,
		  `upload_id_owner` int(11) NOT NULL,
		  `upload_isPending` tinyint(1) NOT NULL,
		  PRIMARY KEY (`upload_id`),
		  KEY `upload_id` (`upload_id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;	
		CREATE TABLE IF NOT EXISTS upload_category (
		  `upload_category_id` int(11) NOT NULL AUTO_INCREMENT,
		  `upload_category_name` varchar(255) NOT NULL,
		  PRIMARY KEY (`upload_category_id`),
		  KEY `upload_category_id` (`upload_category_id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
		INSERT INTO upload_category (`upload_category_id`, `upload_category_name`) VALUES (1, 'Modélisation'), (2, 'Développement Jeux'), (3, 'Logiciels'), (4, 'Autres');";
	
	$request = $wpdb->get_results($sql);
	
	
	// Liste des catéories de projets
    $sql2 = 'SELECT * FROM upload_category ';
    $category = $wpdb->get_results($sql2);
	
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

    $sql = "INSERT INTO upload_file(upload_code, upload_filesize, upload_name, upload_title, upload_description, upload_date, upload_id_owner, upload_isPending, upload_id_category)".
    " VALUES ('".$nom."', '".$_FILES['fichier']['size']."', '".$_FILES['fichier']['name']."', '".$_POST['titre']."', '".$_POST['description']."', CURDATE(), '".get_current_user_id()."', true, '".$_POST['categorie']."');";
    $wpdb->query($sql);
} else if ($_FILES['fichier']['error'] == 2 || $_FILES['fichier']['error'] == 1){
	echo('Le fichier est trop gros.');
}

/*
 * Fonction de gestion des fichiers en attente
 */
if(isset($_POST['update'])){
	$sql = 'UPDATE upload_file '.
	    'SET upload_isPending = 0 '.
	    'WHERE upload_id = '.$_POST['file'];
    $res = $wpdb->get_results($sql);
}
if(isset($_POST['delete'])){
	$sql = 'DELETE FROM upload_file '.
	    'WHERE upload_id = '.$_POST['file'];
    $res = $wpdb->get_results($sql);
}
?>

<?php 	echo '<h1>';
		the_title();
		echo '</h1>'; ?>
<div id="upload-zone">
    <form method="post" enctype="multipart/form-data" action="<?php the_permalink(); ?>">
         <label for="fichier">Fichier :</label><br />
         <input type="hidden" name="MAX_FILE_SIZE" value="100048576" />
         <input type="file" name="fichier" id="fichier" /><br />
         <label for="titre">Titre du fichier :</label><br />
         <input type="text" name="titre" value="Titre du fichier" id="titre" /><br />
         <label for="description">Description du fichier :</label><br />
         <textarea name="description" id="description"></textarea><br />
         <label for="categorie">Catégorie du fichier :</label><br />
         <select name="categorie" id="categorie">
            <?php
                $j=0;
                while(isset($category[$j])){
                    echo '<option value="'.$category[$j]->upload_category_id.'">'.$category[$j]->upload_category_name.'</option>';
                    $j++;
                }
            ?>
         </select><br />
         <input type="submit" name="submit" value="Envoyer" />
    </form>
</div>

<div id="uploaded-files">
<?php
       
	// Liste des fichiers en attentes (uniquement pour l'admin)
	if(current_user_can('manage_options')) {
		$sql = 'SELECT * '.
	    'FROM upload_file '.
	    'WHERE upload_isPending = 1';
	    $pending_files = $wpdb->get_results($sql);
		
		echo '<h2>Fichiers en attente</h2><br/>';
		$i=0;
	    while(isset($pending_files[$i])){
			echo '<form method="post" enctype="multipart/form-data" action="';
			echo the_permalink();
			echo '">';
		        echo('<a download="'.$pending_files[$i]->upload_name.'" href="wp-content/themes/premier_theme/upload/'.$pending_files[$i]->upload_code.'">'.$pending_files[$i]->upload_title.' | '.$pending_files[$i]->upload_name .'</a>'.
	     			'<input type="hidden" name="file" value="'.$pending_files[$i]->upload_id.'" />'.
	     			'<input type="submit" name="delete" value="-" />'.
	     			'<input type="submit" name="update" value="+" />'.
		        	'<br/>');
		        $i++;
			echo '</form>';
	    }
	}
	
	$j=0;
	echo '<h2>Fichiers uploadés</h2><br/>';
	while(isset($category[$j])){
 
	 	// Liste des fichiers upload qui ne sont plus en attente
	    $sql3 = 'SELECT * '.
	    'FROM upload_file '.
	    'WHERE upload_id_category='.$category[$j]->upload_category_id.' AND upload_isPending = 0';
	    $files = $wpdb->get_results($sql3);
		
		if(!empty($files)){
			echo '<h3>'.$category[$j]->upload_category_name.'</h3><br/>';
		    $i=0;
		    while(isset($files[$i])){
		        echo('<a download="'.$files[$i]->upload_name.'" href="wp-content/themes/premier_theme/upload/'.$files[$i]->upload_code.'">'.$files[$i]->upload_title.'</a><br/>');
		        $i++;
		    }
	    }
	    $j++;
    }
?>
		</div>
        
        <?php
			echo '</div></div>';
					get_footer();
		?>
	</body>
</html>