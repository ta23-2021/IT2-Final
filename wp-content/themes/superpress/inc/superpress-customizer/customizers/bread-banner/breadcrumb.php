<?php
$wp_customize->add_setting( 'superpress_breadcrumb_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_breadcrumb_heading',
		array(
			'label' => esc_html__( 'Breadcrumb Setting', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_breadcrumb_section',
		)
	) 
);
$wp_customize->add_setting( 'superpress_breadcrumb_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_breadcrumb_switch',
		array(
			'label' => esc_html__( 'Show Breadcrumb', 'superpress' ),
			'section' => 'superpress_breadcrumb_section'
		)
	)
);
$wp_customize->add_setting( 'superpress_breadcrumb_separator', 
	array(
		'default' => '/',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( 'superpress_breadcrumb_separator', 
	array(
		'label' => esc_html__( 'Breadcrumb Separator', 'superpress' ),
		'section' => 'superpress_breadcrumb_section',
		'type' => 'text',
		'active_callback' => 'superpress_bread_button_cb'
	)
); 
$wp_customize->add_setting( 'superpress_bread_sep_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_bread_sep_color',
		array(
			'label' => esc_html__( 'Breadcrumb Separator Color', 'superpress' ),
			'section' => 'superpress_breadcrumb_section',
			'show_opacity' => false,
			'active_callback' => 'superpress_bread_button_cb'
		)
	)
);
$wp_customize->add_setting( 'superpress_bread_nav_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_bread_nav_color',
		array(
			'label' => esc_html__( 'Breadcrumb Nav Color', 'superpress' ),
			'section' => 'superpress_breadcrumb_section',
			'show_opacity' => false,
			'active_callback' => 'superpress_bread_button_cb'
		)
	)
);
$wp_customize->add_setting( 'superpress_bread_nav_hover_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_bread_nav_hover_color',
		array(
			'label' => esc_html__( 'Breadcrumb Nav Hover Color', 'superpress' ),
			'section' => 'superpress_breadcrumb_section',
			'show_opacity' => false,
			'active_callback' => 'superpress_bread_button_cb'
		)
	)
);