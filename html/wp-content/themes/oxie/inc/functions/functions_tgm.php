<?php

/**************************************
TGM PLUGIN ACTIVATION
***************************************/

require_once dirname( __FILE__ ) . '/../lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'canon_register_tgm_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function canon_get_tgm_plugins_array() {
	
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(

		array(
			'name'     				=> 'Oxie Core Plugin', // The plugin name
			'slug'     				=> 'oxie-core-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/oxie-core-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'oxie-core-plugin/index.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'Theme Canon',
				'requires'				=> '3.0',
				'tested'				=> '4.2.2',
				'last_updated'			=> '2015-05-29',
				'sections' 				=> array(
					'description'	 		=> 'Core plugin bundled with Oxie theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Oxie Shortcodes Plugin', // The plugin name
			'slug'     				=> 'oxie-shortcodes-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/oxie-shortcodes-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'oxie-shortcodes-plugin/index.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'Theme Canon',
				'requires'				=> '3.0',
				'tested'				=> '4.2.2',
				'last_updated'			=> '2015-05-29',
				'sections' 				=> array(
					'description'	 		=> 'Shortcodes plugin bundled with Oxie theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Oxie Widgets Plugin', // The plugin name
			'slug'     				=> 'oxie-widgets-plugin', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/oxie-widgets-plugin.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'oxie-widgets-plugin/index.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'Theme Canon',
				'requires'				=> '3.0',
				'tested'				=> '4.2.2',
				'last_updated'			=> '2015-05-29',
				'sections' 				=> array(
					'description'	 		=> 'Widgets plugin bundled with Oxie theme by Theme Canon.',
				),			
			),
		),

		array(
			'name'     				=> 'Envato WordPress Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/envato-wordpress-toolkit.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'envato-wordpress-toolkit/index.php',
		),

		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/inc/lib/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '4.6.93', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			
			'canon_auc'				=> true,
			'canon_auc_plugin_file'	=> 'revslider/revslider.php',
			'canon_auc_info'		=> array(	
				'author'				=> 'ThemePunch',
				'requires'				=> '3.0',
				'tested'				=> '4.2.2',
				'last_updated'			=> '2015-05-29',
				'sections' 				=> array(
					'description'	 		=> 'Revolution Slider plugin bundled with Oxie theme by Theme Canon.',
				),			
			),
		),

		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),

		// This is an example of how to include a plugin pre-packaged with a theme
		// array(
		// 	'name'     				=> 'TGM Example Plugin', // The plugin name
		// 	'slug'     				=> 'tgm-example-plugin', // The plugin slug (typically the folder name)
		// 	'source'   				=> get_template_directory_uri() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
		// 	'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		// 	'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		// 	'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		// 	'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		// 	'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		// ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		// array(
		// 	'name' 		=> 'BuddyPress',
		// 	'slug' 		=> 'buddypress',
		// 	'required' 	=> false,
		// ),

	);

	return $plugins;

}

function canon_register_tgm_plugins() {

	// Get TGM plugins array
	$plugins = canon_get_tgm_plugins_array();

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'loc_canon';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		// 'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

