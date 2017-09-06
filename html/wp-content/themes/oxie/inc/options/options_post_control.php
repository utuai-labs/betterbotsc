<?php

/****************************************************
DESCRIPTION: 	POST & PAGE OPTIONS
OPTION HANDLE: 	canon_options_post
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_post');

	function register_canon_options_post () {
		global $screen_handle_canon_options_post;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_post = add_submenu_page(
			'handle_canon_options',						//the handle of the parent options page. 
			'Posts & Pages Settings',						//the submenu title that will appear in browser title area.
			'Posts & Pages',								//the on screen name of the submenu
			'manage_options',							//privileges check
			'handle_canon_options_post',				//the handle of this submenu
			'display_canon_options_post'						//the callback function to display the actual submenu page content.
		);

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		// Put this in the submenu controller. NB: Not in the first add_menu_page controller, but in the first submenu controller with add_submenu_page. It is not defined until then. 
		global $submenu;	
		$submenu['handle_canon_options'][0][0] = "General";

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_post');	
	
	function init_canon_options_post () {
		register_setting(
			'group_canon_options_post',				//group name. The group for the fields custom_options_group
			'canon_options_post',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_post'				//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_post');	

	function default_canon_options_post () {

		//if this is first runthrough set default values
		if (get_option('canon_options_post') == FALSE) {		//trying to get options 'canon_options_post' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'homepage_layout'						=> 'masonry_sidebar',
		 			'homepage_num_columns'					=> '1',
					'homepage_sidebar'						=> 'canon_archive_sidebar_widget_area',
					'homepage_drop_cap'						=> 'checked',
		 			'homepage_excerpt_length'				=> 500,
		 			'homepage_pagination'					=> 'prevnext_ajax',

		 			'cat_layout'							=> 'masonry',
		 			'cat_num_columns'						=> '2',
					'cat_sidebar'							=> 'canon_archive_sidebar_widget_area',
					'cat_drop_cap'							=> 'checked',
		 			'cat_excerpt_length'					=> 500,
		 			'show_cat_title'						=> 'unchecked',
		 			'show_cat_description'					=> 'unchecked',
		 			'cat_pagination'						=> 'prevnext',

		 			'archive_layout'						=> 'masonry',
		 			'archive_num_columns'					=> '2',
					'archive_sidebar'						=> 'canon_archive_sidebar_widget_area',
					'archive_drop_cap'						=> 'checked',
		 			'archive_excerpt_length'				=> 500,
		 			'archive_pagination'					=> 'prevnext',

		 			'page_show_comments' 					=> 'unchecked',

		 			'single_default_post_style' 			=> 'compact_sidebar',
		 			'single_use_dropcap' 					=> 'checked',
		 			'show_tags' 							=> 'checked',
		 			'show_comments' 						=> 'checked',
		 			'show_post_nav' 						=> 'checked',
		 			'post_nav_same_cat' 					=> 'unchecked',
		 			'post_component_ad_code' 				=> "<a href='http://www.themeforest.com/?ref=themecanon' target='_blank'><img src='".get_template_directory_uri()."/img/ad-example.png' alt='Advertisement'></a>",
		 			
		 			'show_meta_author' 						=> 'checked',
		 			'show_meta_date' 						=> 'checked',
		 			'show_meta_comments' 					=> 'checked',
		 			'show_meta_likes' 						=> 'checked',
		 			'show_meta_views' 						=> 'checked',
		 			'show_share_link_facebook' 				=> 'checked',
		 			'show_share_link_twitter' 				=> 'checked',
		 			'show_share_link_google_plus' 			=> 'checked',
		 			'show_share_link_pinterest' 			=> 'checked',

		 			'archive_header_padding_top' 			=> 200,
		 			'archive_header_padding_bottom' 		=> 100,

			 		'search_box_text'						=> __('What are you looking for?', "loc_canon"),
			 		'search_posts'							=> 'checked',
			 		'search_pages'							=> 'unchecked',
			 		'search_cpt'							=> 'unchecked',
			 		'search_cpt_source'						=> '',
			 		'search_widget_area_1'					=> 'canon_cwa_search-widget-area-1',
			 		'search_widget_area_2'					=> 'canon_cwa_search-widget-area-2',
			 		'search_widget_area_3'					=> 'canon_cwa_search-widget-area-3',
			 		'search_widget_area_4'					=> 'off',
			 		'search_widget_area_5'					=> 'off',

		 			'404_layout'							=> 'full',
					'404_sidebar'							=> 'canon_page_sidebar_widget_area',
			 		'404_title'								=> __('Page not found', "loc_canon"),
			 		'404_msg'								=> __("Sorry, you're lost my friend, the page you're looking for does not exist anymore. Take your luck at searching for a new one.", "loc_canon"),
					
					'use_woocommerce_sidebar'				=> 'unchecked',
					'woocommerce_sidebar'					=> 'canon_archive_sidebar_widget_area',

				);

			update_option('canon_options_post', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_post ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_canon_options_post () {
		require "options_post.php";
	}