	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s Settings - %s", esc_attr(wp_get_theme()->Name), esc_attr(__("Posts & Pages", "loc_canon")) ); ?></h2>

		<?php 
			//delete_option('canon_options_post');

			// GET VARS
			$canon_options_post = get_option('canon_options_post'); 
			$canon_theme_name = wp_get_theme()->Name;

			// GET ARRAY OF REGISTERED SIDEBARS
			$registered_sidebars_array = array();
			foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) { array_push($registered_sidebars_array, $value); }

			// GET CAT LIST
			$cat_list = get_categories(array('hide_empty' => 0));
			$cat_list = array_values($cat_list);

			// var_dump($canon_options_post);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_post'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_post'); ?>		


					<?php submit_button(); ?>


					<!-- 

						INDEX

						HOMEPAGE
						CATEGORY
						OTHER ARCHIVE PAGES
						SINGLE PAGE
						SINGLE POST
						META INFO AND SHARE LINKS
						ARCHIVE HEADER
						SEARCH 
						404
						WOOCOMMERCE
					
					-->


					<!-- 
					--------------------------------------------------------------------------
						HOMEPAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php _e("Homepage", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>

							<?php _e('The theme homepage. Displays your latest posts. Can display a feature at the top of the page. Go to <i>Header & Footer > Homepage Feature Builder</i> to setup feature.', 'loc_canon') ?>

							<br><br>
							
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose a layout. Layouts can have sidebar or no sidebar.', 'loc_canon'),
										__('<i>Masonry</i>: Column layout where posts rearrange to form a masonry pattern.', 'loc_canon'),
										__('<i>Even grid</i>: Column layout where posts arrange into an even grid.', 'loc_canon'),
										__('<i>Classic</i>: Classic blog layout with featured image to the left and text to the right.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of columns', 'loc_canon'),
									'content' 				=> array(
										__('Select number of columns for column layouts.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebar', 'loc_canon'),
									'content' 				=> array(
										__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Grid box style', 'loc_canon'),
									'content' 				=> array(
										__('Select style of post boxes in the grid.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Drop cap excerpt', 'loc_canon'),
									'content' 				=> array(
										__('Drop cap first letter in post excerpt.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Set the excerpt length in approx. number of characters before cut-off.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Pagination', 'loc_canon'),
									'content' 				=> array(
										__('Choose type of pagination.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table homepage-section group-page-setups'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Homepage layout', 'loc_canon'),
									'slug' 					=> 'homepage_layout',
									'select_options'		=> array(
										'masonry'				=> __('Masonry', 'loc_canon'),
										'masonry_sidebar'		=> __('Masonry with sidebar', 'loc_canon'),
										'even'					=> __('Even grid', 'loc_canon'),
										'even_sidebar'			=> __('Even grid with sidebar', 'loc_canon'),
										'classic'				=> __('Classic', 'loc_canon'),
										'classic_sidebar'		=> __('Classic with sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Number of columns', 'loc_canon'),
									'slug' 					=> 'homepage_num_columns',
									'select_options'		=> array(
										'1'						=> __('1 Column', 'loc_canon'),
										'2'						=> __('2 Columns', 'loc_canon'),
										'3'						=> __('3 Columns', 'loc_canon'),
										'4'						=> __('4 Columns', 'loc_canon'),
									),
									'listen_to'				=> '#homepage_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Sidebar for homepage', 'loc_canon'),
									'slug' 					=> 'homepage_sidebar',
									'listen_to'				=> '#homepage_layout',
									'listen_for'			=> 'masonry_sidebar even_sidebar classic_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Drop cap excerpt', 'loc_canon'),
									'slug' 					=> 'homepage_drop_cap',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'homepage_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pagination', 'loc_canon'),
									'slug' 					=> 'homepage_pagination',
									'select_options'		=> array(
										'prevnext'				=> __('Previous/next', 'loc_canon'),
										'prevnext_ajax'			=> __('Previous/next (AJAX)', 'loc_canon'),
										'links'					=> __('Links', 'loc_canon'),
										'links_ajax'			=> __('Links (AJAX)', 'loc_canon'),
										'loadmore_ajax'			=> __('Load more (AJAX)', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						CATEGORY
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php _e("Category", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php _e('Category pages display posts from a certain category. To add a category page to your site go to <i>Appearance > Menus > Categories</i>. Select a category and click the Add to Menu button. Drag and drop the new menu item to the desired location in the menu.', 'loc_canon') ?>

							<br><br>
							
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose a layout. Layouts can have sidebar or no sidebar.', 'loc_canon'),
										__('<i>Masonry</i>: Column layout where posts rearrange to form a masonry pattern.', 'loc_canon'),
										__('<i>Even grid</i>: Column layout where posts arrange into an even grid.', 'loc_canon'),
										__('<i>Classic</i>: Classic blog layout with featured image to the left and text to the right.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of columns', 'loc_canon'),
									'content' 				=> array(
										__('Select number of columns for column layouts.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebar', 'loc_canon'),
									'content' 				=> array(
										__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Grid box style', 'loc_canon'),
									'content' 				=> array(
										__('Select style of post boxes in the grid.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Drop cap excerpt', 'loc_canon'),
									'content' 				=> array(
										__('Drop cap first letter in post excerpt.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Set the excerpt length in approx. number of characters before cut-off.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Pagination', 'loc_canon'),
									'content' 				=> array(
										__('Choose type of pagination.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show category title', 'loc_canon'),
									'content' 				=> array(
										__('Choose to display the category title at the top of category pages.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show category description', 'loc_canon'),
									'content' 				=> array(
										__('Choose to display the category description at the top of category pages.', 'loc_canon'),
										__('You can set the category description at <i>Posts > Categories > Your category > Description</i>.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table cat-section group-page-setups'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Category layout', 'loc_canon'),
									'slug' 					=> 'cat_layout',
									'select_options'		=> array(
										'masonry'				=> __('Masonry', 'loc_canon'),
										'masonry_sidebar'		=> __('Masonry with sidebar', 'loc_canon'),
										'even'					=> __('Even grid', 'loc_canon'),
										'even_sidebar'			=> __('Even grid with sidebar', 'loc_canon'),
										'classic'				=> __('Classic', 'loc_canon'),
										'classic_sidebar'		=> __('Classic with sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Number of columns', 'loc_canon'),
									'slug' 					=> 'cat_num_columns',
									'select_options'		=> array(
										'1'						=> __('1 Column', 'loc_canon'),
										'2'						=> __('2 Columns', 'loc_canon'),
										'3'						=> __('3 Columns', 'loc_canon'),
										'4'						=> __('4 Columns', 'loc_canon'),
									),
									'listen_to'				=> '#cat_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Sidebar for category pages', 'loc_canon'),
									'slug' 					=> 'cat_sidebar',
									'listen_to'				=> '#cat_layout',
									'listen_for'			=> 'masonry_sidebar even_sidebar classic_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Drop cap excerpt', 'loc_canon'),
									'slug' 					=> 'cat_drop_cap',
									'listen_to'				=> '#cat_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'cat_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pagination', 'loc_canon'),
									'slug' 					=> 'cat_pagination',
									'select_options'		=> array(
										'prevnext'				=> __('Previous/next', 'loc_canon'),
										'prevnext_ajax'			=> __('Previous/next (AJAX)', 'loc_canon'),
										'links'					=> __('Links', 'loc_canon'),
										'links_ajax'			=> __('Links (AJAX)', 'loc_canon'),
										'loadmore_ajax'			=> __('Load more (AJAX)', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show category title', 'loc_canon'),
									'slug' 					=> 'show_cat_title',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show category description', 'loc_canon'),
									'slug' 					=> 'show_cat_description',
									'options_name'			=> 'canon_options_post',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						OTHER ARCHIVE PAGES
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php _e("Other archive pages", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php _e('Other archive pages are pages such as search results, author pages, tag pages, date pages (day, month, year) etc.', 'loc_canon') ?>

							<br><br>
							
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose a layout. Layouts can have sidebar or no sidebar.', 'loc_canon'),
										__('<i>Masonry</i>: Column layout where posts rearrange to form a masonry pattern.', 'loc_canon'),
										__('<i>Even grid</i>: Column layout where posts arrange into an even grid.', 'loc_canon'),
										__('<i>Classic</i>: Classic blog layout with featured image to the left and text to the right.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Number of columns', 'loc_canon'),
									'content' 				=> array(
										__('Select number of columns for column layouts.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Sidebar', 'loc_canon'),
									'content' 				=> array(
										__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Grid box style', 'loc_canon'),
									'content' 				=> array(
										__('Select style of post boxes in the grid.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Drop cap excerpt', 'loc_canon'),
									'content' 				=> array(
										__('Drop cap first letter in post excerpt.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'content' 				=> array(
										__('Set the excerpt length in approx. number of characters before cut-off.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Pagination', 'loc_canon'),
									'content' 				=> array(
										__('Choose type of pagination.', 'loc_canon'),
									),
								)); 

							?>


						</div>

						<table class='form-table archive-section group-page-setups'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Archive layout', 'loc_canon'),
									'slug' 					=> 'archive_layout',
									'select_options'		=> array(
										'masonry'				=> __('Masonry', 'loc_canon'),
										'masonry_sidebar'		=> __('Masonry with sidebar', 'loc_canon'),
										'even'					=> __('Even grid', 'loc_canon'),
										'even_sidebar'			=> __('Even grid with sidebar', 'loc_canon'),
										'classic'				=> __('Classic', 'loc_canon'),
										'classic_sidebar'		=> __('Classic with sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Number of columns', 'loc_canon'),
									'slug' 					=> 'archive_num_columns',
									'select_options'		=> array(
										'1'						=> __('1 Column', 'loc_canon'),
										'2'						=> __('2 Columns', 'loc_canon'),
										'3'						=> __('3 Columns', 'loc_canon'),
										'4'						=> __('4 Columns', 'loc_canon'),
									),
									'listen_to'				=> '#archive_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Sidebar for archive', 'loc_canon'),
									'slug' 					=> 'archive_sidebar',
									'listen_to'				=> '#archive_layout',
									'listen_for'			=> 'masonry_sidebar even_sidebar classic_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Drop cap excerpt', 'loc_canon'),
									'slug' 					=> 'archive_drop_cap',
									'listen_to'				=> '#archive_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Excerpt length', 'loc_canon'),
									'slug' 					=> 'archive_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Pagination', 'loc_canon'),
									'slug' 					=> 'archive_pagination',
									'select_options'		=> array(
										'prevnext'				=> __('Previous/next', 'loc_canon'),
										'prevnext_ajax'			=> __('Previous/next (AJAX)', 'loc_canon'),
										'links'					=> __('Links', 'loc_canon'),
										'links_ajax'			=> __('Links (AJAX)', 'loc_canon'),
										'loadmore_ajax'			=> __('Load more (AJAX)', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>


						</table>


					<!-- HORIZONTAL DIVIDER -->
					<br><hr><br>


					<!-- 
					--------------------------------------------------------------------------
						SINGLE PAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Single Page", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show comments', 'loc_canon'),
									'content' 				=> array(
										__('Displays comments and comment reply form.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show comments', 'loc_canon'),
									'slug' 					=> 'page_show_comments',
									'options_name'			=> 'canon_options_post',
								)); 

							 ?>	

						</table>


					<!-- 
					--------------------------------------------------------------------------
						SINGLE POST
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Single Post", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Use dropcap', 'loc_canon'),
									'content' 				=> array(
										__('Drop cap the first letter in content.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show tags', 'loc_canon'),
									'content' 				=> array(
										__('Display tags associated with your post.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show comments', 'loc_canon'),
									'content' 				=> array(
										__('Displays comments and comment reply form.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show post navigation', 'loc_canon'),
									'content' 				=> array(
										__('Adds post navigation to posts. Use this to navigate between previous and next post relative to the current post.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Post navigate only same category posts', 'loc_canon'),
									'content' 				=> array(
										__('The prev/next post navigation only navigates posts from the same category as the current post.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Ad code', 'loc_canon'),
									'content' 				=> array(
										__('Insert your ad code or ad HTML here. If you are unsure what code to use you should consult your ad provider.', 'loc_canon'),
										__('To display the ad in your single posts remember to check the checkbox <i>Your post > Post settings > Post component: Ad > Show ad</i>.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('Default post style', 'loc_canon'),
									'slug' 					=> 'single_default_post_style',
									'select_options'		=> array(
										'full'					=> __('Full width featured image', 'loc_canon'),
										'compact'				=> __('Compact featured image', 'loc_canon'),
										'full_sidebar'			=> __('Full width featured image and sidebar', 'loc_canon'),
										'compact_sidebar'		=> __('Compact featured image and sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Use dropcap', 'loc_canon'),
									'slug' 					=> 'single_use_dropcap',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show tags', 'loc_canon'),
									'slug' 					=> 'show_tags',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show comments', 'loc_canon'),
									'slug' 					=> 'show_comments',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show post navigation', 'loc_canon'),
									'slug' 					=> 'show_post_nav',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Post navigate only same category posts', 'loc_canon'),
									'slug' 					=> 'post_nav_same_cat',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('Ad code', 'loc_canon'),
									'slug' 					=> 'post_component_ad_code',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_post',
								)); 

							 ?>	

						</table>


					<!-- 
					--------------------------------------------------------------------------
						META INFO AND SHARE LINKS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Meta info and share links", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show meta info', 'loc_canon'),
									'content' 				=> array(
										__('Choose what meta info to display in posts and on archive pages.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Show share links', 'loc_canon'),
									'content' 				=> array(
										__('Choose what share links to display in posts and on archive pages.', 'loc_canon'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: author', 'loc_canon'),
									'slug' 					=> 'show_meta_author',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: publish date', 'loc_canon'),
									'slug' 					=> 'show_meta_date',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: comments', 'loc_canon'),
									'slug' 					=> 'show_meta_comments',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: likes', 'loc_canon'),
									'slug' 					=> 'show_meta_likes',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Show meta info: views', 'loc_canon'),
									'slug' 					=> 'show_meta_views',
									'options_name'			=> 'canon_options_post',
								)); 


							 ?>	

							 <!-- DIVIDER -->
							 <tr><td colspan="2"><hr></td></tr>

							<?php 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Share link: Facebook', 'loc_canon'),
									'slug' 					=> 'show_share_link_facebook',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Share link: Twitter', 'loc_canon'),
									'slug' 					=> 'show_share_link_twitter',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Share link: Google Plus', 'loc_canon'),
									'slug' 					=> 'show_share_link_google_plus',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Share link: Pinterest', 'loc_canon'),
									'slug' 					=> 'show_share_link_pinterest',
									'options_name'			=> 'canon_options_post',
								)); 

							?>

						</table>




					<!-- 
					--------------------------------------------------------------------------
						ARCHIVE HEADER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Archive Header", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Padding top / bottom', 'loc_canon'),
									'content' 				=> array(
										__('Set amount of padding for the archive header.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Archive header images', 'loc_canon'),
									'content' 				=> array(
										__('Select a default image to use as background for the archive header. You can also set a custom image for each of the category pages. If no image is set for a category the default image will be used.', 'loc_canon'),
									),
								)); 


							?>

						</div>

						<table class='form-table'>

							<?php
								
								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Padding top', 'loc_canon'),
									'slug' 					=> 'archive_header_padding_top',
									'min'					=> '1',									// optional
									'max'					=> '10000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(pixels)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'number',
									'title' 				=> __('Padding bottom', 'loc_canon'),
									'slug' 					=> 'archive_header_padding_bottom',
									'min'					=> '1',									// optional
									'max'					=> '10000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(pixels)',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'upload',
									'title' 				=> __('Default archive header image', 'loc_canon'),
									'slug' 					=> 'archive_header_image_default',
									'btn_text'				=> __('Select image', 'loc_canon'),
									'options_name'			=> 'canon_options_post',
								)); 
								
							?>

							 <!-- DIVIDER -->
							 <tr><td colspan="2"><hr></td></tr>

							<?php


								for ($i = 0; $i < count($cat_list); $i++) { 

									fw_option(array(
										'type'					=> 'upload',
										'title' 				=> __('Category: ', 'loc_canon') . $cat_list[$i]->name,
										'slug' 					=> 'archive_header_cat_'. $cat_list[$i]->slug,
										'btn_text'				=> __('Select image', 'loc_canon'),
										'options_name'			=> 'canon_options_post',
									)); 

								}



							?>		

						</table>

					<!-- 
					--------------------------------------------------------------------------
						SEARCH 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php _e("Search", "loc_canon"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search box text', 'loc_canon'),
									'content' 				=> array(
										__('The text that displays inside the search box.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search post types', 'loc_canon'),
									'content' 				=> array(
										__('Select what post types to include in search. Notice that deselecting all post types will result in no filters being applied to search (default WordPress behaviour) and all post types containing the search term will be returned on the search results page. This may not always be what you want as a lot of custom post types are for internal theme/plugin use only and are not meant to be viewed as regular posts. Correct styling and functionality of search results can only be guaranteed for posts and pages. Including custom post types in search is to be viewed as "experimental" and is "use-at-own-risk".', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Custom post types', 'loc_canon'),
									'content' 				=> array(
										__('What custom post types to include in search when Search custom post types has been selected. Separate with commas. Notice that you need to put in the custom post type slug. If you are unsure what the slug of a certain custom post type is please consult the plugin documentation or the plugin author.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('Search widget areas', 'loc_canon'),
									'content' 				=> array(
										__('Search buttons like those that can be added to the header will activate a full screen search window. This window has a search area as well as a widget area consisting of 5 widget columns.', 'loc_canon'),
										__('Select what widget areas to display in the 5 search widget columns. You have to select widget areas for at least 2 of the 5 columns. Column widths will adjust to the number of active columns.', 'loc_canon'),
										__('If you do not want to display widgets in your search window select widget areas for at least 2 of the 5 columns but leave the widget areas empty.', 'loc_canon'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php
								
								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Search box text', 'loc_canon'),
									'slug' 					=> 'search_box_text',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 
							
								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search posts', 'loc_canon'),
									'slug' 					=> 'search_posts',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search pages', 'loc_canon'),
									'slug' 					=> 'search_pages',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> __('Search custom post types', 'loc_canon'),
									'slug' 					=> 'search_cpt',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('Custom post types', 'loc_canon'),
									'slug' 					=> 'search_cpt_source',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 
							
								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Search Widget Area 1', 'loc_canon'),
									'slug' 					=> 'search_widget_area_1',
									'select_options'		=> array(
										'off'					=> __('Off', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Search Widget Area 2', 'loc_canon'),
									'slug' 					=> 'search_widget_area_2',
									'select_options'		=> array(
										'off'					=> __('Off', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Search Widget Area 3', 'loc_canon'),
									'slug' 					=> 'search_widget_area_3',
									'select_options'		=> array(
										'off'					=> __('Off', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Search Widget Area 4', 'loc_canon'),
									'slug' 					=> 'search_widget_area_4',
									'select_options'		=> array(
										'off'					=> __('Off', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Search Widget Area 5', 'loc_canon'),
									'slug' 					=> 'search_widget_area_5',
									'select_options'		=> array(
										'off'					=> __('Off', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>			

						</table>

					<!-- 
					--------------------------------------------------------------------------
						404
				    -------------------------------------------------------------------------- 
					-->

						<h3>404 <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('404 layout', 'loc_canon'),
									'content' 				=> array(
										__('Choose between full width or sidebar layout.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('404 title', 'loc_canon'),
									'content' 				=> array(
										__('Title that displays on the 404-page.', 'loc_canon'),
									),
								)); 

								fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> __('404 message', 'loc_canon'),
									'content' 				=> array(
										__('Message to display on the 404-page.', 'loc_canon'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<?php 

								fw_option(array(
									'type'					=> 'select',
									'title' 				=> __('404 Layout', 'loc_canon'),
									'slug' 					=> '404_layout',
									'select_options'		=> array(
										'full'				=> __('Full width', 'loc_canon'),
										'sidebar'			=> __('Sidebar', 'loc_canon'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> __('Sidebar for 404 page', 'loc_canon'),
									'slug' 					=> '404_sidebar',
									'listen_to'				=> '#404_layout',
									'listen_for'			=> 'sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								fw_option(array(
									'type'					=> 'text',
									'title' 				=> __('404 title', 'loc_canon'),
									'slug' 					=> '404_title',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 

								fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> __('404 message', 'loc_canon'),
									'slug' 					=> '404_msg',
									'cols'					=> '100',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_post',
								)); 
							
							?>			

						</table>
						
						
						

					<?php 

						if (is_plugin_active('woocommerce/woocommerce.php')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						WOOCOMMERCE
				    -------------------------------------------------------------------------- 
					-->

							<h3>WooCommerce <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar on shop and product pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose to have a sidebar displayed on your shop and product pages.', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('What about the other WooCommerce pages?', 'loc_canon'),
										'content' 				=> array(
											__('Other WooCommerce pages use ordinary page templates. You can change which template to use for each of the WooCommerce pages (sidebar or full width page templates).', 'loc_canon'),
										),
									)); 

									fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> __('Sidebar for WooCommerce pages', 'loc_canon'),
										'content' 				=> array(
											__('Choose which sidebar to use for your WooCommerce pages. This will be the same across all WooCommerce pages that have a sidebar.', 'loc_canon'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> __('Sidebar on shop and product pages', 'loc_canon'),
										'slug' 					=> 'use_woocommerce_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 

									fw_option(array(
										'type'					=> 'select_sidebar',
										'title' 				=> __('Sidebar for WooCommerce pages', 'loc_canon'),
										'slug' 					=> 'woocommerce_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 
								
								?>

							</table>

						 		
						<?php	
						}
					?>




					<!-- END OPTIONS AND WRAP UP FILE -->

					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

