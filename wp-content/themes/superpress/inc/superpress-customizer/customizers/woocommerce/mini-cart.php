<?php
$wp_customize->add_setting( 'superpress_mini_cart_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_mini_cart_heading',
		array(
			'label' => esc_html__( 'Mini Cart Settings', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_mini_cart_section',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_mini_cart_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Toggle_Switch_Custom_control( 
		$wp_customize, 'superpress_mini_cart_switch',
		array(
			'label' => esc_html__( 'Show Mini Cart', 'superpress' ),
			'section' => 'superpress_mini_cart_section',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_mc_button_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_mc_button_text_color',
		array(
			'label' => esc_html__( 'Button Text Color', 'superpress' ),
			'section' => 'superpress_mini_cart_section',
			'active_callback'=>'superpress_mini_cart_switch_cb',
		)
	) 
);
$wp_customize->add_setting( 'superpress_mc_button_bg_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_mc_button_bg_color',
		array(
			'label' => esc_html__( 'Button Background', 'superpress' ),
			'section' => 'superpress_mini_cart_section',
			'show_opacity' => true,
			'active_callback'=>'superpress_mini_cart_switch_cb',
		)
	) 
);
$wp_customize->add_setting( 'superpress_mc_button_text_hcolor',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_mc_button_text_hcolor',
		array(
			'label' => esc_html__( 'Button Hover Text ', 'superpress' ),
			'section' => 'superpress_mini_cart_section',
			'active_callback'=>'superpress_mini_cart_switch_cb',
		)
	) 
);
$wp_customize->add_setting( 'superpress_mc_button_bg_hcolor',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_mc_button_bg_hcolor',
		array(
			'label' => esc_html__( 'Button Hover Background', 'superpress' ),
			'section' => 'superpress_mini_cart_section',
			'show_opacity' => true,
			'active_callback'=>'superpress_mini_cart_switch_cb',
		)
	) 
);

