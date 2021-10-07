<?php 
/* Header Styles */ 

$wp_customize->add_setting( 'superpress_trans_header_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control( 
	new Superpress_Toggle_Switch_Custom_control( 
		$wp_customize, 'superpress_trans_header_switch',
		array(
			'label' => esc_html__( 'Transparent Header', 'superpress' ),
			'section' => 'header_customizer_setting',
			'active_callback' => 'superpress_header_layouts_cb_default',
			'priority' => 1
		)
	) 
); 
$wp_customize->add_setting( 'superpress_header_container_switch',
	array(
		'default' => 'default',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( 
	new Superpress_Text_Radio_Button_Custom_Control( 
		$wp_customize, 'superpress_header_container_switch',
		array(
			'label' => esc_html__( 'Header Container', 'superpress' ),
			'section' => 'header_customizer_setting',
			'choices' => array(
				'default' => esc_html__('Full','superpress'),
				'boxed' => esc_html__('Boxed','superpress'),
			),
			'active_callback' => 'superpress_header_layouts_cb_default',
			'priority' => 1
		)
	) 
); 
$wp_customize->add_setting(
	'superpress_header_layouts_border',
	array(
		'default' => '0',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_floatval'
	)
);
$wp_customize->add_control(
	new Superpress_Slider_Custom_Control(
		$wp_customize,
		'superpress_header_layouts_border',
		array(
			'label' => esc_html__('Border Bottom', 'superpress'),
			'section' => 'header_customizer_setting',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'active_callback' => 'superpress_header_layouts_cb_default',
			'priority' => 1			
		)
	)
);
$wp_customize->add_setting(
	'superpress_header_layouts_border_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Customize_Alpha_Color_Control(
		$wp_customize,
		'superpress_header_layouts_border_color',
		array(
			'label' => esc_html__('Border Bottom Color', 'superpress'),
			'section' => 'header_customizer_setting',
			'show_opacity' => false,
			'active_callback' => 'superpress_header_layouts_cb_default',
			'priority' => 1			
		)
	)
);
$wp_customize->add_setting(
	'superpress_header_layouts_bg_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control(
		$wp_customize,
		'superpress_header_layouts_bg_color',
		array(
			'label' => esc_html__('Background Color', 'superpress'),
			'section' => 'header_customizer_setting',
			'show_opacity' => false,
			'active_callback' => 'superpress_header_layouts_cb_default',
			'priority' => 1			
		)
	)
);
$wp_customize->add_setting( 
	'superpress_header_layouts_bg_img', 
	array(
		'sanitize_callback' => 'esc_url_raw'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Upload_Control( 
		$wp_customize, 
		'superpress_header_layouts_bg_img', 
		array(
			'label'      => __( 'Background Image', 'superpress' ),
			'section'    => 'header_customizer_setting',    
			'active_callback' => 'superpress_header_layouts_cb_default', 
			'priority' => 1               
		)
	) 
);
/* Button Styles */
$wp_customize->add_setting(
	'superpress_purchase_btn_text_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control(
		$wp_customize,
		'superpress_purchase_btn_text_color',
		array(
			'label' => esc_html__('Text Color', 'superpress'),
			'section' => 'header_customizer_setting',
			'show_opacity' =>false,
			'active_callback' => 'superpress_header_button_cb'			
		)
	)
);
$wp_customize->add_setting(
	'superpress_purchase_btn_text_hover_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control(
		$wp_customize,
		'superpress_purchase_btn_link_text_hcolor',
		array(
			'label' => esc_html__('Text Hover Color', 'superpress'),
			'section' => 'header_customizer_setting',
			'show_opacity' => false,
			'active_callback' => 'superpress_header_button_cb'			
		)
	)
);
$wp_customize->add_setting(
	'superpress_purchase_btn_background',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control(
		$wp_customize,
		'superpress_purchase_btn_background',
		array(
			'label' => esc_html__('Background Color', 'superpress'),
			'section' => 'header_customizer_setting',
			'show_opacity' => true,
			'active_callback' => 'superpress_header_button_cb'			
		)
	)
);
$wp_customize->add_setting(
	'superpress_purchase_btn_hover_background',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control(
		$wp_customize,
		'superpress_purchase_btn_hover_background',
		array(
			'label' => esc_html__('Background Hover Color', 'superpress'),
			'section' => 'header_customizer_setting',
			'show_opacity' => true,
			'active_callback' => 'superpress_header_button_cb'			
		)
	)
);
$wp_customize->add_setting(
	'superpress_purchase_btn_bradious',
	array(
		'default' => '0',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_floatval'
	)
);
$wp_customize->add_control(
	new Superpress_Slider_Custom_Control(
		$wp_customize,
		'superpress_purchase_btn_bradious',
		array(
			'label' => esc_html__('Radius', 'superpress'),
			'section' => 'header_customizer_setting',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'active_callback' => 'superpress_header_button_cb'			
		)
	)
);
$wp_customize->add_setting( 'superpress_purchase_btn_border_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new Superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_purchase_btn_border_color',
		array(
			'label' => esc_html__( 'Border Color', 'superpress' ),
			'section' => 'header_customizer_setting',
			'active_callback' => 'superpress_header_button_cb'
		)
	) 
);