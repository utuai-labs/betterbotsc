<?php

/****************************************************
DESCRIPTION: 	ADVANCED OPTIONS
OPTION HANDLE: 	canon_options_advanced
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_advanced');

	function register_canon_options_advanced () {
		global $screen_handle_canon_options_advanced;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		$screen_handle_canon_options_advanced = add_submenu_page(
			'handle_canon_options',					//the handle of the parent options page. 
			'Advanced Settings',					//the submenu title that will appear in browser title area.
			'Advanced',								//the on screen name of the submenu
			'manage_options',						//privileges check
			'handle_canon_options_advanced',				//the handle of this submenu
			'display_canon_options_advanced'				//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_advanced');	
	
	function init_canon_options_advanced () {
		register_setting(
			'group_canon_options_advanced',				//group name. The group for the fields custom_options_group
			'canon_options_advanced',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_advanced'				//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_advanced');	

	function default_canon_options_advanced () {

		//if this is first runthrough set default values
		if (get_option('canon_options_advanced') == FALSE) {		//trying to get options 'canon_options_advanced' which doesn't yet exist results in FALSE
		 	$options = array (

			 		'reset_all'					=> '',
			 		'reset_basic'				=> '',

			 		'custom_widget_areas'		=> array(
			 			0							=> array(
			 				'name'						=> 'Search Widget Area 1',
			 			),
			 			1							=> array(
			 				'name'						=> 'Search Widget Area 2',
			 			),
			 			2							=> array(
			 				'name'						=> 'Search Widget Area 3',
			 			),
			 			3							=> array(
			 				'name'						=> 'Search Widget Area 4',
			 			),
			 			4							=> array(
			 				'name'						=> 'Search Widget Area 5',
			 			),

			 		),
			 		
					'use_final_call_css'				=> 'checked',
					
					'oauth_instagram_client_id'				=> '',
					'oauth_instagram_client_secret'			=> '',
					'oauth_instagram'						=> '',
					'reset_oauth_instagram'					=> '',
				);

			update_option('canon_options_advanced', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_advanced ($new_instance) {				
		// $old_instance = get_option('canon_options_advanced');
		return $new_instance;
	}

	//display the menus
	function display_canon_options_advanced () {
		require "options_advanced.php";
	}