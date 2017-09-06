<?php

/*
Plugin Name: Oxie Core Plugin
Plugin URI: http://www.themecanon.com
Description: Core functionality plugin for Oxie theme by Theme Canon.
Version: 1.0
Author: ThemeCanon
Auhtor URI: http://www.themecanon.com
*/



/**************************************
INDEX

PHP INCLUDES
WP ENQUEUE
PLUGIN LOCALIZATION INIT
ADD CUSTOM FIELDS TO USER PROFILE

***************************************/



/**************************************
PHP INCLUDES
***************************************/

	// custom post types and custom meta boxes
	include 'inc/functions/functions_cmb_pages.php';
	include 'inc/functions/functions_cmb_posts.php';


/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','oxie_core_plugin_load_to_front');
	function oxie_core_plugin_load_to_front() {
	}

	//back end includes
	add_action('admin_enqueue_scripts', 'oxie_core_plugin_load_to_back');
	function oxie_core_plugin_load_to_back() {

		//scripts (js)
		wp_enqueue_script('oxie-core-plugin-admin-scripts', plugins_url('', __FILE__ ) . '/js/admin-scripts.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('oxie-core-plugin-stylesheet', plugins_url('', __FILE__ ) . '/css/style.css');

	}


/**************************************
PLUGIN LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'oxie_core_plugin_localization_setup');
	function oxie_core_plugin_localization_setup() {
	    load_plugin_textdomain('loc_oxie_core_plugin', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/');
	}

 
/**************************************
ADD CUSTOM FIELDS TO USER PROFILE
***************************************/

	add_filter('user_contactmethods', 'oxie_add_social_links_to_user_profile');

	function oxie_add_social_links_to_user_profile ($profile_fields) {

		// Add new fields
		$profile_fields['twitter'] 		= 'Twitter URL';
		$profile_fields['facebook'] 	= 'Facebook URL';
		$profile_fields['googleplus'] 	= 'Google+ URL';
		$profile_fields['linkedin'] 	= 'LinkedIn URL';

		// Remove old fields
		// unset($profile_fields['aim']);

		return $profile_fields;
	}
