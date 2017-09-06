<?php

/**************************************
WIDGET: oxie_more_posts
***************************************/

	add_action('widgets_init', 'register_widget_oxie_more_posts' );
	function register_widget_oxie_more_posts () {
		register_widget('oxie_more_posts');	
	}

	class oxie_more_posts extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'oxie_more_posts', 								
					'description' => __('Display more posts', "loc_oxie_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'oxie_more_posts' 														
				);

				$this->WP_Widget('oxie_more_posts',__('Oxie: More Posts', "loc_oxie_widgets_plugin")	, $widget_ops, $control_ops );	
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

			//defaults
			$defaults = array( 
				'title' 			=> __('More posts', "loc_oxie_widgets_plugin")	,
				'show' 				=> 'latest_posts', 
				'display_style' 	=> 'images_to_posts', 
				'num_posts' 		=> 4,
				'num_columns' 		=> 2,
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
		     			<option value="latest_posts" <?php if (isset($show)) {if ($show == "latest_posts") echo "selected='selected'";} ?>><?php _e("Latest posts", "loc_oxie_widgets_plugin"); ?>	</option> 
	 					<option value="random_posts" <?php if (isset($show)) {if ($show == "random_posts") echo "selected='selected'";} ?>><?php _e("Random posts", "loc_oxie_widgets_plugin"); ?>	</option> 
		     			
		     			<option value=""><hr></option> 

		     			<option value="popular_views" <?php if (isset($show)) {if ($show == "popular_views") echo "selected='selected'";} ?>><?php _e("Popular posts by views", "loc_oxie_widgets_plugin"); ?>	</option> 
		     			<option value="popular_likes" <?php if (isset($show)) {if ($show == "popular_likes") echo "selected='selected'";} ?>><?php _e("Popular posts by likes", "loc_oxie_widgets_plugin"); ?>	</option> 
	 					<option value="popular_comments" <?php if (isset($show)) {if ($show == "popular_comments") echo "selected='selected'";} ?>><?php _e("Popular posts by comments", "loc_oxie_widgets_plugin"); ?>	</option> 


		     			<option value=""><hr></option> 

		     			<?php 
		     				$categories = get_categories(array(
		     					'orderby' => 'name',
		     					'order' => 'ASC'
		     				));
		     				foreach ($categories as $single_category) {
		     				?>
		     					<option value="postcat_<?php echo esc_attr($single_category->cat_ID); ?>" <?php if (isset($show)) {if ($show == "postcat_" . $single_category->cat_ID) echo "selected='selected'";} ?>><?php echo esc_attr($single_category->name); ?> category</option> 
		     				<?php	     						
		     				}
		     			 ?>

					</select> 
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('display_style')); ?> "><?php _e("Display style", "loc_oxie_widgets_plugin"); ?>	: </label><br>
					<select id="<?php echo esc_attr($this->get_field_id('display_style')); ?>" name="<?php echo esc_attr($this->get_field_name('display_style')); ?>"> 
		     			<option value="images_to_posts" <?php if (isset($display_style)) {if ($display_style == "images_to_posts") echo "selected='selected'";} ?>><?php _e("Images linking to posts", "loc_oxie_widgets_plugin"); ?>	</option> 
		     			<option value="images_to_lightbox" <?php if (isset($display_style)) {if ($display_style == "images_to_lightbox") echo "selected='selected'";} ?>><?php _e("Images linking to lightbox", "loc_oxie_widgets_plugin"); ?>	</option> 
		     			<option value="thumbnails_list" <?php if (isset($display_style)) {if ($display_style == "thumbnails_list") echo "selected='selected'";} ?>><?php _e("Thumbnails list", "loc_oxie_widgets_plugin"); ?>	</option> 
	 					<option value="text_list" <?php if (isset($display_style)) {if ($display_style == "text_list") echo "selected='selected'";} ?>><?php _e("Text", "loc_oxie_widgets_plugin"); ?>	</option> 
					</select> 
				</p>

				<p>
					<label for='<?php echo esc_attr($this->get_field_id('num_posts')); ?>'><?php _e("Number of posts", "loc_oxie_widgets_plugin"); ?>	: </label><br>
					<input 
						style='width: 40px;'
						type='number' 
						min='1'
						max='100'
						id='<?php echo esc_attr($this->get_field_id('num_posts')); ?>' 
						name='<?php echo esc_attr($this->get_field_name('num_posts')); ?>' 
						value='<?php if (isset($num_posts)) echo esc_attr($num_posts); ?>'
					>
				</p>

				<p>
					<label for='<?php echo esc_attr($this->get_field_id('num_columns')); ?>'><?php _e("Number of image columns", "loc_oxie_widgets_plugin"); ?>	: </label><br>
					<input 
						style='width: 40px;'
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
				$title 				= __('More posts', "loc_oxie_widgets_plugin");
				$show				= 'latest_posts'; 
				$display_style 		= 'images_to_posts'; 
				$num_posts 			= 4;
				$num_columns 		= 2;
			}

			// SET VARS
			global $post;

			// GET POSTS
			$results_query = mb_get_posts_from_show_select($show, $num_posts*10, false);

			// if less posts in query set num_posts to num query posts
			if (count($results_query) < $num_posts) $num_posts = count($results_query);

            // WPML
			$title = apply_filters('widget_title', $instance['title']);


			?>

			<?php echo wp_kses_post($before_widget); ?>

			<?php if (!empty($title)) { echo wp_kses_post($before_title . $title . $after_title); } ?>
			
			<div class="clearfix">

				<?php 

					if ($display_style == "images_to_posts" || $display_style == "images_to_lightbox") {



	                	$post_counter = 0;
						for ($i = 0; $i < count($results_query); $i++) { 
							if ($post_counter < $num_posts) {

								$this_post = $results_query[$i];

		                       	if (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) {
									//set classes
									$base_class = "";
									$size_class = " " . mb_get_size_class_from_num($num_columns, "fourth");
									$last_class = (($post_counter+1)%$num_columns) ? "" : " last";

			                        $cat_class = "";
			                        $item_categories = get_the_terms($this_post->ID, 'category');
			                        if ($item_categories) foreach ($item_categories as $value) $cat_class .= " cat-item-" . $value->term_id;

									$final_class = $base_class . $size_class . $cat_class . $last_class;

		                            echo '<div class="'.esc_attr($final_class).'">';
		                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
		                            $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'widget_more_posts_thumb');
		                            $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
		                            $img_post = get_post(get_post_thumbnail_id($this_post->ID));

                                    if ($display_style == "images_to_posts") {
										printf('<a href="%s" class="" data-fancybox-group="gallery" title="%s"><img src="%s" alt="%s" /></a>', get_permalink($this_post->ID), esc_attr(strip_tags($this_post->post_title)), esc_url($post_thumbnail_src_fit[0]), esc_attr(strip_tags($this_post->post_title)));
                                    } else {
										printf('<a href="%s" class="fancybox" data-fancybox-group="more-posts-gallery" title="%s"><img src="%s" alt="%s" /></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title), esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
                                    }

		                            echo '</div>';
		                            $post_counter++;
		                        }
									
							}

						}

					} elseif ($display_style == "thumbnails_list") {
						echo '<ul class="more-posts-thumbnails-list">';
						for ($i = 0; $i < $num_posts; $i++) { 
							$this_post = $results_query[$i];
                            $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'widget_more_posts_thumbnails_list_thumb');
                            $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                            $img_post = get_post(get_post_thumbnail_id($this_post->ID));

							// DATE
							$archive_year  = get_the_time('Y', $this_post->ID); 
							$archive_month = get_the_time('m', $this_post->ID); 
							$archive_day   = get_the_time('d', $this_post->ID); 							

                            $this_post_publish_date = mb_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID));

							echo '<li>';
							printf('<div class="thumbnails-list-img"><a href="%s" title="%s"><img src="%s" alt="%s" /></a></div>', get_permalink($this_post->ID), esc_attr($img_post->post_title), esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
							echo '<div class="thumbnails-list-text">';
							printf('<div class="thumbnails-list-title"><a href="%s">%s</a></div>', esc_url(get_permalink($this_post->ID)), wp_kses_post($this_post->post_title));
							printf('<div class="thumbnails-list-date"><a href="%s">%s</a></div>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr($this_post_publish_date));
							echo '</div>';
							echo '</li>';

						}
						echo "</ul>";

					} elseif ($display_style == "text_list") {
						echo '<ul class="more-posts-text-list">';
						for ($i = 0; $i < $num_posts; $i++) { 
							$this_post = $results_query[$i];
							printf('<li><a href="%s">%s</a></li>', esc_url(get_permalink($this_post->ID)), wp_kses_post($this_post->post_title));

						}
						echo '</ul>';

					}


				?>

			</div>

			<?php echo wp_kses_post($after_widget); ?>

			<?php
		}

	} //END CLASS

