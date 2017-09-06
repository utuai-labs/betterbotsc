<?php if (get_next_posts_link() || get_previous_posts_link()) : ?>

				<div class="pagination archive-pagination-prevnext">
					<ul>
						<li class="prev"><?php if (get_next_posts_link()) { next_posts_link( '<i class="fa fa-angle-left"></i> ' . __('Older Posts', 'loc_canon') ); } else { printf("<span class='eol'>%s</span>", __("No More Posts", "loc_canon")); } ?> &nbsp;</li>
						<li class="next">&nbsp; <?php if (get_previous_posts_link()) { previous_posts_link( __('Newer Posts', 'loc_canon') . ' <i class="fa fa-angle-right"></i>' ); } else { printf("<span class='eol'>%s</span>", __("No More Posts", "loc_canon")); } ?></li>
					</ul>	
				</div>

<?php endif; ?>
