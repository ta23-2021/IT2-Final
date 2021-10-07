<?php 
// function amandalite_sanitize_default($value) {return $value;}
function amandalite_sanitize_checkbox( $checked ) {	
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//radio box sanitization function
function amandalite_sanitize_radio( $input, $setting ){
  
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
      
}

/** Customizer - Add Settings */
function amandalite_register_theme_customizer( $wp_customize )
{
	# Theme Options
    $wp_customize->add_panel('amandalite_panel', array('priority' => 1, 'capability'=> 'edit_theme_options', 'title' => esc_html__('AmandaLite Theme Options', 'amandalite') ));

    # Sections
   	$wp_customize->add_section( 'amandalite_section_social_media', array( 'title' => esc_html__('Social Networks', 'amandalite'), 'panel' => 'amandalite_panel', 'priority' => 23 ) );
    $wp_customize->add_section( 'amandalite_section_footer', array('title' => esc_html__('Footer', 'amandalite'), 'panel' => 'amandalite_panel', 'priority' => 25 ));
    
	/** Social Media */
    $wp_customize->add_setting('amandalite_facebook_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('amandalite_twitter_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('amandalite_instagram_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('amandalite_pinterest_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('amandalite_youtube_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field')); 
    $wp_customize->add_setting('amandalite_vimeo_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'amandalite_facebook_url', array('label' => esc_html__('Facebook URL', 'amandalite'), 'section' => 'amandalite_section_social_media', 'settings' => 'amandalite_facebook_url', 'type' => 'text', 'priority' => 1)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'amandalite_twitter_url', array('label' => esc_html__('Twitter URL', 'amandalite'), 'section' => 'amandalite_section_social_media', 'settings' => 'amandalite_twitter_url', 'type' => 'text', 'priority' => 2)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'amandalite_instagram_url', array('label' => esc_html__('Instagram URL', 'amandalite'), 'section' => 'amandalite_section_social_media', 'settings' => 'amandalite_instagram_url', 'type' => 'text', 'priority' => 3)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'amandalite_pinterest_url', array('label' => esc_html__('Pinterest URL', 'amandalite'), 'section' => 'amandalite_section_social_media', 'settings' => 'amandalite_pinterest_url', 'type' => 'text', 'priority' => 4)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'amandalite_youtube_url', array('label' => esc_html__('Youtube URL', 'amandalite'), 'section' => 'amandalite_section_social_media', 'settings'  => 'amandalite_youtube_url', 'type' => 'text', 'priority' => 6)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'amandalite_vimeo_url', array('label' => esc_html__('Vimeo URL', 'amandalite'), 'section' => 'amandalite_section_social_media', 'settings' => 'amandalite_vimeo_url', 'type' => 'text', 'priority' => 7)));


    /** Footer */
    $wp_customize->add_setting( 'amandalite_instagram_show', array( 'default' => false, 'sanitize_callback' => 'amandalite_sanitize_checkbox' ) );
    $wp_customize->add_setting( 'amandalite_social_footer_enable', array('default' => false,'sanitize_callback' => 'amandalite_sanitize_checkbox' ) );
    $wp_customize->add_setting( 'amandalite_footer_copyright_text', array( 'default' => esc_html__('© Copyright 2021', 'amandalite'), 'sanitize_callback' => 'wp_kses_post'));
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'amandalite_instagram_show',
            array(
                'label' => 'Show Instagram Feed',
                'section' => 'amandalite_section_footer',
                'type'  => 'checkbox'
            )
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'amandalite_social_footer_enable',
            array(
                'label' => esc_html__('Show Social Network?', 'amandalite'),
                'section' => 'amandalite_section_footer',
                'type' => 'checkbox'
            )
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'amandalite_footer_copyright_text',
            array(
            'label' => esc_html__('Copyright Text', 'amandalite'), 
            'section' => 'amandalite_section_footer',
            'type' => 'textarea'
        )
    ));

    # Site Title - Tagline
    $wp_customize->add_setting('amandalite_hide_tagline', array('default' => false, 'sanitize_callback' => 'amandalite_sanitize_checkbox'));

     $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'amandalite_hide_tagline',
            array(
                'label' => esc_html__('Hide Tagline?', 'amandalite'),
                'section' => 'title_tagline',
                'type' => 'checkbox'
            )
        )
    );

    /** Colors */
    $wp_customize->add_setting('amandalite_body_color', array('default' => esc_attr('#494949'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('amandalite_accent_color', array('default' => esc_attr('#F29478'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'amandalite_body_color', array('label' => esc_html__('Body Text Color', 'amandalite'), 'section' => 'colors', 'settings' => 'amandalite_body_color')));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'amandalite_accent_color', array('label' => esc_html__('Accent Color', 'amandalite'), 'section' => 'colors', 'settings' => 'amandalite_accent_color')));
    
}
add_action( 'customize_register', 'amandalite_register_theme_customizer' );
?>