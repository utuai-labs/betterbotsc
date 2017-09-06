<?php
	
    // GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    $author_description = get_the_author_meta('description');
    $author_description = (!empty($author_description)) ? $author_description : __("This author has not supplied a bio yet.","loc_canon");

?>

				
						<div class="post-component-container post-component-author postAuthor">

							<div class="feat-title"></div>
							
							<div class="postAuthor-inner clearfix">
								
								<div class="col-2-5"> 

									<?php echo get_avatar(get_the_author_meta('ID'), 72, '', 'author-avatar'); ?>
									
	                                <?php 

	                                    // DATE
	                                    $archive_year  = get_the_time('Y'); 
	                                    $archive_month = get_the_time('m'); 
	                                    $archive_day   = get_the_time('d');                             

	                                    // BYLINE AND PUBLISH DATE
	                                    echo '<div class="author-meta"><div>';

	                                    if ($canon_options_post['show_meta_author'] == "checked") { printf('%s <a class="meta-author" href="%s">%s</a>', esc_attr(__('Written By', 'loc_canon')), esc_url(get_author_posts_url( get_the_author_meta('ID'))), esc_attr(get_the_author()) ); }
	                                    if ($canon_options_post['show_meta_author'] == "checked" && $canon_options_post['show_meta_date'] == "checked") { printf('<br> %s', __(' on ', 'loc_canon')); }
	                                    if ($canon_options_post['show_meta_date'] == "checked") { printf('<a class="meta-date" href="%s">%s</a>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(mb_localize_datetime(get_the_time(get_option('date_format')))) ); }

	                                    echo '</div></div>';

									?>

									
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
								
								
								<div class="col-3-5 last">

									<?php echo wp_kses_post($author_description); ?>

								</div>
								
							</div>	

						</div>

					
