<?php

$wp_customize->add_setting( 'superpress_scrolltop_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_scrolltop_heading',
		array(
			'label' => esc_html__( 'Scroll Top Settings', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_additional_setting_section',
		)
	) 
);
$wp_customize->add_setting( 'superpress_scroll_top_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_scroll_top_switch',
		array(
			'label' => esc_html__( 'Show Scroll Top', 'superpress' ),
			'section' => 'superpress_additional_setting_section'
		)
	)
);
$wp_customize->add_setting( 'superpress_scroll_top_position',
	array(
		'default' => 'right',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( 
	'superpress_scroll_top_position',
	array(
		'type' => 'select',
		'label' => esc_html__( 'Scroll Top Position', 'superpress' ),
		'section' => 'superpress_additional_setting_section',
		'choices' => array(
			'left' => esc_html__('Left','superpress'),
			'right' => esc_html__('Right','superpress'),              
		),
		'active_callback'=>'superpress_footer_scrolltotop_cb'
	)
);
$wp_customize->add_setting( 'superpress_scroll_top_layout',
	array(
		'default' => 'square',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( 'superpress_scroll_top_layout',
	array(
		'type' => 'select',
		'label' => esc_html__( 'Display Style', 'superpress' ),
		'section' => 'superpress_additional_setting_section',
		'choices' => array(
			'square' => esc_html__('Square','superpress'),
			'circle' => esc_html__('Circle','superpress'),              
		),
		'active_callback'=>'superpress_footer_scrolltotop_cb'
	)
);
$wp_customize->add_setting( 'superpress_scroll_top_bg',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'superpress_scroll_top_bg',
		array(
			'label' => esc_html__( 'Background Color', 'superpress' ),
			'section' => 'superpress_additional_setting_section',
			'active_callback'=>'superpress_footer_scrolltotop_cb'
		)
	) 
);
$wp_customize->add_setting( 'superpress_scroll_top_bg_hover',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'superpress_scroll_top_bg_hover',
		array(
			'label' => esc_html__( 'Background Hover', 'superpress' ),
			'section' => 'superpress_additional_setting_section',
			'active_callback'=>'superpress_footer_scrolltotop_cb'
		)
	) 
);
$wp_customize->add_setting( 'superpress_scroll_top_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'superpress_scroll_top_color',
		array(
			'label' => esc_html__( 'Text Color', 'superpress' ),
			'section' => 'superpress_additional_setting_section',
			'active_callback'=>'superpress_footer_scrolltotop_cb'
		)
	) 
);
$wp_customize->add_setting( 'superpress_scroll_top_hover_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'superpress_scroll_top_hover_color',
		array(
			'label' => esc_html__( 'Text Hover Color', 'superpress' ),
			'section' => 'superpress_additional_setting_section',
			'active_callback'=>'superpress_footer_scrolltotop_cb'
		)
	) 
);