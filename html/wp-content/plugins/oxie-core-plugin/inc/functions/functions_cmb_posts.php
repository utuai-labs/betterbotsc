<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_canon_posts');
	add_action ('save_post', 'update_cmb_canon_posts');

	function register_cmb_canon_posts () {
		add_meta_box('cmb_canon_posts','Oxie Post Settings', 'display_cmb_canon_posts','post');
	}

	function display_cmb_canon_posts ($post) {

	/**************************************
	GET VALUES
	***************************************/

		// OPTIONS
		$default_excerpt_len = 300;
	    $canon_options_post = get_option('canon_options_post'); 

		
		// DEFAULTS
		$cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);

		if (empty($cmb_exist)) {

			update_post_meta($post->ID, 'cmb_quote_is_tweet', 'unchecked');
			update_post_meta($post->ID, 'cmb_single_style', 'default');
			update_post_meta($post->ID, 'cmb_feature', 'image');
			update_post_meta($post->ID, 'cmb_grid_style', 'image');

			update_post_meta($post->ID, 'cmb_hide_from_popular', 'unchecked');
			update_post_meta($post->ID, 'cmb_hide_feature_in_post', 'unchecked');
			update_post_meta($post->ID, 'cmb_sidebar_id', 'canon_archive_sidebar_widget_area');

			update_post_meta($post->ID, 'cmb_post_show_info', 'unchecked');
			update_post_meta($post->ID, 'cmb_post_info_title', 'My Recipe');
			update_post_meta($post->ID, 'cmb_post_show_info_meta', 'checked');
			update_post_meta($post->ID, 'cmb_post_info_meta', array(
				0	=>	array (
					'label'		=> __('Prep Time', 'loc_oxie_core_plugin'),
					'text'		=> __('15 mins', 'loc_oxie_core_plugin'),
				),
				1	=>	array (
					'label'		=> __('Cook Time', 'loc_oxie_core_plugin'),
					'text'		=> __('30 mins', 'loc_oxie_core_plugin'),
				),
				2	=>	array (
					'label'		=> __('Yields', 'loc_oxie_core_plugin'),
					'text'		=> __('18', 'loc_oxie_core_plugin'),
				),
			));
			update_post_meta($post->ID, 'cmb_post_show_info_ul', 'checked');
			update_post_meta($post->ID, 'cmb_post_info_ul_title', 'Ingredients');
			update_post_meta($post->ID, 'cmb_post_info_ul', array(
				0	=>	array (
					'text'		=> __('2 Cups - Organic Plain Flour', 'loc_oxie_core_plugin'),
				),
			));
			update_post_meta($post->ID, 'cmb_post_show_info_ol', 'checked');
			update_post_meta($post->ID, 'cmb_post_info_ol_title', 'Method');
			update_post_meta($post->ID, 'cmb_post_info_ol', array(
				0	=>	array (
					'text'		=> __('Heat oven to 190°C/fan 170°C/gas 5', 'loc_oxie_core_plugin'),
				),
			));
			update_post_meta($post->ID, 'cmb_post_info_extra_title', 'Additional Info');
			update_post_meta($post->ID, 'cmb_post_info_extra_text', '');

			update_post_meta($post->ID, 'cmb_post_show_ratings', 'unchecked');
			update_post_meta($post->ID, 'cmb_post_ratings_title', __('Review', 'loc_cookbook_core_plugin'));
			update_post_meta($post->ID, 'cmb_post_ratings_parameters', array(
				0	=>	array (
					'name'		=> __('My First Parameter', 'loc_cookbook_core_plugin'),
					'score'		=> '5.0',
				),
			));

			update_post_meta($post->ID, 'cmb_post_show_ad', 'unchecked');

			update_post_meta($post->ID, 'cmb_post_show_author', 'unchecked');

			update_post_meta($post->ID, 'cmb_post_show_more_carousel', 'unchecked');
			update_post_meta($post->ID, 'cmb_post_more_carousel_title', 'You May Also Like');
			update_post_meta($post->ID, 'cmb_post_more_carousel_shows', 'same_cat');
			update_post_meta($post->ID, 'cmb_post_more_carousel_num_load', '10');
			update_post_meta($post->ID, 'cmb_post_more_carousel_num_show', '3');
			update_post_meta($post->ID, 'cmb_post_more_carousel_excerpt_length', '100');
			update_post_meta($post->ID, 'cmb_post_more_carousel_hide_excerpts', 'unchecked');
		}

		// GET CUSTOM FIELDS
		$cmb_single_style = get_post_meta($post->ID, 'cmb_single_style', true);
		$cmb_feature = get_post_meta($post->ID, 'cmb_feature', true);
		$cmb_grid_style = get_post_meta($post->ID, 'cmb_grid_style', true);
		$cmb_media_link = get_post_meta($post->ID, 'cmb_media_link', true);
		$cmb_quote_is_tweet = get_post_meta($post->ID, 'cmb_quote_is_tweet', true);
		$cmb_byline = get_post_meta($post->ID, 'cmb_byline', true);
		$cmb_hide_from_popular = get_post_meta($post->ID, 'cmb_hide_from_popular', true);
		$cmb_hide_feature_in_post = get_post_meta($post->ID, 'cmb_hide_feature_in_post', true);
		$cmb_sidebar_id = get_post_meta($post->ID, 'cmb_sidebar_id', true);

		// POST COMPONENTS
		$cmb_post_show_info = get_post_meta($post->ID, 'cmb_post_show_info', true);
		$cmb_post_info_title = get_post_meta($post->ID, 'cmb_post_info_title', true);
		$cmb_post_show_info_meta = get_post_meta($post->ID, 'cmb_post_show_info_meta', true);
		$cmb_post_info_meta = get_post_meta($post->ID, 'cmb_post_info_meta', true);
		$cmb_post_show_info_ul = get_post_meta($post->ID, 'cmb_post_show_info_ul', true);
		$cmb_post_info_ul_title = get_post_meta($post->ID, 'cmb_post_info_ul_title', true);
		$cmb_post_info_ul= get_post_meta($post->ID, 'cmb_post_info_ul', true);
		$cmb_post_show_info_ol = get_post_meta($post->ID, 'cmb_post_show_info_ol', true);
		$cmb_post_info_ol_title = get_post_meta($post->ID, 'cmb_post_info_ol_title', true);
		$cmb_post_info_ol= get_post_meta($post->ID, 'cmb_post_info_ol', true);
		$cmb_post_info_extra_title = get_post_meta($post->ID, 'cmb_post_info_extra_title', true);
		$cmb_post_info_extra_text = get_post_meta($post->ID, 'cmb_post_info_extra_text', true);

		$cmb_post_show_ratings = get_post_meta($post->ID, 'cmb_post_show_ratings', true);
		$cmb_post_ratings_title = get_post_meta($post->ID, 'cmb_post_ratings_title', true);
		$cmb_post_ratings_overall_score = get_post_meta($post->ID, 'cmb_post_ratings_overall_score', true);
		$cmb_post_ratings_out_of_total = get_post_meta($post->ID, 'cmb_post_ratings_out_of_total', true);
		$cmb_post_ratings_summary = get_post_meta($post->ID, 'cmb_post_ratings_summary', true);
		$cmb_post_show_parameters = get_post_meta($post->ID, 'cmb_post_show_parameters', true);
		$cmb_post_ratings_parameters = get_post_meta($post->ID, 'cmb_post_ratings_parameters', true);

		$cmb_post_show_ad = get_post_meta($post->ID, 'cmb_post_show_ad', true);

		$cmb_post_show_author = get_post_meta($post->ID, 'cmb_post_show_author', true);

		$cmb_post_show_more_carousel = get_post_meta($post->ID, 'cmb_post_show_more_carousel', true);
		$cmb_post_more_carousel_title = get_post_meta($post->ID, 'cmb_post_more_carousel_title', true);
		$cmb_post_more_carousel_shows = get_post_meta($post->ID, 'cmb_post_more_carousel_shows', true);
		$cmb_post_more_carousel_num_load = get_post_meta($post->ID, 'cmb_post_more_carousel_num_load', true);
		$cmb_post_more_carousel_num_show = get_post_meta($post->ID, 'cmb_post_more_carousel_num_show', true);
		$cmb_post_more_carousel_excerpt_length = get_post_meta($post->ID, 'cmb_post_more_carousel_excerpt_length', true);
		$cmb_post_more_carousel_hide_excerpts = get_post_meta($post->ID, 'cmb_post_more_carousel_hide_excerpts', true);

		// POST SLIDER
		$cmb_post_show_post_slider = get_post_meta($post->ID, 'cmb_post_show_post_slider', true);
		$cmb_post_slider_source = get_post_meta($post->ID, 'cmb_post_slider_source', true);


	    // GET POST ATTACHMENTS
	    $args = array(
	        'post_type' => 'attachment',
	        'numberposts' => -1,
	        'post_status' => null,
	        'orderby' => 'title',
	        'order'  => 'ASC',
	        'post_parent' => $post->ID
	    );

	    $post_attachments = get_posts( $args );


		// GET REGISTERED SIDEBARS ARRAY
		$registered_sidebars_array = array();
		foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
			array_push($registered_sidebars_array, $value);
		}


	/**************************************
	DISPLAY CONTENT

			GENERAL
			POST COMPONENT: INFO BOX
			POST COMPONENT: RATINGS
			POST COMPONENT: AD
			POST COMPONENT: AUTHOR BOX
			POST COMPONENT: MORE POSTS 
			POST COMPONENT: TAXONOMIES
			POST SLIDER

	***************************************/
		?>

		<!-- 
		--------------------------------------------------------------------------
			GENERAL
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("General", "loc_oxie_core_plugin"); ?></span>
		</div>

		<!-- specific post format options: quote -->
		<div class="options_post_format default_hidden" data-post_format="quote">
			
			<?php
				
				fw_cmb_option(array(
					'type'					=> 'checkbox',
					'title' 				=> __('Display quote as a tweet', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_quote_is_tweet',
					'post_id'				=> $post->ID,
				)); 
							
				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Quote byline', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_byline',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 
							
			?>

		</div>


		<?php
			
			fw_cmb_option(array(
				'type'					=> 'select',
				'title' 				=> __('Post style', 'loc_oxie_core_plugin'),
				'slug' 					=> 'cmb_single_style',
				'select_options'		=> array(
					'default'				=> __('Site default', 'loc_oxie_core_plugin'),
					'full'					=> __('Full width featured image', 'loc_oxie_core_plugin'),
					'compact'				=> __('Compact featured image', 'loc_oxie_core_plugin'),
					'full_sidebar'			=> __('Full width featured image and sidebar', 'loc_oxie_core_plugin'),
					'compact_sidebar'		=> __('Compact featured image and sidebar', 'loc_oxie_core_plugin'),
				),
				'post_id'				=> $post->ID,
			)); 

			fw_cmb_option(array(
				'type'					=> 'select',
				'title' 				=> __('Feature style', 'loc_oxie_core_plugin'),
				'slug' 					=> 'cmb_feature',
				'select_options'		=> array(
					'image'				=> __('Featured image', 'loc_oxie_core_plugin'),
					'media'				=> __('Use embeddable media instead of featured image', 'loc_oxie_core_plugin'),
					'media_in_lightbox'	=> __('Use featured image but open media link in lightbox', 'loc_oxie_core_plugin'),
				),
				'post_id'				=> $post->ID,
			)); 

		?>

		<div class="options_post_format default_hidden" data-post_format="0">

		<?php
						
			fw_cmb_option(array(
				'type'					=> 'select',
				'title' 				=> __('Grid box style', 'loc_oxie_core_plugin'),
				'slug' 					=> 'cmb_grid_style',
				'select_options'		=> array(
					'default'			=> __('Default', 'loc_oxie_core_plugin'),
					'side'				=> __('Side image', 'loc_oxie_core_plugin'),
				),
				'listen_to'				=> '#cmb_feature',
				'listen_for'			=> 'image',
				'post_id'				=> $post->ID,
			)); 

		?>

		</div>

		<?php

			fw_cmb_option(array(
				'type'					=> 'textarea',
				'title' 				=> __('Featured media - <i>(optional)</i>', 'loc_oxie_core_plugin'),
				'slug' 					=> 'cmb_media_link',
				'cols'					=> '100',
				'rows'					=> '5',
				'class'					=> 'widefat',
				'post_id'				=> $post->ID,
			)); 


			fw_cmb_option(array(
				'type'					=> 'checkbox',
				'title' 				=> __('Hide from popular lists', 'loc_oxie_core_plugin'),
				'slug' 					=> 'cmb_hide_from_popular',
				'post_id'				=> $post->ID,
			)); 

		?>

		<?php
			
			if (has_post_thumbnail($post->ID)) {
			?>
				<div class="option_item">
					<input type="hidden" name="cmb_hide_feature_in_post" value="unchecked" />
					<input type='checkbox' id='cmb_hide_feature_in_post' name='cmb_hide_feature_in_post' value='checked' <?php checked($cmb_hide_feature_in_post == "checked"); ?>>
					<label for='cmb_hide_feature_in_post'><?php _e("Hide feature in post", "loc_oxie_core_plugin"); ?></label>
				</div>
					
			<?php
			}
		
		?>	

		<div class="dynamic_option default_hidden" data-listen_to="#cmb_single_style" data-listen_for="sidebar">

			<div class="option_item">
				<label for='cmb_sidebar_id'><?php _e("Select sidebar", "loc_oxie_core_plugin"); ?></label><br>
				<select name="cmb_sidebar_id">
					<?php 
						for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
						?>
		     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($cmb_sidebar_id)) {if ($cmb_sidebar_id ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
						<?php
						}
					?>
				</select> 
			</div>

		</div>


		<!-- 
		--------------------------------------------------------------------------
			POST COMPONENT: INFO BOX
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("Post Component: Info box", "loc_oxie_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_info" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_info' name='cmb_post_show_info' value='checked' <?php checked($cmb_post_show_info == "checked"); ?>>
			<label for='cmb_post_show_info'><?php _e("Show info box", "loc_oxie_core_plugin"); ?></label><br>
		</div>

		<div class="dynamic_option default-hidden" data-listen_to="#cmb_post_show_info" data-listen_for="checked">
		
		<!-- INFO BOX TITLE -->

			<?php
							
				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Title', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_info_title',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

			?>

		<!-- INFO BOX META -->

			<div class="option_item info-meta-fields">

				<input type="hidden" name="cmb_post_show_info_meta" value="unchecked" />
				<input type='checkbox' id='cmb_post_show_info_meta' name='cmb_post_show_info_meta' value='checked' <?php checked($cmb_post_show_info_meta == "checked"); ?>>
				<label for='cmb_post_show_info_meta'><?php _e("Show meta", "loc_oxie_core_plugin"); ?></label><br>

				<ul>
					<?php
						
						for ($i = 0; $i < 3; $i++) {  
						?>

							<li>
								<label><?php _e("Meta field label", "loc_oxie_core_plugin"); ?></label>
								<input type='text' name="cmb_post_info_meta[<?php echo esc_attr($i); ?>][label]" class="li_option parameter_name" value="<?php if (!empty($cmb_post_info_meta[$i]['label'])) { echo htmlspecialchars($cmb_post_info_meta[$i]['label']); } ?>">
								<label><?php _e("text", "loc_oxie_core_plugin"); ?> </label>
								<input type='text' name="cmb_post_info_meta[<?php echo esc_attr($i); ?>][text]" class="li_option parameter_score" value="<?php if (!empty($cmb_post_info_meta[$i]['text'])) { echo htmlspecialchars($cmb_post_info_meta[$i]['text']); } ?>">
							</li>
							
						<?php
						}
					
					?>
				</ul>

			</div>

		<!-- INFO BOX UNORDERED LIST -->

			<div class="option_item info-ul cmb-ul-sortable">

				<input type="hidden" name="cmb_post_show_info_ul" value="unchecked" />
				<input type='checkbox' id='cmb_post_show_info_ul' name='cmb_post_show_info_ul' value='checked' <?php checked($cmb_post_show_info_ul == "checked"); ?>>
				<label for='cmb_post_show_info_ul'><?php _e("Show checklist", "loc_oxie_core_plugin"); ?></label><br>

				<?php
								
					fw_cmb_option(array(
						'type'					=> 'text',
						'title' 				=> __('Checklist title', 'loc_oxie_core_plugin'),
						'slug' 					=> 'cmb_post_info_ul_title',
						'class' 				=> 'widefat',
						'post_id'				=> $post->ID,
					)); 

				?>

				<ul class="ul_sortable" data-split_index="1">

					<?php
						
						for ($i = 0; $i < count($cmb_post_info_ul); $i++) {  
						?>

							<li>
								<input type='text' name="cmb_post_info_ul[<?php echo esc_attr($i); ?>][text]" class="li_option parameter_name" value="<?php if (!empty($cmb_post_info_ul[$i]['text'])) { echo htmlspecialchars($cmb_post_info_ul[$i]['text']); } ?>">
								<button type="button" class="button ul_del_this"><?php _e("delete", "loc_oxie_core_plugin"); ?></button>
							</li>
							
						<?php
						}
					
					?>
				</ul>
				<div class="ul_control" data-min="1" data-max="1000">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_oxie_core_plugin"); ?>" />
				</div>

			</div>

		<!-- INFO BOX ORDERED LIST -->

			<div class="option_item info-ol cmb-ul-sortable">

				<input type="hidden" name="cmb_post_show_info_ol" value="unchecked" />
				<input type='checkbox' id='cmb_post_show_info_ol' name='cmb_post_show_info_ol' value='checked' <?php checked($cmb_post_show_info_ol == "checked"); ?>>
				<label for='cmb_post_show_info_ol'><?php _e("Show ordered list", "loc_oxie_core_plugin"); ?></label><br>

				<?php
								
					fw_cmb_option(array(
						'type'					=> 'text',
						'title' 				=> __('Ordered list title', 'loc_oxie_core_plugin'),
						'slug' 					=> 'cmb_post_info_ol_title',
						'class' 				=> 'widefat',
						'post_id'				=> $post->ID,
					)); 

				?>

				<ul class="ul_sortable" data-split_index="1">

					<?php
						
						for ($i = 0; $i < count($cmb_post_info_ol); $i++) {  
						?>

							<li>
								<input type='text' name="cmb_post_info_ol[<?php echo esc_attr($i); ?>][text]" class="li_option parameter_name" value="<?php if (!empty($cmb_post_info_ol[$i]['text'])) { echo htmlspecialchars($cmb_post_info_ol[$i]['text']); } ?>">
								<button type="button" class="button ul_del_this"><?php _e("delete", "loc_oxie_core_plugin"); ?></button>
							</li>
							
						<?php
						}
					
					?>
				</ul>
				<div class="ul_control" data-min="1" data-max="1000">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_oxie_core_plugin"); ?>" />
				</div>

			</div>

		<!-- INFO BOX ADDITIONAL INFO -->

			<?php

				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Additional info title', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_info_extra_title',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'textarea',
					'title' 				=> __('Additional info text <i>(accepts shortcodes and some HTML)</i>', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_info_extra_text',
					'cols'					=> '100',
					'rows'					=> '5',
					'class'					=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

			?>


		</div>



		<!-- 
		--------------------------------------------------------------------------
			POST COMPONENT: RATINGS
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("Post Component: Ratings", "loc_cookbook_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_ratings" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_ratings' name='cmb_post_show_ratings' value='checked' <?php checked($cmb_post_show_ratings == "checked"); ?>>
			<label for='cmb_post_show_ratings'><?php _e("Show ratings", "loc_cookbook_core_plugin"); ?></label><br>
		</div>

		<div class="dynamic_option default-hidden" data-listen_to="#cmb_post_show_ratings" data-listen_for="checked">
		
			<?php
							
				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Title', 'loc_cookbook_core_plugin'),
					'slug' 					=> 'cmb_post_ratings_title',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Overall score <i>(if decimal score remember to use period as decimal mark)</i>', 'loc_cookbook_core_plugin'),
					'slug' 					=> 'cmb_post_ratings_overall_score',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Out of a total <i>(required for parameters)</i>', 'loc_cookbook_core_plugin'),
					'slug' 					=> 'cmb_post_ratings_out_of_total',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'textarea',
					'title' 				=> __('Summary', 'loc_cookbook_core_plugin'),
					'slug' 					=> 'cmb_post_ratings_summary',
					'cols'					=> '100',
					'rows'					=> '5',
					'class'					=> 'widefat',
					'post_id'				=> $post->ID,
				)); 


			?>

			<div class="option_item ratings-parameters cmb-ul-sortable">

				<input type="hidden" name="cmb_post_show_parameters" value="unchecked" />
				<input type='checkbox' id='cmb_post_show_parameters' name='cmb_post_show_parameters' value='checked' <?php checked($cmb_post_show_parameters == "checked"); ?>>
				<label for='cmb_post_show_parameters'><?php _e("Show parameters", "loc_cookbook_core_plugin"); ?></label><br>

				<ul class="ul_sortable" data-split_index="1">

					<?php
						
						for ($i = 0; $i < count($cmb_post_ratings_parameters); $i++) {  
						?>

							<li>
								<label><?php _e("Parameter name", "loc_cookbook_core_plugin"); ?></label>
								<input type='text' name="cmb_post_ratings_parameters[<?php echo esc_attr($i); ?>][name]" class="li_option parameter_name" value="<?php if (!empty($cmb_post_ratings_parameters[$i]['name'])) { echo htmlspecialchars($cmb_post_ratings_parameters[$i]['name']); } ?>">
								<label><?php _e("Score", "loc_cookbook_core_plugin"); ?> </label>
								<input type='text' name="cmb_post_ratings_parameters[<?php echo esc_attr($i); ?>][score]" class="li_option parameter_score" value="<?php if (!empty($cmb_post_ratings_parameters[$i]['score'])) { echo htmlspecialchars($cmb_post_ratings_parameters[$i]['score']); } ?>">
								<button type="button" class="button ul_del_this float-right"><?php _e("delete", "loc_cookbook_core_plugin"); ?></button>
							</li>
							
						<?php
						}
					
					?>
				</ul>
				<div class="ul_control" data-min="1" data-max="1000">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_cookbook_core_plugin"); ?>" />
				</div>


			</div>
			

		</div>

		
		<!-- 
		--------------------------------------------------------------------------
			POST COMPONENT: AD
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("Post Component: Ad", "loc_oxie_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_ad" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_ad' name='cmb_post_show_ad' value='checked' <?php checked($cmb_post_show_ad == "checked"); ?>>
			<label for='cmb_post_show_ad'><?php _e("Show Ad", "loc_oxie_core_plugin"); ?></label><br>
		</div>


		<!-- 
		--------------------------------------------------------------------------
			POST COMPONENT: AUTHOR BOX
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("Post Component: About the Author", "loc_oxie_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_author" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_author' name='cmb_post_show_author' value='checked' <?php checked($cmb_post_show_author == "checked"); ?>>
			<label for='cmb_post_show_author'><?php _e("Show About the Author box", "loc_oxie_core_plugin"); ?></label><br>
		</div>


		<!-- 
		--------------------------------------------------------------------------
			POST COMPONENT: MORE POSTS 
	    -------------------------------------------------------------------------- 
		-->


		<div class="option_heading">
			<span><?php _e("Post Component: More posts carousel", "loc_oxie_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_more_carousel" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_more_carousel' name='cmb_post_show_more_carousel' value='checked' <?php checked($cmb_post_show_more_carousel == "checked"); ?>>
			<label for='cmb_post_show_more_carousel'><?php _e("Show more posts carousel", "loc_oxie_core_plugin"); ?></label><br>
		</div>

		<div class="dynamic_option default-hidden" data-listen_to="#cmb_post_show_more_carousel" data-listen_for="checked">

			<?php
				
				fw_cmb_option(array(
					'type'					=> 'text',
					'title' 				=> __('Title', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_more_carousel_title',
					'class' 				=> 'widefat',
					'post_id'				=> $post->ID,
				)); 
			
			?>

			<!-- DYNAMIC SELECT -->
			<?php 

				$cat_list = get_categories(array(
					'hide_empty' => 0
				));
				$cat_list = array_values($cat_list);

			 ?>
			<div class="option_item">
				<label><?php _e("Show", "loc_trades_core_plugin"); ?></label><br>
				<select class='block_option' id="show" name="cmb_post_more_carousel_shows"> 
	     			<option value="same_cat" <?php if ($cmb_post_more_carousel_shows == "same_cat") { echo "selected='selected'";} ?>><?php _e("Same category as post", "loc_trades_core_plugin"); ?></option> 
	     			<option value="latest_posts" <?php if ($cmb_post_more_carousel_shows == "latest_posts") { echo "selected='selected'";} ?>><?php _e("Latest posts", "loc_trades_core_plugin"); ?></option> 
	     			<option value="random_posts" <?php if ($cmb_post_more_carousel_shows == "random_posts") { echo "selected='selected'";} ?>><?php _e("Random posts", "loc_trades_core_plugin"); ?></option> 
	     			<option value="latest_posts"></option> 

	     			<option value="popular_views" <?php if ($cmb_post_more_carousel_shows == "popular_views") { echo "selected='selected'";} ?>><?php _e("Popular posts by views", "loc_trades_core_plugin"); ?>	</option> 
	     			<option value="popular_likes" <?php if ($cmb_post_more_carousel_shows == "popular_likes") { echo "selected='selected'";} ?>><?php _e("Popular posts by likes", "loc_trades_core_plugin"); ?>	</option> 
 					<option value="popular_comments" <?php if ($cmb_post_more_carousel_shows == "popular_comments") { echo "selected='selected'";} ?>><?php _e("Popular posts by comments", "loc_trades_core_plugin"); ?>	</option> 
	     			<option value="latest_posts"></option> 

				<?php 
					for ($i = 0; $i < count($cat_list); $i++) { 
					?>
	     				<option value="postcat_<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($cmb_post_more_carousel_shows == "postcat_" . $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php _e("category", "loc_oxie_core_plugin"); ?></option> 
					<?php
					}
				?>
				</select> 
			</div>

			<?php
				
				fw_cmb_option(array(
					'type'					=> 'number',
					'title' 				=> __('Number of items to load', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_more_carousel_num_load',
					'min'					=> '1',										// optional
					'max'					=> '10000',									// optional
					'step'					=> '1',										// optional
					'width_px'				=> '60',									// optional
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'number',
					'title' 				=> __('Number of items to display at a time', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_more_carousel_num_show',
					'min'					=> '1',										// optional
					'max'					=> '5',										// optional
					'step'					=> '1',										// optional
					'width_px'				=> '60',									// optional
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'number',
					'title' 				=> __('Excerpt length', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_more_carousel_excerpt_length',
					'min'					=> '1',										// optional
					'step'					=> '1',										// optional
					'width_px'				=> '60',									// optional
					'post_id'				=> $post->ID,
				)); 

				fw_cmb_option(array(
					'type'					=> 'checkbox',
					'title' 				=> __('Hide excerpts', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_post_more_carousel_hide_excerpts',
					'post_id'				=> $post->ID,
				)); 
			
			?>		

		</div>



		<!-- 
		--------------------------------------------------------------------------
			POST SLIDER
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("Post Slider", "loc_oxie_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_post_slider" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_post_slider' name='cmb_post_show_post_slider' value='checked' <?php checked($cmb_post_show_post_slider == "checked"); ?>>
			<label for='cmb_post_show_post_slider'><?php _e("Show post slider", "loc_oxie_core_plugin"); ?></label><br>
		</div>

		<div class="dynamic_option default-hidden" data-listen_to="#cmb_post_show_post_slider" data-listen_for="checked">

			<ul class="wp_galleries_source_hints">
				<li><?php _e("The post slider will replace the featured image at the top of the post.", "loc_oxie_core_plugin"); ?></li>
				<li><?php _e("Add WordPress galleries using the Add Media button. You can add as many WordPress galleries as you would like.", "loc_oxie_core_plugin"); ?></li>
				<li><?php _e("The images from these WordPress galleries will be used in the post slider.", "loc_oxie_core_plugin"); ?></li>
				<li><?php _e("The images will appear in the same order as they appear in the galleries. Duplicate images will be removed.", "loc_oxie_core_plugin"); ?></li>
			</ul>

			<?php 

				wp_editor($cmb_post_slider_source, 'cmb_post_slider_source', array(
				    'textarea_name' 		=> 'cmb_post_slider_source',
				    'teeny' 				=> true,
				    'media_buttons' 		=> true,
	    			'tinymce' 				=> true,
	    			'quicktags'				=> true,
	    			'textarea_rows' 		=> 20,
	    			'editor_class'			=> 'post_slider_source'
				));

			?>

		</div>




		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />






		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_canon_posts ($post_id) {
		// avoid activation on irrelevant admin pages
		if (!isset($_POST['cmb_nonce'])) {
			return false;		
		}

		// verify nonce.    
		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__)) || !isset($_POST['cmb_nonce'])) {
			return false;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		} else {

		//GENERAL
			if (isset($_POST['cmb_single_style'])) { update_post_meta($post_id, 'cmb_single_style', $_POST['cmb_single_style']); } else { update_post_meta($post_id, 'cmb_single_style', null); };
			if (isset($_POST['cmb_feature'])) { update_post_meta($post_id, 'cmb_feature', $_POST['cmb_feature']); } else { update_post_meta($post_id, 'cmb_feature', null); };
			if (isset($_POST['cmb_grid_style'])) { update_post_meta($post_id, 'cmb_grid_style', $_POST['cmb_grid_style']); } else { update_post_meta($post_id, 'cmb_grid_style', null); };
			if (isset($_POST['cmb_media_link'])) { update_post_meta($post_id, 'cmb_media_link', $_POST['cmb_media_link']); } else { update_post_meta($post_id, 'cmb_media_link', null); };
			if (isset($_POST['cmb_quote_is_tweet'])) { update_post_meta($post_id, 'cmb_quote_is_tweet', $_POST['cmb_quote_is_tweet']); } else { update_post_meta($post_id, 'cmb_quote_is_tweet', null); };
			if (isset($_POST['cmb_byline'])) { update_post_meta($post_id, 'cmb_byline', $_POST['cmb_byline']); } else { update_post_meta($post_id, 'cmb_byline', null); };
			if (isset($_POST['cmb_hide_from_popular'])) { update_post_meta($post_id, 'cmb_hide_from_popular', $_POST['cmb_hide_from_popular']); } else { update_post_meta($post_id, 'cmb_hide_from_popular', null); };
			if (isset($_POST['cmb_hide_feature_in_post'])) { update_post_meta($post_id, 'cmb_hide_feature_in_post', $_POST['cmb_hide_feature_in_post']); } else { update_post_meta($post_id, 'cmb_hide_feature_in_post', null); };
			if (isset($_POST['cmb_sidebar_id'])) { update_post_meta($post_id, 'cmb_sidebar_id', $_POST['cmb_sidebar_id']); } else { update_post_meta($post_id, 'cmb_sidebar_id', null); };
			
		// POST COMPONENTS
			if (isset($_POST['cmb_post_show_info'])) { update_post_meta($post_id, 'cmb_post_show_info', $_POST['cmb_post_show_info']); } else { update_post_meta($post_id, 'cmb_post_show_info', null); };
			if (isset($_POST['cmb_post_info_title'])) { update_post_meta($post_id, 'cmb_post_info_title', $_POST['cmb_post_info_title']); } else { update_post_meta($post_id, 'cmb_post_info_title', null); };
			if (isset($_POST['cmb_post_show_info_meta'])) { update_post_meta($post_id, 'cmb_post_show_info_meta', $_POST['cmb_post_show_info_meta']); } else { update_post_meta($post_id, 'cmb_post_show_info_meta', null); };
			if (isset($_POST['cmb_post_info_meta'])) { update_post_meta($post_id, 'cmb_post_info_meta', $_POST['cmb_post_info_meta']); } else { update_post_meta($post_id, 'cmb_post_info_meta', null); };
			if (isset($_POST['cmb_post_show_info_ul'])) { update_post_meta($post_id, 'cmb_post_show_info_ul', $_POST['cmb_post_show_info_ul']); } else { update_post_meta($post_id, 'cmb_post_show_info_ul', null); };
			if (isset($_POST['cmb_post_info_ul_title'])) { update_post_meta($post_id, 'cmb_post_info_ul_title', $_POST['cmb_post_info_ul_title']); } else { update_post_meta($post_id, 'cmb_post_info_ul_title', null); };
			if (isset($_POST['cmb_post_info_ul'])) { update_post_meta($post_id, 'cmb_post_info_ul', $_POST['cmb_post_info_ul']); } else { update_post_meta($post_id, 'cmb_post_info_ul', null); };
			if (isset($_POST['cmb_post_show_info_ol'])) { update_post_meta($post_id, 'cmb_post_show_info_ol', $_POST['cmb_post_show_info_ol']); } else { update_post_meta($post_id, 'cmb_post_show_info_ol', null); };
			if (isset($_POST['cmb_post_info_ol_title'])) { update_post_meta($post_id, 'cmb_post_info_ol_title', $_POST['cmb_post_info_ol_title']); } else { update_post_meta($post_id, 'cmb_post_info_ol_title', null); };
			if (isset($_POST['cmb_post_info_ol'])) { update_post_meta($post_id, 'cmb_post_info_ol', $_POST['cmb_post_info_ol']); } else { update_post_meta($post_id, 'cmb_post_info_ol', null); };
			if (isset($_POST['cmb_post_info_extra_title'])) { update_post_meta($post_id, 'cmb_post_info_extra_title', $_POST['cmb_post_info_extra_title']); } else { update_post_meta($post_id, 'cmb_post_info_extra_title', null); };
			if (isset($_POST['cmb_post_info_extra_text'])) { update_post_meta($post_id, 'cmb_post_info_extra_text', $_POST['cmb_post_info_extra_text']); } else { update_post_meta($post_id, 'cmb_post_info_extra_text', null); };

			if (isset($_POST['cmb_post_show_ratings'])) { update_post_meta($post_id, 'cmb_post_show_ratings', $_POST['cmb_post_show_ratings']); } else { update_post_meta($post_id, 'cmb_post_show_ratings', null); };
			if (isset($_POST['cmb_post_ratings_overall_score'])) { update_post_meta($post_id, 'cmb_post_ratings_overall_score', $_POST['cmb_post_ratings_overall_score']); } else { update_post_meta($post_id, 'cmb_post_ratings_overall_score', null); };
			if (isset($_POST['cmb_post_ratings_out_of_total'])) { update_post_meta($post_id, 'cmb_post_ratings_out_of_total', $_POST['cmb_post_ratings_out_of_total']); } else { update_post_meta($post_id, 'cmb_post_ratings_out_of_total', null); };
			if (isset($_POST['cmb_post_ratings_title'])) { update_post_meta($post_id, 'cmb_post_ratings_title', $_POST['cmb_post_ratings_title']); } else { update_post_meta($post_id, 'cmb_post_ratings_title', null); };
			if (isset($_POST['cmb_post_ratings_summary'])) { update_post_meta($post_id, 'cmb_post_ratings_summary', $_POST['cmb_post_ratings_summary']); } else { update_post_meta($post_id, 'cmb_post_ratings_summary', null); };
			if (isset($_POST['cmb_post_show_parameters'])) { update_post_meta($post_id, 'cmb_post_show_parameters', $_POST['cmb_post_show_parameters']); } else { update_post_meta($post_id, 'cmb_post_show_parameters', null); };
			if (isset($_POST['cmb_post_ratings_parameters'])) { update_post_meta($post_id, 'cmb_post_ratings_parameters', $_POST['cmb_post_ratings_parameters']); } else { update_post_meta($post_id, 'cmb_post_ratings_parameters', null); };

			if (isset($_POST['cmb_post_show_ad'])) { update_post_meta($post_id, 'cmb_post_show_ad', $_POST['cmb_post_show_ad']); } else { update_post_meta($post_id, 'cmb_post_show_ad', null); };

			if (isset($_POST['cmb_post_show_author'])) { update_post_meta($post_id, 'cmb_post_show_author', $_POST['cmb_post_show_author']); } else { update_post_meta($post_id, 'cmb_post_show_author', null); };

			if (isset($_POST['cmb_post_show_more_carousel'])) { update_post_meta($post_id, 'cmb_post_show_more_carousel', $_POST['cmb_post_show_more_carousel']); } else { update_post_meta($post_id, 'cmb_post_show_more_carousel', null); };
			if (isset($_POST['cmb_post_more_carousel_title'])) { update_post_meta($post_id, 'cmb_post_more_carousel_title', $_POST['cmb_post_more_carousel_title']); } else { update_post_meta($post_id, 'cmb_post_more_carousel_title', null); };
			if (isset($_POST['cmb_post_more_carousel_shows'])) { update_post_meta($post_id, 'cmb_post_more_carousel_shows', $_POST['cmb_post_more_carousel_shows']); } else { update_post_meta($post_id, 'cmb_post_more_carousel_shows', null); };
			if (isset($_POST['cmb_post_more_carousel_num_load'])) { update_post_meta($post_id, 'cmb_post_more_carousel_num_load', $_POST['cmb_post_more_carousel_num_load']); } else { update_post_meta($post_id, 'cmb_post_more_carousel_num_load', null); };
			if (isset($_POST['cmb_post_more_carousel_num_show'])) { update_post_meta($post_id, 'cmb_post_more_carousel_num_show', $_POST['cmb_post_more_carousel_num_show']); } else { update_post_meta($post_id, 'cmb_post_more_carousel_num_show', null); };
			if (isset($_POST['cmb_post_more_carousel_excerpt_length'])) { update_post_meta($post_id, 'cmb_post_more_carousel_excerpt_length', $_POST['cmb_post_more_carousel_excerpt_length']); } else { update_post_meta($post_id, 'cmb_post_more_carousel_excerpt_length', null); };
			if (isset($_POST['cmb_post_more_carousel_hide_excerpts'])) { update_post_meta($post_id, 'cmb_post_more_carousel_hide_excerpts', $_POST['cmb_post_more_carousel_hide_excerpts']); } else { update_post_meta($post_id, 'cmb_post_more_carousel_hide_excerpts', null); };

		// POST SLIDER
			if (isset($_POST['cmb_post_show_post_slider'])) { update_post_meta($post_id, 'cmb_post_show_post_slider', $_POST['cmb_post_show_post_slider']); } else { update_post_meta($post_id, 'cmb_post_show_post_slider', null); };
			if (isset($_POST['cmb_post_slider_source'])) { update_post_meta($post_id, 'cmb_post_slider_source', $_POST['cmb_post_slider_source']); } else { update_post_meta($post_id, 'cmb_post_slider_source', null); };

			if (isset($_POST['cmb_exist'])) { update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']); } else { update_post_meta($post_id, 'cmb_exist', null); };

		}
	}


