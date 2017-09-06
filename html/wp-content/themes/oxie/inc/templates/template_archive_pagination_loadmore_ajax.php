<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>

				<div class="pagination archive-pagination-loadmore-ajax is-loadmore">
					<ul>
						<li class="load-more"><?php if (get_next_posts_link()) { next_posts_link( __('Load More', 'loc_canon') . ' <i class="fa fa-angle-down"></i>' ); } else { printf("<span class='eol'>%s</span>", __("No More Posts", "loc_canon")); } ?></li>
					</ul>	
				</div>

<?php endif; ?>
