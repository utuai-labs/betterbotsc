<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_canon_pages');
	add_action ('save_post', 'update_cmb_canon_pages');

	function register_cmb_canon_pages () {
		add_meta_box('cmb_canon_pages','Oxie Page Settings', 'display_cmb_canon_pages','page','normal','high');
	}

	function display_cmb_canon_pages ($post) {

	/**************************************
	GET VALUES
	***************************************/

		// TO BE OR NOT TO BE
		$cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);

		// DEFAULTS
		if (empty($cmb_exist)) {

			update_post_meta($post->ID, 'cmb_overlay_header', 'checked');
			update_post_meta($post->ID, 'cmb_page_sidebar_id', 'canon_page_sidebar_widget_area');

			update_post_meta($post->ID, 'cmb_gallery_style', 'masonry');
			update_post_meta($post->ID, 'cmb_gallery_num_columns', 3);

		}

		$cmb_overlay_header = get_post_meta($post->ID, 'cmb_overlay_header', true);
		$cmb_page_sidebar_id = get_post_meta($post->ID, 'cmb_page_sidebar_id', true);

		// gallery specific
		$cmb_gallery_style = get_post_meta($post->ID, 'cmb_gallery_style', true);
		$cmb_gallery_num_columns = get_post_meta($post->ID, 'cmb_gallery_num_columns', true);
		$cmb_gallery_source = get_post_meta($post->ID, 'cmb_gallery_source', true);

		// GET REGISTERED SIDEBARS ARRAY
		$registered_sidebars_array = array();
		foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
			array_push($registered_sidebars_array, $value);
		}


	/**************************************
	DISPLAY CONTENT

			TEMPLATE SPECIFIC: DEFAULT EMPTY
			TEMPLATE SPECIFIC: GALLERY 
			CMB ELEMENT: SIDEBAR SELECT

	***************************************/

		?>


		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: DEFAULT EMPTY
	    -------------------------------------------------------------------------- 
		-->


		<div class="option_item default_hidden option_template_specific 
						option_page-full-width
		">
			<i><?php _e("No additional page settings available for this template type.", "loc_oxie_core_plugin"); ?></i>
		</div>


		<!-- 
		--------------------------------------------------------------------------
			TEMPLATE SPECIFIC: GALLERY 
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page-gallery">

			<div class="option_heading">
				<span><?php _e("Gallery Settings", "loc_oxie_core_plugin"); ?></span>
			</div>

			<?php
				
				// fw_cmb_option(array(
				// 	'type'					=> 'select',
				// 	'title' 				=> __('Gallery Style', 'loc_oxie_core_plugin'),
				// 	'slug' 					=> 'cmb_gallery_style',
				// 	'select_options'		=> array(
				// 		'masonry'				=> __('Gallery Masonry', 'loc_oxie_core_plugin'),
				// 	),
				// 	'post_id'				=> $post->ID,
				// )); 


				fw_cmb_option(array(
					'type'					=> 'number',
					'title' 				=> __('Number of columns', 'loc_oxie_core_plugin'),
					'slug' 					=> 'cmb_gallery_num_columns',
					'min'					=> '1',										// optional
					'max'					=> '5',										// optional
					'step'					=> '1',										// optional
					'width_px'				=> '60',									// optional
					'post_id'				=> $post->ID,
				)); 

			?>

			<div class="option_item">

				<ul class="wp_galleries_source_hints">
					<li><?php _e("Add WordPress galleries using the Add Media button. You can add as many WordPress galleries as you would like.", "loc_cph"); ?></li>
					<li><?php _e("You can add a caption to each image when creating your WordPress gallery.", "loc_cph"); ?></li>
					<li><?php _e("The images and captions from these WordPress galleries will be used in the gallery.", "loc_cph"); ?></li>
					<li><?php _e("The images will appear in the same order as they appear in the galleries. Duplicate images will be removed.", "loc_cph"); ?></li>
					<li><?php _e('You can use the Text editor to rearrange the WordPress gallery shortcodes', "loc_cph"); ?></li>
					<li><?php _e('You can use the Text editor to add a category attribute to the shortcodes e.g. [gallery ids="1,2,3" category="My Category"]', "loc_cph"); ?></li>
				</ul>

				<?php 

					wp_editor($cmb_gallery_source, 'cmb_gallery_source', array(
					    'textarea_name' 		=> 'cmb_gallery_source',
					    'teeny' 				=> true,
					    'media_buttons' 		=> true,
		    			'tinymce' 				=> true,
		    			'quicktags'				=> true,
		    			'textarea_rows' 		=> 30,
		    			'editor_class'			=> 'gallery_source'
					));

				?>

			</div>


		</div>


		<!-- 
		--------------------------------------------------------------------------
			CMB ELEMENT: SIDEBAR SELECT
	    -------------------------------------------------------------------------- 
		-->

		<div class=" default_hidden option_template_specific option_page option_default">

			<div class="option_item">
				<label for='cmb_page_sidebar_id'><?php _e("Select sidebar", "loc_oxie_core_plugin"); ?></label><br>
				<select name="cmb_page_sidebar_id">
					<?php 
						for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
						?>
		     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($cmb_page_sidebar_id)) {if ($cmb_page_sidebar_id ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
						<?php
						}
					?>
				</select> 
			</div>

		</div>




		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />
		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_canon_pages ($post_id) {
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

			// make sure $_POST['cmb_gallery_cat'] is defined
			if (!isset($_POST['cmb_gallery_cat'])) { $_POST['cmb_gallery_cat'] = array(); }

			if (isset($_POST['cmb_overlay_header'])) { update_post_meta($post_id, 'cmb_overlay_header', $_POST['cmb_overlay_header']); } else { update_post_meta($post_id, 'cmb_overlay_header', null); };
			if (isset($_POST['cmb_page_sidebar_id'])) { update_post_meta($post_id, 'cmb_page_sidebar_id', $_POST['cmb_page_sidebar_id']); } else { update_post_meta($post_id, 'cmb_page_sidebar_id', null); };

			// gallery specific
			if (isset($_POST['cmb_gallery_style'])) { update_post_meta($post_id, 'cmb_gallery_style', $_POST['cmb_gallery_style']); } else { update_post_meta($post_id, 'cmb_gallery_style', null); };
			if (isset($_POST['cmb_gallery_num_columns'])) { update_post_meta($post_id, 'cmb_gallery_num_columns', $_POST['cmb_gallery_num_columns']); } else { update_post_meta($post_id, 'cmb_gallery_num_columns', null); };
			if (isset($_POST['cmb_gallery_source'])) { update_post_meta($post_id, 'cmb_gallery_source', $_POST['cmb_gallery_source']); } else { update_post_meta($post_id, 'cmb_gallery_source', null); };

			if (isset($_POST['cmb_exist'])) { update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']); } else { update_post_meta($post_id, 'cmb_exist', null); };
				
		}
	}


