<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s Settings - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("General", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options');
			$canon_options = get_option('canon_options'); 

			//detect dev
			$dev = (isset($_GET['dev'])) ? $_GET['dev'] : "false";

			// var_dump($canon_options);
			// var_dump(get_intermediate_image_sizes());	// displays registered image sizes

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options'); ?>		


					<?php submit_button(); ?>

					<!-- 

						INDEX

						DEVELOPER TOOLS
						GENERAL 
						IMAGE SIZES
						MAIN SEARCH AUTOCOMPLETE
						COMPATIBILITY
					
					-->


					<?php if ($dev === "true") : ?>

					<!-- 
					--------------------------------------------------------------------------
						DEVELOPER TOOLS
				    -------------------------------------------------------------------------- 
					-->

							<h3><?php _e('Developer Tools', 'loc_canon'); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Developer mode', 'loc_canon'),
										'content' 				=> array(
											__('Turns developer mode on. Other developer options will only take effect when developer mode is turned on.', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Use these controller classes', 'loc_canon'),
										'content' 				=> array(
											__('Add custom controller classes. Will replace the theme generated controller classes on grid layouts. Leave empty to not use.', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Use this mockup structure', 'loc_canon'),
										'content' 				=> array(
											__('Add box mockups files to the <i>/inc/templates/mockups</i> folder. Each box mockup file can contain markup of a single box. Add file names (no file extension - just the name) separated with commas. This list will be used to generate a grid. E.g. &quot;1, 2, 3, 1&quot; will generate a grid displaying markup in files 1.php, 2.php, 3.php and 1.php in that order. Leave empty not to use.', 'loc_canon'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Developer mode', 'loc_canon'),
										'slug' 					=> 'dev_mode',
										'options_name'			=> 'canon_options',
									)); 

									fw_option(array(
										'type'					=> 'text',
										'title' 				=> __('Use these controller classes', 'loc_canon'),
										'slug' 					=> 'dev_controller_classes',
										'class'					=> 'widefat',
										'options_name'			=> 'canon_options',
									));

									fw_option(array(
										'type'					=> 'textarea',
										'title' 				=> __('Use this mockup structure', 'loc_canon'),
										'slug' 					=> 'dev_mockup_structure',
										'rows'					=> '5',
										'options_name'			=> 'canon_options',
									)); 


								?>


							</table>

						 		
					<?php else: ?>

						<input type="hidden" name="canon_options[dev_mode]" value="<?php echo esc_attr($canon_options['dev_mode']); ?>" />
						<input type="hidden" name="canon_options[dev_controller_classes]" value="<?php echo esc_attr($canon_options['dev_controller_classes']); ?>" />
						<input type="hidden" name="canon_options[dev_mockup_structure]" value="<?php echo esc_attr($canon_options['dev_mockup_structure']); ?>" />

					<?php endif; ?>
					

					<!-- 
					--------------------------------------------------------------------------
						GENERAL 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("General", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use responsive design', 'loc_canon'),
									'content' 				=> array(
										__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices.', 'loc_canon'),
										__('Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use boxed design', 'loc_canon'),
									'content' 				=> array(
										__('Use boxed design for site layout. Otherwise site will display in full width layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Maintenance mode', 'loc_canon'),
									'content' 				=> array(
										__('Activating maintenance mode will mean that only logged in users can see the content of your site. Only exception are pages using the placeholder template which can still be seen by all.', 'loc_canon'),
										__('We suggest that if you use this function you also use a placeholder page as a "static homepage" to let people know that your site is under maintenance.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Maintenance mode message', 'loc_canon'),
									'content' 				=> array(
										__('The message that will be displayed to visitors when in maintenance mode.', 'loc_canon'),
										__('Remember that you can set up a placeholder page (using the placeholder page-template) and use as a homepage as this page type will always display even when maintenance mode is active.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Favicon URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use this image" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use this image" button.', 'loc_canon'),
										__('If you leave the URL text field empty the default favicon will be displayed.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebars alignment', 'loc_canon'),
									'content' 				=> array(
										__('Choose which side to have your sidebars on.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Back to top button', 'loc_canon'),
									'content' 				=> array(
										__('Select back to top button.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Overlay header', 'loc_canon'),
									'content' 				=> array(
										__('Overlay header on top element. Only available on top elements that accepts header overlay (slider, full width featured images etc).', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Overlay content', 'loc_canon'),
									'content' 				=> array(
										__('Apply negative margin to content to make it overlay top element. Set negative margin in pixels. Only available where top element accepts content overlay (slider, full width featured images etc).', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Responsive overlay', 'loc_canon'),
									'content' 				=> array(
										__('You can turn overlays off at certain responsive break points. Use this if overlays interfere with content on smaller viewport sizes.', 'loc_canon'),
									),
								)); 

							?>			

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use responsive design', 'loc_canon'),
									'slug' 					=> 'use_responsive_design',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use boxed design', 'loc_canon'),
									'slug' 					=> 'use_boxed_design',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Maintenance mode', 'loc_canon'),
									'postfix'				=> __('<i>(Warning: only logged-in users will be able to see your site pages.)</i>', 'loc_canon'),
									'slug' 					=> 'use_maintenance_mode',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Maintenance mode message', 'loc_canon'),
									'slug' 					=> 'maintenance_msg',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Favicon URL', 'loc_canon'),
									'slug' 					=> 'favicon_url',
									'btn_text'				=> 'Upload favicon',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Sidebars alignment', 'loc_canon'),
									'slug' 					=> 'sidebars_alignment',
									'select_options'		=> array(
										'left'					=> __('Left', 'loc_canon'),
										'right'					=> __('Right', 'loc_canon')
									),
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Back to top button', 'loc_canon'),
									'slug' 					=> 'back_to_top_button',
									'select_options'		=> array(
										'none'					=> __('None', 'loc_canon'),
										'floating'				=> __('Classic floating', 'loc_canon'),
										'prefooter'				=> __('Fixed on pre-footer', 'loc_canon'),
									),
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Overlay header', 'loc_canon'),
									'slug' 					=> 'overlay_header',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Overlay content', 'loc_canon'),
									'slug' 					=> 'overlay_content_negative_margin',
									'min'					=> '-10000',						// optional
									'max'					=> '0',								// optional
									'step'					=> '1',								// optional
									'width_px'				=> '80',							// optional
									'postfix'				=> __('(pixels)', 'loc_canon'),
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Responsive overlay header', 'loc_canon'),
									'slug' 					=> 'overlay_header_turn_off_width',
									'select_options'		=> array(
										'0'					=> __('Overlay header stays the same', 'loc_canon'),
										'768'				=> __('Turn off @ viewport width below 768px', 'loc_canon'),
										'600'				=> __('Turn off @ viewport width below 600px', 'loc_canon'),
										'480'				=> __('Turn off @ viewport width below 480px', 'loc_canon'),
									),
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Responsive overlay content', 'loc_canon'),
									'slug' 					=> 'overlay_content_turn_off_width',
									'select_options'		=> array(
										'0'					=> __('Overlay content stays the same', 'loc_canon'),
										'768'				=> __('Turn off @ viewport width below 768px', 'loc_canon'),
										'600'				=> __('Turn off @ viewport width below 600px', 'loc_canon'),
										'480'				=> __('Turn off @ viewport width below 480px', 'loc_canon'),
									),
									'options_name'			=> 'canon_options',
								)); 

							 ?>		

						</table>

					<!-- 
					--------------------------------------------------------------------------
						IMAGE SIZES
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Cropped image sizes", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('Cropped image sizes', 'loc_canon'),
									'content' 				=> array(
										__('Some images in this theme are cropped to a certain size and aspect ratio to make sure the image fits within the design of the theme. For example an even grid layout is dependent on featured images all being the same size or else a single image can break the even layout.', 'loc_canon'),
										__('You can change the width and height of the cropped images in this section. Remember that after each change you have to regenerate all your images. Regenerating your images/thumbnails does not change the original image - it simply creates new copies of that image with the sizes you have set. To regenerate your images you can use a plugin such as the "Regenerate Thumbnails" plugin.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('High definition sizes', 'loc_canon'),
									'content' 				=> array(
										__('If you require your site to be HD ready make sure your cropped images sizes are at least double the size of what is actually displayed. If for example you have a Related Posts Carousel that displays featured images at a size of 234x140 pixels and you want those images to be HD ready the images have to be cropped to at least (double) 468x280 pixels.', 'loc_canon'),
										__('Larger images take longer to load so if HD is not a requirement or if you are using images that are simply not large enough to support HD it is better to crop directly to the displayed size of 234x140 pixels.', 'loc_canon'),
										__('Do notice that depending on responsive state (viewport size) an image that in desktop mode is 234x140 pixels can sometimes change size and become larger. Remember to take this into account when deciding on a crop size.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('Aspect ratios', 'loc_canon'),
									'content' 				=> array(
										__('The aspect ratio is the ratio of the width to the height of an image. So an image that has a width of 600 pixels and a height of 400 pixels will have an aspect ratio of (600/400) 1.5 (1.5:1) When deciding on a crop size it is best to try and maintain the original aspect ratio. Changing the aspect ratio of a cropped image could have unexpected results on design. We can only guarantee a correct design with the default sizes and aspect ratios. Changing sizes and aspect ratios could require further customizations to adapt design to different image sizes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('Most common user case', 'loc_canon'),
									'content' 				=> array(
										__('The most common reason why users change crop sizes is because the default values require images larger than what they have available. In that case they should reduce the sizes but maintain the aspect ratio. An easy way to do this is simply to halve the size values. Notice that reducing the crop sizes could result in images not being HD ready and therefore they could appear pixelated on some HD devices.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('Q&A: What size image should I use?', 'loc_canon'),
									'content' 				=> array(
										__('WordPress can only crop images to a smaller size. So your image has to be larger than the desired crop size. A quick way to estimate how large your images need to be is to look at the list of cropped image sizes and make sure your images are larger than the largest crop size on the list. If you have a lot of images that are smaller than this you should consider setting smaller crop sizes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('Q&A: What size image should I use for images not on the cropped images list?', 'loc_canon'),
									'content' 				=> array(
										__('Our theme uses a lot of images that are not cropped. These images will be loaded in full and will fit to the spot they are placed in while maintaining their original aspect ratio. Most sizes can be used for these images and it is not possible to define an optimal size as this depends on each user case. In general try to use large images that have been opmitized for web. If you image appears pixelated it is probably too small. ', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> __('Troubleshoot: My images are not cropped correctly? The sizes look all wrong!', 'loc_canon'),
									'content' 				=> array(
										__('The number one reason for this is trying to use images that are too small. WordPress can only crop images to a smaller size so if your image is smaller than the crop size WordPress will not crop your image to the correct size and aspect ratio and this will often break the design. To fix this either use larger images or reduce the cropped image size.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php

								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Related posts carousel', 'loc_canon'),
									'slug' 					=> 'canon_post_component_carousel',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Featured post grid (6 items wide)', 'loc_canon'),
									'slug' 					=> 'canon_block_post_grid_6wide',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Featured post grid (3 items wide)', 'loc_canon'),
									'slug' 					=> 'canon_block_post_grid_3wide',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Featured post grid (6 items tall)', 'loc_canon'),
									'slug' 					=> 'canon_block_post_grid_6tall',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Featured block carousel', 'loc_canon'),
									'slug' 					=> 'canon_block_carousel',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Even grid featured image', 'loc_canon'),
									'slug' 					=> 'canon_even_grid',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Gallery post format landscape thumb', 'loc_canon'),
									'slug' 					=> 'canon_grid_gallery_landscape',
									'options_name'			=> 'canon_options',
								)); 
								
								fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> __('Gallery post format portrait thumb', 'loc_canon'),
									'slug' 					=> 'canon_grid_gallery_portrait',
									'options_name'			=> 'canon_options',
								)); 
								
							 ?>		


						</table>


					<!-- 
					--------------------------------------------------------------------------
						MAIN SEARCH AUTOCOMPLETE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Main Search Autocomplete", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search words', 'loc_canon'),
									'content' 				=> array(
										__('When typing a search term in the main search box the autocomplete function will make search suggestions.', 'loc_canon'),
										__('Enter words or phrases to give as search suggestions. Separate terms with a comma.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Suggest these words', 'loc_canon'),
									'slug' 					=> 'autocomplete_words',
									'rows'					=> '5',
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						COMPATIBILITY
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Compatibility", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Suppress theme meta description', 'loc_canon'),
									'content' 				=> array(
										__('If using a 3rd party SEO plugin the theme meta description can sometimes interfere with the plugin meta description.', 'loc_canon'),
										__('Use this option to suppress the theme meta description and use the plugin meta description instead.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Suppress theme Open Graph data', 'loc_canon'),
									'content' 				=> array(
										__('Open Graph is a protocol used by Facebook to gather information about your site that can be utilized when sharing content on Facebook.', 'loc_canon'),
										__('If using a 3rd party SEO plugin the theme Open Graph data can sometimes interfere with the plugin Open Graph data.', 'loc_canon'),
										__('Use this option to suppress the theme Open Graph data and use the plugin Open Graph data instead.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Chrome/Safari @font-face fix', 'loc_canon'),
									'content' 				=> array(
										__('On some server configurations a known bug in Chrome and Safari can prevent the rendering of serverside @font-face fonts leaving a page blank except for images and other non-text media. If your site experiences this bug make sure you turn on the Chrome/Safari @font-face fix.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Suppress theme meta description', 'loc_canon'),
									'slug' 					=> 'hide_theme_meta_description',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Suppress theme Open Graph data', 'loc_canon'),
									'slug' 					=> 'hide_theme_og',
									'options_name'			=> 'canon_options',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Chrome/Safari @font-face fix', 'loc_canon'),
									'slug' 					=> 'fontface_fix',
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>




					<?php submit_button(); ?>


				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

