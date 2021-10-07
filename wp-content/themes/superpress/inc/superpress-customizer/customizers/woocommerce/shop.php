<?php

$theme_path = trailingslashit(get_template_directory_uri()) . 'inc/superpress-customizer/';

$wp_customize->add_setting(
	'superpress_shop_setting_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	new superpress_Simple_Notice_Custom_Control(
		$wp_customize,
		'superpress_shop_setting_heading',
		array(
			'label' => esc_html__('Shop Settings', 'superpress'),
			'type' => 'heading',
			'section' => 'superpress_shop_setting_section',
		)
	)
);
$wp_customize->add_setting(
	'superpress_shop_display_layout',
	array(
		'default' => 'grid',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Image_Radio_Button_Custom_Control(
		$wp_customize,
		'superpress_shop_display_layout',
		array(
			'label' => esc_html__('Display Layout', 'superpress'),
			'section' => 'superpress_shop_setting_section',
			'choices' => array(
				'list' => array(
					'image' => $theme_path.'images/archive-layout3.png',
					'name' => esc_html__('List', 'superpress')
				),
				'grid' => array(
					'image' => $theme_path.'images/archive-layout.png',
					'name' => esc_html__('Grid', 'superpress')
				)
			)
		)
	)
);
$wp_customize->add_setting(
	'superpress_shop_column_no',
	array(
		'capability'            => 'edit_theme_options',
		'default'               => 3,
		'sanitize_callback'     => 'absint'
	)
);
$wp_customize->add_control(
	'superpress_shop_column_no',
	array(
		'label'                 =>  esc_html__('Column no.', 'superpress'),
		'section'               => 'superpress_shop_setting_section',
		'type'                  => 'number',
		'input_attrs' 			=> array(
			'min' => 1,
			'max' => 4,
			'step'  => 1
		),
		'active_callback'  => 'superpress_shop_column_cb',
	)
);
$wp_customize->add_setting(
	'superpress_product_per_page',
	array(
		'capability'            => 'edit_theme_options',
		'default'               => 9,
		'sanitize_callback'     => 'absint'
	)
);
$wp_customize->add_control(
	'superpress_product_per_page',
	array(
		'type'                  => 'number',
		'label'                 =>  esc_html__('Product per page', 'superpress'),
		'section'               => 'superpress_shop_setting_section',
	)
);
$wp_customize->add_setting(
	'superpress_shop_sidebar_layout',
	array(
		'default' => 'right-sidebar',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Image_Radio_Button_Custom_Control(
		$wp_customize,
		'superpress_shop_sidebar_layout',
		array(
			'label' => esc_html__('Choose Sidebar Layout', 'superpress'),
			'section' => 'superpress_shop_setting_section',
			'choices' => array(
				'left-sidebar' => array(
					'image' => $theme_path.'images/sidebar-left.png',
					'name' => esc_html__('Left Sidebar', 'superpress')
				),
				'right-sidebar' => array(
					'image' => $theme_path.'images/sidebar-right.png',
					'name' => esc_html__('Right Sidebar', 'superpress')
				),
				'no-sidebar' => array(
					'image' => $theme_path.'images/sidebar-none.png',
					'name' => esc_html__('No Sidebar', 'superpress')
				)
			)
		)
	)
);
$wp_customize->add_setting('superpress_shop_sidebar', array(
	'default'           =>  'default-sidebar',
	'sanitize_callback' => 'superpress_text_sanitization',
));
$wp_customize->add_control(
	new superpress_Sidebar_Dropdown_Custom_Control(
		$wp_customize,
		'superpress_shop_sidebar',
		array(
			'label'    		=> esc_html__('Choose Sidebar', 'superpress'),
			'section'  		=> 'superpress_shop_setting_section',
			'active_callback'=>'superpress_single_shop_sidebar_cb',
		)
	)
);
