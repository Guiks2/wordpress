<div class="sidebar">
	<ul>
 		<li id="menu"><?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => 'menu' ) ); ?></li>
		<li id="search"><h2>Rechercher sur le site</h2><?php include(TEMPLATEPATH . '/searchform.php'); ?></li>
		<li id="calendar">
			<h2>Calendrier</h2>
			<?php echo do_shortcode('[ai1ec view="agenda"]') ?>
		</li>
	</ul>
</div>