<?php

/*
Plugin Name: Oxie Widgets Plugin
Plugin URI: http://www.themecanon.com
Description: Custom widgets for Oxie theme by Theme Canon.
Version: 1.0
Author: Theme Canon
Auhtor URI: http://www.themecanon.com
*/


/**************************************
NOTES

- Oxie: More Posts.
This widget taps into the post meta: "post_views" to determine most popular posts by view. (NB: data not supplied by plugin).
This widget uses a custom field (post): "cmb_hide_from_popular". (NB: data not supplied by plugin).

***************************************/

/**************************************
INDEX

PLUGIN LOCALIZATION INIT
PHP INCLUDES
WP ENQUEUE
IMAGE SIZES
FACEBOOK PAGE PLUGIN MECHANICS

***************************************/

/**************************************
PLUGIN LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'oxie_widgets_plugin_localization_setup');
	function oxie_widgets_plugin_localization_setup() {
	    load_plugin_textdomain('loc_oxie_widgets_plugin', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/');
	}


/**************************************
PHP INCLUDES
***************************************/

	// include widgets
	include 'inc/widgets/widget_oxie_more_posts.php';
	include 'inc/widgets/widget_oxie_twitter.php';
	include 'inc/widgets/widget_oxie_search.php';
	include 'inc/widgets/widget_oxie_quicklinks.php';
	include 'inc/widgets/widget_oxie_fact.php';
	include 'inc/widgets/widget_oxie_statistics.php';
	include 'inc/widgets/widget_oxie_single_post.php';
	include 'inc/widgets/widget_oxie_quote.php';
	include 'inc/widgets/widget_oxie_accordion.php';
	include 'inc/widgets/widget_oxie_tabs.php';
	include 'inc/widgets/widget_oxie_toggle.php';
	include 'inc/widgets/widget_oxie_facebook.php';
	include 'inc/widgets/widget_oxie_animated_number.php';
	include 'inc/widgets/widget_oxie_paired_list.php';
	include 'inc/widgets/widget_oxie_instagram_gallery.php';
	include 'inc/widgets/widget_oxie_social_links.php';

	// conditional widgets. Notice the after_setup_theme action - this to prevent the class_exists check before all plugins have been loaded. If not in place the class_exists would just be executed when this plugin loads which could be before another plugin.
	add_action('after_setup_theme', 'load_conditional_widgets');
	function load_conditional_widgets() {
		// if (class_exists('Tribe__Events__Main')) { include 'inc/widgets/widget_oxie_single_event.php'; }
	}




/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','oxie_widgets_plugin_load_to_front');
	function oxie_widgets_plugin_load_to_front() {

		//front end scripts (js)
		wp_enqueue_script('oxie-widgets-plugin-scripts', plugins_url('', __FILE__ ) . '/js/scripts.js', array(), false, true);
		wp_enqueue_script('oxie-widgets-plugin-animatenumbers', plugins_url('', __FILE__ ) . '/js/jquery.animateNumbers.js', array(), false, true);
		wp_enqueue_script('oxie-widgets-plugin-fittext', plugins_url('', __FILE__ ) . '/js/fittext.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('oxie-widgets-plugin-style', plugins_url('', __FILE__ ) . '/css/style.css');


	}

	//back end includes
	add_action('admin_enqueue_scripts', 'oxie_widgets_plugin_load_to_back');  //this was changed to admin_enqueue_scripts from action hook admin_footer. Let's see if it makes a difference
	function oxie_widgets_plugin_load_to_back() {

		//back end scripts (js)
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		wp_enqueue_script('oxie-widgets-plugin-admin-scripts', plugins_url('', __FILE__ ) . '/js/admin-scripts.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('oxie-widgets-plugin-admin-style', plugins_url('', __FILE__ ) . '/css/admin-style.css');

	}

/**************************************
IMAGE SIZES
***************************************/

	add_image_size( 'widget_more_posts_thumb', 970, 970, true);
	add_image_size( 'widget_more_posts_thumbnails_list_thumb', 400, 400, true);


/**************************************
FACEBOOK PAGE PLUGIN MECHANICS
***************************************/

	add_action('wp_footer', 'add_facebook_js');  
	function add_facebook_js () {
	?>
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>	
	<?php
	}