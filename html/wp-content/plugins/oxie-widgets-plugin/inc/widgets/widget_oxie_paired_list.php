<?php

/**************************************
WIDGET: oxie_paired_list
***************************************/

	add_action('widgets_init', 'register_widget_oxie_paired_list' );
	function register_widget_oxie_paired_list () {
		register_widget('oxie_paired_list');	
	}

	class oxie_paired_list extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'oxie_paired_list', 								
					'description' => __('Display a paired list.', "loc_oxie_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'oxie_paired_list' 														
				);

				$this->WP_Widget('oxie_paired_list', __('Oxie: Paired List', "loc_oxie_widgets_plugin"), $widget_ops, $control_ops );	
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
				'title' 		=> __('Opening Hours', "loc_oxie_widgets_plugin"),
				'pair'			=> array(
					0				=> array (
						'left'			=> 'Mondays',
						'right'			=> 'Closed',
					),
					1				=> array (
						'left'			=> 'Tue-Fri',
						'right'			=> '10am - 12am',
					),
					2				=> array (
						'left'			=> 'Sat-Sun',
						'right'			=> '7am - 1am',
					),
					3				=> array (
						'left'			=> 'Public Holidays',
						'right'			=> '7am - 1am',
					),
				),
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<!-- TEXT -->	
				<p>
					<label for="<?php echo esc_attr($this->get_field_id('title')); ?> "><?php _e("Title <i>(optional)</i>", "loc_oxie_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('title')); ?>' name='<?php echo esc_attr($this->get_field_name('title')); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

			<!-- SORTABLE UL -->	
 
 				<?php _e("Opening Hours", "loc_cph"); ?>:
				<ul class="widget_sortable paired_list_ul" data-split_index="3" data-placeholder="widget_sortable_placeholder">
				<?php
					for ($i = 0; $i < count($pair); $i++) {  
					?>

						<li>

						<!-- TEXT -->	
							<div class="pair_left">
								<label for="<?php echo esc_attr($this->get_field_id('pair')."[".$i."][left]"); ?> "><?php _e("Left", "loc_oxie_widgets_plugin"); ?>: </label><br>
								<input class='li_option' type='text' id='<?php echo esc_attr($this->get_field_id('pair')."[".$i."][left]"); ?>' name='<?php echo esc_attr($this->get_field_name('pair')."[".$i."][left]"); ?>' value="<?php if(isset($pair[$i]['left'])) echo htmlspecialchars($pair[$i]['left']); ?>">
							</div>


						<!-- TEXT -->	
							<div class="pair_right">
								<label for="<?php echo esc_attr($this->get_field_id('pair')."[".$i."][right]"); ?> "><?php _e("Right", "loc_oxie_widgets_plugin"); ?>: </label><br>
								<input class='li_option' type='text' id='<?php echo esc_attr($this->get_field_id('pair')."[".$i."][right]"); ?>' name='<?php echo esc_attr($this->get_field_name('pair')."[".$i."][right]"); ?>' value="<?php if(isset($pair[$i]['right'])) echo htmlspecialchars($pair[$i]['right']); ?>">
							</div>


						</li>
					<?php
					}
				?>

				</ul>

				<div class="ul_control" data-min="1" data-max="1000">
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
				$title 	= __('Opening Hours', "loc_oxie_widgets_plugin");
			}

            // WPML
			$title = apply_filters('widget_title', $instance['title']);

			?>

			<?php echo wp_kses_post($before_widget); ?>

			<?php if (!empty($title)) { echo wp_kses_post($before_title . $title . $after_title); } ?>

			<ul class="paired-list">

				<?php
					
					for ($i = 0; $i < count($pair); $i++) {  

			            // WPML
						if (function_exists('icl_translate') && function_exists('icl_register_string')) {

				            // VERSION < 3.3
				            icl_register_string ('loc_oxie_widgets_plugin', "$widget_id-widget[$i][left]", $pair[$i]['left']);
				            icl_register_string ('loc_oxie_widgets_plugin', "$widget_id-widget[$i][right]", $pair[$i]['right']);

				            $pair[$i]['left'] = icl_translate('loc_oxie_widgets_plugin', "$widget_id-widget[$i][left]", $pair[$i]['left']);
				            $pair[$i]['right'] = icl_translate('loc_oxie_widgets_plugin', "$widget_id-widget[$i][right]", $pair[$i]['right']);
						
						} elseif (class_exists('SitePress')) {
				            
				            // VERSION > v3.3
				            do_action('wpml_register_single_string', 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][left]", $pair[$i]['left']);
				            do_action('wpml_register_single_string', 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][right]", $pair[$i]['right']);
				            
				            $pair[$i]['left'] = apply_filters('wpml_translate_single_string', $pair[$i]['left'], 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][left]");
				            $pair[$i]['right'] = apply_filters('wpml_translate_single_string', $pair[$i]['right'], 'loc_oxie_widgets_plugin', "$widget_id-widget[$i][right]");
						
						}

						printf('<li>%s	<span>%s</span></li>', esc_attr($pair[$i]['left']), esc_attr($pair[$i]['right']));
					}
				
				?>

			</ul>

			<?php echo wp_kses_post($after_widget); ?>


			<?php
		}

	} //END CLASS



