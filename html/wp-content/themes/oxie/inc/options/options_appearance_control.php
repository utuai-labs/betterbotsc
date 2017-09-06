<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	canon_options_appearance
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_appearance');

	function register_canon_options_appearance () {
		global $screen_handle_canon_options_appearance;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_appearance = add_submenu_page(
			'handle_canon_options',							//the handle of the parent options page. 
			'Appearance Settings',							//the submenu title that will appear in browser title area.
			'Appearance',									//the on screen name of the submenu
			'manage_options',								//privileges check
			'handle_canon_options_appearance',				//the handle of this submenu
			'display_canon_options_appearance'					//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_appearance');	
	
	function init_canon_options_appearance () {
		register_setting(
			'group_canon_options_appearance',				//group name. The group for the fields custom_options_group
			'canon_options_appearance',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_appearance'				//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_appearance');	

	function default_canon_options_appearance () {

		//if this is first runthrough set default values
		if (get_option('canon_options_appearance') == FALSE) {		//trying to get options 'canon_options_appearance' which doesn't yet exist results in FALSE
		 	$options = array (

			 		'body_skin_class'					=> 'tc-oxie-1',
					
					'color_body'						=> '#f3f5f7',
					'color_plate'						=> '#ffffff',
					'color_main_text'					=> '#222425',
					'color_main_headings'				=> '#222425',
					'color_links'						=> '#222425',
					'color_links_hover'					=> '#9088a3',
					'color_like'						=> '#9088a3',
					'color_white_text'					=> '#ffffff',
					'color_btn'							=> '#dbdcde',
					'color_btn_hover'					=> '#9088a3',
					'color_btn_text'					=> '#b8babd',
					'color_btn_text_hover'				=> '#ffffff',
					'color_feat_color'					=> '#9088a3',
					
					'color_feat_overlay_color'			=> '#4d4365',
					'color_feat_overtext_color'			=> '#ffffff',
					
					'color_meta'						=> '#cacbcc',
					'color_drops'						=> '#222425',
					'color_pre_header'					=> '#ffffff',
					'color_pre_header_text'				=> '#222425',
					'color_pre_header_text_hover'		=> '#9189a4',
					'color_pre_header_menus'			=> '#f1f1f1',
					'color_header'						=> '#272b32',
					'color_header_stuck'				=> '#272b32',
					'color_header_text'					=> '#ffffff',
					'color_header_text_hover'			=> '#ded9ea',
					'color_header_menus_2nd'			=> '#393f49',
					'color_header_menus'				=> '#2f343c',
					'color_post_header'					=> '#3d424a',
					'color_post_header_text'			=> '#ffffff',
					'color_post_header_text_hover'		=> '#9189a4',
					'color_post_header_menus'			=> '#535963',
					'color_search_bg'					=> '#1f2327',
					'color_search_text'					=> '#ffffff',
					'color_search_text_hover'			=> '#9189a4',
					'color_search_line'					=> '#464d51',
					'color_sidr'						=> '#191c20',
					'color_sidr_text'					=> '#ffffff',
					'color_sidr_text_hover'				=> '#9189a4',
					'color_sidr_line'					=> '#23272c',
					'color_borders'						=> '#e0e0e0',
					
					'color_second_plate'				=> '#f7f9fb',
					
					'color_fields'						=> '#f9fafb',
					'color_feat_area'					=> '#f4f6f7',
					'color_feat_area_text'				=> '#222425',
					'color_feat_area_text_hover'		=> '#9088a3',
					'color_feat_car_text'				=> '#ffffff',
					'color_feat_car_text_hover'			=> '#c1b1e4',
					
					'color_feat_area_borders'			=> '#e0e0e0',
					'color_pre_footer'					=> '#ffffff',
					'color_pre_footer_text'				=> '#222425',
					'color_pre_footer_text_hover'		=> '#9088a3',
					'color_baseline'					=> '#3d464b',
					'color_baseline_text'				=> '#ffffff',
					'color_baseline_text_hover'			=> '#9088a3',
					'color_logo'						=> '#ffffff',
					

					'bg_img_url'						=> get_template_directory_uri() . '/img/patterns/tile4.png',
					'bg_link'							=> '',
					'bg_size'							=> 'auto',
					'bg_repeat'							=> 'repeat',
					'bg_attachment'						=> 'scroll',

					'lightbox_overlay_color'			=> '#000000',
					'lightbox_overlay_opacity'			=> '0.7',

				 	'font_main'        					=> array('canon_default','',''),				 	
				 	'font_heading'        				=> array('canon_default','',''),
				 	'font_heading_strong'        		=> array('canon_default','',''),
				 	'font_heading2'        				=> array('canon_default','',''),
				 	'font_heading3'        				=> array('canon_default','',''),
				 	'font_nav'	        				=> array('canon_default','',''),
				 	'font_meta'        					=> array('canon_default','',''),
				 	'font_button'      					=> array('canon_default','',''),
				 	'font_dropcap'        				=> array('canon_default','',''),
				 	'font_quote'        				=> array('canon_default','',''),
				 	'font_logotext'        				=> array('canon_default','',''),
				 	'font_lead'        					=> array('canon_default','',''),
				 	'font_bold'        					=> array('canon_default','',''),
				 	'font_italic'        				=> array('canon_default','',''),

				 	'font_size_root'					=> 100,

					'anim_img_slider_slideshow'			=> 'unchecked',
					'anim_img_slider_delay'				=> '5000',
					'anim_img_slider_anim_duration'		=> '800',
					'anim_quote_slider_slideshow'		=> 'checked',
					'anim_quote_slider_delay'			=> '5000',
					'anim_quote_slider_anim_duration'	=> '800',

					'anim_menus'						=> 'anim_menus_off',
					'anim_menus_enter'					=> 'left',
					'anim_menus_move'					=> 40,
					'anim_menus_duration'				=> 600,
					'anim_menus_delay'					=> 150,

				);

			update_option('canon_options_appearance', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_appearance ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_canon_options_appearance () {
		require "options_appearance.php";
	}