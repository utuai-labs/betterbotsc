	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s Settings - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Advanced", "loc_canon")) ); ?></h2>

		<?php 
			$canon_options_advanced = get_option('canon_options_advanced'); 

			//LOAD OPTIONS
			$canon_options = get_option('canon_options'); 
			$canon_options_frame = get_option('canon_options_frame'); 
			$canon_options_post = get_option('canon_options_post'); 
			$canon_options_appearance = get_option('canon_options_appearance');
			$canon_options_advanced = get_option('canon_options_advanced'); 
			

		////////////////////////////////////////////////
		// IMPORT/EXPORT SETTINGS
		////////////////////////////////////////////////

			//MAKE SUPERARRAY AND ENCODE
			$canon_options_superarray = array(
				'canon_options' => $canon_options,
				'canon_options_frame' => $canon_options_frame,
				'canon_options_post' => $canon_options_post,
				'canon_options_appearance' => $canon_options_appearance,
				'canon_options_advanced' => $canon_options_advanced,

			);
			$encoded_serialized_options_data = base64_encode(serialize($canon_options_superarray));

			//IF IMPORT DATA WAS CLICKED
			if ( (isset($canon_options_advanced['import_data'])) && (isset($canon_options_advanced['canon_options_data'])) )  {
				if ($canon_options_advanced['import_data'] == 'IMPORT') {
					
					//get import data (returns false if improper structured data sent)
					$import_superarray = @unserialize(base64_decode($canon_options_advanced['canon_options_data']));

					//only proceed if unserialize succeeded
					if ($import_superarray) {
						//replace old data with new data
						$canon_options = mb_array_replace($canon_options, $import_superarray['canon_options']);
						$canon_options_frame = mb_array_replace($canon_options_frame, $import_superarray['canon_options_frame']);
						$canon_options_post = mb_array_replace($canon_options_post, $import_superarray['canon_options_post']);
						$canon_options_appearance = mb_array_replace($canon_options_appearance, $import_superarray['canon_options_appearance']);
						$canon_options_advanced = mb_array_replace($canon_options_advanced, $import_superarray['canon_options_advanced']);

						//update data to database
						update_option('canon_options', $canon_options);
						update_option('canon_options_frame', $canon_options_frame);
						update_option('canon_options_post', $canon_options_post);
						update_option('canon_options_appearance', $canon_options_appearance);
						update_option('canon_options_advanced', $canon_options_advanced);

						//get data from database (is this not superfluous?)
						$canon_options = get_option('canon_options'); 
						$canon_options_frame = get_option('canon_options_frame'); 
						$canon_options_post = get_option('canon_options_post'); 
						$canon_options_appearance = get_option('canon_options_appearance');
						$canon_options_advanced = get_option('canon_options_advanced'); 

						//display success notice:
						echo '<div class="updated"><p>Settings successfully imported!</p></div>';

					} else {
							
						//display fail notice:
						echo '<div class="error"><p>Import failed!</p></div>';

					}

				}
					
			}


		////////////////////////////////////////////////
		// IMPORT/EXPORT WIDGETS
		////////////////////////////////////////////////

			// MAKE WIDGETS SUPERARRAY
			$canon_widgets_superarray = array();

			// GET AND ADD WIDGET AREAS SUBARRAY
			$widget_areas = get_option('sidebars_widgets');
			$canon_widgets_superarray['widget_areas'] = $widget_areas;

			// CREATE AND ADD ACTIVE WIDGETS SUBARRAY
			$active_widgets = array();
			foreach ($widget_areas as $area_slug => $area_content) {			// first we create an array of active widget slugs
				if (is_array($area_content) && !empty($area_content)) {
					foreach ($area_content as $key => $widget_name) {
						// grab and delete postfix
						$widget_name_explode_array = explode('-', $widget_name);
						$last_index = count($widget_name_explode_array)-1;
						$postfix = "-" . $widget_name_explode_array[$last_index];
						$widget_name = str_replace($postfix, "", $widget_name);
						array_push($active_widgets, $widget_name);
					}
				}
			}
			$active_widgets = array_unique($active_widgets);
			foreach ($active_widgets as $key => $widget_slug) {					// then we convert the array of active widget slugs to an assoc array of active widget slugs and their settings
				$widget_settings_array = get_option('widget_' . $widget_slug);
				$active_widgets[$widget_slug] = $widget_settings_array;
				unset($active_widgets[$key]);

			}
			$canon_widgets_superarray['active_widgets'] = $active_widgets;
			$encoded_serialized_widgets_data = base64_encode(serialize($canon_widgets_superarray));

			//IF IMPORT widgetsDATA WAS CLICKED
			if ( (isset($canon_options_advanced['import_widgets_data'])) && (isset($canon_options_advanced['canon_widgets_data'])) )  {
				if ($canon_options_advanced['import_widgets_data'] == 'IMPORT') {
					
					//get import data (returns false if improper structured data sent)
					$import_widgets_superarray = @unserialize(base64_decode($canon_options_advanced['canon_widgets_data']));

					//only proceed if unserialize succeeded
					if ($import_widgets_superarray) {

						// first replace widget areas
						update_option('sidebars_widgets', $import_widgets_superarray['widget_areas']);

						// next replace active widget settings
						foreach ($import_widgets_superarray['active_widgets'] as $widget_slug => $widget_content) {
							update_option('widget_' . $widget_slug, $widget_content);
						}

						// update data to database
						unset($canon_options_advanced['import_widgets_data']);
						unset($canon_options_advanced['canon_widgets_data']);
						update_option('canon_options_advanced', $canon_options_advanced);

						// get data from database (is this not superfluous?)
						$canon_options_advanced = get_option('canon_options_advanced'); 

						//display success notice:
						echo '<div class="updated"><p>Widgets successfully imported!</p></div>';

					} else {
							
						//display fail notice:
						echo '<div class="error"><p>Import failed!</p></div>';

					}

				}
					
			}


		////////////////////////////////////////////////
		// RESET SETTINGS
		////////////////////////////////////////////////

			//RESET BASIC
			if ($canon_options_advanced['reset_basic'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');

				// clear reset_basic var
				$canon_options_advanced['reset_basic'] = "";
				update_option('canon_options_advanced', $canon_options_advanced);

				// output response
				echo "<script>alert('Basic theme settings have been reset!'); window.location.reload();</script>";
			}


			//RESET ALL
			if ($canon_options_advanced['reset_all'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');
				delete_option('canon_options_advanced');


				// output response
				echo "<script>alert('All theme settings have been reset!'); window.location.reload();</script>";
			}



		////////////////////////////////////////////////
		// INSTAGRAM OAUTH
		////////////////////////////////////////////////


			// UNSERIALIZE OAUTH FOR USE ON OPTIONS PAGE
			$canon_options_advanced['oauth_instagram'] = @unserialize(base64_decode($canon_options_advanced['oauth_instagram']));

			// DETECT RESET
			if ($canon_options_advanced['reset_oauth_instagram'] == 'RESET') {

				// clear variables
				$canon_options_advanced['oauth_instagram_client_id'] = "";
				$canon_options_advanced['oauth_instagram_client_secret'] = "";
				$canon_options_advanced['oauth_instagram'] = "";

				// clear reset_oauth_instagram var
				$canon_options_advanced['reset_oauth_instagram'] = "";
				update_option('canon_options_advanced', $canon_options_advanced);
				$canon_options_advanced = get_option('canon_options_advanced'); 

				// output response
				echo "<script>alert('Instagram authorization has been reset!'); window.location.reload();</script>";
			}

			// STEP 1: CREATE CLIENT/APP AND GET CLIENT ID+CLIENT SECRET
			$oauth_instagram_error_message = "";
			$oauth_instagram_step = 1;
			$redirect_uri = get_admin_url() . "admin.php?page=handle_canon_options_advanced";

			// STEP 2: USER AUTHORIZES CLIENT AND RETURNS WITH A TEMPORARY CODE
			if ( !empty($canon_options_advanced['oauth_instagram_client_id']) && !empty($canon_options_advanced['oauth_instagram_client_secret']) ) {
				$oauth_instagram_step = 2;
				$oauth_instagram_authorize_uri = sprintf('https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=code', esc_attr($canon_options_advanced['oauth_instagram_client_id']), esc_url($redirect_uri));
			}

			// STEP 3: GRAB TEMPORARY CODE AND EXCHANGE IT FOR FINAL OAUTH TOKEN
			if (isset($_GET['code']) && !$canon_options_advanced['oauth_instagram'] && !empty($canon_options_advanced['oauth_instagram_client_id']) && !empty($canon_options_advanced['oauth_instagram_client_secret']) ) {
				$oauth_instagram_step = 3;
				$oauth_instagram_temporary_code = $_GET['code'];

				$oauth_instagram_access_token_uri = "https://api.instagram.com/oauth/access_token";
				$args = array(
					'body' 		=> array(
						'client_id'			=> $canon_options_advanced['oauth_instagram_client_id'],
						'client_secret'		=> $canon_options_advanced['oauth_instagram_client_secret'],
						'grant_type'		=> 'authorization_code',
						'redirect_uri'		=> $redirect_uri,
						'code'				=> $oauth_instagram_temporary_code,
					),
				);

				$response = wp_remote_post($oauth_instagram_access_token_uri, $args);

				if ( is_wp_error( $response ) ) {
					$error = true;
				    $oauth_instagram_error_message .= $response->get_error_message();
						
				} elseif ($response['response']['code'] == 400) {
					
					// IF FAILURE
					$response_body = json_decode($response['body'], true);
					$oauth_instagram_error_message = $response_body['error_message'];

					// IF OLD CODE PARAM ISSUE
					if (strpos($oauth_instagram_error_message, 'No matching code') !== false) {
						$oauth_instagram_error_message .= sprintf(' Try <a href="%s">clearing code</a> or reset.', esc_url($redirect_uri));
					}
						
				} elseif ($response['response']['code'] == 200) {
					
					// IF SUCCESS
					$canon_options_advanced['oauth_instagram'] = json_decode($response['body'], true);
					$canon_options_advanced['oauth_instagram'] = base64_encode(serialize($canon_options_advanced['oauth_instagram']));
					update_option('canon_options_advanced', $canon_options_advanced);
					$canon_options_advanced = get_option('canon_options_advanced'); 

					// reload
					echo "<script>window.location.reload();</script>";

				}

			}

			// STEP 4: AUTHORIZED - ACCESS TOKEN IN DATABASE
			if (!empty($canon_options_advanced['oauth_instagram'])) {
				$oauth_instagram_step = 4;	
			}

			// DEBUG
			// printf("OAUTH INSTAGRAM STEP: %s ", esc_attr($oauth_instagram_step));
			// if (isset($response_body)) { var_dump($response_body);; }

			// QUERY API
			// $response = json_decode(wp_remote_retrieve_body(wp_remote_get('https://api.instagram.com/v1/users/self/feed?access_token=' . $canon_options_advanced['oauth_instagram']['access_token'])), true);
			// var_dump($response);



		////////////////////////////////////////////////
		// MISC
		////////////////////////////////////////////////


			// remove template + remove duplicate custom widget areas and rearrange keys
			if (isset($canon_options_advanced['custom_widget_areas'][9999])) { unset($canon_options_advanced['custom_widget_areas'][9999]); }
            $canon_options_advanced['custom_widget_areas'] = array_values($canon_options_advanced['custom_widget_areas']);

			// delete_option('canon_options_advanced');
			// var_dump($canon_options_advanced);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_advanced'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_advanced'); ?>		

					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						CUSTOM WIDGET AREAS (CWA)
						FINAL CALL CSS
						IMPORT/EXPORT SETTINGS
						IMPORT/EXPORT WIDGETS
						INSTAGRAM AUTHORIZATION
					
					-->


					<!-- 
					--------------------------------------------------------------------------
						CUSTOM WIDGET AREAS (CWA)
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Widget Areas Manager", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Widget Areas Manager', 'loc_canon'),
									'content' 				=> array(
										__('Here you can create new custom widget areas. Give each widget area a unique name.', 'loc_canon'),
										__('You can drag and drop to decide the order of which the widget areas will display in the widgets section.', 'loc_canon'),
										__('To add widgets to your custom widget areas go to <i>WordPress Appearance > Widgets</i>.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<tr>

								<th scope='row'></th>
								<td>
									<ul id="cwa_template">

												<!-- TEMPLATE: C/P LI -->
												<?php $i=9999; ?>

												<li>
													<span><?php _e("Custom Widget Area Name", "loc_canon"); ?>:<span>
													<span class="cwa_del"><a href="#"><?php _e("Delete", "loc_canon"); ?></a></span>
													<input class='widefat cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo esc_attr($i); ?>][name]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]['name']); ?>">
												</li>


									</ul>
								</td>
							</tr>

							<tr>
								<th scope='row'><?php _e("Custom Widget Areas", "loc_canon"); ?></th>
								<td>
									<ul id="cwa_list" class="cwa_sortable">

										<?php 

											if (isset($canon_options_advanced['custom_widget_areas'])) {

												for ($i = 0; $i < count($canon_options_advanced['custom_widget_areas']); $i++) {  
												?>

												<li>
													<span><?php _e("Custom Widget Area Name", "loc_canon"); ?>:<span>
													<span class="cwa_del"><a href="#"><?php _e("Delete", "loc_canon"); ?></a></span>
													<input class='widefat cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo esc_attr($i); ?>][name]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]['name']); ?>">
												</li>

												<?php
												}

											}

										?>

									</ul>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="button" class="button button_add_cwa" value="<?php _e("Create new custom widget area", "loc_canon"); ?>" />
									<br><br>
								</td>
							</tr>




						</table>


					<!-- 
					--------------------------------------------------------------------------
						FINAL CALL CSS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Final Call CSS", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Final call CSS', 'loc_canon'),
									'content' 				=> array(
										__('Put your own CSS code here. This CSS will be called last and overwrites all theme CSS.', 'loc_canon'),
										__('Final call CSS will be exported/imported along with all other theme settings when using the <i>Import/Export</i> option.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use final call CSS', 'loc_canon'),
									'slug' 					=> 'use_final_call_css',
									'options_name'			=> 'canon_options_advanced',
								)); 

							?>


							<tr valign='top'>
								<th></th>
								<td colspan="2">
									<textarea id='final_call_css' name='canon_options_advanced[final_call_css]' rows='20' cols='100'><?php if (isset($canon_options_advanced['final_call_css'])) echo htmlentities($canon_options_advanced['final_call_css']); ?></textarea>

								</td>
							</tr>

						</table>




						<table class='form-table'>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						IMPORT/EXPORT SETTINGS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Import/Export Settings", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Import/Export settings', 'loc_canon'),
									'content' 				=> array(
										__('Use this section to import/export your settings.', 'loc_canon'),
										__('<strong>WARNING</strong>: Settings may be overwritten/deleted/replaced. ', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Generate settings data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will generate settings data. You can copy this data from the settings data window.', 'loc_canon'),
										__('Clicking the window will select all text.', 'loc_canon'),
										__('Press CTRL+C on your keyboard or right click selected text and select copy.', 'loc_canon'),
										__('Once you have copied the data you can either save it to a text document/file (safest) or simply keep the data in your copy/paste clipboard (not safe).', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Import settings data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will import your settings data from the data string supplied in the settings data window.', 'loc_canon'),
										__('Make sure you paste all of the data into the settings data textarea/window. If part of the code is altered or left out import will fail.', 'loc_canon'),
										__('Click the "Import settings data" button.', 'loc_canon'),
										__('Your setting have now been imported.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Load predefined settings data', 'loc_canon'),
									'content' 				=> array(
										__('Use this select to load predefined settings data into the data window.', 'loc_canon'),
										__('Click the "Import settings data" button.', 'loc_canon'),
										__('The predefined settings have now been imported.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table import-export'>

							<tr valign='top'>
								<th scope='row'><?php _e("Settings data", "loc_canon"); ?></th>
								<td colspan="2">
									<textarea id='canon_options_data' class='canon_export_data' name='canon_options_advanced[canon_options_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_data" name="canon_options_advanced[import_data]" value="">

									<input type="button" class="button button_generate_data" value="Generate settings data" data-export_data="<?php echo esc_attr($encoded_serialized_options_data); ?>" />
									<button id="button_import_data" name="button_import_data" class="button-secondary"><?php _e("Import settings data", "loc_canon"); ?></button>
								</td>

								<td class="float-right">
									<select class="predefined-data-select">
							     		<option value="" selected='selected'><?php _e('Load predefined settings data...', 'loc_canon'); ?></option> 
							     		
							     		<option value="YTo1OntzOjEzOiJjYW5vbl9vcHRpb25zIjthOjE5OntzOjg6ImRldl9tb2RlIjtzOjk6InVuY2hlY2tlZCI7czoyMjoiZGV2X2NvbnRyb2xsZXJfY2xhc3NlcyI7czowOiIiO3M6MjA6ImRldl9tb2NrdXBfc3RydWN0dXJlIjtzOjA6IiI7czoyMToidXNlX3Jlc3BvbnNpdmVfZGVzaWduIjtzOjc6ImNoZWNrZWQiO3M6MTY6InVzZV9ib3hlZF9kZXNpZ24iO3M6OToidW5jaGVja2VkIjtzOjIwOiJ1c2VfbWFpbnRlbmFuY2VfbW9kZSI7czo5OiJ1bmNoZWNrZWQiO3M6MTU6Im1haW50ZW5hbmNlX21zZyI7czo1NjoiV2UgYXJlIGJ1c3kgZG9pbmcgbWFpbnRlbmFuY2UgLSBwbGVhc2UgY2hlY2sgYmFjayBsYXRlciEiO3M6MTE6ImZhdmljb25fdXJsIjtzOjA6IiI7czoxODoic2lkZWJhcnNfYWxpZ25tZW50IjtzOjU6InJpZ2h0IjtzOjE4OiJiYWNrX3RvX3RvcF9idXR0b24iO3M6OToicHJlZm9vdGVyIjtzOjE0OiJvdmVybGF5X2hlYWRlciI7czo3OiJjaGVja2VkIjtzOjMxOiJvdmVybGF5X2NvbnRlbnRfbmVnYXRpdmVfbWFyZ2luIjtzOjQ6Ii0zMDAiO3M6Mjk6Im92ZXJsYXlfaGVhZGVyX3R1cm5fb2ZmX3dpZHRoIjtzOjM6Ijc2OCI7czozMDoib3ZlcmxheV9jb250ZW50X3R1cm5fb2ZmX3dpZHRoIjtzOjM6IjQ4MCI7czoxMToiaW1hZ2Vfc2l6ZXMiO2E6ODp7czoyOToiY2Fub25fcG9zdF9jb21wb25lbnRfY2Fyb3VzZWwiO2E6Mzp7czo1OiJ3aWR0aCI7czozOiI3MDAiO3M6NjoiaGVpZ2h0IjtzOjM6IjQyMCI7czo1OiJyYXRpbyI7czo0OiIxLjY3Ijt9czoyNzoiY2Fub25fYmxvY2tfcG9zdF9ncmlkXzZ3aWRlIjthOjM6e3M6NToid2lkdGgiO3M6NDoiMTAwNSI7czo2OiJoZWlnaHQiO3M6MzoiNTE5IjtzOjU6InJhdGlvIjtzOjQ6IjEuOTQiO31zOjI3OiJjYW5vbl9ibG9ja19wb3N0X2dyaWRfM3dpZGUiO2E6Mzp7czo1OiJ3aWR0aCI7czo0OiIxMjY3IjtzOjY6ImhlaWdodCI7czozOiI2NTQiO3M6NToicmF0aW8iO3M6NDoiMS45NCI7fXM6Mjc6ImNhbm9uX2Jsb2NrX3Bvc3RfZ3JpZF82dGFsbCI7YTozOntzOjU6IndpZHRoIjtzOjQ6IjEyNjciO3M6NjoiaGVpZ2h0IjtzOjM6IjY1NCI7czo1OiJyYXRpbyI7czo0OiIxLjk0Ijt9czoyMDoiY2Fub25fYmxvY2tfY2Fyb3VzZWwiO2E6Mzp7czo1OiJ3aWR0aCI7czozOiI5NzAiO3M6NjoiaGVpZ2h0IjtzOjM6IjU0NiI7czo1OiJyYXRpbyI7czo0OiIxLjc4Ijt9czoxNToiY2Fub25fZXZlbl9ncmlkIjthOjM6e3M6NToid2lkdGgiO3M6MzoiOTcwIjtzOjY6ImhlaWdodCI7czozOiI1NDYiO3M6NToicmF0aW8iO3M6NDoiMS43OCI7fXM6Mjg6ImNhbm9uX2dyaWRfZ2FsbGVyeV9sYW5kc2NhcGUiO2E6Mzp7czo1OiJ3aWR0aCI7czozOiI2MDAiO3M6NjoiaGVpZ2h0IjtzOjM6IjM2MSI7czo1OiJyYXRpbyI7czo0OiIxLjY2Ijt9czoyNzoiY2Fub25fZ3JpZF9nYWxsZXJ5X3BvcnRyYWl0IjthOjM6e3M6NToid2lkdGgiO3M6MzoiNTAwIjtzOjY6ImhlaWdodCI7czozOiI2MDIiO3M6NToicmF0aW8iO3M6NDoiMS44MyI7fX1zOjE4OiJhdXRvY29tcGxldGVfd29yZHMiO3M6NzI6ImMrKywganF1ZXJ5LCBJIGxpa2UgalF1ZXJ5LCBqYXZhLCBwaHAsIGNvbGRmdXNpb24sIGphdmFzY3JpcHQsIGFzcCwgcnVieSI7czoyNzoiaGlkZV90aGVtZV9tZXRhX2Rlc2NyaXB0aW9uIjtzOjk6InVuY2hlY2tlZCI7czoxMzoiaGlkZV90aGVtZV9vZyI7czo5OiJ1bmNoZWNrZWQiO3M6MTI6ImZvbnRmYWNlX2ZpeCI7czo5OiJ1bmNoZWNrZWQiO31zOjE5OiJjYW5vbl9vcHRpb25zX2ZyYW1lIjthOjEwNjp7czoxNzoiaGVhZGVyX3ByZV9sYXlvdXQiO3M6Mjg6ImhlYWRlcl9wcmVfY3VzdG9tX2xlZnRfcmlnaHQiO3M6MjQ6ImhlYWRlcl9wcmVfY3VzdG9tX2NlbnRlciI7czozOiJvZmYiO3M6MjI6ImhlYWRlcl9wcmVfY3VzdG9tX2xlZnQiO3M6NzoicHJpbWFyeSI7czoyMzoiaGVhZGVyX3ByZV9jdXN0b21fcmlnaHQiO3M6Njoic29jaWFsIjtzOjE4OiJoZWFkZXJfbWFpbl9sYXlvdXQiO3M6Mjk6ImhlYWRlcl9tYWluX2N1c3RvbV9sZWZ0X3JpZ2h0IjtzOjI1OiJoZWFkZXJfbWFpbl9jdXN0b21fY2VudGVyIjtzOjM6Im9mZiI7czoyMzoiaGVhZGVyX21haW5fY3VzdG9tX2xlZnQiO3M6NDoibG9nbyI7czoyNDoiaGVhZGVyX21haW5fY3VzdG9tX3JpZ2h0IjtzOjc6InRvb2xiYXIiO3M6MTg6ImhlYWRlcl9wb3N0X2xheW91dCI7czozOiJvZmYiO3M6MjU6ImhlYWRlcl9wb3N0X2N1c3RvbV9jZW50ZXIiO3M6Mzoib2ZmIjtzOjIzOiJoZWFkZXJfcG9zdF9jdXN0b21fbGVmdCI7czozOiJvZmYiO3M6MjQ6ImhlYWRlcl9wb3N0X2N1c3RvbV9yaWdodCI7czozOiJvZmYiO3M6MjM6ImhvbWVwYWdlX2ZlYXR1cmVfbGF5b3V0IjtzOjEyOiJibG9ja19zbGlkZXIiO3M6MTc6ImZvb3Rlcl9wcmVfbGF5b3V0IjtzOjI4OiJmb290ZXJfcHJlX2N1c3RvbV9sZWZ0X3JpZ2h0IjtzOjI0OiJmb290ZXJfcHJlX2N1c3RvbV9jZW50ZXIiO3M6Mzoib2ZmIjtzOjIyOiJmb290ZXJfcHJlX2N1c3RvbV9sZWZ0IjtzOjg6ImF1eF9sb2dvIjtzOjIzOiJmb290ZXJfcHJlX2N1c3RvbV9yaWdodCI7czo5OiJzZWNvbmRhcnkiO3M6MTg6ImZvb3Rlcl9tYWluX2xheW91dCI7czozOiJvZmYiO3M6MTg6ImZvb3Rlcl9wb3N0X2xheW91dCI7czoyOToiZm9vdGVyX3Bvc3RfY3VzdG9tX2xlZnRfcmlnaHQiO3M6MjU6ImZvb3Rlcl9wb3N0X2N1c3RvbV9jZW50ZXIiO3M6Mzoib2ZmIjtzOjIzOiJmb290ZXJfcG9zdF9jdXN0b21fbGVmdCI7czo2OiJzb2NpYWwiO3M6MjQ6ImZvb3Rlcl9wb3N0X2N1c3RvbV9yaWdodCI7czoxMToiZm9vdGVyX3RleHQiO3M6MjA6InVzZV9zdGlja3lfcHJlaGVhZGVyIjtzOjk6InVuY2hlY2tlZCI7czoxNzoidXNlX3N0aWNreV9oZWFkZXIiO3M6NzoiY2hlY2tlZCI7czoyMToidXNlX3N0aWNreV9wb3N0aGVhZGVyIjtzOjk6InVuY2hlY2tlZCI7czoxNzoicHJlaGVhZGVyX29wYWNpdHkiO3M6MToiMSI7czoxNDoiaGVhZGVyX29wYWNpdHkiO3M6MzoiMC42IjtzOjE4OiJwb3N0aGVhZGVyX29wYWNpdHkiO3M6MToiMSI7czoyMToic3RpY2t5X3R1cm5fb2ZmX3dpZHRoIjtzOjM6Ijc2OCI7czoyNToiYWRkX3NlYXJjaF9idG5fdG9fcHJpbWFyeSI7czo5OiJ1bmNoZWNrZWQiO3M6Mjc6ImFkZF9zZWFyY2hfYnRuX3RvX3NlY29uZGFyeSI7czo5OiJ1bmNoZWNrZWQiO3M6MTg6ImhlYWRlcl9wYWRkaW5nX3RvcCI7czoyOiIyMCI7czoyMToiaGVhZGVyX3BhZGRpbmdfYm90dG9tIjtzOjI6IjIwIjtzOjIwOiJwb3NfbGVmdF9lbGVtZW50X3RvcCI7czoxOiIwIjtzOjIxOiJwb3NfbGVmdF9lbGVtZW50X2xlZnQiO3M6MToiMCI7czoyMToicG9zX3JpZ2h0X2VsZW1lbnRfdG9wIjtzOjE6IjAiO3M6MjM6InBvc19yaWdodF9lbGVtZW50X3JpZ2h0IjtzOjE6IjAiO3M6MjE6InByZWZvb3Rlcl9wYWRkaW5nX3RvcCI7czoyOiIzNSI7czoyNDoicHJlZm9vdGVyX3BhZGRpbmdfYm90dG9tIjtzOjI6IjM1IjtzOjMwOiJwcmVmb290ZXJfcG9zX2xlZnRfZWxlbWVudF90b3AiO3M6MToiMCI7czozMToicHJlZm9vdGVyX3Bvc19sZWZ0X2VsZW1lbnRfbGVmdCI7czoxOiIwIjtzOjMxOiJwcmVmb290ZXJfcG9zX3JpZ2h0X2VsZW1lbnRfdG9wIjtzOjE6IjAiO3M6MzM6InByZWZvb3Rlcl9wb3NfcmlnaHRfZWxlbWVudF9yaWdodCI7czoxOiIwIjtzOjg6ImxvZ29fdXJsIjtzOjA6IiI7czoxNDoibG9nb19tYXhfd2lkdGgiO3M6MzoiMjE5IjtzOjk6ImxvZ29fdGV4dCI7czowOiIiO3M6MjQ6ImxvZ29fdGV4dF9hcHBlbmRfdGFnbGluZSI7czo3OiJjaGVja2VkIjtzOjE0OiJsb2dvX3RleHRfc2l6ZSI7czoyOiIzMCI7czoxNzoidGFnbGluZV90ZXh0X3NpemUiO3M6MjoiMTIiO3M6MTI6ImF1eF9sb2dvX3VybCI7czowOiIiO3M6MTg6ImF1eF9sb2dvX21heF93aWR0aCI7czozOiIyMTkiO3M6MjQ6ImhlYWRlcl9pbWdfaG9tZXBhZ2Vfb25seSI7czo5OiJ1bmNoZWNrZWQiO3M6MTQ6ImhlYWRlcl9pbWdfdXJsIjtzOjA6IiI7czoxOToiaGVhZGVyX2ltZ19iZ19jb2xvciI7czo3OiIjMTQxMzEyIjtzOjE3OiJoZWFkZXJfaW1nX2hlaWdodCI7czozOiI0MDAiO3M6MjY6ImhlYWRlcl9pbWdfcGFyYWxsYXhfYW1vdW50IjtzOjI6IjUwIjtzOjE1OiJoZWFkZXJfaW1nX3RleHQiO3M6OTg6IjxoMz5IZWFkZXIgSW1hZ2UgV2l0aCBQYXJhbGxheCBTY3JvbGxpbmcgLSBXaGF0J3MgTm90IFRvIExpa2UhPC9oMz5bYnV0dG9uXUJ1eSBPeGllIFRvZGF5Wy9idXR0b25dIjtzOjI1OiJoZWFkZXJfaW1nX3RleHRfYWxpZ25tZW50IjtzOjg6ImNlbnRlcmVkIjtzOjI2OiJoZWFkZXJfaW1nX3RleHRfbWFyZ2luX3RvcCI7czozOiIxNTAiO3M6MTE6ImJhbm5lcl9jb2RlIjtzOjE1NjoiPGEgaHJlZj0naHR0cDovL3d3dy50aGVtZWZvcmVzdC5jb20vP3JlZj10aGVtZWNhbm9uJyB0YXJnZXQ9J19ibGFuayc+PGltZyBzcmM9J2h0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL3dwLWNvbnRlbnQvdGhlbWVzL294aWUvaW1nL2Jhbm5lcl80Njh4NjAuZ2lmJz48L2E+IjtzOjExOiJoZWFkZXJfdGV4dCI7czo4NDoiPGltZyBzcmM9Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL3dwLWNvbnRlbnQvdGhlbWVzL294aWUvaW1nL2xvZ29AMngtZGFyay5wbmciIC8+IjtzOjExOiJmb290ZXJfdGV4dCI7czo3NToiwqkgPGEgaHJlZj0iaHR0cDovL3d3dy50aGVtZWNhbm9uLmNvbSIgdGFyZ2V0PSJfYmxhbmsiPlRoZW1lIENhbm9uPC9hPiAyMDE1IjtzOjEzOiJzb2NpYWxfaW5fbmV3IjtzOjc6ImNoZWNrZWQiO3M6MTI6InNvY2lhbF9saW5rcyI7YTo2OntpOjA7YToyOntpOjA7czoxMToiZmEtZmFjZWJvb2siO2k6MTtzOjM1OiJodHRwczovL3d3dy5mYWNlYm9vay5jb20vdGhlbWVjYW5vbiI7fWk6MTthOjI6e2k6MDtzOjEwOiJmYS10d2l0dGVyIjtpOjE7czozMDoiaHR0cHM6Ly90d2l0dGVyLmNvbS9UaGVtZUNhbm9uIjt9aToyO2E6Mjp7aTowO3M6MTQ6ImZhLWdvb2dsZS1wbHVzIjtpOjE7czoxOiIjIjt9aTozO2E6Mjp7aTowO3M6MTE6ImZhLWRyaWJiYmxlIjtpOjE7czoxOiIjIjt9aTo0O2E6Mjp7aTowO3M6OToiZmEtZ2l0aHViIjtpOjE7czoxOiIjIjt9aTo1O2E6Mjp7aTowO3M6NjoiZmEtcnNzIjtpOjE7czozMjoiaHR0cDovL294aWUudGhlbWVjYW5vbi5jb20vZmVlZC8iO319czoyMToidG9vbGJhcl9zZWFyY2hfYnV0dG9uIjtzOjc6ImNoZWNrZWQiO3M6MjU6ImNvdW50ZG93bl9kYXRldGltZV9zdHJpbmciO3M6MjY6IkRlY2VtYmVyIDMxLCAyMDIzIDIzOjU5OjU5IjtzOjIwOiJjb3VudGRvd25fZ210X29mZnNldCI7czozOiIrMTAiO3M6MjE6ImNvdW50ZG93bl9kZXNjcmlwdGlvbiI7czoxMjoiTmV4dCBFdmVudDogIjtzOjIxOiJibG9ja19wb3N0X2dyaWRfc2hvd3MiO3M6MTY6InBvc3RjYXRfY2Fyb3VzZWwiO3M6MjI6ImJsb2NrX3Bvc3RfZ3JpZF9sYXlvdXQiO3M6NToiNndpZGUiO3M6MjU6ImJsb2NrX3Bvc3RfZ3JpZF9hbmltYXRpb24iO3M6Mzoib2ZmIjtzOjI2OiJibG9ja19wb3N0X2dyaWRfYW5pbV9kZWxheSI7czozOiI0MDAiO3M6MjY6ImJsb2NrX3Bvc3RfZ3JpZF9hbmltX3NwZWVkIjtzOjQ6IjMwMDAiO3M6MTg6ImJsb2NrX3NsaWRlcl9hbGlhcyI7czo4OiJob21lcGFnZSI7czoxODoiYmxvY2tfc2xpZGVyX2JveGVkIjtzOjk6InVuY2hlY2tlZCI7czoyMDoiYmxvY2tfY2Fyb3VzZWxfc2hvd3MiO3M6MTY6InBvc3RjYXRfY2Fyb3VzZWwiO3M6MzQ6ImJsb2NrX2Nhcm91c2VsX3Nob3dfZmVhdHVyZWRfaW1hZ2UiO3M6NzoiY2hlY2tlZCI7czoyNToiYmxvY2tfY2Fyb3VzZWxfc2hvd190aXRsZSI7czo5OiJ1bmNoZWNrZWQiO3M6Mjc6ImJsb2NrX2Nhcm91c2VsX3Nob3dfZXhjZXJwdCI7czo5OiJ1bmNoZWNrZWQiO3M6MzI6ImJsb2NrX2Nhcm91c2VsX2Rpc3BsYXlfbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MjQ6ImJsb2NrX2Nhcm91c2VsX251bV9wb3N0cyI7czoyOiIxNSI7czoyOToiYmxvY2tfY2Fyb3VzZWxfZXhjZXJwdF9sZW5ndGgiO3M6MzoiMTMwIjtzOjI5OiJibG9ja19jYXJvdXNlbF9hdXRvcGxheV9zcGVlZCI7czo0OiIzMDAwIjtzOjI4OiJibG9ja19jYXJvdXNlbF9zdG9wX29uX2hvdmVyIjtzOjc6ImNoZWNrZWQiO3M6MjU6ImJsb2NrX2Nhcm91c2VsX3BhZ2luYXRpb24iO3M6OToidW5jaGVja2VkIjtzOjMwOiJibG9ja19pbnN0YWdyYW1fY2Fyb3VzZWxfc2hvd3MiO3M6NjoicmVjZW50IjtzOjMyOiJibG9ja19pbnN0YWdyYW1fY2Fyb3VzZWxfdXNlcl9pZCI7czo4OiIyNTAyNTMyMCI7czoyODoiYmxvY2tfaW5zdGFncmFtX2Nhcm91c2VsX3RhZyI7czo4OiJpbnN0Z3JhbSI7czo0MjoiYmxvY2tfaW5zdGFncmFtX2Nhcm91c2VsX2Rpc3BsYXlfbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MzQ6ImJsb2NrX2luc3RhZ3JhbV9jYXJvdXNlbF9udW1fcG9zdHMiO3M6MjoiMTUiO3M6Mzk6ImJsb2NrX2luc3RhZ3JhbV9jYXJvdXNlbF9leGNlcnB0X2xlbmd0aCI7czozOiIxMDAiO3M6Mzk6ImJsb2NrX2luc3RhZ3JhbV9jYXJvdXNlbF9hdXRvcGxheV9zcGVlZCI7czo0OiIzMDAwIjtzOjM4OiJibG9ja19pbnN0YWdyYW1fY2Fyb3VzZWxfc3RvcF9vbl9ob3ZlciI7czo3OiJjaGVja2VkIjtzOjM1OiJibG9ja19pbnN0YWdyYW1fY2Fyb3VzZWxfcGFnaW5hdGlvbiI7czo3OiJjaGVja2VkIjtzOjE5OiJibG9ja193aWRnZXRzX2JveGVkIjtzOjc6ImNoZWNrZWQiO3M6MjM6ImJsb2NrX3NlYXJjaF9iZ19pbWdfdXJsIjtzOjc2OiJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbS93cC1jb250ZW50L3VwbG9hZHMvcmV2c2xpZGVyL2hvbWVwYWdlL3NsaWRlLTIuanBnIjtzOjIxOiJibG9ja19zZWFyY2hfYmdfY29sb3IiO3M6NzoiIzE0MTMxMiI7czoyMzoiYmxvY2tfc2VhcmNoX3RleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoyNjoiYmxvY2tfc2VhcmNoX2JnX2F0dGFjaG1lbnQiO3M6Njoic2Nyb2xsIjtzOjIwOiJibG9ja19zZWFyY2hfYmdfc2l6ZSI7czo1OiJjb3ZlciI7czoyNToiYmxvY2tfc2VhcmNoX2Jsb2NrX2hlaWdodCI7czozOiIzMDAiO3M6MzE6ImJsb2NrX3NlYXJjaF9jb250ZW50X3RvcF9tYXJnaW4iO3M6MjoiNjAiO3M6MTc6ImJsb2NrX3NlYXJjaF9odG1sIjtzOjkxOiI8aDE+U2VhcmNoIDxiPlNwZWNpZmljIENhdGVnb3JpZXM8L2I+PC9oMT4NCjxwPlNlYXJjaCBteSBibG9nIG9mIGxpdGVyYXJ5IG1hc3RlcnBpZWNlcy48L3A+IjtzOjI0OiJibG9ja19zZWFyY2hfcGxhY2Vob2xkZXIiO3M6MTY6IlNlYXJjaCBGb3IgUG9zdHMiO3M6MjE6ImJsb2NrX3NlYXJjaF9idG5fdGV4dCI7czo2OiJTZWFyY2giO3M6MTU6ImJsb2NrX3NlYXJjaF9pbiI7czoxNDoiYWxsX2NhdGVnb3JpZXMiO31zOjE4OiJjYW5vbl9vcHRpb25zX3Bvc3QiO2E6NjA6e3M6MTU6ImhvbWVwYWdlX2xheW91dCI7czoxNToibWFzb25yeV9zaWRlYmFyIjtzOjIwOiJob21lcGFnZV9udW1fY29sdW1ucyI7czoxOiIxIjtzOjE2OiJob21lcGFnZV9zaWRlYmFyIjtzOjMzOiJjYW5vbl9hcmNoaXZlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6MTc6ImhvbWVwYWdlX2Ryb3BfY2FwIjtzOjc6ImNoZWNrZWQiO3M6MjM6ImhvbWVwYWdlX2V4Y2VycHRfbGVuZ3RoIjtzOjM6IjUwMCI7czoxOToiaG9tZXBhZ2VfcGFnaW5hdGlvbiI7czoxMzoibG9hZG1vcmVfYWpheCI7czoxMDoiY2F0X2xheW91dCI7czo3OiJtYXNvbnJ5IjtzOjE1OiJjYXRfbnVtX2NvbHVtbnMiO3M6MToiMyI7czoxMToiY2F0X3NpZGViYXIiO3M6MzM6ImNhbm9uX2FyY2hpdmVfc2lkZWJhcl93aWRnZXRfYXJlYSI7czoxMjoiY2F0X2Ryb3BfY2FwIjtzOjk6InVuY2hlY2tlZCI7czoxODoiY2F0X2V4Y2VycHRfbGVuZ3RoIjtzOjM6IjIwMCI7czoxNDoiY2F0X3BhZ2luYXRpb24iO3M6ODoicHJldm5leHQiO3M6MTQ6InNob3dfY2F0X3RpdGxlIjtzOjc6ImNoZWNrZWQiO3M6MjA6InNob3dfY2F0X2Rlc2NyaXB0aW9uIjtzOjc6ImNoZWNrZWQiO3M6MTQ6ImFyY2hpdmVfbGF5b3V0IjtzOjE1OiJtYXNvbnJ5X3NpZGViYXIiO3M6MTk6ImFyY2hpdmVfbnVtX2NvbHVtbnMiO3M6MToiMSI7czoxNToiYXJjaGl2ZV9zaWRlYmFyIjtzOjMzOiJjYW5vbl9hcmNoaXZlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6MTY6ImFyY2hpdmVfZHJvcF9jYXAiO3M6NzoiY2hlY2tlZCI7czoyMjoiYXJjaGl2ZV9leGNlcnB0X2xlbmd0aCI7czozOiIyNTAiO3M6MTg6ImFyY2hpdmVfcGFnaW5hdGlvbiI7czo4OiJwcmV2bmV4dCI7czoxODoicGFnZV9zaG93X2NvbW1lbnRzIjtzOjk6InVuY2hlY2tlZCI7czoyNToic2luZ2xlX2RlZmF1bHRfcG9zdF9zdHlsZSI7czo0OiJmdWxsIjtzOjE4OiJzaW5nbGVfdXNlX2Ryb3BjYXAiO3M6NzoiY2hlY2tlZCI7czo5OiJzaG93X3RhZ3MiO3M6NzoiY2hlY2tlZCI7czoxMzoic2hvd19jb21tZW50cyI7czo3OiJjaGVja2VkIjtzOjEzOiJzaG93X3Bvc3RfbmF2IjtzOjc6ImNoZWNrZWQiO3M6MTc6InBvc3RfbmF2X3NhbWVfY2F0IjtzOjk6InVuY2hlY2tlZCI7czoyMjoicG9zdF9jb21wb25lbnRfYWRfY29kZSI7czoxNTU6IjxhIGhyZWY9J2h0dHA6Ly93d3cudGhlbWVmb3Jlc3QuY29tLz9yZWY9dGhlbWVjYW5vbicgdGFyZ2V0PSdfYmxhbmsnPjxpbWcgc3JjPSdodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbS93cC1jb250ZW50L3RoZW1lcy9veGllL2ltZy9hZC1leGFtcGxlLTIucG5nJz48L2E+IjtzOjE2OiJzaG93X21ldGFfYXV0aG9yIjtzOjc6ImNoZWNrZWQiO3M6MTQ6InNob3dfbWV0YV9kYXRlIjtzOjc6ImNoZWNrZWQiO3M6MTg6InNob3dfbWV0YV9jb21tZW50cyI7czo3OiJjaGVja2VkIjtzOjE1OiJzaG93X21ldGFfbGlrZXMiO3M6NzoiY2hlY2tlZCI7czoxNToic2hvd19tZXRhX3ZpZXdzIjtzOjc6ImNoZWNrZWQiO3M6MjQ6InNob3dfc2hhcmVfbGlua19mYWNlYm9vayI7czo3OiJjaGVja2VkIjtzOjIzOiJzaG93X3NoYXJlX2xpbmtfdHdpdHRlciI7czo3OiJjaGVja2VkIjtzOjI3OiJzaG93X3NoYXJlX2xpbmtfZ29vZ2xlX3BsdXMiO3M6NzoiY2hlY2tlZCI7czoyNToic2hvd19zaGFyZV9saW5rX3BpbnRlcmVzdCI7czo3OiJjaGVja2VkIjtzOjI2OiJhcmNoaXZlX2hlYWRlcl9wYWRkaW5nX3RvcCI7czozOiIyMDAiO3M6Mjk6ImFyY2hpdmVfaGVhZGVyX3BhZGRpbmdfYm90dG9tIjtzOjM6IjEwMCI7czoyODoiYXJjaGl2ZV9oZWFkZXJfaW1hZ2VfZGVmYXVsdCI7czo2MToiaHR0cDovL294aWUudGhlbWVjYW5vbi5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTUvMDcvbXVnLmpwZyI7czoyNzoiYXJjaGl2ZV9oZWFkZXJfY2F0X2Nhcm91c2VsIjtzOjA6IiI7czozMzoiYXJjaGl2ZV9oZWFkZXJfY2F0X2ZlYXR1cmUtc2xpZGVyIjtzOjA6IiI7czoyOToiYXJjaGl2ZV9oZWFkZXJfY2F0X215LXN0b3JpZXMiO3M6MDoiIjtzOjMyOiJhcmNoaXZlX2hlYWRlcl9jYXRfdW5jYXRlZ29yaXplZCI7czowOiIiO3M6MTU6InNlYXJjaF9ib3hfdGV4dCI7czoyNToiV2hhdCBhcmUgeW91IGxvb2tpbmcgZm9yPyI7czoxMjoic2VhcmNoX3Bvc3RzIjtzOjc6ImNoZWNrZWQiO3M6MTI6InNlYXJjaF9wYWdlcyI7czo3OiJjaGVja2VkIjtzOjEwOiJzZWFyY2hfY3B0IjtzOjc6ImNoZWNrZWQiO3M6MTc6InNlYXJjaF9jcHRfc291cmNlIjtzOjA6IiI7czoyMDoic2VhcmNoX3dpZGdldF9hcmVhXzEiO3M6MzA6ImNhbm9uX2N3YV9zZWFyY2gtd2lkZ2V0LWFyZWEtMSI7czoyMDoic2VhcmNoX3dpZGdldF9hcmVhXzIiO3M6MzA6ImNhbm9uX2N3YV9zZWFyY2gtd2lkZ2V0LWFyZWEtMiI7czoyMDoic2VhcmNoX3dpZGdldF9hcmVhXzMiO3M6MzA6ImNhbm9uX2N3YV9zZWFyY2gtd2lkZ2V0LWFyZWEtMyI7czoyMDoic2VhcmNoX3dpZGdldF9hcmVhXzQiO3M6MzA6ImNhbm9uX2N3YV9zZWFyY2gtd2lkZ2V0LWFyZWEtNCI7czoyMDoic2VhcmNoX3dpZGdldF9hcmVhXzUiO3M6Mzoib2ZmIjtzOjEwOiI0MDRfbGF5b3V0IjtzOjQ6ImZ1bGwiO3M6MTE6IjQwNF9zaWRlYmFyIjtzOjMwOiJjYW5vbl9wYWdlX3NpZGViYXJfd2lkZ2V0X2FyZWEiO3M6OToiNDA0X3RpdGxlIjtzOjE0OiJQYWdlIG5vdCBmb3VuZCI7czo3OiI0MDRfbXNnIjtzOjc5OiJZb3UncmUgbG9zdCBteSBmcmllbmQsIHRoZSBwYWdlIHlvdSdyZSBsb29raW5nIGZvciBkb2VzIG5vdCBleGlzdCBhbnltb3JlLiANCg0KIjtzOjIzOiJ1c2Vfd29vY29tbWVyY2Vfc2lkZWJhciI7czo3OiJjaGVja2VkIjtzOjE5OiJ3b29jb21tZXJjZV9zaWRlYmFyIjtzOjE0OiJjYW5vbl9jd2Ffc2hvcCI7fXM6MjQ6ImNhbm9uX29wdGlvbnNfYXBwZWFyYW5jZSI7YTo4OTp7czoxNToiYm9keV9za2luX2NsYXNzIjtzOjk6InRjLW94aWUtMSI7czoxMDoiY29sb3JfYm9keSI7czo3OiIjZjNmNWY3IjtzOjExOiJjb2xvcl9wbGF0ZSI7czo3OiIjZmZmZmZmIjtzOjE1OiJjb2xvcl9tYWluX3RleHQiO3M6NzoiIzIyMjQyNSI7czoxOToiY29sb3JfbWFpbl9oZWFkaW5ncyI7czo3OiIjMjIyNDI1IjtzOjExOiJjb2xvcl9saW5rcyI7czo3OiIjMjIyNDI1IjtzOjE3OiJjb2xvcl9saW5rc19ob3ZlciI7czo3OiIjOTA4OGEzIjtzOjEwOiJjb2xvcl9saWtlIjtzOjc6IiM5MDg4YTMiO3M6MTY6ImNvbG9yX3doaXRlX3RleHQiO3M6NzoiI2ZmZmZmZiI7czo5OiJjb2xvcl9idG4iO3M6NzoiI2RiZGNkZSI7czoxNToiY29sb3JfYnRuX2hvdmVyIjtzOjc6IiM5MDg4YTMiO3M6MTQ6ImNvbG9yX2J0bl90ZXh0IjtzOjc6IiNiOGJhYmQiO3M6MjA6ImNvbG9yX2J0bl90ZXh0X2hvdmVyIjtzOjc6IiNmZmZmZmYiO3M6MTY6ImNvbG9yX2ZlYXRfY29sb3IiO3M6NzoiIzkwODhhMyI7czoyNDoiY29sb3JfZmVhdF9vdmVybGF5X2NvbG9yIjtzOjc6IiM0ZDQzNjUiO3M6MjU6ImNvbG9yX2ZlYXRfb3ZlcnRleHRfY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMDoiY29sb3JfbWV0YSI7czo3OiIjY2FjYmNjIjtzOjExOiJjb2xvcl9kcm9wcyI7czo3OiIjMjIyNDI1IjtzOjE2OiJjb2xvcl9wcmVfaGVhZGVyIjtzOjc6IiNmZmZmZmYiO3M6MjE6ImNvbG9yX3ByZV9oZWFkZXJfdGV4dCI7czo3OiIjMjIyNDI1IjtzOjI3OiJjb2xvcl9wcmVfaGVhZGVyX3RleHRfaG92ZXIiO3M6NzoiIzkxODlhNCI7czoyMjoiY29sb3JfcHJlX2hlYWRlcl9tZW51cyI7czo3OiIjZjFmMWYxIjtzOjEyOiJjb2xvcl9oZWFkZXIiO3M6NzoiIzI3MmIzMiI7czoxODoiY29sb3JfaGVhZGVyX3N0dWNrIjtzOjc6IiMyNzJiMzIiO3M6MTc6ImNvbG9yX2hlYWRlcl90ZXh0IjtzOjc6IiNmZmZmZmYiO3M6MjM6ImNvbG9yX2hlYWRlcl90ZXh0X2hvdmVyIjtzOjc6IiNkZWQ5ZWEiO3M6MTg6ImNvbG9yX2hlYWRlcl9tZW51cyI7czo3OiIjMmYzNDNjIjtzOjIyOiJjb2xvcl9oZWFkZXJfbWVudXNfMm5kIjtzOjc6IiMzOTNmNDkiO3M6MTc6ImNvbG9yX3Bvc3RfaGVhZGVyIjtzOjc6IiMzZDQyNGEiO3M6MjI6ImNvbG9yX3Bvc3RfaGVhZGVyX3RleHQiO3M6NzoiI2ZmZmZmZiI7czoyODoiY29sb3JfcG9zdF9oZWFkZXJfdGV4dF9ob3ZlciI7czo3OiIjOTE4OWE0IjtzOjIzOiJjb2xvcl9wb3N0X2hlYWRlcl9tZW51cyI7czo3OiIjNTM1OTYzIjtzOjE1OiJjb2xvcl9zZWFyY2hfYmciO3M6NzoiIzFmMjMyNyI7czoxNzoiY29sb3Jfc2VhcmNoX3RleHQiO3M6NzoiI2ZmZmZmZiI7czoyMzoiY29sb3Jfc2VhcmNoX3RleHRfaG92ZXIiO3M6NzoiIzkxODlhNCI7czoxNzoiY29sb3Jfc2VhcmNoX2xpbmUiO3M6NzoiIzQ2NGQ1MSI7czoxMDoiY29sb3Jfc2lkciI7czo3OiIjMTkxYzIwIjtzOjE1OiJjb2xvcl9zaWRyX3RleHQiO3M6NzoiI2ZmZmZmZiI7czoyMToiY29sb3Jfc2lkcl90ZXh0X2hvdmVyIjtzOjc6IiM5MTg5YTQiO3M6MTU6ImNvbG9yX3NpZHJfbGluZSI7czo3OiIjMjMyNzJjIjtzOjEzOiJjb2xvcl9ib3JkZXJzIjtzOjc6IiNlMGUwZTAiO3M6MTg6ImNvbG9yX3NlY29uZF9wbGF0ZSI7czo3OiIjZjVmNmY3IjtzOjEyOiJjb2xvcl9maWVsZHMiO3M6NzoiI2YzZjNmMyI7czoxNToiY29sb3JfZmVhdF9hcmVhIjtzOjc6IiNmNGY2ZjciO3M6MjA6ImNvbG9yX2ZlYXRfYXJlYV90ZXh0IjtzOjc6IiMyMjI0MjUiO3M6MjY6ImNvbG9yX2ZlYXRfYXJlYV90ZXh0X2hvdmVyIjtzOjc6IiM5MDg4YTMiO3M6MTk6ImNvbG9yX2ZlYXRfY2FyX3RleHQiO3M6NzoiI2ZmZmZmZiI7czoyNToiY29sb3JfZmVhdF9jYXJfdGV4dF9ob3ZlciI7czo3OiIjYzFiMWU0IjtzOjIzOiJjb2xvcl9mZWF0X2FyZWFfYm9yZGVycyI7czo3OiIjZTBlMGUwIjtzOjE2OiJjb2xvcl9wcmVfZm9vdGVyIjtzOjc6IiNmZmZmZmYiO3M6MjE6ImNvbG9yX3ByZV9mb290ZXJfdGV4dCI7czo3OiIjMjIyNDI1IjtzOjI3OiJjb2xvcl9wcmVfZm9vdGVyX3RleHRfaG92ZXIiO3M6NzoiIzkwODhhMyI7czoxNDoiY29sb3JfYmFzZWxpbmUiO3M6NzoiIzNkNDY0YiI7czoxOToiY29sb3JfYmFzZWxpbmVfdGV4dCI7czo3OiIjZmZmZmZmIjtzOjI1OiJjb2xvcl9iYXNlbGluZV90ZXh0X2hvdmVyIjtzOjc6IiM5MDg4YTMiO3M6MTA6ImNvbG9yX2xvZ28iO3M6NzoiI2ZmZmZmZiI7czoxMDoiYmdfaW1nX3VybCI7czo3MjoiaHR0cDovL294aWUudGhlbWVjYW5vbi5jb20vd3AtY29udGVudC90aGVtZXMvb3hpZS9pbWcvcGF0dGVybnMvdGlsZTQucG5nIjtzOjc6ImJnX2xpbmsiO3M6MDoiIjtzOjc6ImJnX3NpemUiO3M6NzoicGF0dGVybiI7czo5OiJiZ19yZXBlYXQiO3M6NjoicmVwZWF0IjtzOjEzOiJiZ19hdHRhY2htZW50IjtzOjU6ImZpeGVkIjtzOjk6ImZvbnRfbWFpbiI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjEyOiJmb250X2hlYWRpbmciO2E6Mzp7aTowO3M6MTM6ImNhbm9uX2RlZmF1bHQiO2k6MTtzOjc6InJlZ3VsYXIiO2k6MjtzOjU6ImxhdGluIjt9czoxOToiZm9udF9oZWFkaW5nX3N0cm9uZyI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjEzOiJmb250X2hlYWRpbmcyIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTM6ImZvbnRfaGVhZGluZzMiO2E6Mzp7aTowO3M6MTM6ImNhbm9uX2RlZmF1bHQiO2k6MTtzOjc6InJlZ3VsYXIiO2k6MjtzOjU6ImxhdGluIjt9czo4OiJmb250X25hdiI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjk6ImZvbnRfbWV0YSI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjExOiJmb250X2J1dHRvbiI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjEyOiJmb250X2Ryb3BjYXAiO2E6Mzp7aTowO3M6MTM6ImNhbm9uX2RlZmF1bHQiO2k6MTtzOjc6InJlZ3VsYXIiO2k6MjtzOjU6ImxhdGluIjt9czoxMDoiZm9udF9xdW90ZSI7YTozOntpOjA7czoxMzoiY2Fub25fZGVmYXVsdCI7aToxO3M6NzoicmVndWxhciI7aToyO3M6NToibGF0aW4iO31zOjEzOiJmb250X2xvZ290ZXh0IjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6OToiZm9udF9sZWFkIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6OToiZm9udF9ib2xkIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTE6ImZvbnRfaXRhbGljIjthOjM6e2k6MDtzOjEzOiJjYW5vbl9kZWZhdWx0IjtpOjE7czo3OiJyZWd1bGFyIjtpOjI7czo1OiJsYXRpbiI7fXM6MTQ6ImZvbnRfc2l6ZV9yb290IjtzOjM6IjEwMCI7czoyMjoibGlnaHRib3hfb3ZlcmxheV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjI0OiJsaWdodGJveF9vdmVybGF5X29wYWNpdHkiO3M6MzoiMC43IjtzOjI1OiJhbmltX2ltZ19zbGlkZXJfc2xpZGVzaG93IjtzOjk6InVuY2hlY2tlZCI7czoyMToiYW5pbV9pbWdfc2xpZGVyX2RlbGF5IjtzOjQ6IjUwMDAiO3M6Mjk6ImFuaW1faW1nX3NsaWRlcl9hbmltX2R1cmF0aW9uIjtzOjM6IjgwMCI7czoyNzoiYW5pbV9xdW90ZV9zbGlkZXJfc2xpZGVzaG93IjtzOjc6ImNoZWNrZWQiO3M6MjM6ImFuaW1fcXVvdGVfc2xpZGVyX2RlbGF5IjtzOjQ6IjUwMDAiO3M6MzE6ImFuaW1fcXVvdGVfc2xpZGVyX2FuaW1fZHVyYXRpb24iO3M6MzoiODAwIjtzOjEwOiJhbmltX21lbnVzIjtzOjE0OiJhbmltX21lbnVzX29mZiI7czoxNjoiYW5pbV9tZW51c19lbnRlciI7czo0OiJsZWZ0IjtzOjE1OiJhbmltX21lbnVzX21vdmUiO3M6MjoiNDAiO3M6MTk6ImFuaW1fbWVudXNfZHVyYXRpb24iO3M6MzoiNjAwIjtzOjE2OiJhbmltX21lbnVzX2RlbGF5IjtzOjM6IjE1MCI7fXM6MjI6ImNhbm9uX29wdGlvbnNfYWR2YW5jZWQiO2E6MTQ6e3M6MTk6ImN1c3RvbV93aWRnZXRfYXJlYXMiO2E6ODp7aTo5OTk5O2E6MTp7czo0OiJuYW1lIjtzOjA6IiI7fWk6MDthOjE6e3M6NDoibmFtZSI7czoyMDoiU2VhcmNoIFdpZGdldCBBcmVhIDEiO31pOjE7YToxOntzOjQ6Im5hbWUiO3M6MjA6IlNlYXJjaCBXaWRnZXQgQXJlYSAyIjt9aToyO2E6MTp7czo0OiJuYW1lIjtzOjIwOiJTZWFyY2ggV2lkZ2V0IEFyZWEgMyI7fWk6MzthOjE6e3M6NDoibmFtZSI7czoyMDoiU2VhcmNoIFdpZGdldCBBcmVhIDQiO31pOjQ7YToxOntzOjQ6Im5hbWUiO3M6MjA6IlNlYXJjaCBXaWRnZXQgQXJlYSA1Ijt9aTo1O2E6MTp7czo0OiJuYW1lIjtzOjU6InBhZ2VzIjt9aTo2O2E6MTp7czo0OiJuYW1lIjtzOjQ6InNob3AiO319czoxODoidXNlX2ZpbmFsX2NhbGxfY3NzIjtzOjc6ImNoZWNrZWQiO3M6MTQ6ImZpbmFsX2NhbGxfY3NzIjtzOjIzNzoiaDEsIGgzLCBuYXYgYSwgLm5hdiBhLCAucmVzcG9uc2l2ZS1tZW51LWJ1dHRvbnsNCgl0ZXh0LXRyYW5zZm9ybTogdXBwZXJjYXNlOw0KCWxldHRlci1zcGFjaW5nOiAxcHg7DQp9DQoucG9zdC1mb290ZXItY29udGFpbmVyew0KICAgIHRleHQtYWxpZ246IGNlbnRlcjsNCn0NCi5wb3N0LWZvb3Rlci5sZWZ0LCAucG9zdC1mb290ZXIucmlnaHR7DQogICAgZmxvYXQ6IG5vbmU7DQogICAgZGlzcGxheTogYmxvY2s7DQp9IjtzOjE4OiJjYW5vbl9vcHRpb25zX2RhdGEiO3M6MDoiIjtzOjExOiJpbXBvcnRfZGF0YSI7czowOiIiO3M6MTg6ImNhbm9uX3dpZGdldHNfZGF0YSI7czowOiIiO3M6MTk6ImltcG9ydF93aWRnZXRzX2RhdGEiO3M6MDoiIjtzOjI1OiJvYXV0aF9pbnN0YWdyYW1fY2xpZW50X2lkIjtzOjA6IiI7czoyOToib2F1dGhfaW5zdGFncmFtX2NsaWVudF9zZWNyZXQiO3M6MDoiIjtzOjI4OiJvYXV0aF9pbnN0YWdyYW1fcmVkaXJlY3RfdXJpIjtzOjgwOiJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbS93cC1hZG1pbi9hZG1pbi5waHA/cGFnZT1oYW5kbGVfY2Fub25fb3B0aW9uc19hZHZhbmNlZCI7czoxNToib2F1dGhfaW5zdGFncmFtIjtzOjA6IiI7czoyMToicmVzZXRfb2F1dGhfaW5zdGFncmFtIjtzOjA6IiI7czoxMToicmVzZXRfYmFzaWMiO3M6MDoiIjtzOjk6InJlc2V0X2FsbCI7czowOiIiO319">
							     		<?php _e('Demo settings', 'loc_canon'); ?></option>
							     		
							     		

									</select> 
								</td>
							</tr>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						IMPORT/EXPORT WIDGETS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Import/Export Widgets", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Import/Export widgets', 'loc_canon'),
									'content' 				=> array(
										__('Use this section to import/export your widgets.', 'loc_canon'),
										__(' ', 'loc_canon'),
										__('<strong>WARNING</strong>: Existing widgets and widget settings will be lost! ', 'loc_canon'),
										__(' ', 'loc_canon'),
										__('The Widget Areas Manager which is used to create custom widget areas is part of the theme settings so please notice that custom widget areas are imported/exported along with the rest of the theme settings and NOT as part of the widgets import/export function. As widgets can only be imported into custom widget areas that already exist you may want to import your theme settings first to make sure that the required custom widget areas exist when importing your widgets.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Generate widgets data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will generate widgets data. You can copy this data from the widgets data window.', 'loc_canon'),
										__('Clicking the window will select all text.', 'loc_canon'),
										__('Press CTRL+C on your keyboard or right click selected text and select copy.', 'loc_canon'),
										__('Once you have copied the data you can either save it to a text document/file (safest) or simply keep the data in your copy/paste clipboard (not safe).', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Import widgets data', 'loc_canon'),
									'content' 				=> array(
										__('Clicking this button will import your widgets data from the data string supplied in the widgets data window.', 'loc_canon'),
										__('Make sure you paste all of the data into the widgets data textarea/window. If part of the code is altered or left out import will fail.', 'loc_canon'),
										__('Click the "Import widgets data" button.', 'loc_canon'),
										__('Your widgets have now been imported.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> __('Load predefined widgets data', 'loc_canon'),
									'content' 				=> array(
										__('Use this select to load predefined widgets data into the data window.', 'loc_canon'),
										__('Click the "Import widgets data" button.', 'loc_canon'),
										__('The predefined widgets have now been imported.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'><?php _e("Widgets data", "loc_canon"); ?></th>
								<td colspan="2">
									<textarea id='canon_widgets_data' class='canon_export_data' name='canon_options_advanced[canon_widgets_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_widgets_data" name="canon_options_advanced[import_widgets_data]" value="">

									<input type="button" class="button button_generate_data" value="Generate widgets data" data-export_data="<?php echo esc_attr($encoded_serialized_widgets_data); ?>" />
									<button id="button_import_widgets_data" name="button_import_widgets_data" class="button-secondary"><?php _e("Import widgets data", "loc_canon"); ?></button>
								</td>
								<td class="float-right">
									<select class="predefined-data-select">
							     		<option value="" selected='selected'><?php _e('Load predefined widgets data...', 'loc_canon'); ?></option> 
							     		
							     		<option value="YToyOntzOjEyOiJ3aWRnZXRfYXJlYXMiO2E6MTc6e3M6MTg6Im9ycGhhbmVkX3dpZGdldHNfMSI7YTozOntpOjA7czoyNToid29vY29tbWVyY2Vfd2lkZ2V0X2NhcnQtMyI7aToxO3M6MjY6Indvb2NvbW1lcmNlX3ByaWNlX2ZpbHRlci0zIjtpOjI7czozMjoid29vY29tbWVyY2VfdG9wX3JhdGVkX3Byb2R1Y3RzLTMiO31zOjE5OiJ3cF9pbmFjdGl2ZV93aWRnZXRzIjthOjY6e2k6MDtzOjEwOiJhcmNoaXZlcy0yIjtpOjE7czo2OiJtZXRhLTIiO2k6MjtzOjg6InNlYXJjaC0yIjtpOjM7czoxMjoiY2F0ZWdvcmllcy0yIjtpOjQ7czoxNDoicmVjZW50LXBvc3RzLTIiO2k6NTtzOjE3OiJyZWNlbnQtY29tbWVudHMtMiI7fXM6MzM6ImNhbm9uX2FyY2hpdmVfc2lkZWJhcl93aWRnZXRfYXJlYSI7YTo1OntpOjA7czoxOToib3hpZV9zb2NpYWxfbGlua3MtMyI7aToxO3M6NjoidGV4dC0yIjtpOjI7czoxNzoib3hpZV9tb3JlX3Bvc3RzLTUiO2k6MztzOjI0OiJveGllX2luc3RhZ3JhbV9nYWxsZXJ5LTMiO2k6NDtzOjY6InRleHQtMyI7fXM6MzA6ImNhbm9uX3BhZ2Vfc2lkZWJhcl93aWRnZXRfYXJlYSI7YTowOnt9czoyNzoiY2Fub25fZmVhdHVyZV93aWRnZXRfYXJlYV8xIjthOjE6e2k6MDtzOjE3OiJveGllX21vcmVfcG9zdHMtNCI7fXM6Mjc6ImNhbm9uX2ZlYXR1cmVfd2lkZ2V0X2FyZWFfMiI7YToxOntpOjA7czoxNzoib3hpZV9xdWlja2xpbmtzLTUiO31zOjI3OiJjYW5vbl9mZWF0dXJlX3dpZGdldF9hcmVhXzMiO2E6MTp7aTowO3M6MTQ6Im94aWVfdHdpdHRlci0zIjt9czoyNzoiY2Fub25fZmVhdHVyZV93aWRnZXRfYXJlYV80IjthOjA6e31zOjI3OiJjYW5vbl9mZWF0dXJlX3dpZGdldF9hcmVhXzUiO2E6MDp7fXM6MzA6ImNhbm9uX2N3YV9zZWFyY2gtd2lkZ2V0LWFyZWEtMSI7YToxOntpOjA7czoxNzoib3hpZV9tb3JlX3Bvc3RzLTIiO31zOjMwOiJjYW5vbl9jd2Ffc2VhcmNoLXdpZGdldC1hcmVhLTIiO2E6MTp7aTowO3M6MTc6Im94aWVfcXVpY2tsaW5rcy00Ijt9czozMDoiY2Fub25fY3dhX3NlYXJjaC13aWRnZXQtYXJlYS0zIjthOjE6e2k6MDtzOjE0OiJveGllX3R3aXR0ZXItMiI7fXM6MzA6ImNhbm9uX2N3YV9zZWFyY2gtd2lkZ2V0LWFyZWEtNCI7YTowOnt9czozMDoiY2Fub25fY3dhX3NlYXJjaC13aWRnZXQtYXJlYS01IjthOjA6e31zOjE1OiJjYW5vbl9jd2FfcGFnZXMiO2E6Mjp7aTowO3M6MTk6Im94aWVfc29jaWFsX2xpbmtzLTIiO2k6MTtzOjE3OiJveGllX21vcmVfcG9zdHMtMyI7fXM6MTQ6ImNhbm9uX2N3YV9zaG9wIjthOjM6e2k6MDtzOjI1OiJ3b29jb21tZXJjZV93aWRnZXRfY2FydC0yIjtpOjE7czoyNjoid29vY29tbWVyY2VfcHJpY2VfZmlsdGVyLTIiO2k6MjtzOjMyOiJ3b29jb21tZXJjZV90b3BfcmF0ZWRfcHJvZHVjdHMtMiI7fXM6MTM6ImFycmF5X3ZlcnNpb24iO2k6Mzt9czoxNDoiYWN0aXZlX3dpZGdldHMiO2E6MTU6e3M6MjM6Indvb2NvbW1lcmNlX3dpZGdldF9jYXJ0IjthOjM6e2k6MjthOjI6e3M6NToidGl0bGUiO3M6MTM6IlNob3BwaW5nIENhcnQiO3M6MTM6ImhpZGVfaWZfZW1wdHkiO3M6MToiMSI7fWk6MzthOjI6e3M6NToidGl0bGUiO3M6MTM6IlNob3BwaW5nIENhcnQiO3M6MTM6ImhpZGVfaWZfZW1wdHkiO2k6MDt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MjQ6Indvb2NvbW1lcmNlX3ByaWNlX2ZpbHRlciI7YTozOntpOjI7YToxOntzOjU6InRpdGxlIjtzOjE1OiJGaWx0ZXIgYnkgcHJpY2UiO31pOjM7YToxOntzOjU6InRpdGxlIjtzOjE1OiJGaWx0ZXIgYnkgcHJpY2UiO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czozMDoid29vY29tbWVyY2VfdG9wX3JhdGVkX3Byb2R1Y3RzIjthOjM6e2k6MjthOjI6e3M6NToidGl0bGUiO3M6MTg6IlRvcCBSYXRlZCBQcm9kdWN0cyI7czo2OiJudW1iZXIiO3M6MToiNSI7fWk6MzthOjI6e3M6NToidGl0bGUiO3M6MTg6IlRvcCBSYXRlZCBQcm9kdWN0cyI7czo2OiJudW1iZXIiO3M6MToiMyI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjg6ImFyY2hpdmVzIjthOjI6e2k6MjthOjM6e3M6NToidGl0bGUiO3M6MDoiIjtzOjU6ImNvdW50IjtpOjA7czo4OiJkcm9wZG93biI7aTowO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czo0OiJtZXRhIjthOjI6e2k6MjthOjE6e3M6NToidGl0bGUiO3M6MDoiIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6Njoic2VhcmNoIjthOjI6e2k6MjthOjE6e3M6NToidGl0bGUiO3M6MDoiIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MTA6ImNhdGVnb3JpZXMiO2E6Mjp7aToyO2E6NDp7czo1OiJ0aXRsZSI7czowOiIiO3M6NToiY291bnQiO2k6MDtzOjEyOiJoaWVyYXJjaGljYWwiO2k6MDtzOjg6ImRyb3Bkb3duIjtpOjA7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjEyOiJyZWNlbnQtcG9zdHMiO2E6Mjp7aToyO2E6Mjp7czo1OiJ0aXRsZSI7czowOiIiO3M6NjoibnVtYmVyIjtpOjU7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjE1OiJyZWNlbnQtY29tbWVudHMiO2E6Mjp7aToyO2E6Mjp7czo1OiJ0aXRsZSI7czowOiIiO3M6NjoibnVtYmVyIjtpOjU7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjE3OiJveGllX3NvY2lhbF9saW5rcyI7YTozOntpOjI7YTo0OntzOjU6InRpdGxlIjtzOjEyOiJTb2NpYWwgTGlua3MiO3M6MTM6ImRpc3BsYXlfc3R5bGUiO3M6NjoiY2lyY2xlIjtzOjExOiJvcGVuX2luX25ldyI7czo3OiJjaGVja2VkIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6Njp7aTowO2E6Mjp7aTowO3M6MTE6ImZhLWZhY2Vib29rIjtpOjE7czozNToiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3RoZW1lY2Fub24iO31pOjE7YToyOntpOjA7czoxMDoiZmEtdHdpdHRlciI7aToxO3M6MzA6Imh0dHBzOi8vdHdpdHRlci5jb20vVGhlbWVDYW5vbiI7fWk6MjthOjI6e2k6MDtzOjE0OiJmYS1nb29nbGUtcGx1cyI7aToxO3M6MToiIyI7fWk6MzthOjI6e2k6MDtzOjExOiJmYS1kcmliYmJsZSI7aToxO3M6MToiIyI7fWk6NDthOjI6e2k6MDtzOjk6ImZhLWdpdGh1YiI7aToxO3M6MToiIyI7fWk6NTthOjI6e2k6MDtzOjY6ImZhLXJzcyI7aToxO3M6MzI6Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL2ZlZWQvIjt9fX1pOjM7YTo0OntzOjU6InRpdGxlIjtzOjEyOiJTb2NpYWwgTGlua3MiO3M6MTM6ImRpc3BsYXlfc3R5bGUiO3M6NjoiY2lyY2xlIjtzOjExOiJvcGVuX2luX25ldyI7czo3OiJjaGVja2VkIjtzOjEyOiJzb2NpYWxfbGlua3MiO2E6Njp7aTowO2E6Mjp7aTowO3M6MTE6ImZhLWZhY2Vib29rIjtpOjE7czozNToiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL3RoZW1lY2Fub24iO31pOjE7YToyOntpOjA7czoxMDoiZmEtdHdpdHRlciI7aToxO3M6MzA6Imh0dHBzOi8vdHdpdHRlci5jb20vVGhlbWVDYW5vbiI7fWk6MjthOjI6e2k6MDtzOjE0OiJmYS1nb29nbGUtcGx1cyI7aToxO3M6MToiIyI7fWk6MzthOjI6e2k6MDtzOjExOiJmYS1kcmliYmJsZSI7aToxO3M6MToiIyI7fWk6NDthOjI6e2k6MDtzOjk6ImZhLWdpdGh1YiI7aToxO3M6MToiIyI7fWk6NTthOjI6e2k6MDtzOjY6ImZhLXJzcyI7aToxO3M6MzI6Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL2ZlZWQvIjt9fX1zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czo0OiJ0ZXh0IjthOjM6e2k6MjthOjM6e3M6NToidGl0bGUiO3M6ODoiQWJvdXQgTWUiO3M6NDoidGV4dCI7czozMDM6IjxpbWcgc3JjPSJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbS93cC1jb250ZW50L3VwbG9hZHMvcmV2c2xpZGVyL2hvbWVwYWdlL3NsaWRlLTEuanBnIiBhbHQ9ImFib3V0IG1lIiAvPg0KDQpDcmFzIGp1c3RvIG9kaW8sIGRhcGlidXMgYWMgZmFjaWxpc2lzIGluLCBlZ2VzdGFzIGVnZXQgcXVhbS4gQ3VtIHNvY2lpcyBuYXRvcXVlIHBlbmF0aWJ1cyBldCBtYWduaXMgZGlzIHBhcnR1cmllbnQgbW9udGVzLCBuYXNjZXR1ciByaWRpY3VsdXMgbXVzLiANCg0KPGEgY2xhc3M9InJlYWQtbW9yZSIgaHJlZj0iIyI+UmVhZCBNb3JlPC9hPiI7czo2OiJmaWx0ZXIiO2I6MTt9aTozO2E6Mzp7czo1OiJ0aXRsZSI7czo2OiJBZHZlcnQiO3M6NDoidGV4dCI7czo3OToiPGltZyBzcmM9Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE1LzA4L2FkLW1vY2sucG5nIiAvPiI7czo2OiJmaWx0ZXIiO2I6MDt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MTU6Im94aWVfbW9yZV9wb3N0cyI7YTo1OntpOjI7YTo1OntzOjU6InRpdGxlIjtzOjEwOiJNb3JlIHBvc3RzIjtzOjQ6InNob3ciO3M6MTI6ImxhdGVzdF9wb3N0cyI7czoxMzoiZGlzcGxheV9zdHlsZSI7czoxNToidGh1bWJuYWlsc19saXN0IjtzOjk6Im51bV9wb3N0cyI7czoxOiIzIjtzOjExOiJudW1fY29sdW1ucyI7czoxOiIzIjt9aTozO2E6NTp7czo1OiJ0aXRsZSI7czoxMzoiUG9wdWxhciBQb3N0cyI7czo0OiJzaG93IjtzOjEzOiJwb3B1bGFyX3ZpZXdzIjtzOjEzOiJkaXNwbGF5X3N0eWxlIjtzOjE1OiJ0aHVtYm5haWxzX2xpc3QiO3M6OToibnVtX3Bvc3RzIjtzOjE6IjMiO3M6MTE6Im51bV9jb2x1bW5zIjtzOjE6IjIiO31pOjQ7YTo1OntzOjU6InRpdGxlIjtzOjEwOiJNb3JlIHBvc3RzIjtzOjQ6InNob3ciO3M6MTI6ImxhdGVzdF9wb3N0cyI7czoxMzoiZGlzcGxheV9zdHlsZSI7czoxNToidGh1bWJuYWlsc19saXN0IjtzOjk6Im51bV9wb3N0cyI7czoxOiIyIjtzOjExOiJudW1fY29sdW1ucyI7czoxOiIyIjt9aTo1O2E6NTp7czo1OiJ0aXRsZSI7czoxMjoiUmVjZW50IFBvc3RzIjtzOjQ6InNob3ciO3M6MTI6ImxhdGVzdF9wb3N0cyI7czoxMzoiZGlzcGxheV9zdHlsZSI7czoxNToidGh1bWJuYWlsc19saXN0IjtzOjk6Im51bV9wb3N0cyI7czoxOiIzIjtzOjExOiJudW1fY29sdW1ucyI7czoxOiIyIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MjI6Im94aWVfaW5zdGFncmFtX2dhbGxlcnkiO2E6Mjp7aTozO2E6Nzp7czo1OiJ0aXRsZSI7czoxNzoiSW5zdGFncmFtIEdhbGxlcnkiO3M6NDoic2hvdyI7czo2OiJyZWNlbnQiO3M6NzoidXNlcl9pZCI7czo4OiIyNTAyNTMyMCI7czo3OiJoYXNodGFnIjtzOjU6ImZhZGVkIjtzOjEwOiJpbWFnZV9saW5rIjtzOjk6Imluc3RhZ3JhbSI7czo5OiJudW1fcG9zdHMiO3M6MToiOSI7czoxMToibnVtX2NvbHVtbnMiO3M6MToiMyI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjE1OiJveGllX3F1aWNrbGlua3MiO2E6Mzp7aTo0O2E6Mjp7czo1OiJ0aXRsZSI7czoxMDoiUXVpY2tsaW5rcyI7czo3OiJjb250ZW50IjtzOjM4NjoiPHVsIGNsYXNzPSJsaW5rLWxpc3QiPg0KCTxsaT48YSBocmVmPSJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbSI+T3hpZSBIb21lIFBhZ2U8L2E+PC9saT4NCjxsaT48YSBocmVmPSJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbS9hYm91dC1tZS8iPkFib3V0IE1lPC9hPjwvbGk+DQoJPGxpPjxhIGhyZWY9Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL2NvbnRhY3QtbWUvIj5Db250YWN0IFVzIFRvZGF5PC9hPjwvbGk+DQo8bGk+PGEgaHJlZj0iaHR0cDovL294aWUudGhlbWVjYW5vbi5jb20vc2hvcC8iPlZpc2l0IE91ciBTaG9wIDwvYT48L2xpPg0KCTxsaT48YSBocmVmPSJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbSI+UmVhZCBPdXIgQmxvZzwvYT48L2xpPg0KPC91bD4iO31pOjU7YToyOntzOjU6InRpdGxlIjtzOjEwOiJRdWlja2xpbmtzIjtzOjc6ImNvbnRlbnQiO3M6MzIwOiI8dWwgY2xhc3M9ImxpbmstbGlzdCI+DQoJPGxpPjxhIGhyZWY9Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tIj5PeGllIEhvbWUgUGFnZTwvYT48L2xpPg0KPGxpPjxhIGhyZWY9Imh0dHA6Ly9veGllLnRoZW1lY2Fub24uY29tL2Fib3V0LW1lLyI+QWJvdXQgTWU8L2E+PC9saT4NCgk8bGk+PGEgaHJlZj0iaHR0cDovL294aWUudGhlbWVjYW5vbi5jb20vY29udGFjdC1tZS8iPkNvbnRhY3QgVXMgVG9kYXk8L2E+PC9saT4NCjxsaT48YSBocmVmPSJodHRwOi8vb3hpZS50aGVtZWNhbm9uLmNvbS9zaG9wLyI+VmlzaXQgT3VyIFNob3AgPC9hPjwvbGk+DQo8L3VsPiI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjEyOiJveGllX3R3aXR0ZXIiO2E6Mzp7aToyO2E6NDp7czo1OiJ0aXRsZSI7czoxMzoiTGF0ZXN0IHR3ZWV0cyI7czoxOToidHdpdHRlcl93aWRnZXRfY29kZSI7czo0Njc6IiAgICAgICAgICAgIDxhIGNsYXNzPSJ0d2l0dGVyLXRpbWVsaW5lIiAgaHJlZj0iaHR0cHM6Ly90d2l0dGVyLmNvbS9tYWtlbGVtb25hZGVjbyIgZGF0YS13aWRnZXQtaWQ9IjM3NzMxNjE1ODIzMzI2NDEyOCI+VHdlZXRzIGJ5IEBtYWtlbGVtb25hZGVjbzwvYT4NCiAgICAgICAgICAgIDxzY3JpcHQ+IWZ1bmN0aW9uKGQscyxpZCl7dmFyIGpzLGZqcz1kLmdldEVsZW1lbnRzQnlUYWdOYW1lKHMpWzBdLHA9L15odHRwOi8udGVzdChkLmxvY2F0aW9uKT8naHR0cCc6J2h0dHBzJztpZighZC5nZXRFbGVtZW50QnlJZChpZCkpe2pzPWQuY3JlYXRlRWxlbWVudChzKTtqcy5pZD1pZDtqcy5zcmM9cCsiOi8vcGxhdGZvcm0udHdpdHRlci5jb20vd2lkZ2V0cy5qcyI7ZmpzLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKGpzLGZqcyk7fX0oZG9jdW1lbnQsInNjcmlwdCIsInR3aXR0ZXItd2pzIik7PC9zY3JpcHQ+DQogICAgICAgICAgIjtzOjE2OiJ1c2VfdGhlbWVfZGVzaWduIjtzOjc6ImNoZWNrZWQiO3M6MTg6InR3aXR0ZXJfbnVtX3R3ZWV0cyI7czoxOiIxIjt9aTozO2E6NDp7czo1OiJ0aXRsZSI7czoxMzoiTGF0ZXN0IHR3ZWV0cyI7czoxOToidHdpdHRlcl93aWRnZXRfY29kZSI7czo0Njc6IiAgICAgICAgICAgIDxhIGNsYXNzPSJ0d2l0dGVyLXRpbWVsaW5lIiAgaHJlZj0iaHR0cHM6Ly90d2l0dGVyLmNvbS9tYWtlbGVtb25hZGVjbyIgZGF0YS13aWRnZXQtaWQ9IjM3NzMxNjE1ODIzMzI2NDEyOCI+VHdlZXRzIGJ5IEBtYWtlbGVtb25hZGVjbzwvYT4NCiAgICAgICAgICAgIDxzY3JpcHQ+IWZ1bmN0aW9uKGQscyxpZCl7dmFyIGpzLGZqcz1kLmdldEVsZW1lbnRzQnlUYWdOYW1lKHMpWzBdLHA9L15odHRwOi8udGVzdChkLmxvY2F0aW9uKT8naHR0cCc6J2h0dHBzJztpZighZC5nZXRFbGVtZW50QnlJZChpZCkpe2pzPWQuY3JlYXRlRWxlbWVudChzKTtqcy5pZD1pZDtqcy5zcmM9cCsiOi8vcGxhdGZvcm0udHdpdHRlci5jb20vd2lkZ2V0cy5qcyI7ZmpzLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKGpzLGZqcyk7fX0oZG9jdW1lbnQsInNjcmlwdCIsInR3aXR0ZXItd2pzIik7PC9zY3JpcHQ+DQogICAgICAgICAgIjtzOjE2OiJ1c2VfdGhlbWVfZGVzaWduIjtzOjc6ImNoZWNrZWQiO3M6MTg6InR3aXR0ZXJfbnVtX3R3ZWV0cyI7czoxOiIxIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fX19">
							     		<?php _e('Demo widgets', 'loc_canon'); ?></option>

									</select> 
								</td>

							</tr>

						</table>




					<!-- 
					--------------------------------------------------------------------------
						INSTAGRAM AUTHORIZATION
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Instagram Authorization", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php _e('Register and authorize your site as an Instagram client. This will allow you to use the Instagram features of this theme e.g. displaying your recent Instagram media using the Instagram carousel.', 'loc_canon'); ?>

							<br><br>

							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('STEP 1', 'loc_canon'),
									'content' 				=> array(
										__('Register your site as an Instagram client to receive a Client ID and a Client secret. Click the STEP 1 link to begin the process. The STEP 1 link will take you to instagram.com where you will need to log in to Instagram and register your site/application/client. During this procedure you will be asked for:', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'ul',
									'content' 				=> array(
										__('Application Name (e.g. Oxie)', 'loc_canon'),
										__('Description (e.g. My Homepage)', 'loc_canon'),
										__('Website (http://www.myhomepage.com)', 'loc_canon'),
										__('OAuth redirect_uri (this must be exactly the same as provided in the Redirect URI text field in the theme settings)', 'loc_canon'),
										__('Contact email (e.g. my@email.com)', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'content' 				=> array(
										__('Once your site is registered as an Instagram client copy/paste the Client ID and Client Secret to the corresponding inputs in the theme settings and click Save Changes.', 'loc_canon'),
										__('<strong>NB</strong>: Never give out your Client Secret.', 'loc_canon'),
									),
								)); 


								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('STEP 2', 'loc_canon'),
									'content' 				=> array(
										__('The STEP 1 link will now be replaced by a STEP 2 link. Simply click this link to authorize your site/client with Instagram.', 'loc_canon'),
										__('If successful the STEP 2 link will be replaced by a success notification and you are now ready to use the theme Instagram features.', 'loc_canon'),
									),
								)); 

								printf('<h2>%s</h2><br>', __('Troubleshooting', 'loc_canon'));

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('ERROR: No matching code found. Try clearing code or reset.', 'loc_canon'),
									'content' 				=> array(
										__('This error happens on rare occassions when a timed out code parameter still resides in the URL. Simply click the Clearing code link or visit another page and come back to the General Settings as this will clear the old code parameter from the URL.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('ERROR: There are no HTTP transports available which can complete the requested request.', 'loc_canon'),
									'content' 				=> array(
										__('Instagram authorization uses the <a href="http://codex.wordpress.org/HTTP_API" target="_blank">WordPress HTTP API</a> which detects and uses the transport methods that are available on your server (e.g. file_get_contents, cURL etc). Very rarely a server will have no transport methods available and you will get this error message. You will need to contact the people responsible for your server and kindly ask them to make transports available on your server.', 'loc_canon'),
									),
								)); 

							?>


						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Client ID', 'loc_canon'),
									'slug' 					=> 'oauth_instagram_client_id',
									'colspan'				=> '2',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_advanced',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Client Secret', 'loc_canon'),
									'slug' 					=> 'oauth_instagram_client_secret',
									'colspan'				=> '2',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_advanced',
								)); 

							?>

							<tr>
								<th scope='row'><?php _e("Redirect URI", "loc_canon"); ?></th>
								<td colspan="2">
									<input type='text' name='canon_options_advanced[oauth_instagram_redirect_uri]' class="widefat" value="<?php echo esc_url($redirect_uri); ?>" readonly>
								</td>
							</tr>

							<tr>
								<th></th>

								<td>
									<?php 

										// OAUTH INSTAGRAM STATUS
										if (!empty($oauth_instagram_error_message)) {
											printf('ERROR: %s', wp_kses_post($oauth_instagram_error_message));		
										} elseif ($oauth_instagram_step === 1) {
											printf('<a href="https://instagram.com/developer/clients/manage/" target="_blank">%s</a>', __('STEP 1: Register your site as an Instagram client to get Client ID and Client Secret (Save when done).', 'loc_canon'));
										} elseif ($oauth_instagram_step == 2) {
											printf('<a href="%s">%s</a>', esc_url($oauth_instagram_authorize_uri), __('STEP 2: Log in to Instagram.', 'loc_canon'));
										} elseif ($oauth_instagram_step == 4) {
											$instagram_username = $canon_options_advanced['oauth_instagram']['user']['username'];
											printf('Hi <strong>%s</strong>, your site is now authorized to interact with Instagram.', esc_attr($instagram_username));	
										}

									?>

								</td>
								<td>
									<input type="hidden" id="oauth_instagram" name="canon_options_advanced[oauth_instagram]" value="<?php echo esc_attr(base64_encode(serialize($canon_options_advanced['oauth_instagram']))); ?>">
									<input type="hidden" id="reset_oauth_instagram" name="canon_options_advanced[reset_oauth_instagram]" value="">
									<button id="reset_oauth_instagram_button" class="button-secondary reset_nowarn_button"><?php _e("Reset", "loc_canon"); ?></button>
								</td>
							</tr>



						</table>



					<!-- BOTTOM BUTTONS -->

					<br><br>
					
					<div class="save_submit"><?php submit_button(); ?></div>

					<input type="hidden" id="reset_basic" name="canon_options_advanced[reset_basic]" value="">
					<button id="reset_basic_button" class="button-primary reset_button"><?php _e("Reset basic settings ..", "loc_canon"); ?></button>

					<input type="hidden" id="reset_all" name="canon_options_advanced[reset_all]" value="">
					<button id="reset_all_button" class="button-primary reset_button"><?php _e("Reset all settings ..", "loc_canon"); ?></button>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

