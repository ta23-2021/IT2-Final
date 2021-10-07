<?php
$wp_customize->add_setting( 'superpress_body_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_body_font_heading',
		array(
			'label' => esc_html__( 'Body Font Styles', 'superpress' ),
			'type' => 'heading',
			'section' => 'body_style',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_body_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'superpress_google_font_sanitization',
		'transport' => 'refresh',
	)
);
$wp_customize->add_control( 
	new superpress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'superpress_body_font_family',
		array(
			'label' => esc_html__( 'Body Font Family' , 'superpress'),
			'section' => 'body_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
			'priority' => 2
		)
	) 
);
$wp_customize->add_setting( 'superpress_body_font_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control(
		$wp_customize, 'superpress_body_font_color',
		array(
			'label' => esc_html__( 'Text Color', 'superpress' ),
			'section' => 'body_style',
			'show_opacity' => false,
			'priority' => 3
		)
	) 
);
$wp_customize->add_setting( 'superpress_body_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_body_font_size',
		array(
			'label' => esc_html__( 'Font Size(px)', 'superpress' ),
			'section' => 'body_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 4
		)
	) 
);
$wp_customize->add_setting( 'superpress_body_line_height',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_floatval'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_body_line_height',
		array(
			'label' => esc_html__( 'Line Height(em)', 'superpress' ),
			'section' => 'body_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
			),
			'priority' => 5
		)
	) 
);
/* BlockQuote */
$wp_customize->add_setting( 'superpress_bquote_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_bquote_font_heading',
		array(
			'label' => esc_html__( 'BlockQuote', 'superpress' ),
			'type' => 'heading',
			'section' => 'body_style',
			'priority' => 8
		)
	) 
);
$wp_customize->add_setting( 'superpress_bquote_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'superpress_google_font_sanitization',
		'transport' => 'refresh',
	)
);
$wp_customize->add_control( 
	new superpress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'superpress_bquote_font_family',
		array(
			'label' => esc_html__( 'Font Family' , 'superpress'),
			'section' => 'body_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
			'priority' => 8
		)
	) 
);

$wp_customize->add_setting( 'superpress_bquote_font_size',
	array(
		'default' => '19',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_bquote_font_size',
		array(
			'label' => esc_html__( 'Font Size(px)', 'superpress' ),
			'section' => 'body_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 8
		)
	) 
);

/* Preformatted */
$wp_customize->add_setting( 'superpress_preform_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_preform_font_heading',
		array(
			'label' => esc_html__( 'Preformatted', 'superpress' ),
			'type' => 'heading',
			'section' => 'body_style',
			'priority' => 9
		)
	) 
);
$wp_customize->add_setting( 'superpress_preform_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'superpress_google_font_sanitization',
		'transport' => 'refresh',
	)
);
$wp_customize->add_control( 
	new superpress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'superpress_preform_font_family',
		array(
			'label' => esc_html__( 'Font Family' , 'superpress'),
			'section' => 'body_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
			'priority' => 9
		)
	) 
);

$wp_customize->add_setting( 'superpress_preform_font_size',
	array(
		'default' => '15',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_preform_font_size',
		array(
			'label' => esc_html__( 'Font Size(px)', 'superpress' ),
			'section' => 'body_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 9
		)
	) 
);