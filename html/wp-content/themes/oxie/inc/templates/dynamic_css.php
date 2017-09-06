<?php 

/******************************************************************************
INDEX

		THEME COLOURS
		FONTS
		OTHER DYNAMIC OPTIONS
		FINAL CALL CSS

*******************************************************************************/

	function canon_dynamic_css() {
			

		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_post = get_option('canon_options_post');
		$canon_options_appearance = get_option('canon_options_appearance');
		$canon_options_advanced = get_option('canon_options_advanced');

		// GET CAT LIST
		$cat_list = get_categories(array('hide_empty' => 0));
		$cat_list = array_values($cat_list);

		// DEV MODE OPTIONS
	    if ($canon_options['dev_mode'] == "checked") {
	        if (isset($_GET['preheader_opacity'])) { $canon_options_frame['preheader_opacity'] = wp_filter_nohtml_kses($_GET['preheader_opacity']); }
	        if (isset($_GET['header_opacity'])) { $canon_options_frame['header_opacity'] = wp_filter_nohtml_kses($_GET['header_opacity']); }
	        if (isset($_GET['postheader_opacity'])) { $canon_options_frame['postheader_opacity'] = wp_filter_nohtml_kses($_GET['postheader_opacity']); }
	    }


 ?>

	<style type="text/css">
	
		
	/* ==========================================================================
		THEME COLOURS
	   
	   
		001. BODY BACKGROUND
		002. MAIN TEXT
		003. HEADINGS TEXT
		004. LINK COLOR
		005. LINK HOVER COLOR
		006. LIKE HEART
		007. WHITE TEXT
		008. MAIN BUTTON COLOR
		009. MAIN BUTTON HOVER COLOR 
		010. MAIN BUTTON TEXT COLOR
		011. META COLOR
		012. PRE HEADER COLOR
		013. PRE HEADER TEXT COLOR
		014. PRE HEADER TEXT HOVER COLOR
		015. PRE HEADER 3RD MENU
		016. HEADER CONTAINER
		017. HEADER CONTAINER TEXT 
		018. HEADER CONTAINER TEXT HOVER
		019. HEADER CONTAINER 3RD MENU
		020. POST HEADER
		021. POST HEADER TEXT
		022. POST HEADER TEXT HOVER
		023. POST HEADER 3RD MENU 
		024. SIDR MENU
		025. SIDR MENU TEXT
		026. SIDR MENU TEXT HOVER
		027. SIDR MENU BORDERS
		028. MAIN BORDERS
		029. SECONDARY PLATE COLOR
		030. FORM FIELDS
		031. BASELINE
		032. BASELINE TEXT
		033. BASELINE TEXT HOVER 
		

	   
	   ========================================================================== */
		   
		
		
		/* 
		001. BODY BACKGROUND _________________________________________________________ */
		html, 
		body {
			background-color: #f3f5f7;
			<?php if (!empty($canon_options_appearance['color_body'])) echo "background-color: ".$canon_options_appearance['color_body']."!important;"; ?>
		}
		
		
		
		/* 
		002. PLATE BACKGROUND _________________________________________________________ */
		.boxed-page .outter-wrapper-parent,
		aside.sidebar .widget,
		.is-boxed .inner-wrapper,
		.is-boxed .post-format-quote cite a,
		.is-classic .post-format-quote cite a,
		.postMeta ul.socialList li ul,
		.postMeta ul.socialList ul:before,
		.is-classic .inner-wrapper,
		.is-boxed .top-post-meta .avatar,
		.flex-control-paging li a,
		.flex-direction-nav a,
		.boxy.review-box .rate-tab,
		.not-full.outter-wrapper.archive-header .postAuthor,
		.not-full.outter-wrapper.archive-header .postAuthor img:first-child,
		.not-full.outter-wrapper.archive-header .category-description,
		
		.sepTitle *, 
		h3.widget-title .widget-title-inner,
		ul.tab-nav li.active,
		h3.v_active,
		.tparrows.preview3:after,
		.element-block-carousel .block-carousel-nav a,
		.is-bordered .inner-wrapper.post-format-quote,
		.style-sep span,
		.comment-count,
		ul.review-graph > li .rate-span, 
		.error404 .main-column, 
		
		/* WOO COMMERCE */
		.woocommerce #payment div.payment_box, 
		.woocommerce-page #payment div.payment_box, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active, 
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active {
			background-color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_plate'])) echo "background-color: ".$canon_options_appearance['color_plate'].";"; ?>
		}
		
		.tc-info-box:after,
		.boxy.review-box:after,
		.gallery .gallery-item img{
			border-color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_plate'])) echo "border-color: ".$canon_options_appearance['color_plate'].";"; ?>
		}  
		 
		   
		   
		/* 
		002. MAIN TEXT _______________________________________________________________ */  
		html, 
		button, 
		input, 
		textarea,
		.is-dropcap .postText:first-letter,
		.not-full.outter-wrapper.archive-header .postAuthor *,
		.not-full.outter-wrapper.archive-header .category-description *,
		.is-dropcap .postText * + p.lead:first-letter {
		    color: #222425;
		    <?php if (!empty($canon_options_appearance['color_main_text'])) echo "color: ".$canon_options_appearance['color_main_text'].";"; ?>
		}
		
		
		
		/* 
		003. HEADINGS TEXT ____________________________________________________________ */ 
		h1, h2, h3, h4, h5, h6,
		a h1, a h2, a h3, a h4, a h5, a h6,
		a h1 *, a h2 *, a h3 *, a h4 *, a h5 *, a h6 *,
		.is-col-1-1 .postText blockquote,
		.is-col-1-2 .postText blockquote,
		.is-col-1-3 .postText blockquote,
		.is-col-1-4 .postText blockquote,
		.is-col-1-5 .postText blockquote,
		ul.tab-nav li,
		.oxie_statistics li,
		
		/* WOO COMMERCE */
		.woocommerce ul.products li.product .price, 
		.woocommerce-page ul.products li.product .price, 
		.woocommerce table.cart a.remove:hover, 
		.woocommerce #content table.cart a.remove:hover, 
		.woocommerce-page table.cart a.remove:hover, 
		.woocommerce-page #content table.cart a.remove:hover, 
		.summary.entry-summary .price span,  
		.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, 
		mark{
			 color: #222425;
			 <?php if (!empty($canon_options_appearance['color_main_headings'])) echo "color: ".$canon_options_appearance['color_main_headings'].";"; ?>
		}
		
		
		
		/* 
		004. LINK COLOR _______________________________________________________________ */
		a, a *,
		.tparrows.preview3:after{
			 color: #222425;
			 <?php if (!empty($canon_options_appearance['color_links'])) echo "color: ".$canon_options_appearance['color_links'].";"; ?>
		}
		
		
		
		/* 
		005. LINK HOVER COLOR _________________________________________________________ */
		a:hover, a:hover *,
		.pagination ul li a:hover,
		.pagination ul li a:hover *,
		.sepTitle span span,
		.maintenance_msg h1:before,
		.error404 .main-column .super:after,
		.highlight,
		.sc_toggle-btn.active,
		.toggle-btn.active,
		.sc_accordion-btn.active,
		.accordion-btn.active,
		.quoterate,
		ul.tab-nav li.active,
		h3.v_active,
		.oxie_statistics li em,
		.sidebar ul li.recentcomments:before,
		.page-numbers.current,
		.single-item.alt-post .dateMeta a:hover,
		.tparrows.preview3:hover:after,
		.tc-info-box ul.tc-info-box-ul li:before,
		ol > li:before,
		.style-sep,
		.review-box .star-rating li .fa-star,
		cite a *,
		.paging a:hover,
		.more-posts-carousel .meta:hover *,
		.boxy.review-box .rate-tab,
		.main-column .postText ul li:before,
		.sidebar ul li:before,
		cite,
		.main-column .postText ul li:after,
		ul.comments li .clearfix ul li:after,
		.widget.woocommerce ul.product-categories li:after,
		
		
		/* WOOCOMMERCE */
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
		
		/* WOO COMMERCE */
		.shipping_calculator h2 a, 
		.woocommerce table.cart a.remove, 
		.woocommerce #content table.cart a.remove, 
		.woocommerce-page table.cart a.remove, 
		.woocommerce-page #content table.cart a.remove, 
		.woocommerce form .form-row .required, 
		.woocommerce-page form .form-row .required, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover, 
		.woocommerce .star-rating span:before, 
		.woocommerce-page .star-rating span:before, 
		.woocommerce div.product .stock, 
		.woocommerce #content div.product .stock, 
		.woocommerce-page div.product .stock, 
		.woocommerce-page #content div.product .stock, 
		.woocommerce div.product .out-of-stock, 
		.woocommerce #content div.product .out-of-stock, 
		.woocommerce-page div.product .out-of-stock,
		.woocommerce-page #content div.product .out-of-stock{
			color: #9088a3;
			<?php if (!empty($canon_options_appearance['color_links_hover'])) echo "color: ".$canon_options_appearance['color_links_hover'].";"; ?>	
		}
		
		
		
		/* 
		006. LIKE HEART _______________________________________________________________ */
		.heart.liked .fa{
			color: #9088a3;
			<?php if (!empty($canon_options_appearance['color_like'])) echo "color: ".$canon_options_appearance['color_like'].";"; ?>	
		}
		
		
		
		/* 
		007. WHITE TEXT _______________________________________________________________ */
		a.hover-effect h3,
		ol.graphs > li div,
		.tc-hover-content, 
		.tc-hover-content *,
		.pre-footer-container a.scroll-up *,
		.pre-footer-container a.scroll-up:hover *,
		
		/* WOO COMMERCE */
		.woocommerce span.onsale, 
		.woocommerce-page span.onsale,
		.woocommerce ul.products li.product p.wc-new-badge *{
			color: #fff;
			<?php if (!empty($canon_options_appearance['color_white_text'])) echo "color: ".$canon_options_appearance['color_white_text'].";"; ?>
		}
		
		
		
		/* 
		008. MAIN BUTTON COLOR  _______________________________________________________ */
		.btn, 
		input[type=button], 
		input[type=submit], 
		button,
		.read-more,
		.owl-controls .owl-page.active span,
		.flex-control-paging li a.flex-active,
		 ul.review-graph > li .rate-span div,
		 .rate-tab,
		 .widget.oxie_social_links ul.social-links:not(.standard) li a,
		 .widget_price_filter .ui-slider .ui-slider-range,
		 .postTags ul li a,
		 .gallery-filter li a,
		
		/* WOO COMMERCE */
		.woocommerce a.button, 
		.woocommerce button.button, 
		.woocommerce input.button, 
		.woocommerce #respond input#submit, 
		.woocommerce #content input.button, 
		.woocommerce-page a.button, 
		.woocommerce-page button.button, 
		.woocommerce-page input.button, 
		.woocommerce-page #respond input#submit, 
		.woocommerce-page #content input.button,  
		.woocommerce a.button.alt, 
		.woocommerce button.button.alt, 
		.woocommerce input.button.alt, 
		.woocommerce #respond input#submit.alt, 
		.woocommerce #content input.button.alt, 
		.woocommerce-page a.button.alt, 
		.woocommerce-page button.button.alt, 
		.woocommerce-page input.button.alt, 
		.woocommerce-page #respond input#submit.alt, 
		.woocommerce-page #content input.button.alt, 
		.woocommerce-message:before, 
		.woocommerce .shop_table.cart td.actions .button.alt, 
		.widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce .woocommerce-message a.button,
		.woocommerce .shop_table.cart td.actions .button{
			border-color: #dbdcde!important;
			<?php if (!empty($canon_options_appearance['color_btn'])) echo "border-color: ".$canon_options_appearance['color_btn'].";"; ?>
		}
		
		
		
		/* 
		009. MAIN BUTTON HOVER COLOR  _________________________________________________ */
		.btn:hover, 
		input[type=button]:hover, 
		input[type=submit]:hover, 
		button:hover,
		.read-more:hover,
		.widget.oxie_social_links ul.social-links:not(.standard) li a:hover,
		.postTags ul li a:hover,
		.gallery-filter li a:hover,
		.gallery-filter li a.selected,
		
		.owl-controls .owl-page span,
		
		/* WOO COMMERCE */
		p.demo_store, 
		.woocommerce .shop_table.cart td.actions .button:hover, 
		.woocommerce .woocommerce-message a.button:hover,
		.woocommerce a.button:hover,
		.woocommerce button:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce #content input.button:hover,
		.woocommerce-page a.button:hover,
		.woocommerce-page button.button:hover,
		.woocommerce-page input.button:hover,
		.woocommerce-page #respond input#submit:hover,
		.woocommerce-page #content input.button:hover,
		.woocommerce .shop_table.cart td.actions .button.alt:hover,
		.product .cart button.single_add_to_cart_button:hover,
		#place_order:hover,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale{
			background-color: #9088a3;
			border-color: #9088a3!important;
			<?php if (!empty($canon_options_appearance['color_btn_hover'])) echo "background-color: ".$canon_options_appearance['color_btn_hover'].";"; ?>
			<?php if (!empty($canon_options_appearance['color_btn_hover'])) echo "border-color: ".$canon_options_appearance['color_btn_hover'].";"; ?>
		}
		
		
		
		/* 
		010. MAIN BUTTON TEXT COLOR  __________________________________________________ */
		.btn, 
		input[type=button], 
		input[type=submit], 
		button,
		.rate-tab,
		.widget.oxie_social_links ul.social-links:not(.standard) li a *,
		.postTags ul li a,
		.gallery-filter li a,
		
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce #respond input#submit,
		.woocommerce #content input.button,
		.woocommerce-page a.button,
		.woocommerce-page button.button,
		.woocommerce-page input.button,
		.woocommerce-page #respond input#submit,
		.woocommerce-page #content input.button{
			color: #b8babd;
			<?php if (!empty($canon_options_appearance['color_btn_text'])) echo "color: ".$canon_options_appearance['color_btn_text'].";"; ?>
		}
		
		
		/* 
		010. MAIN BUTTON TEXT HOVER COLOR  __________________________________________________ */
		.btn:hover, 
		input[type=button]:hover, 
		input[type=submit]:hover, 
		button:hover,
		.read-more:hover,
		.widget.oxie_social_links ul.social-links:not(.standard) li a:hover *,
		.postTags ul li a:hover,
		.gallery-filter li a:hover,
		.gallery-filter li a.selected{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_btn_text_hover'])) echo "color: ".$canon_options_appearance['color_btn_text_hover']."!important;"; ?>
		}
		
		
		
		/* 
		010. FEATURE COLOR  __________________________________________________ */
		.postMeta:before, 
		h3.widget-title:before,
		.post-format-quote cite:before,
		.sticky.post:after,
		.postText span.postTitle:before,
		.single-post .postTitle:before,
		.feat-title:before,
		.post-type-archive-product .inner-wrapper h1.page-title:before,
		h1.product_title.entry-title:before,
		.scroll-up,
		ol.graphs > li div, 
		.ratings-bar,
		.widget_price_filter .ui-slider .ui-slider-handle,
		.widget_price_filter .ui-slider .ui-slider-range {
			background-color: #9088a3;
			<?php if (!empty($canon_options_appearance['color_feat_color'])) echo "background-color: ".$canon_options_appearance['color_feat_color'].";"; ?>
		}
		
		
		
		/* 
		010. FEATURE OVERLAY COLOR  __________________________________________________ */
		.not-full.outter-wrapper.archive-header:after,
		.tc-hover:before{
			background-color: #4d4365;
			<?php if (!empty($canon_options_appearance['color_feat_overlay_color'])) echo "background-color: ".$canon_options_appearance['color_feat_overlay_color'].";"; ?>
		}
		
		
		
		/* 
		010. FEATURE OVERLAY TEXT COLOR  __________________________________________________ */
		.not-full.outter-wrapper.archive-header *{
			color: #fff;
			<?php if (!empty($canon_options_appearance['color_feat_overtext_color'])) echo "color: ".$canon_options_appearance['color_feat_overtext_color'].";"; ?>
		}
		
		
		
		/* 
		011. META COLOR  _______________________________________________________________ */
		.postMeta *, 
		.socialList *,
		a.hover-effect .dateMeta, 
		.pagination ul li *,
		.paging .meta,
		.oxie_twitter .tweet .meta,
		.wp-caption-text,
		.gallery-caption,
		.single-item.alt-post .dateMeta a,
		.single-item.alt-post .dateMeta,
		.read-more,
		.review-box .star-rating li .fa-star-o,
		blockquote:before,
		.thumbnails-list-date:before,
		.thumbnails-list-date *,
		.author-meta *,
		.author-meta,
		.more-posts-carousel .meta *,
		.comments .meta span,
		.star-rating-result,
		h1 em,
		h2 em,
		h3 em,
		
		/* WOO COMMERCE */
		 .woocommerce-result-count, 
		 .woocommerce ul.products li.product .price del, 
		 .woocommerce-page ul.products li.product .price del, 
		 .summary.entry-summary .price del span,  
		 .woocommerce .cart-collaterals .cart_totals p small, 
		 .woocommerce-page .cart-collaterals .cart_totals p small, 
		 .woocommerce .star-rating:before, 
		 .woocommerce-page .star-rating:before,
		 .added_to_cart.wc-forward,
		 .woocommerce ul.cart_list li .quantity {
			color: #cacbcc;
			<?php if (!empty($canon_options_appearance['color_meta'])) echo "color: ".$canon_options_appearance['color_meta'].";"; ?>
		}
		
		
		/* 
		011. DROP CAP COLOR  _______________________________________________________________ */
		.is-dropcap .postText:first-letter,
		.is-dropcap .postText .lead:first-letter,
		.is-dropcap .postText .classic-dropcap:first-letter,
		.single-post .is-dropcap .postText > p:first-child:first-letter,
		.is-dropcap .postText .featImage + p:first-letter{
			color: #222425;
			<?php if (!empty($canon_options_appearance['color_drops'])) echo "color: ".$canon_options_appearance['color_drops'].";"; ?>
		}
		
		
		
		/* 
		012. PRE HEADER COLOR  _________________________________________________________ */ 
		.pre-header-container:after, 
		.pre-header-container .nav li ul,
		.ui-autocomplete li{
			background-color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_pre_header'])) echo "background-color: ".$canon_options_appearance['color_pre_header'].";"; ?>
		}
		
		
		
		/* 
		013. PRE HEADER TEXT COLOR  ____________________________________________________ */  
		.pre-header-container *,
		.ui-autocomplete li, 
		.ui-autocomplete li a, 
		.ui-state-focus{
			color: #222425;
			<?php if (!empty($canon_options_appearance['color_pre_header_text'])) echo "color: ".$canon_options_appearance['color_pre_header_text'].";"; ?>
		}
		
		
		
		/* 
		014. PRE HEADER TEXT HOVER COLOR  ______________________________________________ */  
		.pre-header-container a:hover,
		.pre-header-container a:hover *,
		.search_controls li:hover,
		.ui-autocomplete li.ui-state-focus,
		.pre-header-container #primary_menu:before,
		.pre-header-container .mobile-header a.responsive-menu-button em,
		.pre-header-container .toolbar-search-btn:hover *{
			color: #9189a4;
			<?php if (!empty($canon_options_appearance['color_pre_header_text_hover'])) echo "color: ".$canon_options_appearance['color_pre_header_text_hover'].";"; ?>
		}
		
		
		
		/* 
		015. PRE HEADER 3RD MENU  ______________________________________________________ */ 
		.pre-header-container .nav li:hover ul ul, 
		.pre-header-container .nav li:hover ul ul:before,
		.pre-header-container .right .nav li ul.sub-menu ul.sub-menu:after,
		.pre-header-container .centered .nav li ul.sub-menu ul.sub-menu:after{
			background-color: #f1f1f1;
			<?php if (!empty($canon_options_appearance['color_pre_header_menus'])) echo "background-color: ".$canon_options_appearance['color_pre_header_menus'].";"; ?>
		}
		
		
		
		/* 
		016. HEADER CONTAINER  _________________________________________________________ */ 
		.header-container:after, 
		.header-container .nav li ul{
			background-color: #272b32;
			<?php if (!empty($canon_options_appearance['color_header'])) echo "background-color: ".$canon_options_appearance['color_header'].";"; ?>
		}
		
		
		/* Header Container Sticky */ 
		.header-container.canon_stuck:after,
		.header-container.canon_stuck .nav li ul,
		.header-container.canon_stuck .nav li ul:before{
			background-color: #272b32;
			<?php if (!empty($canon_options_appearance['color_header_stuck'])) echo "background-color: ".$canon_options_appearance['color_header_stuck'].";"; ?>
		}
		
		/* 
		017. HEADER CONTAINER TEXT  _____________________________________________________ */ 
		.header-container *{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_header_text'])) echo "color: ".$canon_options_appearance['color_header_text'].";"; ?>
		}
		
		
		
		/* 
		018. HEADER CONTAINER TEXT HOVER  _______________________________________________ */ 
		.header-container a:hover,
		.header-container a:hover *,
		.header-container .toolbar-search-btn:hover *{
			color: #ded9ea;
			<?php if (!empty($canon_options_appearance['color_header_text_hover'])) echo "color: ".$canon_options_appearance['color_header_text_hover'].";"; ?>
		}
		
		
		
		/* 
		019. HEADER CONTAINER 2nD MENU  __________________________________________________ */
		.header-container .nav li ul:before,
		.header-container .nav li ul{
		     background-color: #fafafa;
		     <?php if (!empty($canon_options_appearance['color_header_menus_2nd'])) echo "background-color: ".$canon_options_appearance['color_header_menus_2nd'].";"; ?>   
		}
		
		
		/* 
		019. HEADER CONTAINER 3RD MENU  __________________________________________________ */ 
		.header-container .nav li:hover ul ul, 
		.header-container .nav li:hover ul ul:before,
		.header-container .right .nav li ul.sub-menu ul.sub-menu:after,
		.header-container .centered .nav li ul.sub-menu ul.sub-menu:after{
			background-color: #f1f1f1;
			<?php if (!empty($canon_options_appearance['color_header_menus'])) echo "background-color: ".$canon_options_appearance['color_header_menus'].";"; ?>
		}
		
		
		
		/* 
		020. POST HEADER  ________________________________________________________________ */  
		.post-header-container:after,
		.post-header-container .nav li ul{
			background-color: #3d424a;
			<?php if (!empty($canon_options_appearance['color_post_header'])) echo "background-color: ".$canon_options_appearance['color_post_header'].";"; ?>
		}
		
		
		
		/* 
		021. POST HEADER TEXT  ___________________________________________________________ */  
		.post-header-container *{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_post_header_text'])) echo "color: ".$canon_options_appearance['color_post_header_text'].";"; ?>
		}
		
		
		
		/* 
		022. POST HEADER TEXT HOVER  _____________________________________________________ */ 
		.post-header-container a:hover,
		.post-header-container a:hover *,
		.post-header-container .toolbar-search-btn:hover *{
			color: #9189a4;
			<?php if (!empty($canon_options_appearance['color_post_header_text_hover'])) echo "color: ".$canon_options_appearance['color_post_header_text_hover'].";"; ?>
		}
		
		
		
		/* 
		023. POST HEADER 3RD MENU  _______________________________________________________ */ 
		.post-header-container .nav li:hover ul ul, 
		.post-header-container .nav li:hover ul ul:before,
		.post-header-container .right .nav li ul.sub-menu ul.sub-menu:after,
		.post-header-container .centered .nav li ul.sub-menu ul.sub-menu:after{
			background-color: #535963;
			<?php if (!empty($canon_options_appearance['color_post_header_menus'])) echo "background-color: ".$canon_options_appearance['color_post_header_menus'].";"; ?>
		}
		
		
		
		/* 
		024. SEARCH CONTAINER BACKGROUND  __________________________________________________________________ */
		.outter-wrapper.search-header-container:after,
		.search-header-container .widget-tabs-container .tab-content-block,
		.search-header-container .widget-tabs-container .tab-nav li.active,
		.search-header-container .widget-tabs-container h3.v_nav{
			background-color: #1f2327;
			<?php if (!empty($canon_options_appearance['color_search_bg'])) echo "background-color: ".$canon_options_appearance['color_search_bg'].";"; ?>
		}
		
		
		
		/* 
		024. SEARCH CONTAINER TEXT  __________________________________________________________________ */
		.outter-wrapper.search-header-container,
		.outter-wrapper.search-header-container *,
		.search-header-container header form input{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_search_text'])) echo "color: ".$canon_options_appearance['color_search_text'].";"; ?>
		}
		
		
		
		/* 
		024. SEARCH CONTAINER TEXT HOVER  __________________________________________________________________ */
		.outter-wrapper.search-header-container a:hover,
		.outter-wrapper.search-header-container a:hover *{
			color: #9189a4;
			<?php if (!empty($canon_options_appearance['color_search_text_hover'])) echo "color: ".$canon_options_appearance['color_search_text_hover'].";"; ?>
		}
		
		
		/* 
		024. SEARCH CONTAINER BORDERS  __________________________________________________________________ */
		.search-header-container header form input,
		.search-header-container h3.widget-title:after,
		.search-header-container .widget .more-posts-thumbnails-list li,
		.search-header-container *,
		.search-header-container ul li,
		.search-header-container ul.sc_toggle li, 
		.search-header-container ul.toggle li, 
		.search-header-container ul.sc_accordion li, 
		.search-header-container ul.accordion li,
		.search-header-container .widget-tabs-container *{
			border-color: #464d51;
			<?php if (!empty($canon_options_appearance['color_search_line'])) echo "border-color: ".$canon_options_appearance['color_search_line']."!important;"; ?>
		}
		
		/* 
		024. SIDR MENU  __________________________________________________________________ */
		#sidr-main{
			background-color: #191c20;
			<?php if (!empty($canon_options_appearance['color_sidr'])) echo "background-color: ".$canon_options_appearance['color_sidr'].";"; ?>
		}
		
		
		
		/* 
		025. SIDR MENU TEXT ______________________________________________________________ */
		#sidr-main *{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_sidr_text'])) echo "color: ".$canon_options_appearance['color_sidr_text'].";"; ?>
		}
		
		
		
		/* 
		026. SIDR MENU TEXT HOVER _________________________________________________________ */ 
		#sidr-main a:hover,
		#sidr-main a:hover *{
			color: #9189a4;
			<?php if (!empty($canon_options_appearance['color_sidr_text_hover'])) echo "color: ".$canon_options_appearance['color_sidr_text_hover'].";"; ?>
		}
		
		
		
		/* 
		027. SIDR MENU BORDERS ____________________________________________________________ */  
		#sidr-main ul, #sidr-main li{
			border-color: #23272c;
			<?php if (!empty($canon_options_appearance['color_sidr_line'])) echo "border-color: ".$canon_options_appearance['color_sidr_line']."!important;"; ?>
		}
		
		
		
		/* 
		028. MAIN BORDERS _________________________________________________________________ */ 
		.sepTitle:after,
		.is-sidebar aside.sidebar:before,
		.postMeta:after, 
		h3.widget-title:after,
		.postText span.postTitle:after,
		.single-post .postTitle:after,
		.post-format-quote cite:after,
		.feat-title:after,
		.post-type-archive-product .inner-wrapper h1.page-title:after,
		h1.product_title.entry-title:after,
		.widget .more-posts-thumbnails-list li,
		.user-ratings,
		
		.postAuthor,
		.pagination,
		.pagination ul li:first-child,
		ul.comments > li,
		ul.comments .comment-respond,
		.is-classic .inner-wrapper:after,
		.paging,
		.paging .prev,
		.error404 .main-column,
		hr,
		ul.sc_toggle li,
		ul.toggle li,
		ul.sc_accordion li,
		ul.accordion li,
		pre,
		.main-column table,
		.main-column table th,
		.main-column table td,
		ul.tab-nav li,
		.tab-content-block,
		h3.v_active,
		.sidebar ul li,
		.is-classic .single-item,
		.link-pages p,
		.instagram-media,
		.hero-widgets.element-block-widgets ul li,
		.single-item.alt-post-style-5 .postText .clearfix,
		.tc-info-box-meta,
		.is-bordered .inner-wrapper,
		.style-sep:after,
		ul.review-graph > li .rate-span,
		ul.comments .children .clearfix,
		
		input[type=text],  
		input[type=email], 
		input[type=password], 
		textarea, 
		input[type=tel],  
		input[type=range], 
		input[type=url],
		input[type=number], 
		input[type=search],  
		input[type=date],
		
		/* WOO COMMERCE */
		ul.products li .price,
		ul.products li h3,
		.woocommerce #payment div.payment_box,
		.woocommerce-page #payment div.payment_box,
		.col2-set.addresses .address,
		p.myaccount_user,
		.summary.entry-summary .price,
		.summary.entry-summary .price,
		.product_meta .sku_wrapper,
		.product_meta .posted_in,
		.product_meta .tagged_as,
		.product_meta span:first-child,
		.woocommerce-message,
		.related.products,
		.woocommerce .widget_shopping_cart .total,
		.woocommerce-page .widget_shopping_cart .total,
		.woocommerce div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
		.woocommerce #reviews #comments ol.commentlist li img.avatar,
		.woocommerce-page #reviews #comments ol.commentlist li img.avatar,
		.woocommerce #reviews #comments ol.commentlist li .comment-text,
		.woocommerce-page #reviews #comments ol.commentlist li .comment-text,
		.upsells.products,
		.woocommerce #payment ul.payment_methods,
		.woocommerce-page #payment ul.payment_methods,
		.woocommerce form.login,
		.woocommerce form.checkout_coupon,
		.woocommerce form.register,
		.woocommerce-page form.login,
		.woocommerce-page form.checkout_coupon,
		.woocommerce-page form.register,
		.woocommerce #reviews #comments ol.commentlist,
		.widget_price_filter .price_slider_wrapper .ui-widget-content,
		.widget.woocommerce .tagcloud a,
		.widget.woocommerce ul.product_list_widget li,
		.widget.woocommerce ul.product-categories li,
		.woocommerce nav.woocommerce-pagination ul li, 
		.woocommerce #content nav.woocommerce-pagination ul li, 
		.woocommerce-page nav.woocommerce-pagination ul li, 
		.woocommerce-page #content nav.woocommerce-pagination ul li,
		.woocommerce nav.woocommerce-pagination ul, 
		.woocommerce #content nav.woocommerce-pagination ul, 
		.woocommerce-page nav.woocommerce-pagination ul, 
		.woocommerce-page #content nav.woocommerce-pagination ul,
		.woocommerce table.shop_table td, 
		.woocommerce-page table.shop_table td,
		.woocommerce .cart-collaterals .cart_totals tr td, 
		.woocommerce .cart-collaterals .cart_totals tr th, 
		.woocommerce-page .cart-collaterals .cart_totals tr td, 
		.woocommerce-page .cart-collaterals .cart_totals tr th,
		.woocommerce .quantity input.qty, 
		.woocommerce #content .quantity input.qty, 
		.woocommerce-page .quantity input.qty, 
		.woocommerce-page #content .quantity input.qty,
		.woocommerce ul.products li.product p{
			border-color: #e0e0e0!important;
			<?php if (!empty($canon_options_appearance['color_borders'])) echo "border-color: ".$canon_options_appearance['color_borders']."!important;"; ?>
		}
		
		
		
		/* 
		029. SECONDARY PLATE COLOR _________________________________________________________ */
		.is-classic .postAuthor,
		.category-description,		
		.block-carousel .owl-item .owl-item-boxed-content,
		ol.graphs > li,
		tbody tr:nth-child(2n+1),
		ul.tab-nav li,
		.tc-info-box,
		.review-box,
		.is-boxed .main-isotope-container .style-sep span,
		.main-isotope-container .post-format-quote .style-sep span,
		
		/* WOO COMMERCE */
		.woocommerce ul.products li.product,
		.woocommerce ul.products li.product.last .woocommerce-page ul.products li.product,
		.col2-set.addresses .address,
		.woocommerce-message,
		.woocommerce div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li,
		.woocommerce #payment,
		.woocommerce-page #payment,
		.woocommerce-main-image img,
		.widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce nav.woocommerce-pagination ul li span.current, 
		.woocommerce nav.woocommerce-pagination ul li a:hover, 
		.woocommerce nav.woocommerce-pagination ul li a:focus, 
		.woocommerce #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page nav.woocommerce-pagination ul li a:focus, 
		.woocommerce-page #content nav.woocommerce-pagination ul li span.current, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:hover, 
		.woocommerce-page #content nav.woocommerce-pagination ul li a:focus{
			background-color: #f7f9fb;
			<?php if (!empty($canon_options_appearance['color_second_plate'])) echo "background-color: ".$canon_options_appearance['color_second_plate'].";"; ?>
		}
		
		.tc-info-box,
		.boxy.review-box{
			border-color: #f7f9fb;
			<?php if (!empty($canon_options_appearance['color_second_plate'])) echo "border-color: ".$canon_options_appearance['color_second_plate']."!important;"; ?>
		}
		
		
		/* 
		030. FORM FIELDS __________________________________________________________________ */
		input[type=text],  
		input[type=email], 
		input[type=password], 
		textarea, 
		input[type=tel],  
		input[type=range], 
		input[type=url],
		input[type=number], 
		input[type=search],  
		input[type=date]{
			background-color: #f9fafb;
			<?php if (!empty($canon_options_appearance['color_fields'])) echo "background-color: ".$canon_options_appearance['color_fields'].";"; ?>
		}
			
		
		
		/* 
		031. Feature Area Background _____________________________________________________________________ */ 
		.hero-widgets.element-block-widgets,
		.hero-widgets.element-block-widgets h3.widget-title .widget-title-inner,
		.hero-widgets.element-block-widgets .style-sep span,
		.main-footer-container,
		.homepage-feature-container,
		.hero-carousel .block-carousel .owl-item .owl-item-boxed-content{
			background: #f4f6f7;
			<?php if (!empty($canon_options_appearance['color_feat_area'])) echo "background-color: ".$canon_options_appearance['color_feat_area']."!important;"; ?>	
		}	
		
		
		/* 
		031. FEATURE AREA TEXT _____________________________________________________________________ */ 
		.hero-widgets, 
		.hero-widgets *,
		.hero-widgets *:before,
		.hero-carousel,
		.hero-carousel *,
		.hero-carousel *:before{
			color: #222425;
			<?php if (!empty($canon_options_appearance['color_feat_area_text'])) echo "color: ".$canon_options_appearance['color_feat_area_text'].";"; ?>
		}
		
		
		/* 
		031. FEATURE AREA TEXT HOVER _____________________________________________________________________ */ 
		.hero-widgets a:hover, 
		.hero-widgets a:hover *,
		.hero-carousel a:hover,
		.hero-carousel a:hover *{
			color: #9088a3;
			<?php if (!empty($canon_options_appearance['color_feat_area_text_hover'])) echo "color: ".$canon_options_appearance['color_feat_area_text_hover'].";"; ?>
		}
		
		
		/* 
		031. FEATURE INSTGRAM TEXT _____________________________________________________________________ */ 
		.hero-carousel.element-block-instagram-carousel .block-carousel,
		.hero-carousel.element-block-instagram-carousel .block-carousel *,
		.hero-carousel.element-block-instagram-carousel .block-carousel *:before{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_feat_car_text'])) echo "color: ".$canon_options_appearance['color_feat_car_text'].";"; ?>
		}
		
		
		/* 
		031. FEATURE INSTGRAM TEXT HOVER _____________________________________________________________________ */ 
		.hero-carousel.element-block-instagram-carousel .block-carousel a:hover,
		.hero-carousel.element-block-instagram-carousel .block-carousel a:hover *{
			color: #c1b1e4;
			<?php if (!empty($canon_options_appearance['color_feat_car_text_hover'])) echo "color: ".$canon_options_appearance['color_feat_car_text_hover'].";"; ?>
		}
		
		
		
		/* 
		031. FEATURE AREA BORDERS _____________________________________________________________________ */  	
		.hero-widgets.element-block-widgets ul li,
		.hero-widgets h3.widget-title:after{
			border-color: #e0e0e0;
			<?php if (!empty($canon_options_appearance['color_feat_area_borders'])) echo "border-color: ".$canon_options_appearance['color_feat_area_borders']."!important;"; ?>
		}
		
		
		
		/* 
		031. PRE FOOTER  _____________________________________________________________________ */
		.pre-footer-container{
			background-color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_pre_footer'])) echo "background-color: ".$canon_options_appearance['color_pre_footer'].";"; ?>
		}
		
		
		
		/* 
		031. PRE FOOTER TEXT  _____________________________________________________________________ */
		.pre-footer-container *{
			color: #222425;
			<?php if (!empty($canon_options_appearance['color_pre_footer_text'])) echo "color: ".$canon_options_appearance['color_pre_footer_text'].";"; ?>
		}
		
		
		
		/* 
		031. PRE FOOTER TEXT HOVER  _____________________________________________________________________ */
		.pre-footer-container a:hover,
		.pre-footer-container a:hover *{
			color: #9088a3;
			<?php if (!empty($canon_options_appearance['color_pre_footer_text_hover'])) echo "color: ".$canon_options_appearance['color_pre_footer_text_hover'].";"; ?>
		}
		
				
		
		/* 
		031. POST FOOTER  _____________________________________________________________________ */ 
		.post-footer-container{
			background-color: #3d464b;
			<?php if (!empty($canon_options_appearance['color_baseline'])) echo "background-color: ".$canon_options_appearance['color_baseline'].";"; ?>
		}
		
		
		
		/* 
		032. POST FOOTER TEXT _______________________________________________________________ */
		.post-footer-container *{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_baseline_text'])) echo "color: ".$canon_options_appearance['color_baseline_text'].";"; ?>
		}
		
		
		
		/* 
		033. POST FOOTER TEXT HOVER _________________________________________________________ */
		.post-footer-container a:hover,
		.post-footer-container a:hover *{
			color: #9088a3;
			<?php if (!empty($canon_options_appearance['color_baseline_text_hover'])) echo "color: ".$canon_options_appearance['color_baseline_text_hover'].";"; ?>
		}
		
		
		
		/* 
		034. LOGO TEXT _________________________________________________________ */
		a.logo-text{
			color: #ffffff;
			<?php if (!empty($canon_options_appearance['color_logo'])) echo "color: ".$canon_options_appearance['color_logo'].";"; ?>
		}
		
		
		
		
		
		
		
		
		/* ==========================================================================
		FONTS
		========================================================================== */
		
		
		
		/* 
		001. MAIN BODY FONT _________________________________________________________ */
		body,
		.is-dropcap .postText:first-letter,
		.search-header-container header form input{
			font-family: 'source_sans_prolight';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_main'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_main']); ?>
		}
		
		
		/* 
		002. MAIN HEADINGS _________________________________________________________ */
		h1, h1 em{
			font-family: 'ralewaylight';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_heading'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading']); ?>
		}
		
		
		/* 
		003. MAIN HEADINGS STRONG ____________________________________________________ */
		h1 strong, 
		h1 b, 
		h3 strong, 
		h3 b{
			font-family: 'ralewaybold';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_heading_strong'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading_strong']); ?>
		}
		
		
		/* 
		004. SECONDARY HEADINGS _________________________________________________________ */
		h2, h2 em, 
		h4, h4 em,
		h5, h5 em,
		h6, h6 em,
		.woocommerce #reviews h3, .woocommerce-page #reviews h3{
			font-family: 'merriweatherbold';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_heading2'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading2']); ?>
		}
		   
		
		/* 
		005. THIRD HEADINGS _________________________________________________________ */
		h3, h3 em{
			font-family: 'ralewayregular';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_heading3'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_heading3']); ?>
		}
		
		
		/* 
		006. NAVIGATION _________________________________________________________ */ 
		.nav a,
		.nav a strong,
		.nav a b,  
		.header-area .wrapper ul li a,  
		.pre-header-area .wrapper ul li a,
		.responsive-menu-button{
			font-family: 'ralewaysemibold';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_nav'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_nav']); ?>
		}
		
		
		/* 
		007. META TEXT _________________________________________________________ */
		.meta, 
		.dateMeta, 
		.pagination,
		.thumbnails-list-date,
		.author-meta,
		.top-post-meta .socialList a,
		.comment-reply-link, 
		.comment-edit-link, 
		#cancel-comment-reply-link,
		.tc-info-box-meta p,
		ol > li:before,
		ul.review-graph > li,
		.star-rating-result,
		.added_to_cart.wc-forward {
			font-family: 'source_sans_proregular';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_meta'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_meta']); ?>
		}
		
		
		/* 
		008. BUTTONS TEXT _________________________________________________________ */
		.btn, 
		input[type=button], 
		input[type=submit], 
		button,
		.read-more,
		.postTags a, 
		.main-column table th,
		ul.tab-nav li,
		h3.v_nav,
		.oxie_animated_number .super,
		h4.fittext,
		.button,
		.gallery-filter li a{
			 font-family: 'source_sans_proregular';
			 font-weight: normal;
			 font-style: normal;
			 <?php if ($canon_options_appearance['font_button'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_button']); ?>
		}
		
		
		/* 
		009. DROP CAPS _________________________________________________________ */
		.is-dropcap .postText:first-letter,
		.is-dropcap .postText .lead:first-letter,
		.is-dropcap .postText .classic-dropcap:first-letter,
		.single-post .is-dropcap .postText > p:first-child:first-letter,
		.is-dropcap .postText .featImage + p:first-letter{
			font-family: 'playfair_displayregular';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_dropcap'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_dropcap']); ?>
		}
		.is-dropcap .postText .featImage + p:first-letter{
			font-family: 'playfair_displayregular'!important;
			font-weight: normal!important;
			font-style: normal!important;
			<?php if ($canon_options_appearance['font_dropcap'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_dropcap']); ?>
		}
		
		
		/* 
		010. QUOTES _________________________________________________________ */
		blockquote, cite,
		.hero-carousel .tc-hover-content h3 > a,
		.logo-text .tagline{
			font-family: 'merriweatherlight_italic';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_quote'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_quote']); ?>
		}
		
		
		/* 
		011. LOGO TEXT _________________________________________________________ */
		a.logo-text .text-logo{
			font-family: 'ralewaybold';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_logotext'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_logotext']); ?>
		}
		
		
		/* 
		012. LEAD TEXT _________________________________________________________ */
		.lead, .is-dropcap .postText * + p.lead:first-letter{
			font-family: 'merriweatherlight_italic';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_lead'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_lead']); ?>
		}
		
		
		/* 
		013. BOLD TEXT _________________________________________________________ */
			strong, b,
			.sc_toggle-btn,
			.sc_accordion-btn,
			.toggle-btn,
			.accordion-btn,
			ol.graphs > li span {
			font-family: 'source_sans_prosemibold';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_bold'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_bold']); ?>
		}
		
		
		/* 
		014. ITALIC TEXT _________________________________________________________ */
		em, .wp-caption-text{
			font-family: 'source_sans_prolight_italic';
			font-weight: normal;
			font-style: normal;
			<?php if ($canon_options_appearance['font_italic'][0] != 'canon_default') echo mb_get_css_from_google_webfonts_settings_array($canon_options_appearance['font_italic']); ?>
		}




		/******************************************************************************
		OTHER DYNAMIC OPTIONS
		*******************************************************************************/

		/* HEADER OPACITY */
			.is-overlaid-header .pre-header-container:after { 	
				<?php if ($canon_options_frame['preheader_opacity'] !== "") echo "opacity: ". esc_attr($canon_options_frame['preheader_opacity']) .";"; ?>
			}

			.is-overlaid-header .header-container:after {
				<?php if ($canon_options_frame['header_opacity'] !== "") echo "opacity: ". esc_attr($canon_options_frame['header_opacity']) .";"; ?>
			}

			.is-overlaid-header .post-header-container:after {
				<?php if ($canon_options_frame['postheader_opacity'] !== "") echo "opacity: ". esc_attr($canon_options_frame['postheader_opacity']) .";"; ?>
			}


		/* LOGOS MAX WIDTH */

			.logo{
				max-width: 219px; 
				<?php if (!empty($canon_options_frame['logo_max_width'])) echo "max-width: ".$canon_options_frame['logo_max_width']."px;"; ?>
			}

			.aux-logo{
				max-width: 219px; 
				<?php if (!empty($canon_options_frame['aux_logo_max_width'])) echo "max-width: ".$canon_options_frame['aux_logo_max_width']."px;"; ?>
			}



		/* HEADER ADJUSTMENTS*/

			.header-container .wrapper{
				padding-top: 0px;
				<?php if ($canon_options_frame['header_padding_top'] > -1) echo "padding-top: ".$canon_options_frame['header_padding_top']."px;"; ?>

				padding-bottom: 0px;
				<?php if ($canon_options_frame['header_padding_bottom'] > -1) echo "padding-bottom: ".$canon_options_frame['header_padding_bottom']."px;"; ?>
			}   

			.main-header.left {
				position: relative;	
				top: 0px;
				<?php if (!empty($canon_options_frame['pos_left_element_top'])) echo "top: ".$canon_options_frame['pos_left_element_top']."px;"; ?>
				left: 0px;
				<?php if (!empty($canon_options_frame['pos_left_element_left'])) echo "left: ".$canon_options_frame['pos_left_element_left']."px;"; ?>
			}

			.main-header.right {
				position: relative;	
				top: 0px;
				<?php if (!empty($canon_options_frame['pos_right_element_top'])) echo "top: ".$canon_options_frame['pos_right_element_top']."px;"; ?>
				right: 0px;
				<?php if (!empty($canon_options_frame['pos_right_element_right'])) echo "right: ".$canon_options_frame['pos_right_element_right']."px;"; ?>
			}
			
		/* PRE-FOOTER ADJUSTMENTS*/

			.pre-footer-container .wrapper{
				padding-top: 0px;
				<?php if ($canon_options_frame['prefooter_padding_top'] > -1) echo "padding-top: ".$canon_options_frame['prefooter_padding_top']."px;"; ?>

				padding-bottom: 0px;
				<?php if ($canon_options_frame['prefooter_padding_bottom'] > -1) echo "padding-bottom: ".$canon_options_frame['prefooter_padding_bottom']."px;"; ?>
			}   

			.pre-footer.left {
				position: relative;	
				top: 0px;
				<?php if (!empty($canon_options_frame['prefooter_pos_left_element_top'])) echo "top: ".$canon_options_frame['prefooter_pos_left_element_top']."px;"; ?>
				left: 0px;
				<?php if (!empty($canon_options_frame['prefooter_pos_left_element_left'])) echo "left: ".$canon_options_frame['prefooter_pos_left_element_left']."px;"; ?>
			}

			.pre-footer.right {
				position: relative;	
				top: 0px;
				<?php if (!empty($canon_options_frame['prefooter_pos_right_element_top'])) echo "top: ".$canon_options_frame['prefooter_pos_right_element_top']."px;"; ?>
				right: 0px;
				<?php if (!empty($canon_options_frame['prefooter_pos_right_element_right'])) echo "right: ".$canon_options_frame['prefooter_pos_right_element_right']."px;"; ?>
			}
			

		/* TEXT AS LOGO */

			.logo-text .text-logo {
				<?php if (isset($canon_options_frame['logo_text_size'])) echo "font-size: ".$canon_options_frame['logo_text_size']."px;"; ?>
			}

			.logo-text .tagline {
				<?php if (isset($canon_options_frame['tagline_text_size'])) echo "font-size: ".$canon_options_frame['tagline_text_size']."px;"; ?>
			}


		/* RELATIVE FONT SIZE */

			html {
				<?php if ($canon_options_appearance['font_size_root'] != 100) echo "font-size: ".$canon_options_appearance['font_size_root']."%;"; ?>
			}

		/* ANIMATE MENUS */

			<?php if (isset($canon_options_appearance['anim_menus'])) {echo esc_attr($canon_options_appearance['anim_menus']);} ?> > li {
				opacity: 0;
				<?php 
					$anim_menus_enter = (isset($canon_options_appearance['anim_menus_enter'])) ? $canon_options_appearance['anim_menus_enter'] : 'left';
					$anim_menus_move = (isset($canon_options_appearance['anim_menus_move'])) ? $canon_options_appearance['anim_menus_move'] : '0';

					if ($anim_menus_enter == 'right') {
						$anim_menus_enter = 'left';
						$anim_menus_move = '-' . $anim_menus_move;
					}
					if ($anim_menus_enter == 'bottom') {
						$anim_menus_enter = 'top';
						$anim_menus_move = '-' . $anim_menus_move;
					}

					printf('%s: %spx;', esc_attr($anim_menus_enter), esc_attr($anim_menus_move) );
				?>
			}

		   
		/* BACKGROUND */

			body{
				<?php if (!empty($canon_options_appearance['bg_img_url'])) echo 'background-image: url("' . $canon_options_appearance['bg_img_url'] . '")!important;'; ?>
				<?php if (isset($canon_options_appearance['bg_repeat'])) echo 'background-repeat: ' . $canon_options_appearance['bg_repeat'] . '!important;'; ?>
				<?php if (isset($canon_options_appearance['bg_attachment'])) echo 'background-attachment: ' . $canon_options_appearance['bg_attachment'] .'!important;'; ?>
				background-position: top center;
				<?php if (isset($canon_options_appearance['bg_link'])) { if (!empty($canon_options_appearance['bg_link'])) { echo "cursor: pointer;"; } } ;?>
			} 

			body div { cursor: auto; }

			<?php 

				if ($canon_options_appearance['bg_size'] == "pattern") : 

				$bg_img_size = getimagesize($canon_options_appearance['bg_img_url']);
				$bg_img_width = round($bg_img_size[0] / 2);
				$bg_img_height = round($bg_img_size[1] / 2);

			?>

				@media 
				(min--moz-device-pixel-ratio: 1.5),
				(-o-min-device-pixel-ratio: 3/2),
				(-webkit-min-device-pixel-ratio: 1.5),
				(min-device-pixel-ratio: 1.5),
				(min-resolution: 1.5dppx) {
					body{
						background-size: <?php printf('%spx %spx', esc_attr($bg_img_width), esc_attr($bg_img_height)); ?>;
					}
				}

			<?php elseif ($canon_options_appearance['bg_size'] == "cover") : ?>

				body { background-size: cover; }

			<?php endif; ?>

		
		/* ARCHIVE HEADER */

			.not-full.outter-wrapper.archive-header {
				<?php if (!empty($canon_options_post['archive_header_padding_top'])) echo 'padding-top: ' . $canon_options_post['archive_header_padding_top'] . 'px;'; ?>
				<?php if (!empty($canon_options_post['archive_header_padding_bottom'])) echo 'padding-bottom: ' . $canon_options_post['archive_header_padding_bottom'] . 'px;'; ?>
				
				<?php if (isset($canon_options_post['archive_header_image_default'])) { if (!empty($canon_options_post['archive_header_image_default'])) { echo 'background-image: url("'. esc_url($canon_options_post['archive_header_image_default']) .'");'; } } ?>
			}

			<?php 

				for ($i = 0; $i < count($cat_list); $i++) { 

					$slug = $cat_list[$i]->slug;
					$option_slug = 'archive_header_cat_' . $slug;

					if (isset($canon_options_post[$option_slug])) { if (!empty($canon_options_post[$option_slug])) {
					?>

						.archive.category.category-<?php echo esc_attr($slug); ?> .not-full.outter-wrapper.archive-header {
							<?php echo 'background-image: url("'. esc_url($canon_options_post[$option_slug]) .'");'; ?>
						}

					<?php
					}}

				}

			?>
		 

		    
		/******************************************************************************
		FINAL CALL CSS
		*******************************************************************************/
		
		<?php if ($canon_options_advanced['use_final_call_css'] == "checked" && !empty($canon_options_advanced['final_call_css'])) { echo mb_sanitized_output($canon_options_advanced['final_call_css']); } ?>





	</style>


<?php 

        // dev_mode
        if ($canon_options['dev_mode'] == "checked") {
            if (isset($_GET['preview_style'])) { 
                get_template_part('inc/templates/preview/'.wp_filter_nohtml_kses($_GET['preview_style']));
            }
        }


	} // end function canon_dynamic_css