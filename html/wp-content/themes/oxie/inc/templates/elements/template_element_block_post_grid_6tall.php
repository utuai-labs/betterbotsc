<?php
	
	// GET OPTIONS
	$canon_options_frame = get_option('canon_options_frame'); 

	// GET VARS
	$show = $canon_options_frame['block_post_grid_shows'];

	// GET POSTS
	$results_query = mb_get_posts_from_show_select($show, 6, false);

?>


		<div class="hero-grid element-block-post-grid grid-6tall clearfix">
			
			<div class="col-1-2">

				<div class="col-1-1">

					<?php 

						$this_index = 0;
						if (isset($results_query[$this_index])) {
							// IMAGE VARS
							$this_post = $results_query[$this_index];
							$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_6tall') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
	                        
	                        // FEATURED IMAGE WITH HOVER BOX
							echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
							printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
	                        canon_hoverbox_default($this_post->ID, $this_post->post_title );														
	                        echo "</div></div>";
						}

					?>

				</div>
					
				<div class="col-1-1">

					<div class="col-1-2">
								
						<?php 

							$this_index = 1;
							if (isset($results_query[$this_index])) {
								// IMAGE VARS
								$this_post = $results_query[$this_index];
								$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_6tall') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
								$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
		                        
		                        // FEATURED IMAGE WITH HOVER BOX
								echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
								printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
		                        canon_hoverbox_default($this_post->ID, $this_post->post_title );														
		                        echo "</div></div>";
							}

						?>
						
					</div>

					<div class="col-1-2">
											
						<?php 

							$this_index = 2;
							if (isset($results_query[$this_index])) {
								// IMAGE VARS
								$this_post = $results_query[$this_index];
								$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_6tall') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
								$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
		                        
		                        // FEATURED IMAGE WITH HOVER BOX
								echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
								printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
		                        canon_hoverbox_default($this_post->ID, $this_post->post_title );														
		                        echo "</div></div>";
							}

						?>

					</div>

				</div>		

			</div>

			
				
			<div class="col-1-2">

				<div class="col-1-2">

					<?php 

						$this_index = 3;
						if (isset($results_query[$this_index])) {
							// IMAGE VARS
							$this_post = $results_query[$this_index];
							$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_6tall') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
	                        
	                        // FEATURED IMAGE WITH HOVER BOX
							echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
							printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
	                        canon_hoverbox_default($this_post->ID, $this_post->post_title );														
	                        echo "</div></div>";
						}

					?>
						
				</div>
					
				<div class="col-1-2">
				
					<?php 

						$this_index = 4;
						if (isset($results_query[$this_index])) {
							// IMAGE VARS
							$this_post = $results_query[$this_index];
							$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_6tall') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
	                        
	                        // FEATURED IMAGE WITH HOVER BOX
							echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
							printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
	                        canon_hoverbox_default($this_post->ID, $this_post->post_title );														
	                        echo "</div></div>";
						}

					?>
						
				</div>

			</div>
				
				
			<div class="col-1-2">

				<?php 

					$this_index = 5;
					if (isset($results_query[$this_index])) {
						// IMAGE VARS
						$this_post = $results_query[$this_index];
						$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_6tall') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
						$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                        
                        // FEATURED IMAGE WITH HOVER BOX
						echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
						printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
                        canon_hoverbox_default($this_post->ID, $this_post->post_title );														
                        echo "</div></div>";
					}

				?>

			</div>

		</div>
