<?php

/**************************************
CHILD THEME ENQUEUE STYLES
***************************************/

	add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

	if (!function_exists("child_theme_enqueue_styles")) { function child_theme_enqueue_styles() {	
		wp_enqueue_style( 'canon-parent-style', get_template_directory_uri() . '/style.css', array('canon-normalize') );
	}}