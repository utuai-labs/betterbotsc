<?php
							
	//VARS
    $canon_options = get_option('canon_options'); 
    $canon_options_post = get_option('canon_options_post'); 

	// DETERMINE PAGE TYPE (home, page or category)
	$page_type = mb_get_page_type();

    // SET TITLE STRING
    switch ($page_type) {
        case 'category':
            $archive_title = __('in category', 'loc_canon');
            $archive_subject = single_cat_title('', false);
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'tag':
            $archive_title = __('tagged', 'loc_canon');
            $archive_subject = single_tag_title('', false);
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'search':
            $archive_title = __('searching for', 'loc_canon');
            $archive_subject = get_search_query();
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'author':
            $archive_title = __('by', 'loc_canon');
            $archive_subject = get_the_author_meta('display_name',$wp_query->post->post_author);
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'day':
            $archive_title = __('from day', 'loc_canon');
            $archive_subject =  get_the_time('d/m/Y');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'month':
            $archive_title = __('from month', 'loc_canon');
            $archive_subject = get_the_time('m/Y');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'year':
            $archive_title = __('from year', 'loc_canon');
            $archive_subject = get_the_time('Y');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'tax':
            $archive_title = __('in group', 'loc_canon');
            $archive_subject = get_query_var('term');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        default:
            $archive_title = __('browsing', 'loc_canon');
            $archive_subject = __('Unknown', 'loc_canon');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
    }


    $num_posts_found = $wp_query->found_posts;
    $num_posts_found_postfix = ($num_posts_found == "1") ? __("post", "loc_canon") : __("posts", "loc_canon");
    if ($page_type == "search") { $num_posts_found_postfix = ($num_posts_found === 1) ? __("result", "loc_canon") : __("results", "loc_canon"); }
    $num_posts_found_string = sprintf('%s %s', esc_attr($num_posts_found), esc_attr($num_posts_found_postfix) );

    // SET CONTROLLER CLASSES
    $controller_classes = "is-col-1-1 not-boxed is-classic not-dropcap not-sidebar";
    $controller_classes .= " not-full";


?>

			<div class="outter-wrapper clearfix archive-header <?php echo esc_attr($controller_classes); ?> <?php if ($canon_options['overlay_header'] == "checked") { echo "overlay-header"; } ?>">

				<!-- SUMMARY -->
				<?php if (!($page_type == "category" && $canon_options_post['show_cat_title'] != "checked")) { printf('<h1>%s %s</h1>', esc_attr($num_posts_found_string), wp_kses_post($archive_title_string)); } ?>
				
				
				<?php if ($page_type == "author") : ?>

				<?php
					
				    $author_description = get_the_author_meta('description');
				    $author_description = (!empty($author_description)) ? $author_description : __("This author has not supplied a bio yet.","loc_canon");

				?>

					<!-- AUTHOR BOX -->
					<div class="postAuthor">

						<div class="postAuthor-inner">

							<?php echo get_avatar(get_the_author_meta('ID'), 72, '', 'author-avatar'); ?>

							<p><?php echo wp_kses_post($author_description); ?></p>
							
							<div class="author-social">
									
								<ul class="socialList">
									<?php if ( get_the_author_meta('user_url') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-globe"></em></a></li>', esc_url(get_the_author_meta('user_url')) ); } ?>
									<?php if ( get_the_author_meta('facebook') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-facebook"></em></a></li>', esc_url(get_the_author_meta('facebook')) ); } ?>
									<?php if ( get_the_author_meta('twitter') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-twitter"></em></a></li>', esc_url(get_the_author_meta('twitter')) ); } ?>
									<?php if ( get_the_author_meta('googleplus') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-google-plus"></em></a></li>', esc_url(get_the_author_meta('googleplus')) ); } ?>
									<?php if ( get_the_author_meta('linkedin') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-linkedin"></em></a></li>', esc_url(get_the_author_meta('linkedin')) ); } ?>
								</ul>
								
							</div>

						</div>	

					</div>

				<?php endif; ?>



                <?php $category_description = category_description(); ?>

                <?php if ( $page_type == "category" && $canon_options_post['show_cat_description'] == "checked" && !empty($category_description) ) : ?>

                    <!-- CATEGORY DESCRIPTION -->
                    <div class="category-description">

                        <div class="category-description-inner">

                            <?php echo wp_kses_post($category_description); ?>

                        </div>

                    </div>

                <?php endif; ?>


			</div>
