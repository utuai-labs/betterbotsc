<?php

/**************************************
WIDGET: oxie_instagram_gallery
***************************************/

	add_action('widgets_init', 'register_widget_oxie_instagram_gallery' );
	function register_widget_oxie_instagram_gallery () {
		register_widget('oxie_instagram_gallery');	
	}

	class oxie_instagram_gallery extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'oxie_instagram_gallery', 								
					'description' => __('Display Instagram photos', "loc_oxie_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'oxie_instagram_gallery' 														
				);

				$this->WP_Widget('oxie_instagram_gallery',__('Oxie: Instagram Gallery', "loc_oxie_widgets_plugin")	, $widget_ops, $control_ops );	
		}

		/**************************************
		2. UPDATE
		***************************************/
		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		/**************************************
		3. FORM
		***************************************/
		function form($instance) {

			// SUGGEST INSTAGRAM USER ID
			$canon_options_advanced = get_option('canon_options_advanced');
			$default_user_id = ""; 
			if ( !empty($canon_options_advanced['oauth_instagram']) ) {
				$canon_options_advanced['oauth_instagram'] = @unserialize(base64_decode($canon_options_advanced['oauth_instagram']));
				$default_user_id = $canon_options_advanced['oauth_instagram']['user']['id'];
			}

			//defaults
			$defaults = array( 
				'title' 			=> __('Instagram Gallery', "loc_oxie_widgets_plugin")	,
				'show' 				=> 'hashtag', 
				'user_id'			=> $default_user_id,
				'hashtag' 			=> 'food', 
				'image_link' 		=> 'instagram', 
				'num_posts' 		=> 9,
				'num_columns' 		=> 3,
			);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('title')); ?> "><?php _e("Title", "loc_oxie_widgets_plugin"); ?>:	 </label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('title')); ?>' name='<?php echo esc_attr($this->get_field_name('title')); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('show')); ?> "><?php _e("What to show", "loc_oxie_widgets_plugin"); ?>:	 </label><br>
					<select id="<?php echo esc_attr($this->get_field_id('show')); ?>" name="<?php echo esc_attr($this->get_field_name('show')); ?>"> 
		     			<option value="recent" <?php if (isset($show)) {if ($show == "recent") echo "selected='selected'";} ?>><?php _e("Recent media", "loc_oxie_widgets_plugin"); ?>	</option> 
	 					<option value="hashtag" <?php if (isset($show)) {if ($show == "hashtag") echo "selected='selected'";} ?>><?php _e("Hashtag", "loc_oxie_widgets_plugin"); ?>	</option> 
					</select> 
				</p>

				<p class="dynamic_option" data-listen_to="#widget-<?php echo esc_attr($this->id); ?>-show" data-listen_for="recent">
					<label for="<?php echo esc_attr($this->get_field_id('user_id')); ?> "><?php _e("User ID", "loc_oxie_widgets_plugin"); ?>:	 </label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('user_id')); ?>' name='<?php echo esc_attr($this->get_field_name('user_id')); ?>' value="<?php if(isset($user_id)) echo htmlspecialchars($user_id); ?>">
				</p>

				<p class="dynamic_option" data-listen_to="#widget-<?php echo esc_attr($this->id); ?>-show" data-listen_for="hashtag">
					<label for="<?php echo esc_attr($this->get_field_id('hashtag')); ?> "><?php _e("Hashtag", "loc_oxie_widgets_plugin"); ?>:	 </label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('hashtag')); ?>' name='<?php echo esc_attr($this->get_field_name('hashtag')); ?>' value="<?php if(isset($hashtag)) echo htmlspecialchars($hashtag); ?>">
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('image_link')); ?> "><?php _e("Clicking image", "loc_oxie_widgets_plugin"); ?>	: </label><br>
					<select id="<?php echo esc_attr($this->get_field_id('image_link')); ?>" name="<?php echo esc_attr($this->get_field_name('image_link')); ?>"> 
		     			<option value="instagram" <?php if (isset($image_link)) {if ($image_link == "instagram") echo "selected='selected'";} ?>><?php _e("Links to Instagram", "loc_oxie_widgets_plugin"); ?>	</option> 
		     			<option value="lightbox" <?php if (isset($image_link)) {if ($image_link == "lightbox") echo "selected='selected'";} ?>><?php _e("Opens lightbox", "loc_oxie_widgets_plugin"); ?>	</option> 
					</select> 
				</p>

				<p>
					<label for='<?php echo esc_attr($this->get_field_id('num_posts')); ?>'><?php _e("Number of posts", "loc_oxie_widgets_plugin"); ?>	: </label><br>
					<input 
						style='width: 60px;'
						type='number' 
						min='1'
						max='20'
						id='<?php echo esc_attr($this->get_field_id('num_posts')); ?>' 
						name='<?php echo esc_attr($this->get_field_name('num_posts')); ?>' 
						value='<?php if (isset($num_posts)) echo esc_attr($num_posts); ?>'
					>
				</p>

				<p>
					<label for='<?php echo esc_attr($this->get_field_id('num_columns')); ?>'><?php _e("Number of image columns", "loc_oxie_widgets_plugin"); ?>	: </label><br>
					<input 
						style='width: 60px;'
						type='number' 
						min='1'
						max='5'
						id='<?php echo esc_attr($this->get_field_id('num_columns')); ?>' 
						name='<?php echo esc_attr($this->get_field_name('num_columns')); ?>' 
						value='<?php if (isset($num_columns)) echo esc_attr($num_columns); ?>'
					>
				</p>

			<?php
		}


		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);	

			// DEFAULTS
			if (empty($instance)) {
				$title				= __('Instagram Gallery', "loc_oxie_widgets_plugin");
				$show				= 'hashtag'; 
				$hashtag 			= 'food';	
				$image_link			= 'instagram'; 
				$num_posts			= 9;
				$num_columns		= 3;
			}

			// GET OPTIONS
			$canon_options_advanced = get_option('canon_options_advanced'); 
			$canon_options_advanced['oauth_instagram'] = @unserialize(base64_decode($canon_options_advanced['oauth_instagram']));

			// FAILSAFE DEFAULTS
			if (!isset($canon_options_advanced['oauth_instagram']['access_token'])) { $canon_options_advanced['oauth_instagram']['access_token'] = ""; }
			
			// VARS
			$error = false;
			$error_message = "ERROR";

			// SET QUERY
			$url = "";
			if ($show == 'recent') {
				$url = sprintf('https://api.instagram.com/v1/users/%s/media/recent/?count=%s&access_token=%s', esc_attr($user_id), esc_attr($num_posts), esc_attr($canon_options_advanced['oauth_instagram']['access_token']));
			} elseif ($show == 'hashtag') {
				$url = sprintf('https://api.instagram.com/v1/tags/%s/media/recent?count=%s&access_token=%s', esc_attr($hashtag), esc_attr($num_posts), esc_attr($canon_options_advanced['oauth_instagram']['access_token']));	
			} 
			
			// CHECK FOR TRANSIENT OR PERFORM QUERY
			if (get_transient($widget_id)) {
				$response = get_transient($widget_id);
				// var_dump("CACHED RESPONSE");	
			} else {
				$response = wp_remote_get($url);
				// var_dump("RUN REMOTE GET");	

				// ERROR HANDLING
				if ( is_wp_error( $response ) ) {
					$error = true;
				    $error_message .= ": " . $response->get_error_message();
				} elseif ($response['response']['code'] == 400) {
					$error = true;
					$response = json_decode(wp_remote_retrieve_body($response), true);
					$error_message .= "(400): " . $response['meta']['error_message'];
				} elseif ($response['response']['code'] == 404) {
					$error = true;
					$error_message .= "(404): " . $response['response']['message'];
				}

				if ($error == false) {
					set_transient($widget_id, $response, 10);
				}

			}

			// CONVERT RAW RESPONSE INTO DATA ARRAY
			$response = json_decode(wp_remote_retrieve_body($response), true);
			$data = $response['data'];

            // WPML
            $title = apply_filters('widget_title', $instance['title']);


			?>

			<?php echo wp_kses_post($before_widget); ?>

			<?php if (!empty($title)) { echo wp_kses_post($before_title . $title . $after_title); } ?>
			
			<div class="clearfix">

				<?php 

					if (!$error) {

						for ($i = 0; $i < count($data); $i++) { 

							$this_item = $data[$i];

							//set classes
							$base_class = "";
							$size_class = " " . mb_get_size_class_from_num($num_columns, "half");
							$last_class = (($i+1)%$num_columns) ? "" : " last";

							$final_class = $base_class . $size_class . $last_class;

                            echo '<div class="'.esc_attr($final_class).'">';

                            if ($image_link == "instagram") {
								printf('<a href="%s" title="%s" target="_blank"><img src="%s" alt="%s" /></a>'
									, esc_url($this_item['link'])
									, esc_attr($this_item['caption']['text'])
									, esc_url($this_item['images']['standard_resolution']['url'])
									, esc_attr($this_item['caption']['text']) );
                            } else {
								printf('<a href="%s" class="fancybox" data-fancybox-group="instagram-gallery" title="%s"><img src="%s" alt="%s" /></a>'
									, esc_url($this_item['images']['standard_resolution']['url'])
									, esc_attr(mb_make_excerpt($this_item['caption']['text'], 200, false))
									, esc_url($this_item['images']['standard_resolution']['url'])
									, esc_attr(mb_make_excerpt($this_item['caption']['text'], 200, false)) );
                            }

                            echo '</div>';
									

						}

					} else {
						printf('<div class="widget-error-message">%s</div>', esc_attr($error_message));	
					}



				?>

			</div>

			<?php echo wp_kses_post($after_widget); ?>

			<?php
		}

	} //END CLASS

