<?php

/////////////////////////////////

// INDEX
//
// COLOR
// NUMBER
// IMAGE SIZE
// CHECKBOX
// UPLOAD
// TEXT
// TEXTAREA
// SELECT
// SELECT ONLY
// SELECT SIDEBAR
// FONT
// HIDDEN

/////////////////////////////////





	function fw_option ($params) {

		extract($params);

		// general vars
		$id = $slug;
		$name = $options_name . "[" . $slug . "]";
		$options = get_option($options_name);
		$colspan_str = (isset($colspan)) ? " colspan='".$colspan."'" : "";

		// table row params (incl. dynamic_options)
		$tr_string = "valign='top'";
		if (isset($listen_to) && isset($listen_for)) { $tr_string .= " class='dynamic_option' data-listen_to='$listen_to' data-listen_for='$listen_for'"; }

		// GET ARRAY OF REGISTERED SIDEBARS
		$registered_sidebars_array = array();
		foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) { array_push($registered_sidebars_array, $value); }


// COLOR

// Usage:

// fw_option(array(
// 	'type'					=> 'color',
// 	'title' 				=> __('Example Color', 'loc_canon'),
// 	'slug' 					=> 'color_example',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "color") {

			// specific vars
			$colorselector_id = "colorSelector_" . $slug;

			?>

			<!-- FW OPTION: COLOR-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>

					<td>
						<input type="text" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>" />    
						<div class="colorSelectorBox" id="<?php echo esc_attr($colorselector_id); ?>">
							<div style="background-color: <?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>"></div>
						</div>
					</td>

				</tr>

			<?php

			return true;		
				
		}


// NUMBER
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'number',
// 	'title' 				=> __('Example opacity', 'loc_canon'),
// 	'slug' 					=> 'example_opacity',
// 	'min'					=> '0',										// optional
// 	'max'					=> '1',										// optional
// 	'step'					=> '0.1',									// optional
// 	'width_px'				=> '60',									// optional
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'colspan'				=> '2',										// optional
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "number") {

			// specific vars
			if (isset($width_px)) { $style_width = 'width:' . $width_px . 'px;'; };
			?>

			<!-- FW OPTION: NUMBER-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input 
							type='number' 
							id= <?php echo esc_attr($id); ?>
							name= <?php echo esc_attr($name); ?>
							<?php if (isset($min)) { echo "min=" . $min; } ?>
							<?php if (isset($max)) { echo "max=" . $max; } ?>
							<?php if (isset($step)) { echo "step=" . $step; } ?>
							<?php if (isset($width_px)) { echo "style=" . $style_width; } ?>
							value='<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } ?>
					</td>
				</tr>

			<?php

			return true;		
				
		}


// IMAGE SIZE
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'image_size',
// 	'title' 				=> __('Example opacity', 'loc_canon'),
// 	'slug' 					=> 'example_opacity',
// 	'min'					=> '0',										// optional
// 	'max'					=> '1',										// optional
// 	'step'					=> '0.1',									// optional
// 	'width_px'				=> '60',									// optional
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "image_size") {

			// specific vars
			if (isset($width_px)) { $style_width = 'width:' . $width_px . 'px;'; };

			$name = $options_name . "[image_sizes][" . $slug . "]";

			?>

			<!-- FW OPTION: IMAGE SIZE-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td>
						<input 
							type='number' 
							name= <?php echo esc_attr($name . "[width]"); ?>
							min= <?php if (isset($min)) { echo esc_attr($min); } else { echo '1'; } ?>
							max= <?php if (isset($max)) { echo esc_attr($max); } else { echo '10000'; } ?>
							step= <?php if (isset($step)) { echo esc_attr($step); } else { echo '1'; } ?>
							style= <?php if (isset($width_px)) { echo esc_attr($style_width); } else { echo '"width: 60px"'; } ?>
							value='<?php if (isset($options['image_sizes'][$slug]['width'])) echo esc_attr($options['image_sizes'][$slug]['width']); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } else { _e('(px)', 'loc_canon'); } ?>
					</td>
					<td>
						<?php _e('x', 'loc_canon'); ?>
					</td>
					<td>
						<input 
							type='number' 
							name= <?php echo esc_attr($name . "[height]"); ?>
							min= <?php if (isset($min)) { echo esc_attr($min); } else { echo '1'; } ?>
							max= <?php if (isset($max)) { echo esc_attr($max); } else { echo '10000'; } ?>
							step= <?php if (isset($step)) { echo esc_attr($step); } else { echo '1'; } ?>
							style= <?php if (isset($width_px)) { echo esc_attr($style_width); } else { echo '"width: 60px"'; } ?>
							value='<?php if (isset($options['image_sizes'][$slug]['height'])) echo esc_attr($options['image_sizes'][$slug]['height']); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } else { _e('(px)', 'loc_canon'); } ?>
					</td>
					<td>

						<?php 
							$current_aspect_ratio = round($options['image_sizes'][$slug]['width'] / $options['image_sizes'][$slug]['height'], 2);
							// printf('<i>(Recommended aspect ratio: <strong>%s:1</strong> / Current aspect ratio:  <strong>%s:1</strong>)</i>', esc_attr($options['image_sizes'][$slug]['ratio']), esc_attr($current_aspect_ratio)); 
							printf('Aspect ratio: <strong>%s:1</strong>', esc_attr($current_aspect_ratio)); 
						?>

						<input type="hidden" name="<?php echo esc_attr($name. "[ratio]"); ?>" value="<?php echo esc_attr($options['image_sizes'][$slug]['ratio']); ?>">
					
					</td>

					<td>
						<?php printf('(<i>Recommended: <strong>%s:1</strong>)</i>', esc_attr($options['image_sizes'][$slug]['ratio']) ); ?>
					</td>
				</tr>


			<?php

			return true;		
				
		}


// CHECKBOX
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'checkbox',
// 	'title' 				=> __('Slideshow', 'loc_canon'),
// 	'slug' 					=> 'anim_slider',
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'colspan'				=> '2',										// optional
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "checkbox") {
			?>

			<!-- FW OPTION: CHECKBOX-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input type="hidden" name="<?php echo esc_attr($name); ?>" value="unchecked" />
						<input class="checkbox" type="checkbox" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="checked" <?php if (isset($options[$slug])) { checked($options[$slug] == "checked"); } ?>/> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } ?>
					</td>
				</tr>

			<?php

			return true;		
				
		}


// UPLOAD
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'upload',
// 	'title' 				=> __('Logo URL', 'loc_canon'),
// 	'slug' 					=> 'logo_url',
// 	'btn_text'				=> __('Upload logo', 'loc_canon'),
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "upload") {

			// specific vars
			?>

			<!-- FW OPTION: UPLOAD-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td>
						<input type='text' id='<?php echo esc_attr($id); ?>' name='<?php echo esc_attr($name); ?>' class='url' value='<?php if (isset($options[$slug])) echo esc_url($options[$slug]); ?>'>
						<input type="button" class="upload button upload_button" value="<?php echo esc_attr($btn_text); ?>" />
					</td>
				</tr>

			<?php

			return true;		
				
		}

// TEXT
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'text',
// 	'title' 				=> __('Use text as logo', 'loc_canon'),
// 	'slug' 					=> 'logo_text',
// 	'class'					=> 'widefat',
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options',
// )); 


		if ($type == "text") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW OPTION: TEXT-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input type='text' name='<?php echo esc_attr($name); ?>' class="<?php echo esc_attr($final_class); ?>" value="<?php if (isset($options[$slug])) echo htmlspecialchars($options[$slug]); ?>">
					</td>
				</tr>

			<?php

			return true;		
				
		}


// TEXTAREA
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'textarea',
// 	'title' 				=> __('Footer text', 'loc_canon'),
// 	'slug' 					=> 'footer_text',
// 	'cols'					=> '100',
// 	'rows'					=> '5',
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "textarea") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW OPTION: TEXTAREA-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>

					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>

						<textarea 
							id='<?php echo esc_attr($id); ?>' 
							name='<?php echo esc_attr($name); ?>' 
							class="<?php echo esc_attr($final_class); ?>" 
							<?php if (isset($cols)) { echo "cols=" . $cols; } ?>
							<?php if (isset($rows)) { echo "rows=" . $rows; } ?>
						><?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?></textarea>

					</td>
				</tr>

			<?php

			return true;		
				
		}


// SELECT
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'select',
// 	'title' 				=> __('Homepage Blog Style', 'loc_canon'),
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> __('Full width', 'loc_canon'),
// 		'sidebar'				=> __('With sidebar', 'loc_canon')
// 	),
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select") {

			?>

			<!-- FW OPTION: SELECT-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
					
						<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

							<?php 

								foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
								<?php		
								}


							?>
			     	
						</select> 
					
					</td>
				
				</tr>


			<?php

			return true;		
				
		}



// SELECT ONLY
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'select_only',
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> __('Full width', 'loc_canon'),
// 		'sidebar'				=> __('With sidebar', 'loc_canon')
// 	),
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select_only") {

			?>

			<!-- FW OPTION: SELECT ONLY-->

					
				<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

					<?php 

						foreach ($select_options as $key => $value) {
						?>
	     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
						<?php		
						}


					?>
	     	
				</select> 
					
			<?php

			return true;		
				
		}


// SELECT SIDEBAR
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'select_sidebar',
// 	'title' 				=> __('Homepage Blog Style', 'loc_canon'),
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> __('Full width', 'loc_canon'),
// 		'sidebar'				=> __('With sidebar', 'loc_canon')
// 	),
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select_sidebar") {

			?>

			<!-- FW OPTION: SELECT SIDEBAR-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
					
						<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

							<?php 

								if (isset($select_options)) { foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
								<?php		
								}}

								for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
								?>
				     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo  $registered_sidebars_array[$i]['name']; ?></option> 
								<?php
								}

							?>
			     	
						</select> 
					
					</td>
				
				</tr>

			<?php

			return true;		
				
		}



// FONT
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'font',
// 	'title' 				=> __('Body text', 'loc_canon'),
// 	'slug' 					=> 'font_main',
// 	'options_name'			=> 'canon_options_appearance',
// )); 




		if ($type == "font") {

			?>

			<!-- FW OPTION: FONT-->

				<tr id='<?php echo esc_attr($id); ?>' valign='top' class='canon_webfonts_controller'>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>

					<td>
						<select id="font_main_family" name="<?php echo esc_attr($name); ?>[0]" class="canon_font_family" data-selected="<?php if (isset($options[$slug][0])) echo esc_attr($options[$slug][0]); ?>"> 
							<option value="canon_default" <?php if (isset($options[$slug][0])) {if ($options[$slug][0] == "canon_default") echo "selected='selected'";} ?>><?php _e("Theme default", "loc_canon"); ?></option> 
							<option value="canon_default">----</option> 
						</select> 
					</td>

					<td>
						<select id="font_main_variant" name="<?php echo esc_attr($name); ?>[1]" class="canon_font_variant" data-selected="<?php if (isset($options[$slug][1])) echo esc_attr($options[$slug][1]); ?>"> 
						</select> 
					</td>

					<td>
						<select id="font_main_subset" name="<?php echo esc_attr($name); ?>[2]" class="canon_font_subset" data-selected="<?php if (isset($options[$slug][2])) echo esc_attr($options[$slug][2]); ?>"> 
						</select> 
					</td>
				</tr>


			<?php

			return true;		
				
		}

// HIDDEN
//
// Usage:
//
// fw_option(array(
// 	'type'					=> 'hidden',
// 	'slug' 					=> 'body_skin_class',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "hidden") {

			?>

			<!-- FW OPTION: HIDDEN-->

				<input type="hidden" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($options[$slug]); ?>">

			<?php

			return true;		
				
		}



// END OF MAIN FUNCTION

		return false;

	} // end function fw_option
