<div class="sidebar">
	<ul>
    	<li id="menu"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu' ) ); ?>

		<li id="search"><?php include(TEMPLATEPATH . '/searchform.php'); ?></li>
		<li id="calendar">
			<h2>Calendrier</h2>
			<?php get_calendar(); ?>
		</li>
	</ul>
</div>