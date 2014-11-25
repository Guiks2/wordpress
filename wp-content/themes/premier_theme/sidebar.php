<div class="sidebar">
	<ul>
 		<li id="menu"><?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => 'menu' ) ); ?></li>
		<li id="search"><h2>Rechercher sur le site</h2><?php include(TEMPLATEPATH . '/searchform.php'); ?></li>
		<li id="calendar">
			<h2>Calendrier</h2>
			        	<script class="ai1ec-widget-placeholder" data-widget="ai1ec_agenda_widget" data-events_seek_type="events" data-events_per_page="5" data-show_subscribe_buttons="false">
  (function(){var d=document,s=d.createElement('script'),
  i='ai1ec-script';if(d.getElementById(i))return;s.async=1;
  s.id=i;
  jQuery(s).attr("src", "<?php echo get_site_url(); ?>/?ai1ec_js_widget");
  d.getElementsByTagName('head')[0].appendChild(s);})();
</script>
		</li>
	</ul>
</div>