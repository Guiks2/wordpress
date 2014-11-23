<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage premier_theme
 * @since premier 1.0_theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div class="notfound">
			<div id="content" class="site-content" role="main">

				<header class="page-header">
					<h1 class="page-title" align="center"><?php _e( 'Oh ! Le petit poro est confus...', 'premier_theme' ); ?></h1>
				</header>

				<div class="page-wrapper">
					<div class="page-content" align="center">
						<img src="http://localhost/wordpress/wordpress/wp-content/themes/premier_theme/images/poro.gif">
						<h2><?php _e( 'Erreur 404 : introuvable', 'premier_theme' ); ?></h2>
						<p><?php _e( 'Il semblerait que rien n\'ait été trouvé à cette adresse, pourquoi ne pas essayer une recherche ?', 'premier_theme' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</div><!-- .page-wrapper -->

			</div><!-- #content -->
		</div>		
	</div><!-- #primary -->

<?php get_footer(); ?>