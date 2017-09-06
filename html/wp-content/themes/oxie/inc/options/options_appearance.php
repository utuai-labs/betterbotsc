	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s Settings - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Appearance", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_appearance');
			$canon_options_appearance = get_option('canon_options_appearance'); 

			// var_dump($canon_options_appearance);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_appearance'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_appearance'); ?>		


					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						SKINS
						COLOR SETTINGS
						BACKGROUND
						GOOGLE WEBFONTS
						RELATIVE FONT SIZE
						LIGHTBOX SETTINGS
						ANIMATION: IMG SLIDERS
						ANIMATION: QUOTE SLIDERS
						ANIMATION: REVIEW SLIDERS
						ANIMATION: LAZY LOAD EFFECT
						ANIMATION: MENUS

					-->

					<!-- 
					--------------------------------------------------------------------------
						SKINS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Skins", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Skins', 'loc_canon'),
									'content' 				=> array(
										__('Click a skin-button to change the colour-scheme of the whole theme.', 'loc_canon'),
									),
								)); 

							?>			

						</div>

						<table class='form-table' id="skins">

							<?php
								
								fw_option(array(
									'type'					=> 'hidden',
									'slug' 					=> 'body_skin_class',
									'options_name'			=> 'canon_options_appearance',
								)); 
							
							?>

							<tr valign='top'>
								<td>
									<img src="<?php echo get_template_directory_uri() ?>/img/skin_btn_1.png" alt="" 

										data-body_skin_class					="tc-oxie-1"
										
										data-color_body							="#f3f5f7"
										data-color_plate						="#ffffff"
										data-color_main_text					="#222425"
										data-color_main_headings				="#222425"
										data-color_links						="#222425"
										data-color_links_hover					="#9088a3"
										data-color_like							="#9088a3"
										data-color_white_text					="#ffffff"
										data-color_btn							="#dbdcde"
										data-color_btn_hover					="#9088a3"
										data-color_btn_text						="#b8babd"
										data-color_btn_text_hover				="#ffffff"
										data-color_feat_color					="#9088a3"
										
										data-color_feat_overlay_color			="#4d4365"
										data-color_feat_overtext_color			="#ffffff"
										
										data-color_meta							="#cacbcc"
										data-color_drops						="#222425"
										data-color_pre_header					="#ffffff"
										data-color_pre_header_text				="#222425"
										data-color_pre_header_text_hover		="#9189a4"
										data-color_pre_header_menus				="#f1f1f1"
										data-color_header						="#272b32"
										data-color_header_stuck					="#272b32"
										data-color_header_text					="#ffffff"
										data-color_header_text_hover			="#ded9ea"
										data-color_header_menus_2nd				="#393f49"
										data-color_header_menus					="#2f343c"
										data-color_post_header					="#3d424a"
										data-color_post_header_text				="#ffffff"
										data-color_post_header_text_hover		="#c3ad70"
										data-color_post_header_menus			="#535963"
										data-color_search_bg					="#1f2327"
										data-color_search_text					="#ffffff"
										data-color_search_text_hover			="#9189a4"
										data-color_search_line					="#464d51"
										data-color_sidr							="#191c20"
										data-color_sidr_text					="#ffffff"
										data-color_sidr_text_hover				="#9189a4"
										data-color_sidr_line					="#23272c"
										data-color_borders						="#e0e0e0"
										
										data-color_second_plate					="#f7f9fb"
										
										data-color_fields						="#f9fafb"
										data-color_feat_area					="#f4f6f7"
										data-color_feat_area_text				="#222425"
										data-color_feat_area_text_hover			="#9088a3"
										data-color_feat_car_text				="#ffffff"
										data-color_feat_car_text_hover			="#c1b1e4"
										
										data-color_feat_area_borders			="#e0e0e0"
										data-color_pre_footer					="#ffffff"
										data-color_pre_footer_text				="#222425"
										data-color_pre_footer_text_hover		="#9088a3"
										data-color_baseline						="#3d464b"
										data-color_baseline_text				="#ffffff"
										data-color_baseline_text_hover			="#9088a3"
										data-color_logo							="#ffffff"

									/>
									
									
									
								
									
									
								</td>
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						COLOR SETTINGS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Color settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Colors', 'loc_canon'),
									'content' 				=> array(
										__('Change the colours of the theme. Remember to save your changes.', 'loc_canon'),
									),
								)); 

							?>			

						</div>

						<table class='form-table'>

							<?php
								
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Body Background', 'loc_canon'),
									'slug' 					=> 'color_body',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Main Plate Background', 'loc_canon'),
									'slug' 					=> 'color_plate',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('General Text', 'loc_canon'),
									'slug' 					=> 'color_main_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Main Headings', 'loc_canon'),
									'slug' 					=> 'color_main_headings',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Links Text', 'loc_canon'),
									'slug' 					=> 'color_links',
									'options_name'			=> 'canon_options_appearance',
								));  
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Links Hover', 'loc_canon'),
									'slug' 					=> 'color_links_hover',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Like Heart', 'loc_canon'),
									'slug' 					=> 'color_like',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('White Text', 'loc_canon'),
									'slug' 					=> 'color_white_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Buttons', 'loc_canon'),
									'slug' 					=> 'color_btn',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Buttons Hover', 'loc_canon'),
									'slug' 					=> 'color_btn_hover',
									'options_name'			=> 'canon_options_appearance',
								));    
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Buttons Text', 'loc_canon'),
									'slug' 					=> 'color_btn_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Buttons Hover Text', 'loc_canon'),
									'slug' 					=> 'color_btn_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Color', 'loc_canon'),
									'slug' 					=> 'color_feat_color',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Overlay Color', 'loc_canon'),
									'slug' 					=> 'color_feat_overlay_color',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Overlay Text Color', 'loc_canon'),
									'slug' 					=> 'color_feat_overtext_color',
									'options_name'			=> 'canon_options_appearance',
								));
								  
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Meta Text', 'loc_canon'),
									'slug' 					=> 'color_meta',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Drop Caps Text', 'loc_canon'),
									'slug' 					=> 'color_drops',
									'options_name'			=> 'canon_options_appearance',
								));  
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Header Background', 'loc_canon'),
									'slug' 					=> 'color_pre_header',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Header Text', 'loc_canon'),
									'slug' 					=> 'color_pre_header_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Header Text Hover', 'loc_canon'),
									'slug' 					=> 'color_pre_header_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Header Tertiary Menus', 'loc_canon'),
									'slug' 					=> 'color_pre_header_menus',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Header Background', 'loc_canon'),
									'slug' 					=> 'color_header',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Header Background Sticky', 'loc_canon'),
									'slug' 					=> 'color_header_stuck',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Header Text', 'loc_canon'),
									'slug' 					=> 'color_header_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Header Text hover', 'loc_canon'),
									'slug' 					=> 'color_header_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Header Tertiary Menu', 'loc_canon'),
									'slug' 					=> 'color_header_menus',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Header Secondary Menu', 'loc_canon'),
									'slug' 					=> 'color_header_menus_2nd',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Post Header Background', 'loc_canon'),
									'slug' 					=> 'color_post_header',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Post Header Text', 'loc_canon'),
									'slug' 					=> 'color_post_header_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Post Header Text Hover', 'loc_canon'),
									'slug' 					=> 'color_post_header_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Post Header Tertiary Menu', 'loc_canon'),
									'slug' 					=> 'color_post_header_menus',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Search Container Background', 'loc_canon'),
									'slug' 					=> 'color_search_bg',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Search Container Text', 'loc_canon'),
									'slug' 					=> 'color_search_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Search Container Text Hover', 'loc_canon'),
									'slug' 					=> 'color_search_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Search Container Borders', 'loc_canon'),
									'slug' 					=> 'color_search_line',
									'options_name'			=> 'canon_options_appearance',
								));
															
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Responsive Menu Background', 'loc_canon'),
									'slug' 					=> 'color_sidr',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Responsive Menu Text', 'loc_canon'),
									'slug' 					=> 'color_sidr_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Responsive Menu Text Hover', 'loc_canon'),
									'slug' 					=> 'color_sidr_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Responsive Menu Borders', 'loc_canon'),
									'slug' 					=> 'color_sidr_line',
									'options_name'			=> 'canon_options_appearance',
								));    
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Border/Rulers Color', 'loc_canon'),
									'slug' 					=> 'color_borders',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Light Block Elements', 'loc_canon'),
									'slug' 					=> 'color_second_plate',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Form Fields Background', 'loc_canon'),
									'slug' 					=> 'color_fields',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Area Background', 'loc_canon'),
									'slug' 					=> 'color_feat_area',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Area Text', 'loc_canon'),
									'slug' 					=> 'color_feat_area_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Area Text Hover', 'loc_canon'),
									'slug' 					=> 'color_feat_area_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Instagram Text', 'loc_canon'),
									'slug' 					=> 'color_feat_car_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Instagram Text Hover', 'loc_canon'),
									'slug' 					=> 'color_feat_car_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Feature Area Borders', 'loc_canon'),
									'slug' 					=> 'color_feat_area_borders',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Footer Background', 'loc_canon'),
									'slug' 					=> 'color_pre_footer',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Footer Text', 'loc_canon'),
									'slug' 					=> 'color_pre_footer_text',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Pre Footer Text Hover', 'loc_canon'),
									'slug' 					=> 'color_pre_footer_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Baseline Background', 'loc_canon'),
									'slug' 					=> 'color_baseline',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Baseline Text', 'loc_canon'),
									'slug' 					=> 'color_baseline_text',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Baseline Text Hover', 'loc_canon'),
									'slug' 					=> 'color_baseline_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Logo Text', 'loc_canon'),
									'slug' 					=> 'color_logo',
									'options_name'			=> 'canon_options_appearance',
								));
								
					
							?>			


						</table>


					<!-- 
					--------------------------------------------------------------------------
						BACKGROUND
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Background", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Background image URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use this image" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use this image" button.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
										__('NB: the background image will be positioned top-center.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background link (optional)', 'loc_canon'),
									'content' 				=> array(
										__('If you insert a link here you background will automatically be made clickable. Clicking the background will open up your link in a new window. Great for take-over style ad-campaigns.', 'loc_canon'),
										__('NB: Only works with boxed design.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Size', 'loc_canon'),
									'content' 				=> array(
										__('Set background size.', 'loc_canon'),
										__('<b>Auto</b>: Default. Image retains original size.', 'loc_canon'),
										__('<b>Pattern optimized</b>: Recommended when using patterns for background. On high resolution monitors patterns will be set to half image size to avoid magnification/pixelation. On standard monitors original pattern size will be used.', 'loc_canon'),
										__('<b>Cover</b>: Image will cover viewport background. Works best with large images and Attachement set to fixed - otherwise magnification/pixelation may occur.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Repeat', 'loc_canon'),
									'content' 				=> array(
										__('If set to repeat the background image will repeat vertically.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Attachment', 'loc_canon'),
									'content' 				=> array(
										__('If set to fixed the background image will not scroll.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background pattern', 'loc_canon'),
									'content' 				=> array(
										__('Click one of buttons to use that background pattern. Notice that the url of pattern image file will be automatically inserted into the Backgroun image URL input. Also notice that Repeat and attachment selects will be updated to recommended selections for use with pattern backgrounds (repeat fixed). Remember to save your changes.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table' id="background_table">

							<?php

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Background image URL', 'loc_canon'),
									'slug' 					=> 'bg_img_url',
									'btn_text'				=> __('Upload background image', 'loc_canon'),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Background link (optional)', 'loc_canon'),
									'slug' 					=> 'bg_link',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Size', 'loc_canon'),
									'slug' 					=> 'bg_size',
									'select_options'		=> array(
										'auto'				=> __('Auto', 'loc_canon'),
										'pattern'			=> __('Pattern Optimized', 'loc_canon'),
										'cover'				=> __('Cover', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Repeat', 'loc_canon'),
									'slug' 					=> 'bg_repeat',
									'select_options'		=> array(
										'repeat'			=> __('Repeat', 'loc_canon'),
										'no-repeat'			=> __('No repeat', 'loc_canon')
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Attachment', 'loc_canon'),
									'slug' 					=> 'bg_attachment',
									'select_options'		=> array(
										'fixed'				=> __('Fixed', 'loc_canon'),
										'scroll'			=> __('Scroll', 'loc_canon')
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

							 ?>		

							<tr valign='top'>
								<th scope='row'><?php _e("Background pattern", "loc_canon"); ?></th>
								<td class="bg_pattern_picker">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile_btn.png" data-img_file="tile.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile2_btn.png" data-img_file="tile2.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile3_btn.png" data-img_file="tile3.png">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile4_btn.png" data-img_file="tile4.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile5_btn.png" data-img_file="tile5.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile6_btn.png" data-img_file="tile6.png">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile7_btn.png" data-img_file="tile7.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile8_btn.png" data-img_file="tile8.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile9_btn.png" data-img_file="tile9.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile10_btn.png" data-img_file="tile10.png">  
								</td>
							</tr>


						</table>


					<!-- 
					--------------------------------------------------------------------------
						GOOGLE WEBFONTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Google Webfonts", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Change fonts', 'loc_canon'),
									'content' 				=> array(
										__('<i>first select:</i> Font name.', 'loc_canon'),
										__('<i>middle select:</i> Font variants (will change automatically if available for the chosen font).', 'loc_canon'),
										__('<i>last select:</i> Font subset (will change automatically if available for the chosen font).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('More info', 'loc_canon'),
									'content' 				=> array(
										__('Notice: You can only control the general fonts to be used. However, parameters like font size, styling, letter-spacing etc. are controlled by the theme itself.', 'loc_canon'),
										__('Go to <a href="http://www.google.com/webfonts" target="_blank">Google Webfonts</a> homepage to preview fonts.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Body Font', 'loc_canon'),
									'slug' 					=> 'font_main',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Headings Font', 'loc_canon'),
									'slug' 					=> 'font_heading',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Headings Font Strong', 'loc_canon'),
									'slug' 					=> 'font_heading_strong',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Second Headings Font', 'loc_canon'),
									'slug' 					=> 'font_heading2',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Third Headings Font', 'loc_canon'),
									'slug' 					=> 'font_heading3',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Menu Font', 'loc_canon'),
									'slug' 					=> 'font_nav',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Meta Info Font', 'loc_canon'),
									'slug' 					=> 'font_meta',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Button Font', 'loc_canon'),
									'slug' 					=> 'font_button',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('DropCaps Font', 'loc_canon'),
									'slug' 					=> 'font_dropcap',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Quotes Font', 'loc_canon'),
									'slug' 					=> 'font_quote',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Logo Font', 'loc_canon'),
									'slug' 					=> 'font_logotext',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Lead Text Font', 'loc_canon'),
									'slug' 					=> 'font_lead',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Bold Text Font', 'loc_canon'),
									'slug' 					=> 'font_bold',
									'options_name'			=> 'canon_options_appearance',
								));
								
								fw_option(array(
									'type'					=> 'font',
									'title' 				=> __('Italics Text Font', 'loc_canon'),
									'slug' 					=> 'font_italic',
									'options_name'			=> 'canon_options_appearance',
								));
								
							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						RELATIVE FONT SIZE
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Relative Font Size", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Font size', 'loc_canon'),
									'content' 				=> array(
										__('Adjust the relative size of all fonts.', 'loc_canon'),
									),
								));

							?> 

						</div>
						

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Font size', 'loc_canon'),
									'slug' 					=> 'font_size_root',
									'min'					=> '0',
									'max'					=> '1000',
									'step'					=> '1',
									'width_px'				=> '60',
									'colspan'				=> '2',
									'postfix' 				=> __('%', 'loc_canon'),
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						LIGHTBOX SETTINGS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php _e("Lightbox settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Lightbox overlay color', 'loc_canon'),
									'content' 				=> array(
										__('Select the color of the lightbox overlay.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Lightbox overlay opacity', 'loc_canon'),
									'content' 				=> array(
										__('Select the opacity of the lightbox overlay.', 'loc_canon'),
										__('Choose a value between 0 and 1.', 'loc_canon'),
										__('0 is completely transparent.', 'loc_canon'),
										__('1 is compeltely solid.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php

								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Lightbox overlay color', 'loc_canon'),
									'slug' 					=> 'lightbox_overlay_color',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Lightbox overlay opacity', 'loc_canon'),
									'slug' 					=> 'lightbox_overlay_opacity',
									'min'					=> '0',
									'max'					=> '1',
									'step'					=> '0.1',
									'width_px'				=> '60',
									'colspan'				=> '2',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: IMG SLIDERS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Animation: Image Sliders", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php _e('This controls general behavior of image flexsliders used in theme.', 'loc_canon'); ?>

							<br><br>

							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'content' 				=> array(
										__('If checked slides will change automatically.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'content' 				=> array(
										__('Delay between each slide (in milliseconds).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'content' 				=> array(
										__('Duration of transition animation (in milliseconds).', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'slug' 					=> 'anim_img_slider_slideshow',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'slug' 					=> 'anim_img_slider_delay',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'slug' 					=> 'anim_img_slider_anim_duration',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: QUOTE SLIDERS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Animation: Quote Sliders", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php _e('This controls general behavior of quote flexsliders used in theme.', 'loc_canon'); ?>

							<br><br>

							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'content' 				=> array(
										__('If checked slides will change automatically.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'content' 				=> array(
										__('Delay between each slide (in milliseconds).', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'content' 				=> array(
										__('Duration of transition animation (in milliseconds).', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Slideshow', 'loc_canon'),
									'slug' 					=> 'anim_quote_slider_slideshow',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Slide delay', 'loc_canon'),
									'slug' 					=> 'anim_quote_slider_delay',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'slug' 					=> 'anim_quote_slider_anim_duration',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: MENUS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Animation: Menus", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animate menus', 'loc_canon'),
									'content' 				=> array(
										__('Select which menus to animate - or turn off menu animation altogether.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Enter from', 'loc_canon'),
									'content' 				=> array(
										__('Element moves in from this angle.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Move distance', 'loc_canon'),
									'content' 				=> array(
										__('How much the element will move (in pixels). Can be 0 if you do not want the element to move at all.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'content' 				=> array(
										__('Duration of the menu animation.', 'loc_canon'),
									),
								));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Delay between elements', 'loc_canon'),
									'content' 				=> array(
										__('Delay in milliseconds between each menu item starts to appear.', 'loc_canon'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Animate menus', 'loc_canon'),
									'slug' 					=> 'anim_menus',
									'select_options'		=> array(
										'anim_menus_off'		=> __('Off', 'loc_canon'),
										'.primary_menu'			=> __('Primary menu', 'loc_canon'),
										'.secondary_menu'		=> __('Secondary menu', 'loc_canon'),
										'.nav'					=> __('Primary + Secondary menu', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Enter from', 'loc_canon'),
									'slug' 					=> 'anim_menus_enter',
									'select_options'		=> array(
										'bottom'			=> __('Top', 'loc_canon'),
										'left'				=> __('Right', 'loc_canon'),
										'top'				=> __('Bottom', 'loc_canon'),
										'right'				=> __('Left', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Move distance', 'loc_canon'),
									'slug' 					=> 'anim_menus_move',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '1',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation duration', 'loc_canon'),
									'slug' 					=> 'anim_menus_duration',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Delay between elements', 'loc_canon'),
									'slug' 					=> 'anim_menus_delay',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>







					<?php submit_button(); ?>
				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>