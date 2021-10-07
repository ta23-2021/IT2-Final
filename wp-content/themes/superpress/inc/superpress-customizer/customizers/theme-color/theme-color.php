<?php 
$wp_customize->add_setting( 'superpress_theme_color_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_theme_color_heading',
		array(
			'label' => esc_html__( 'Theme Skin Color', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_theme_color_section',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_theme_skin_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_theme_skin_color',
		array(
			'label' => esc_html__( 'Theme Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 3
		)
	)
);
$wp_customize->add_setting( 'superpress_btn_color_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_btn_color_heading',
		array(
			'label' => esc_html__( 'Button Color', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_theme_color_section',
			'priority' => 5,
		)
	) 
);
$wp_customize->add_setting( 'superpress_theme_btn_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_theme_btn_color',
		array(
			'label' => esc_html__( 'Background Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 7,
		)
	) 
);
$wp_customize->add_setting( 'superpress_theme_btn_hcolor',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_theme_btn_hcolor',
		array(
			'label' => esc_html__( 'Background Hover Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 7,
		)
	) 
);
$wp_customize->add_setting( 'superpress_theme_btn_text_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_theme_btn_text_color',
		array(
			'label' => esc_html__( 'Text Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 7,
		)
	) 
);
$wp_customize->add_setting( 'superpress_theme_btn_text_hcolor',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_theme_btn_text_hcolor',
		array(
			'label' => esc_html__( 'Text Hover Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 7,
		)
	) 
);

$wp_customize->add_setting( 'superpress_anchor_color_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_anchor_color_heading',
		array(
			'label' => esc_html__( 'Anchor Color', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_theme_color_section',
			'priority' => 9,
		)
	) 
);

$wp_customize->add_setting( 'superpress_anchor_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_anchor_color',
		array(
			'label' => esc_html__( 'Anchor Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 11,
		)
	) 
);
$wp_customize->add_setting( 'superpress_anchor_hover_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_anchor_hover_color',
		array(
			'label' => esc_html__( 'Anchor Hover Color', 'superpress' ),
			'section' => 'superpress_theme_color_section',
			'show_opacity' => true,
			'priority' => 11,
		)
	) 
);