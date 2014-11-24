			<?php 
/*
Template Name: Edition profil
*/
				get_header();
				echo '<div id="all">';
				get_sidebar(); 
				echo '<div id="content">';
				echo do_shortcode( '[wp-members page="user-edit"]');
				echo '</div></div>';
				get_footer();
			?>
		</div>
	</body>
</html>