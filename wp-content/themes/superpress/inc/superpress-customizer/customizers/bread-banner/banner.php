<?php
$wp_customize->add_setting( 'superpress_banner_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_banner_heading',
		array(
			'label' => esc_html__( 'Banner Setting', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_breadcrumb_banner_section',
		)
	) 
);

$wp_customize->add_setting( 'superpress_breadcrumb_banner_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_breadcrumb_banner_switch',
		array(
			'label' => esc_html__( 'Show Banner', 'superpress' ),
			'section' => 'superpress_breadcrumb_banner_section'
		)
	)
);

$wp_customize->add_setting( 'superpress_bread_banner_bg_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_bread_banner_bg_color',
		array(
			'label' => esc_html__( 'Background Color', 'superpress' ),
			'section' => 'superpress_breadcrumb_banner_section',
			'show_opacity' => true,
			'active_callback' => 'superpress_banner_button_cb'
		)
	)
);

$wp_customize->add_setting( 'superpress_bread_title_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_bread_title_color',
		array(
			'label' => esc_html__( 'Title Color', 'superpress' ),
			'section' => 'superpress_breadcrumb_banner_section',
			'show_opacity' => false,
			'active_callback' => 'superpress_banner_button_cb'
		)
	)
);

$wp_customize->add_setting( 'superpress_banner_title_position',
	array(
		'default' => 'wide',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_sanitize_select'
	)
);
$wp_customize->add_control( 'superpress_banner_title_position',
	array(
		'type'      => 'select',
		'choices'   => array(
			'left' => esc_html__('Left','superpress'),              
			'right' => esc_html__('Right','superpress'),
			'center' => esc_html__('Center','superpress'),              
			'wide' => esc_html__('Wide','superpress'),   
		),
		'label'     => esc_html__( 'Content Position', 'superpress' ),
		'section'   => 'superpress_breadcrumb_banner_section',
		'active_callback' => 'superpress_banner_button_cb'
	)
);

$wp_customize->add_setting( 'superpress_bread_title_size',
    array(
       'transport' => 'refresh',
       'sanitize_callback' => 'absint'
    )
);
 
$wp_customize->add_control( 'superpress_bread_title_size',
    array(
       'label' => esc_html__( 'Font Size(px)','superpress' ),
       'section' => 'superpress_breadcrumb_banner_section',
	   'type' => 'number', 
	   'active_callback' => 'superpress_banner_button_cb'
    )
);

$wp_customize->add_setting( 
	'superpress_bread_banner_bg_image', 
	array(
		'sanitize_callback' => 'esc_url_raw'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Upload_Control( 
		$wp_customize, 
		'superpress_bread_banner_bg_image', 
		array(
			'label'      => esc_html__( 'Background Image', 'superpress' ),
			'section'    => 'superpress_breadcrumb_banner_section',
			'active_callback' => 'superpress_banner_button_cb'                  
		)
	) 
);

$wp_customize->add_setting( 'superpress_bread_banner_bg_overlay',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization',
		'default' => 'rgba(0, 0, 0, 0.1)'
	)
);
$wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control( 
		$wp_customize, 'superpress_bread_banner_bg_overlay',
		array(
			'label' => esc_html__( 'Background Overlay', 'superpress' ),
			'section' => 'superpress_breadcrumb_banner_section',
			'show_opacity' => true,
			'active_callback'  => 'superpress_bread_banner_image_cb',
		)
	)
);

$wp_customize->add_setting( 'superpress_bread_banner_height',
	array(
		'default' => 76,
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_bread_banner_height',
		array(
			'label' => esc_html__( 'Banner Height(px)', 'superpress' ),
			'section' => 'superpress_breadcrumb_banner_section',
			'input_attrs' => array(
				'max' => 800,
				'step' => 1,
				'min' => 76
			),
			'active_callback' => 'superpress_banner_button_cb'
		)
	) 
);
