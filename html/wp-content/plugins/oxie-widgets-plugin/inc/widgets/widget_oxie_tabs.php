<?php

/**************************************
WIDGET: oxie_tabs
***************************************/

	add_action('widgets_init', 'register_widget_oxie_tabs' );
	function register_widget_oxie_tabs () {
		register_widget('oxie_tabs');	
	}

	class oxie_tabs extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'oxie_tabs', 								
					'description' => __('Displays tabs', "loc_oxie_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'oxie_tabs' 														
				);

				$this->WP_Widget('oxie_tabs', __('Oxie: Tabs', "loc_oxie_widgets_plugin"), $widget_ops, $control_ops );	
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

			//default for checkboxes
			if (empty($instance)) {
				$defaults_checkboxes = array(
					// 'fb_faces' => 'checked'
				);	
			}

			//defaults
			$defaults = array( 
				'title' 	=> __('Tabs', "loc_oxie_widgets_plugin"),
				'tabs'		=> array(
					0				=> array(
						'title'			=> "Tab",
						'content'		=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam suscipit est et risus vulputate suscipit.",
					),
				),
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			?>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('title')); ?> "><?php _e("Title", "loc_oxie_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('title')); ?>' name='<?php echo esc_attr($this->get_field_name('title')); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

				<br>
				<?php _e("Tabs", "loc_oxie_widgets_plugin"); ?>:
				<ul class="widget_sortable" data-split_index="3" data-placeholder="widget_tabs_placeholder">
				<?php
					for ($i = 0; $i < count($tabs); $i++) {  
					?>

						<li>
							<input class="widefat li_option" type='text' name='<?php echo esc_attr($this->get_field_name('tabs')."[".$i."][title]"); ?>' value="<?php if(isset($tabs[$i]['title'])) echo htmlspecialchars($tabs[$i]['title']); ?>">
							<textarea class='widefat li_option' name='<?php echo esc_attr($this->get_field_name('tabs')."[".$i."][content]"); ?>' rows='5'><?php if (isset($tabs[$i]['content'])) echo esc_attr($tabs[$i]['content']); ?></textarea>
						</li>
					<?php
					}
				?>

				</ul>

				<div class="ul_control" data-min="1" data-max="5">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_oxie_widgets_plugin"); ?>" />
					<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_oxie_widgets_plugin"); ?>" />
				</div>



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
				$title 				= __('Tabs', "loc_oxie_widgets_plugin");
				$tabs				= array(
					0					=> array(
						'title'				=> "Tab",
						'content'			=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam suscipit est et risus vulputate suscipit.",
					),
				);
			}

            // WPML
			$title = apply_filters('widget_title', $instance['title']);

			?>

			<?php echo wp_kses_post($before_widget); ?>

			<?php if (!empty($title)) { echo wp_kses_post($before_title . $title . $after_title); } ?>

			<div class="widget-tabs-container">
		
				<!-- Navigation for Tabs -->
				<ul class="tab-nav left">
					<?php
						
						for ($i = 0; $i < count($tabs); $i++) {  

				            // WPML
    						if (function_exists('icl_translate') && function_exists('icl_register_string')) {

					            // VERSION < 3.3
					            icl_register_string ('loc_oxie_widgets_plugin', "$widget_id-widget[$i][title]", $tabs[$i]['title']);

					            $tabs[$i]['title'] = icl_translate('loc_oxie_widgets_plugin', "$widget_id-widget[$i][title]", $tabs[$i]['title']);
    						
    						} elseif (class_exists('SitePress')) {
					            
					            // VERSION > v3.3
					            do_action('wpml_register_single_string', 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][title]", $tabs[$i]['title']);
					            
					            $tabs[$i]['title'] = apply_filters('wpml_translate_single_string', $tabs[$i]['title'], 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][title]");
    						
    						}

						?>
							<li data-tab="<?php printf('%s-tab-%d', esc_attr($widget_id), esc_attr($i)); ?>" <?php if($i === 0) { echo "class='active'"; } ?>><?php echo esc_attr($tabs[$i]['title']); ?></li>
						<?php
						}
					
					?>
				</ul>
		 
		 
		 		<!-- Tab Content -->
				<div class="tab-content-block clearfix">

					<?php
						
						for ($i = 0; $i < count($tabs); $i++) {  

				            // WPML
    						if (function_exists('icl_translate') && function_exists('icl_register_string')) {

					            // VERSION < 3.3
					            icl_register_string ('loc_oxie_widgets_plugin', "$widget_id-widget[$i][content]", $tabs[$i]['content']);

					            $tabs[$i]['content'] = icl_translate('loc_oxie_widgets_plugin', "$widget_id-widget[$i][content]", $tabs[$i]['content']);
    						
    						} elseif (class_exists('SitePress')) {
					            
					            // VERSION > v3.3
					            do_action('wpml_register_single_string', 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][content]", $tabs[$i]['content']);
					            
					            $tabs[$i]['content'] = apply_filters('wpml_translate_single_string', $tabs[$i]['content'], 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][content]");
    						
    						}
						
						?>
							<h3 class="v_nav<?php if($i === 0) { echo ' v_active'; } ?>" data-tab="<?php printf('%s-tab-%d', esc_attr($widget_id), esc_attr($i)); ?>"><?php echo esc_attr($tabs[$i]['title']); ?></h3>
				 			<div id="<?php printf('%s-tab-%d', esc_attr($widget_id), esc_attr($i)); ?>" class="tab_content clearfix">
				            	<p><?php echo do_shortcode(wp_kses_post($tabs[$i]['content'])); ?></p>   
							</div>
						<?php
						}
					
					?>

				</div>
				<!-- End Content -->

			</div>
		    <!-- End -->
    			

			<?php echo wp_kses_post($after_widget); ?>


			<?php
		}

	} //END CLASS



