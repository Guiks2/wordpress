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
 	<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
 	
    <script>
		jQuery(document).ready(function() {
			jQuery('.sidebar #menu div .menu-item > ul').hide();
			jQuery("#hidden-menu").hide();
			jQuery(window).on('resize', function(){
			  var win = jQuery(this); //this = window
			  if (win.width() > 950) {jQuery("#hidden-menu").hide();}
			});
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
        if( !is_user_logged_in()) {
	        echo wp_login_form();
		} else {
	        if ( is_user_logged_in() ) {
	            $sql = 'SELECT ID '.
	            'FROM wp_posts '.
	            'INNER JOIN wp_postmeta ON wp_postmeta.post_id=wp_posts.ID '.
	            'WHERE wp_postmeta.meta_value="edit_profil.php" '.
	                'AND wp_postmeta.meta_key="_wp_page_template"'; 
	            $id_page = $wpdb->get_var($sql);
	             
	            echo '<a href="?page_id='.$id_page.'">Profil</a>';
	        }
		}
        ?>
    </div>
    <div style="height: 30px;"></div>





    <div id="page">

