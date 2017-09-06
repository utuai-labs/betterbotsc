<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	canon_options_help
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_help');

	function register_canon_options_help () {
		global $screen_handle_canon_options_help;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_help = add_submenu_page(
			'handle_canon_options',						//the handle of the parent options page. 
			'Help Center',								//the submenu title that will appear in browser title area.
			'Help',										//the on screen name of the submenu
			'manage_options',							//privileges check
			'handle_canon_options_help',				//the handle of this submenu
			'display_canon_options_help'						//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_help');	
	
	function init_canon_options_help () {
		register_setting(
			'group_canon_options_help',					//group name. The group for the fields custom_options_group
			'canon_options_help',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_help'				//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_help');	

	function default_canon_options_help () {

		//if this is first runthrough set default values
		if (get_option('canon_options_help') == FALSE) {		//trying to get options 'canon_options_help' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'show_tab' 		=> 'theme_docs',

				);

			update_option('canon_options_help', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_help ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_canon_options_help () {
		require "options_help.php";
	}