<?php

// ----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts
// ----------------------------------------------------------------------------------

function upeo_child_frontscripts() {

	wp_enqueue_style( 'upeo-style', get_template_directory_uri() . '/style.css', array( 'upeo-bootstrap' ) );
	wp_enqueue_style( 'upeo-style-business', get_stylesheet_directory_uri() . '/style.css', array( 'upeo-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'upeo_child_frontscripts' );


// ----------------------------------------------------------------------------------
//	Update Options Array With Child Theme Settings
// ----------------------------------------------------------------------------------

// Add child theme settings to options array - UPDATED 20181101
function upeo_updateoption_child_settings() {

	// Set theme name combinations
	$name_theme_upper = 'Upeo';
	$name_theme_lower = strtolower( $name_theme_upper );

	// Set possible options names
	$name_options_free  = 'upeo_redux_variables';
	$name_options_child = 'upeo_child_settings_news';

	// Get options values (theme options)
	$options_free = get_option( $name_options_free );

	// Get child settinsg values
	$options_child_settings = get_option( $name_options_child );

	// Only set child settings values if not already set 
	if ( $options_child_settings != 1 ) {

		$options_free['upeo_header_styleswitch'] = 'option1';
		$options_free['upeo_blog_style']         = 'option1';
		$options_free['upeo_blog_style1layout']  = 'option2';
		$options_free['upeo_blog_style2layout']  = '';
		$options_free['upeo_styles_colorswitch'] = '';
		$options_free['upeo_styles_colorcustom'] = '';
		$options_free['upeo_styles_skinswitch']  = '1';
		$options_free['upeo_styles_skin']        = 'business';		

		// Add child settings to theme options array
		update_option( $name_options_free, $options_free );

	}

	// Set the child settings flag
	update_option( $name_options_child, 1 );

}
add_action( 'init', 'upeo_updateoption_child_settings', 999 );

// Remove child theme settings from options array - UPDATED 20181101
function upeo_removeoption_child_settings() {

	// Set theme name combinations
	$name_theme_upper = 'Upeo';
	$name_theme_lower = strtolower( $name_theme_upper );

	// Set possible options names
	$name_options_free  = 'upeo_redux_variables';
	$name_options_child = 'upeo_child_settings_news';

	// Get options values (theme options)
	$options_free = get_option( $name_options_free );

	// Determine if Pro version is installed
	$themes = wp_get_themes();
	foreach ( $themes as $theme ) {
		if( $theme == $name_theme_upper . ' Pro' ) {
			$indicator_pro_installed = '1';
		}
	}

	// If Pro version is not installed then remove child settings on theme switch
	if ( $indicator_pro_installed !== '1' ) {

		$options_free['upeo_header_styleswitch'] = '';
		$options_free['upeo_blog_style']         = '';
		$options_free['upeo_blog_style1layout']  = '';
		$options_free['upeo_blog_style2layout']  = '';
		$options_free['upeo_styles_colorswitch'] = '';
		$options_free['upeo_styles_colorcustom'] = '';
		$options_free['upeo_styles_skinswitch']  = '';
		$options_free['upeo_styles_skin']        = '';

		// Add child settings to theme options array
		update_option( $name_options_free, $options_free );

	}

	// Delete the child settings flag
	delete_option( $name_options_child );

}
add_action( 'switch_theme', 'upeo_removeoption_child_settings' );

