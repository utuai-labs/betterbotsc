	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s Settings - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Header & Footer", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_frame');
			$canon_options_frame = get_option('canon_options_frame'); 
			$canon_options_advanced = get_option('canon_options_advanced'); 

			// GET CAT LIST
			$cat_list = get_categories(array('hide_empty' => 0));
			$cat_list = array_values($cat_list);

			// SUGGEST INSTAGRAM USER ID
			if ( empty($canon_options_frame['block_instagram_carousel_user_id']) && !empty($canon_options_advanced['oauth_instagram']) ) {
					$canon_options_advanced['oauth_instagram'] = @unserialize(base64_decode($canon_options_advanced['oauth_instagram']));
					$canon_options_frame['block_instagram_carousel_user_id'] = $canon_options_advanced['oauth_instagram']['user']['id'];
					update_option('canon_options_frame', $canon_options_frame);
					$canon_options_frame = get_option('canon_options_frame'); 
			}

			// var_dump($canon_options_frame);
		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_frame'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_frame'); ?>		


					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						HEADER BUILDER
						HOMEPAGE FEATURE BUILDER
						FOOTER BUILDER
						HEADER: GENERAL
						MAIN HEADER ADJUSTMENTS
						PRE-FOOTER ADJUSTMENTS
						ELEMENT: LOGO
						ELEMENT: AUXILIARY LOGO
						ELEMENT: HEADER IMAGE
						ELEMENT: BANNER
						ELEMENT: HEADER TEXT
						ELEMENT: FOOTER TEXT
						ELEMENT: SOCIAL LINKS 
						ELEMENT: TOOLBAR
						ELEMENT: COUNTDOWN
						BLOCK: POST GRID
						BLOCK: SLIDER
						BLOCK: CAROUSEL
						BLOCK: INSTAGRAM CAROUSEL
						BLOCK: WIDGETS
						BLOCK: SEARCH

					-->


					<!-- 
					--------------------------------------------------------------------------
						HEADER BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php _e("Header Builder", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header builder', 'loc_canon'),
									'content' 				=> array(
										__('Build your own header. Select elements for each header section using the selects. Settings for each element can be found below.', 'loc_canon'),
										__('Notice that some elements are only available for certain spots e.g. logo which can only be placed in the main header etc.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Available elements', 'loc_canon'),
									'content' 				=> array(
										__('Primary menu.', 'loc_canon'),
										__('Secondary menu', 'loc_canon'),
										__('Logo', 'loc_canon'),
										__('Header image.', 'loc_canon'),
										__('Social icons', 'loc_canon'),
										__('Text', 'loc_canon'),
										__('Toolbar (search button)', 'loc_canon'),
										__('Ad banner', 'loc_canon'),
										__('Countdown', 'loc_canon'),
										__('Breadcrumbs', 'loc_canon'),
									),
								)); 


							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- PRE HEADER -->

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pre-header', 'loc_canon'),
									'slug' 					=> 'header_pre_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'									=> __('Off', 'loc_canon'),
										'header_pre_custom_center'				=> __('Custom Center', 'loc_canon'),
										'header_pre_custom_left_right'			=> __('Custom Left + Right', 'loc_canon'),
										'header_pre_image'						=> __('Image header', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- PRE HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_pre_layout" data-listen_for="header_pre_custom_center">
								<th></th>
								<td colspan="2">

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- PRE HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_pre_layout" data-listen_for="header_pre_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>


						<!-- MAIN HEADER -->

							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Main header', 'loc_canon'),
									'slug' 					=> 'header_main_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'header_main_custom_center'			=> __('Custom Center', 'loc_canon'),
										'header_main_custom_left_right'		=> __('Custom Left + Right', 'loc_canon'),
										'header_main_image'					=> __('Image header', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- MAIN HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_main_layout" data-listen_for="header_main_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'aux_logo'				=> __('Auxiliary logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'banner'				=> __('Ad banner', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>
					
							</tr>

						<!-- MAIN HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_main_layout" data-listen_for="header_main_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'aux_logo'				=> __('Auxiliary logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'banner'				=> __('Ad banner', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'aux_logo'				=> __('Auxiliary logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'banner'				=> __('Ad banner', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						<!-- POST HEADER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Post-header', 'loc_canon'),
									'slug' 					=> 'header_post_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'header_post_custom_center'		=> __('Custom Center', 'loc_canon'),
										'header_post_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_post_layout" data-listen_for="header_post_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- POST HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_post_layout" data-listen_for="header_post_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						HOMEPAGE FEATURE BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php _e("Homepage Feature Builder", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Homepage feature', 'loc_canon'),
									'content' 				=> array(
										__('Select what feature block to use as homepage feature. Will appear at the top of the homepage. Off for no feature. Settings for each feature block can be found below.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- HOMEPAGE FEATURE -->

							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Homepage feature', 'loc_canon'),
									'slug' 					=> 'homepage_feature_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'block_carousel'				=> __('Carousel', 'loc_canon'),
										'block_instagram_carousel'		=> __('Instagram Carousel', 'loc_canon'),
										'block_post_grid'				=> __('Post Grid', 'loc_canon'),
										'block_slider'					=> __('Slider', 'loc_canon'),
										'block_widgets'					=> __('Widgets', 'loc_canon'),
										'block_search'					=> __('Search', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						FOOTER BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php _e("Footer Builder", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Footer builder', 'loc_canon'),
									'content' 				=> array(
										__('Build your own footer. Select elements for each footer section using the selects. Settings for each element can be found below.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- PRE FOOTER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pre-footer', 'loc_canon'),
									'slug' 					=> 'footer_pre_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'footer_pre_custom_center'		=> __('Custom Center', 'loc_canon'),
										'footer_pre_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- PRE FOOTER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#footer_pre_layout" data-listen_for="footer_pre_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'aux_logo'				=> __('Auxiliary logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- PRE FOOTER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#footer_pre_layout" data-listen_for="footer_pre_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'aux_logo'				=> __('Auxiliary logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'logo'					=> __('Logo', 'loc_canon'),
												'aux_logo'				=> __('Auxiliary logo', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>


						<!-- MAIN FOOTER -->

							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Main footer', 'loc_canon'),
									'slug' 					=> 'footer_main_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'block_carousel'				=> __('Carousel', 'loc_canon'),
										'block_instagram_carousel'		=> __('Instagram Carousel', 'loc_canon'),
										'block_post_grid'				=> __('Post Grid', 'loc_canon'),
										'block_slider'					=> __('Slider', 'loc_canon'),
										'block_widgets'					=> __('Widgets', 'loc_canon'),
										'block_search'					=> __('Search', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						<!-- POST FOOTER -->

							<?php							
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Post-footer', 'loc_canon'),
									'slug' 					=> 'footer_post_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> __('Off', 'loc_canon'),
										'footer_post_custom_center'		=> __('Custom Center', 'loc_canon'),
										'footer_post_custom_left_right'	=> __('Custom Left + Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST FOOTER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#footer_post_layout" data-listen_for="footer_post_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_center',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- POST FOOTER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#footer_post_layout" data-listen_for="footer_post_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_left',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_right',
											'select_options'		=> array(
												'off'					=> __('Off', 'loc_canon'),
												'primary'				=> __('Primary Menu', 'loc_canon'),
												'secondary'				=> __('Secondary Menu', 'loc_canon'),
												'social'				=> __('Social Icons', 'loc_canon'),
												'header_text'			=> __('Header Text', 'loc_canon'),
												'footer_text'			=> __('Footer Text', 'loc_canon'),
												'toolbar'				=> __('Toolbar', 'loc_canon'),
												'countdown'				=> __('Countdown', 'loc_canon'),
												'breadcrumbs'			=> __('Breadcrumbs', 'loc_canon'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						</table>

					
					<!-- HORIZONTAL DIVIDER -->
					<br><hr><br>


					<!-- 
					--------------------------------------------------------------------------
						HEADER: GENERAL
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header: General Settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sticky headers', 'loc_canon'),
									'content' 				=> array(
										__('Make the headers stick to the top of the page when scrolling down.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header opacity', 'loc_canon'),
									'content' 				=> array(
										__('Set the opacity of each header section. Values must be between 0 and 1. 0 is completely transparent. 1 is completely solid/opaque.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Stickyness in responsive mode', 'loc_canon'),
									'content' 				=> array(
										__('Turn off stickyness in responsive mode. Choose the viewport size under which stickyness will be disabled. The optimal setting depends on your content. If you have many sticky elements or tall sticky elements you might want to turn off stickyness at a higher viewport size to avoid the sticky elements taking up the whole viewport.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Add search button to primary or secondary menu', 'loc_canon'),
									'content' 				=> array(
										__('Select this to put a search button at the end of your primary or secondary menu', 'loc_canon'),
									),
								)); 

							 ?>		


						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky pre-header', 'loc_canon'),
									'slug' 					=> 'use_sticky_preheader',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky main header', 'loc_canon'),
									'slug' 					=> 'use_sticky_header',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Sticky post-header', 'loc_canon'),
									'slug' 					=> 'use_sticky_postheader',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Pre-header opacity', 'loc_canon'),
									'slug' 					=> 'preheader_opacity',
									'min'					=> '0',										// optional
									'max'					=> '1',										// optional
									'step'					=> '0.05',									// optional
									'width_px'				=> '60',									// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Main header opacity', 'loc_canon'),
									'slug' 					=> 'header_opacity',
									'min'					=> '0',										// optional
									'max'					=> '1',										// optional
									'step'					=> '0.05',									// optional
									'width_px'				=> '60',									// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Post-header opacity', 'loc_canon'),
									'slug' 					=> 'postheader_opacity',
									'min'					=> '0',										// optional
									'max'					=> '1',										// optional
									'step'					=> '0.05',									// optional
									'width_px'				=> '60',									// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Stickyness in responsive mode', 'loc_canon'),
									'slug' 					=> 'sticky_turn_off_width',
									'select_options'		=> array(
										'0'					=> __('Stickyness is always on', 'loc_canon'),
										'768'				=> __('Turn off @ viewport width below 768px', 'loc_canon'),
										'600'				=> __('Turn off @ viewport width below 600px', 'loc_canon'),
										'480'				=> __('Turn off @ viewport width below 480px', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Add search button to primary menu', 'loc_canon'),
									'slug' 					=> 'add_search_btn_to_primary',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Add search button to secondary menu', 'loc_canon'),
									'slug' 					=> 'add_search_btn_to_secondary',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						MAIN HEADER ADJUSTMENTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Main Header Adjustments", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Padding top & Padding bottom', 'loc_canon'),
									'content' 				=> array(
										__('Used to position your header elements.', 'loc_canon'),
										__('Increase padding top to create space above the header elements.', 'loc_canon'),
										__('Increase padding bottom to create space below the header elements.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust left element relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the left element position. Values are pixels from top-left.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust right element relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the right element position. Values are pixels from top-right.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table header-layout'>

							<?php 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header padding top', 'loc_canon'),
									'slug' 					=> 'header_padding_top',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header padding bottom', 'loc_canon'),
									'slug' 					=> 'header_padding_bottom',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							 ?>		


							<tr valign='top'>
								<th scope='row'><?php _e("Adjust left element relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_left_element_top' 
										name='canon_options_frame[pos_left_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_left_element_top'])) echo esc_attr($canon_options_frame['pos_left_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_left_element_left' 
										name='canon_options_frame[pos_left_element_left]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_left_element_left'])) echo esc_attr($canon_options_frame['pos_left_element_left']); ?>'
									> <i>(pixels from left)</i>
								</td> 
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Adjust right element relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_right_element_top' 
										name='canon_options_frame[pos_right_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_right_element_top'])) echo esc_attr($canon_options_frame['pos_right_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_right_element_right' 
										name='canon_options_frame[pos_right_element_right]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_right_element_right'])) echo esc_attr($canon_options_frame['pos_right_element_right']); ?>'
									> <i>(pixels from right)</i>
								</td> 
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						PRE-FOOTER ADJUSTMENTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Pre-footer Adjustments", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Padding top & Padding bottom', 'loc_canon'),
									'content' 				=> array(
										__('Used to position your pre-footer elements.', 'loc_canon'),
										__('Increase padding top to create space above the pre-footer elements.', 'loc_canon'),
										__('Increase padding bottom to create space below the pre-footer elements.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust left element relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the left element position. Values are pixels from top-left.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Adjust right element relative position', 'loc_canon'),
									'content' 				=> array(
										__('You can fine adjust the right element position. Values are pixels from top-right.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table header-layout'>

							<?php 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Pre-footer padding top', 'loc_canon'),
									'slug' 					=> 'prefooter_padding_top',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Pre-footer padding bottom', 'loc_canon'),
									'slug' 					=> 'prefooter_padding_bottom',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							 ?>		


							<tr valign='top'>
								<th scope='row'><?php _e("Adjust left element relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='prefooter_pos_left_element_top' 
										name='canon_options_frame[prefooter_pos_left_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_left_element_top'])) echo esc_attr($canon_options_frame['prefooter_pos_left_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='prefooter_pos_left_element_left' 
										name='canon_options_frame[prefooter_pos_left_element_left]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_left_element_left'])) echo esc_attr($canon_options_frame['prefooter_pos_left_element_left']); ?>'
									> <i>(pixels from left)</i>
								</td> 
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Adjust right element relative position", "loc_canon"); ?></th>
								<td>
									<input 
										type='number' 
										id='prefooter_pos_right_element_top' 
										name='canon_options_frame[prefooter_pos_right_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_right_element_top'])) echo esc_attr($canon_options_frame['prefooter_pos_right_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='prefooter_pos_right_element_right' 
										name='canon_options_frame[prefooter_pos_right_element_right]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_right_element_right'])) echo esc_attr($canon_options_frame['prefooter_pos_right_element_right']); ?>'
									> <i>(pixels from right)</i>
								</td> 
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: LOGO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Logo", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('General logo hierarchy', 'loc_canon'),
									'content' 				=> array(
										__('by default the theme logo will be displayed', 'loc_canon'),
										__('if you enter a logo image URL this image will be displayed instead of the theme logo.', 'loc_canon'),
										__('if you enter text as logo this text will be displayed instead of any custom logo image and instead of the theme logo.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Logo URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use as logo" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as logo" button.', 'loc_canon'),
										__('If you leave the URL text field empty the default logo will be displayed.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Logo max width', 'loc_canon'),
									'content' 				=> array(
										__('You can control the size of your logo by setting the maximum allowed width of your logo image.', 'loc_canon'),
										__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use text as logo', 'loc_canon'),
									'content' 				=> array(
										__('This text will be displayed instead of any logo image. You can select font for logo text by going to Appearance > Google Webfonts > Logo text.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Append tagline to text logo', 'loc_canon'),
									'content' 				=> array(
										__('Appends the blog tagline to the the text logo. Blog tagline/description can be set in (WordPress) Settings > General > Tagline', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Text as logo size', 'loc_canon'),
									'content' 				=> array(
										__('If using text as logo this option lets you set a font size.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Tagline size', 'loc_canon'),
									'content' 				=> array(
										__('Tagline font size.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									 <br>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Logo Preview", "loc_canon"); ?></th>
								<td>
									<?php 

				                        if (!empty($canon_options_frame['logo_url'])) {
				                            $logo_url = $canon_options_frame['logo_url'];
				                        } else {
				                            $logo_url = get_template_directory_uri() .'/img/logo@2x.png';
				                        }
				                        $logo_size = getimagesize($logo_url);
				                        if (!empty($canon_options_frame['logo_max_width'])) {
					                        $compression_ratio = $logo_size[0] / (int) $canon_options_frame['logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="thelogo" width="<?php if (!empty($canon_options_frame['logo_max_width'])) echo esc_attr($canon_options_frame['logo_max_width']); ?>" src="<?php echo esc_url($logo_url); ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", __("Original size: Width: ", "loc_canon"), esc_attr($logo_size[0]), __("pixels, height: ", "loc_canon") , esc_attr($logo_size[1]), __(" pixels", "loc_canon")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>",__("Resized to max width: ", "loc_canon") , esc_attr($canon_options_frame['logo_max_width']), __("pixels. Compression ratio: ", "loc_canon"), esc_attr($compression_ratio)); ?><br>
									<br><br>
								</td>
							</tr>

							<?php 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Logo URL', 'loc_canon'),
									'slug' 					=> 'logo_url',
									'btn_text'				=> 'Upload logo',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Logo max width (size)', 'loc_canon'),
									'slug' 					=> 'logo_max_width',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Use text as logo', 'loc_canon'),
									'slug' 					=> 'logo_text',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Append tagline to text logo', 'loc_canon'),
									'slug' 					=> 'logo_text_append_tagline',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Text as logo size', 'loc_canon'),
									'slug' 					=> 'logo_text_size',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Tagline size', 'loc_canon'),
									'slug' 					=> 'tagline_text_size',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: AUXILIARY LOGO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Auxiliary logo", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Auxiliary logo', 'loc_canon'),
									'content' 				=> array(
										__('The auxiliary logo lets you display a second logo. Notice that it does not have the same options as the main logo to display text as logo.', 'loc_canon'),
										__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc_canon'),
									),
								)); 


								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Logo URL', 'loc_canon'),
									'content' 				=> array(
										__('Enter a complete URL to the image you want to use or', 'loc_canon'),
										__('Click the "Upload" button, upload an image and make sure you click the "Use as logo" button or', 'loc_canon'),
										__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as logo" button.', 'loc_canon'),
										__('If you leave the URL text field empty the default logo will be displayed.', 'loc_canon'),
										__('Remember to save your changes.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Logo max width', 'loc_canon'),
									'content' 				=> array(
										__('You can control the size of your logo by setting the maximum allowed width of your logo image.', 'loc_canon'),
										__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									 <br>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'><?php _e("Aux. logo Preview", "loc_canon"); ?></th>
								<td>
									<?php 

				                        if (!empty($canon_options_frame['aux_logo_url'])) {
				                            $aux_logo_url = $canon_options_frame['aux_logo_url'];
				                        } else {
				                            $aux_logo_url = get_template_directory_uri() .'/img/logo@2x-dark.png';
				                        }
				                        $aux_logo_size = getimagesize($aux_logo_url);
				                        if (!empty($canon_options_frame['aux_logo_max_width'])) {
					                        $compression_ratio = $aux_logo_size[0] / (int) $canon_options_frame['aux_logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="aux-logo" width="<?php if (!empty($canon_options_frame['aux_logo_max_width'])) echo esc_attr($canon_options_frame['aux_logo_max_width']); ?>" src="<?php echo esc_url($aux_logo_url); ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", __("Original size: Width: ", "loc_canon"), esc_attr($aux_logo_size[0]), __("pixels, height: ", "loc_canon") , esc_attr($aux_logo_size[1]), __(" pixels", "loc_canon")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>",__("Resized to max width: ", "loc_canon") , esc_attr($canon_options_frame['aux_logo_max_width']), __("pixels. Compression ratio: ", "loc_canon"), esc_attr($compression_ratio)); ?><br>
									<br><br>
								</td>
							</tr>

							<?php 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Aux. logo URL', 'loc_canon'),
									'slug' 					=> 'aux_logo_url',
									'btn_text'				=> 'Upload logo',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Aux. logo max width (size)', 'loc_canon'),
									'slug' 					=> 'aux_logo_max_width',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: HEADER IMAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Image", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show only on homepage', 'loc_canon'),
									'content' 				=> array(
										__('The header image will only be displayed on the homepage.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image URL', 'loc_canon'),
									'content' 				=> array(
										__('Insert URL to use as header image or click Select Image button to choose from media library.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background color', 'loc_canon'),
									'content' 				=> array(
										__('Set header image background color. Useful when using transparent image files.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header height', 'loc_canon'),
									'content' 				=> array(
										__('Set header image height', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Parallax amount', 'loc_canon'),
									'content' 				=> array(
										__('Select how much of a parallax effect you want.', 'loc_canon'),
										__('Set at 0% to turn parallax off completely - the image will scroll along with the rest of the page.', 'loc_canon'),
										__('Set at 100% for maximum parallax effect - the image stays fixed as the page scrolls by.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image text', 'loc_canon'),
									'content' 				=> array(
										__('Text to display over header image.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Image text top margin', 'loc_canon'),
									'content' 				=> array(
										__('Increase number to position text further down.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show only on homepage', 'loc_canon'),
									'slug' 					=> 'header_img_homepage_only',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Image URL', 'loc_canon'),
									'slug' 					=> 'header_img_url',
									'btn_text'				=> __('Select Image', 'loc_canon'),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Background color', 'loc_canon'),
									'slug' 					=> 'header_img_bg_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Header height', 'loc_canon'),
									'slug' 					=> 'header_img_height',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Parallax amount', 'loc_canon'),
									'slug' 					=> 'header_img_parallax_amount',
									'min'					=> '0',
									'max'					=> '100',
									'step'					=> '1',
									'postfix'				=> '<i>%</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Image text', 'loc_canon'),
									'slug' 					=> 'header_img_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Image text alignment', 'loc_canon'),
									'slug' 					=> 'header_img_text_alignment',
									'select_options'		=> array(
										'centered'			=> __('Center', 'loc_canon'),
										'left'				=> __('Left', 'loc_canon'),
										'right'				=> __('Right', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Image text top margin', 'loc_canon'),
									'slug' 					=> 'header_img_text_margin_top',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: BANNER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Ad Banner", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Ad Code', 'loc_canon'),
									'content' 				=> array(
										__('Insert your ad code or ad HTML here. If you are unsure what code to use you should consult your ad provider.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Ad code', 'loc_canon'),
									'slug' 					=> 'banner_code',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: HEADER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Header Text", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Header text', 'loc_canon'),
									'content' 				=> array(
										__('Text to display in header. Can contain HTML.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Header text', 'loc_canon'),
									'slug' 					=> 'header_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: FOOTER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Footer Text", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Footer text', 'loc_canon'),
									'content' 				=> array(
										__('Text to display in footer. Can contain HTML.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Footer text', 'loc_canon'),
									'slug' 					=> 'footer_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: SOCIAL LINKS 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Social Links", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Open links in new window', 'loc_canon'),
									'content' 				=> array(
										__('Choose if social links should open in a new window.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Social links', 'loc_canon'),
									'content' 				=> array(
										__('Choose an icon in the select and attach this to a social link.', 'loc_canon'),
										__('Make sure you put the whole URL to your social site in the text input.', 'loc_canon'),
										__('You can add a new social link to the end of the list by clicking "Add social link', 'loc_canon'),
										__('You can remove social links by clicking "Delete".', 'loc_canon'),
										__('You can see a full list of the Font Awesome icons <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a>.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table social_links'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Open links in new window', 'loc_canon'),
									'slug' 					=> 'social_in_new',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

							<?php 
							if (isset($canon_options_frame['social_links'])) {

								$font_awesome_array = mb_get_font_awesome_icon_names_in_array();
								
								// ARRAY VALUES
								$canon_options_frame['social_links'] = array_values($canon_options_frame['social_links']);
								update_option('canon_options_frame', $canon_options_frame);

								?>

								<tr valign='top' class='social_links_row'>
									<th scope='row'><?php _e("Social links", "loc_canon"); ?></th>
									<td>
										<ul class="ul_sortable"  data-split_index="2" data-placeholder="social_links_sortable_placeholder">
											<?php for ($i = 0; $i < count($canon_options_frame['social_links']); $i++) : ?>

												<li>
													<select class="social_links_icon fa_select li_option" name="canon_options_frame[social_links][<?php echo esc_attr($i); ?>][0]"> 
														<?php 

															for ($n = 0; $n < count($font_awesome_array); $n++) {  
															?>
										     					<option value="<?php echo esc_attr($font_awesome_array[$n]); ?>" <?php if (isset($canon_options_frame['social_links'][$i][0])) {if ($canon_options_frame['social_links'][$i][0] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo esc_attr($font_awesome_array[$n]); ?></option> 
															<?php
															}

														?>
													</select> 

													<i class="fa <?php if (isset($canon_options_frame['social_links'][$i][0])) { echo esc_attr($canon_options_frame['social_links'][$i][0]); } else { echo "fa-flag"; } ?>"></i>
													<input type='text' class='social_links_link li_option' name='canon_options_frame[social_links][<?php echo esc_attr($i); ?>][1]' value='<?php if (isset($canon_options_frame['social_links'][$i][1])) echo esc_url($canon_options_frame['social_links'][$i][1]); ?>'>
													<button class="button ul_del_this"><?php _e("delete", "loc_canon"); ?></button>

												</li>

											<?php endfor; ?>

										</ul>

										<div class="ul_control" data-min="1" data-max="1000">
											<input type="button" class="button ul_add" value="<?php _e("Add", "loc_canon"); ?>" />
											<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_canon"); ?>" />
										</div>

									</td>
								</tr>

								<?php

							}

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: TOOLBAR
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Toolbar", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Toolbar', 'loc_canon'),
									'content' 				=> array(
										__('Select what tools to add to the toolbar.', 'loc_canon'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search button', 'loc_canon'),
									'slug' 					=> 'toolbar_search_button',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: COUNTDOWN
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Countdown", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Countdown to', 'loc_canon'),
									'content' 				=> array(
										__('Must be in the format Month DD, YYYY HH:MM:SS e.g. December 31, 2023 23:59:59', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('GMT offset', 'loc_canon'),
									'content' 				=> array(
										__('GMT offset of your current timezone. You can search for your timezone <a href="http://www.worldtimezone.com/" target="_blank">here</a>.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Description', 'loc_canon'),
									'content' 				=> array(
										__('Countdown description. Will appear before the countdown.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>


							<?php 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Countdown to', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_datetime_string',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('GMT Offset', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_gmt_offset',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Description', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_description',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						BLOCK: POST GRID
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php _e("Feature Block: Post Grid", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>
							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Grid shows', 'loc_canon'),
									'content' 				=> array(
										__('Choose what posts to display in the post grid.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose between 3 or 6-item layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('On Load Animation', 'loc_canon'),
									'content' 				=> array(
										__('Off: No animations.', 'loc_canon'),
										__('Simple fade in: All items fade in at once.', 'loc_canon'),
										__('Sequential: Items fade in one at a time in sequential order.', 'loc_canon'),
										__('Random: Items fade in one at a time in random order.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-post-grid group-feature-block'>

							<tr valign='top'>

								<th scope='row'><?php _e("Grid shows", "loc_canon"); ?></th>
								
								<td>
								
									<select id="block_post_grid_shows" name="canon_options_frame[block_post_grid_shows]"> 

						     			<option value="latest_posts" <?php if ($canon_options_frame['block_post_grid_shows'] == "latest_posts") { echo "selected='selected'";} ?>><?php _e("Latest posts", "loc_canon"); ?></option> 
						     			<option value="random_posts" <?php if ($canon_options_frame['block_post_grid_shows'] == "random_posts") { echo "selected='selected'";} ?>><?php _e("Random posts", "loc_canon"); ?></option> 
						     			<option value="latest_posts"></option> 

						     			<option value="popular_views" <?php if ($canon_options_frame['block_post_grid_shows'] == "popular_views") { echo "selected='selected'";} ?>><?php _e("Popular posts by views", "loc_canon"); ?>	</option> 
						     			<option value="popular_likes" <?php if ($canon_options_frame['block_post_grid_shows'] == "popular_likes") { echo "selected='selected'";} ?>><?php _e("Popular posts by likes", "loc_canon"); ?>	</option> 
					 					<option value="popular_comments" <?php if ($canon_options_frame['block_post_grid_shows'] == "popular_comments") { echo "selected='selected'";} ?>><?php _e("Popular posts by comments", "loc_canon"); ?>	</option> 
						     			<option value="latest_posts"></option> 

										<?php 
											for ($i = 0; $i < count($cat_list); $i++) { 
											?>
							     				<option value="postcat_<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($canon_options_frame['block_post_grid_shows'] == "postcat_" . $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php _e("category", "loc_canon"); ?></option> 
											<?php
											}
										?>

									</select> 
								
								</td>
							
							</tr>

							<?php
								
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Layout', 'loc_canon'),
									'slug' 					=> 'block_post_grid_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'6wide'						=> __('Layout 1 (6 items wide)', 'loc_canon'),
										'3wide'						=> __('Layout 2 (3 items wide)', 'loc_canon'),
										'6tall'						=> __('Layout 3 (6 items tall)', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('On load animation', 'loc_canon'),
									'slug' 					=> 'block_post_grid_animation',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'									=> __('Off', 'loc_canon'),
										'simple'								=> __('Simple fade in', 'loc_canon'),
										'sequential'							=> __('Sequential', 'loc_canon'),
										'random'								=> __('Random', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation delay', 'loc_canon'),
									'slug' 					=> 'block_post_grid_anim_delay',
									'min'					=> '0',
									'step'					=> '10',
									'width_px'				=> '60',
									'postfix'				=> '<i>(milliseconds)</i>',
									'listen_to'				=> '#block_post_grid_animation',
									'listen_for'			=> 'simple sequential random',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Animation speed', 'loc_canon'),
									'slug' 					=> 'block_post_grid_anim_speed',
									'min'					=> '0',
									'step'					=> '10',
									'width_px'				=> '60',
									'postfix'				=> '<i>(milliseconds)</i>',
									'listen_to'				=> '#block_post_grid_animation',
									'listen_for'			=> 'simple sequential random',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>


					<!-- 
					--------------------------------------------------------------------------
						BLOCK: SLIDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php _e("Feature Block: Slider", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							The Feature Block: Slider depends on the Revolution Slider plugin so make sure that this plugin is installed and activated (the plugin comes bundled with the theme). Also make sure that you have created at least one slider.

							<br><br>

							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Select slider alias', 'loc_canon'),
									'content' 				=> array(
										__(' Select here which slider to display.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Boxed', 'loc_canon'),
									'content' 				=> array(
										__('By default the Feature Block: Slider will display a full width slider. Check the Boxed checkbox to display a slider in boxed layout instead. Remember that the Revolution Slider itself has a setting called "Force Full Width" which you must turn off to allow for boxed layout.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<?php
							
					        // HANDLE STATUS
					        if (class_exists('RevSlider')) {
						        $slider = new RevSlider();
						        $arrSliders = $slider->getAllSliderAliases();
						        if (empty($arrSliders)) { $arrSliders = array('No sliders found!'); }
					        } else {
					        	$arrSliders = array('Revolution Slider plugin not found!');	
					        }
							

						?>

						<table class='form-table block-feature group-feature-block'>

							<tr valign='top'>

								<th scope='row'><?php _e("Select slider alias", "loc_canon"); ?></th>
								
								<td>
								
									<select class='block_slider_alias' id="alias" name="canon_options_frame[block_slider_alias]"> 
									<?php 
										for ($i = 0; $i < count($arrSliders); $i++) { 
										?>
						     				<option value="<?php echo esc_attr($arrSliders[$i]); ?>" <?php if (isset($canon_options_frame['block_slider_alias'])) {if ($canon_options_frame['block_slider_alias'] == $arrSliders[$i]) echo "selected='selected'";} ?>><?php echo esc_attr($arrSliders[$i]); ?></option> 
										<?php
										}
									?>
									</select> 
								
								</td>
							
							</tr>

							<?php

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Boxed', 'loc_canon'),
									'slug' 					=> 'block_slider_boxed',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>


					<!-- 
					--------------------------------------------------------------------------
						BLOCK: CAROUSEL
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php _e("Feature Block: Carousel", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Carousel shows', 'loc_canon'),
									'content' 				=> array(
										__('Choose what posts to display in the carousel.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show featured image, title and excerpt', 'loc_canon'),
									'content' 				=> array(
										__('Use these checkboxes to select what elements to show.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of posts to display', 'loc_canon'),
									'content' 				=> array(
										__('How many posts to display at a time in the carousel.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of posts to load', 'loc_canon'),
									'content' 				=> array(
										__('How many posts to load into the carousel.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Excerpt length in approximate number of characters.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Autoplay speed', 'loc_canon'),
									'content' 				=> array(
										__('Time between each slide. Set to 0 for no autoplay.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Stop on hover', 'loc_canon'),
									'content' 				=> array(
										__('Carousel pauses when user hovers carousel with cursor.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Pagination', 'loc_canon'),
									'content' 				=> array(
										__('Show pagination. Will appear as bullets under carousel.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>

							<tr valign='top'>

								<th scope='row'><?php _e("Carousel shows", "loc_canon"); ?></th>
								
								<td>
								
									<select id="block_carousel_shows" name="canon_options_frame[block_carousel_shows]"> 

						     			<option value="latest_posts" <?php if ($canon_options_frame['block_carousel_shows'] == "latest_posts") { echo "selected='selected'";} ?>><?php _e("Latest posts", "loc_canon"); ?></option> 
						     			<option value="random_posts" <?php if ($canon_options_frame['block_carousel_shows'] == "random_posts") { echo "selected='selected'";} ?>><?php _e("Random posts", "loc_canon"); ?></option> 
						     			<option value="latest_posts"></option> 

						     			<option value="popular_views" <?php if ($canon_options_frame['block_carousel_shows'] == "popular_views") { echo "selected='selected'";} ?>><?php _e("Popular posts by views", "loc_canon"); ?>	</option> 
						     			<option value="popular_likes" <?php if ($canon_options_frame['block_carousel_shows'] == "popular_likes") { echo "selected='selected'";} ?>><?php _e("Popular posts by likes", "loc_canon"); ?>	</option> 
					 					<option value="popular_comments" <?php if ($canon_options_frame['block_carousel_shows'] == "popular_comments") { echo "selected='selected'";} ?>><?php _e("Popular posts by comments", "loc_canon"); ?>	</option> 
						     			<option value="latest_posts"></option> 

										<?php 
											for ($i = 0; $i < count($cat_list); $i++) { 
											?>
							     				<option value="postcat_<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($canon_options_frame['block_carousel_shows'] == "postcat_" . $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php _e("category", "loc_canon"); ?></option> 
											<?php
											}
										?>

									</select> 
								
								</td>
							
							</tr>

							<?php

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show featured image', 'loc_canon'),
									'slug' 					=> 'block_carousel_show_featured_image',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show title', 'loc_canon'),
									'slug' 					=> 'block_carousel_show_title',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show excerpt', 'loc_canon'),
									'slug' 					=> 'block_carousel_show_excerpt',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Number of posts to display', 'loc_canon'),
									'slug' 					=> 'block_carousel_display_num_posts',
									'min'					=> '2',
									'max'					=> '6',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Number of posts to load', 'loc_canon'),
									'slug' 					=> 'block_carousel_num_posts',
									'min'					=> '1',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'block_carousel_excerpt_length',
									'min'					=> '1',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Autoplay speed', 'loc_canon'),
									'slug' 					=> 'block_carousel_autoplay_speed',
									'min'					=> '0',
									'step'					=> '100',
									'postfix'				=> '<i>(milliseconds - 0 to turn autoplay off)</i>',						// optional
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Stop on hover', 'loc_canon'),
									'slug' 					=> 'block_carousel_stop_on_hover',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Pagination', 'loc_canon'),
									'slug' 					=> 'block_carousel_pagination',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>



					<!-- 
					--------------------------------------------------------------------------
						BLOCK: INSTAGRAM CAROUSEL
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php _e("Feature Block: Instagram Carousel", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Carousel shows', 'loc_canon'),
									'content' 				=> array(
										__('Choose what images to display in the carousel.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('User ID', 'loc_canon'),
									'content' 				=> array(
										__('If Carousel shows is set to Recent media then get recent media from this User ID. If you have succesfully authenticated your site with Instagram your own User ID will display here as default. You can use services such as <a href="http://www.otzberg.net/iguserid/" target="_blank">http://www.otzberg.net/iguserid/</a> to look up user id if you know the user name.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Hashtag', 'loc_canon'),
									'content' 				=> array(
										__('If Carousel shows is set to Media with hashtag then get recent media with this hashtag. Just write a single word like "food" - do not append the # symbol.', 'loc_canon'),
									),
								)); 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of images to display', 'loc_canon'),
									'content' 				=> array(
										__('How many images to display at a time in the carousel.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of images to load', 'loc_canon'),
									'content' 				=> array(
										__('How many images to load into the carousel.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Excerpt length in approximate number of characters.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Autoplay speed', 'loc_canon'),
									'content' 				=> array(
										__('Time between each slide. Set to 0 for no autoplay.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Stop on hover', 'loc_canon'),
									'content' 				=> array(
										__('Carousel pauses when user hovers carousel with cursor.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Pagination', 'loc_canon'),
									'content' 				=> array(
										__('Show pagination. Will appear as bullets under carousel.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>


							<?php

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Carousel shows', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_shows',
									'colspan'				=> 2,
									'select_options'		=> array(
										'recent'								=> __('Recent media', 'loc_canon'),
										'hashtag'								=> __('Media with hashtag', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('User ID', 'loc_canon'),
									'class'					=> 'widefat',
									'listen_to'				=> '#block_instagram_carousel_shows',
									'listen_for'			=> 'recent',
									'slug' 					=> 'block_instagram_carousel_user_id',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Hashtag', 'loc_canon'),
									'class'					=> 'widefat',
									'listen_to'				=> '#block_instagram_carousel_shows',
									'listen_for'			=> 'hashtag',
									'slug' 					=> 'block_instagram_carousel_tag',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Number of images to display', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_display_num_posts',
									'min'					=> '2',
									'max'					=> '8',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Number of images to load', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_num_posts',
									'min'					=> '1',
									'max'					=> '20',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_excerpt_length',
									'min'					=> '1',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Autoplay speed', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_autoplay_speed',
									'min'					=> '0',
									'step'					=> '100',
									'postfix'				=> '<i>(milliseconds - 0 to turn autoplay off)</i>',						// optional
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Stop on hover', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_stop_on_hover',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Pagination', 'loc_canon'),
									'slug' 					=> 'block_instagram_carousel_pagination',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>

					<!-- 
					--------------------------------------------------------------------------
						BLOCK: WIDGETS
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php _e("Feature Block: Widgets", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Boxed', 'loc_canon'),
									'content' 				=> array(
										__('Select this to contain widgets within a boxed width. If unchecked widgets will try to span the full width of the page.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>

							<?php

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Boxed', 'loc_canon'),
									'slug' 					=> 'block_widgets_boxed',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						BLOCK: SEARCH
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php _e("Feature Block: Search", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background image URL', 'loc_canon'),
									'content' 				=> array(
										__('Insert URL to use as background image or click Select Image button to choose from media library.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background color', 'loc_canon'),
									'content' 				=> array(
										__('Set background color. Useful when using transparent image files or for solid color blocks.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Text color', 'loc_canon'),
									'content' 				=> array(
										__('Set text color.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background-attachment', 'loc_canon'),
									'content' 				=> array(
										__('Setting background-attachment to scroll will make the background image scroll along with the rest of the page. Fixed will make the background image stay in place for a parallax style effect.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Background-size', 'loc_canon'),
									'content' 				=> array(
										__('Set to auto the background image will retain its original width and height. With background-size set to cover the background image will be as large as possible while still maintaining its original aspect ratio.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search block height', 'loc_canon'),
									'content' 				=> array(
										__('Set the height of the search block.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Content top margin', 'loc_canon'),
									'content' 				=> array(
										__('Top margin applied to content (text, search field etc.) Use this for placing the content within the block.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Text/HTML', 'loc_canon'),
									'content' 				=> array(
										__('Insert text/HTML here. Notice that only standard HTML tags are allowed by default.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search field placeholder text', 'loc_canon'),
									'content' 				=> array(
										__('Placeholder text for the search input field.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search button text', 'loc_canon'),
									'content' 				=> array(
										__('Text on the search button.', 'loc_canon'),
									),
								)); 


							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>

							<?php

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Background image URL', 'loc_canon'),
									'slug' 					=> 'block_search_bg_img_url',
									'btn_text'				=> __('Select Image', 'loc_canon'),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Background color', 'loc_canon'),
									'slug' 					=> 'block_search_bg_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								fw_option(array(
									'type'					=> 'color',
									'title' 				=> __('Text color', 'loc_canon'),
									'slug' 					=> 'block_search_text_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Background-attachment', 'loc_canon'),
									'slug' 					=> 'block_search_bg_attachment',
									'colspan'				=> 2,
									'select_options'		=> array(
										'scroll'				=> __('Scroll', 'loc_canon'),
										'fixed'					=> __('Fixed', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Background-size', 'loc_canon'),
									'slug' 					=> 'block_search_bg_size',
									'colspan'				=> 2,
									'select_options'		=> array(
										'auto'					=> __('Auto', 'loc_canon'),
										'cover'					=> __('Cover', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Search block height', 'loc_canon'),
									'slug' 					=> 'block_search_block_height',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Content top margin', 'loc_canon'),
									'slug' 					=> 'block_search_content_top_margin',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Text/HTML', 'loc_canon'),
									'slug' 					=> 'block_search_html',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Search field placeholder text', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'block_search_placeholder',
									'options_name'			=> 'canon_options_frame',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Search button text', 'loc_canon'),
									'class'					=> 'widefat',
									'slug' 					=> 'block_search_btn_text',
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

							<tr valign='top'>

								<th scope='row'><?php _e("Search in", "loc_canon"); ?></th>
								
								<td>
								
									<select id="block_search_in" name="canon_options_frame[block_search_in]"> 

						     			<option value="all_categories" <?php if ($canon_options_frame['block_search_in'] == "all_categories") { echo "selected='selected'";} ?>><?php _e("All categories", "loc_canon"); ?></option> 

						     			<option value="all_categories"></option> 

										<?php 
											for ($i = 0; $i < count($cat_list); $i++) { 
											?>
							     				<option value="<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($canon_options_frame['block_search_in'] == $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php _e("category", "loc_canon"); ?></option> 
											<?php
											}
										?>

									</select> 
								
								</td>
							
							</tr>

						</table>







					<!-- BOTTOM OF PAGE -->						
					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

