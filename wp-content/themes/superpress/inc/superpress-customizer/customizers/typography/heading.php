<?php
$wp_customize->add_setting( 'superpress_heading_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_heading_font_heading',
		array(
			'label' => esc_html__( 'Heading Font Style (H1-H6)', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_heading_style',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_heading_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'superpress_google_font_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'superpress_heading_font_family',
		array(
			'label' => esc_html__( 'Font Family' , 'superpress'),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
			'priority' => 2
		)
	) 
);
$wp_customize->add_setting( 'superpress_heading_font_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Customize_Alpha_Color_Control(
		$wp_customize, 'superpress_heading_font_color',
		array(
			'label' => esc_html__( 'Text Color', 'superpress' ),
			'section' => 'superpress_heading_style',
			'show_opacity' => false,
			'priority' => 3
		)
	) 
);
$wp_customize->add_setting( 'superpress_h1_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_h1_font_size',
		array(
			'label' => esc_html__( 'H1 Font Size(px)', 'superpress' ),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 4
		)
	) 
);
$wp_customize->add_setting( 'superpress_h2_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_h2_font_size',
		array(
			'label' => esc_html__( 'H2 Font Size(px)', 'superpress' ),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 5
		)
	) 
);
$wp_customize->add_setting( 'superpress_h3_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new superpress_Slider_Custom_Control(
		$wp_customize, 'superpress_h3_font_size',
		array(
			'label' => esc_html__( 'H3 Font Size(px)', 'superpress' ),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 6
		)
	) 
);
$wp_customize->add_setting( 'superpress_h4_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_h4_font_size',
		array(
			'label' => esc_html__( 'H4 Font Size(px)', 'superpress' ),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 7
		)
	) 
);
$wp_customize->add_setting( 'superpress_h5_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_h5_font_size',
		array(
			'label' => esc_html__( 'H5 Font Size(px)', 'superpress' ),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 8
		)
	) 
);
$wp_customize->add_setting( 'superpress_h6_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_h6_font_size',
		array(
			'label' => esc_html__( 'H6 Font Size(px)', 'superpress' ),
			'section' => 'superpress_heading_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 9
		)
	) 
);
