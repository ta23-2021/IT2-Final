<?php
$wp_customize->add_setting( 'superpress_page_settings_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_page_settings_heading',
		array(
			'label' => esc_html__( 'Page Setting', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_page_setting_section',
		)
	) 
);
$wp_customize->add_setting( 'superpress_page_banner_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_page_banner_switch',
		array(
			'label' => esc_html__( 'Show Banner', 'superpress' ),
			'section' => 'superpress_page_setting_section'
		)
	)
);
$wp_customize->add_setting( 'superpress_page_title_switch',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_page_title_switch',
		array(
			'label' => esc_html__( 'Show Page Title', 'superpress' ),
			'section' => 'superpress_page_setting_section'
		)
	)
);
$wp_customize->add_setting( 'superpress_page_fimage_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_page_fimage_switch',
		array(
			'label' => esc_html__( 'Show Feature Image', 'superpress' ),
			'section' => 'superpress_page_setting_section'
		)
	)
);