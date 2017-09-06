	<!-- NATIVE HEADER STUFF -->

	<?php $canon_options = get_option('canon_options'); ?>
	<?php $canon_options_appearance = get_option('canon_options_appearance'); ?>

		<?php if ($canon_options['hide_theme_meta_description'] != 'checked') { printf("<meta name='description' content='%s'>", esc_attr(get_bloginfo('description'))); } ?>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- FAVICON -->

        <link rel="shortcut icon" href="<?php if (empty($canon_options['favicon_url'])) { echo get_template_directory_uri() . "/img/favicon.ico"; } else { echo esc_url($canon_options['favicon_url']); } ?>" />
        
	<!-- USER FONTS -->

	    <?php if (isset($canon_options_appearance['font_main'][0])) { if ($canon_options_appearance['font_main'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_main']); } ?>
	    <?php if (isset($canon_options_appearance['font_heading'][0])) { if ($canon_options_appearance['font_heading'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_heading']); } ?>
	    <?php if (isset($canon_options_appearance['font_heading_strong'][0])) { if ($canon_options_appearance['font_heading_strong'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_heading_strong']); } ?>
	    <?php if (isset($canon_options_appearance['font_heading2'][0])) { if ($canon_options_appearance['font_heading2'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_heading2']); } ?>
	    <?php if (isset($canon_options_appearance['font_heading3'][0])) { if ($canon_options_appearance['font_heading3'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_heading3']); } ?>
	    <?php if (isset($canon_options_appearance['font_nav'][0])) { if ($canon_options_appearance['font_nav'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_nav']); } ?>
	    <?php if (isset($canon_options_appearance['font_meta'][0])) { if ($canon_options_appearance['font_meta'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_meta']); } ?>
	    <?php if (isset($canon_options_appearance['font_button'][0])) { if ($canon_options_appearance['font_button'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_button']); } ?>
	    <?php if (isset($canon_options_appearance['font_dropcap'][0])) { if ($canon_options_appearance['font_dropcap'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_dropcap']); } ?>
	    <?php if (isset($canon_options_appearance['font_quote'][0])) { if ($canon_options_appearance['font_quote'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_quote']); } ?> 
	    <?php if (isset($canon_options_appearance['font_logotext'][0])) { if ($canon_options_appearance['font_logotext'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_logotext']); } ?> 
	    <?php if (isset($canon_options_appearance['font_lead'][0])) { if ($canon_options_appearance['font_lead'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_lead']); } ?>
	    <?php if (isset($canon_options_appearance['font_bold'][0])) { if ($canon_options_appearance['font_bold'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_bold']); } ?>
	    <?php if (isset($canon_options_appearance['font_italic'][0])) { if ($canon_options_appearance['font_italic'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_italic']); } ?>
	  
	    
	    <?php if (isset($canon_options_appearance['font_widget_footer'][0])) { if ($canon_options_appearance['font_widget_footer'][0] != "canon_default") echo mb_get_google_webfonts_link($canon_options_appearance['font_widget_footer']); } ?>

	<!-- OPEN GRAPH: BLOG VERSION -->

		<?php 

			if ($canon_options['hide_theme_og'] != "checked" && $post) {

				// OG BASICS
				printf('<meta property="og:type" content="article" />');
				printf('<meta property="og:url" content="http://%s"/>', esc_attr($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
				printf('<meta property="og:site_name" content="%s" />', esc_attr(get_bloginfo('name')));

				// OG TITLE
				$og_title = (mb_get_page_type() == 'single') ? strip_tags($post->post_title) : get_bloginfo('name');
				printf('<meta property="og:title" content="%s" />', esc_attr($og_title));

				// OG DESCRIPTION
				$og_description = get_bloginfo('description');	
				if (mb_get_page_type() == "home") {
					$og_description = get_bloginfo('description');
				} elseif (!empty($post->post_content)) {
					$og_description = mb_make_excerpt($post->post_content, 350, true);
				}
				printf('<meta property="og:description" content="%s" />', esc_attr($og_description));

				// OG IMAGE
				if (empty($canon_options_frame['logo_url'])) { $canon_options_frame['logo_url'] = get_template_directory_uri() . "/img/logo@2x.png"; }
				$og_img_src = array($canon_options_frame['logo_url']);
				if (mb_get_page_type() == "home") {
					$og_img_src = array($canon_options_frame['logo_url']);
				} elseif (wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')) {
					$og_img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				}
				printf('<meta property="og:image" content="%s" />', esc_url($og_img_src[0]));

			}

		?>