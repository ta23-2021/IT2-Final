<?php 
//Header Layouts
$wp_customize->add_setting( 'superpress_header_layout_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_header_layout_heading',
		array(
			'label' => esc_html__( 'Header Layouts', 'superpress' ),
			'type' => 'heading',
			'section' => 'header_customizer_setting',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_header_layouts',
	array(
		'default' => 'default',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( new Superpress_Text_Radio_Button_Custom_Control( $wp_customize, 'superpress_header_layouts',
	array(
		'label' => esc_html__( 'Choose Header Layouts', 'superpress' ),
		'section' => 'header_customizer_setting',
		'choices' => array(
			'default' => esc_html__('Default','superpress'),
			'custom' => esc_html__('Custom','superpress'),
		),
		'priority' => 1
	)
) );


if (defined('ELEMENTOR_VERSION')):
//Custom header
$wp_customize->add_setting('superpress_custom_header',
	array(
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'absint',
    	'transport' => 'refresh',
    )
);
$wp_customize->add_control( 'superpress_custom_header',
	array(
		'label'  => esc_html__( 'Choose Header Template', 'superpress' ),
		'section' => 'header_customizer_setting',
		'type' => 'select',
		'choices' => superpress_get_elementor_templates(),
		'active_callback' => 'superpress_header_layouts_cb' 
	)
); 
else:
//Notice
$wp_customize->add_setting( 'superpress_custom_header_notfound_notice',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
 $wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_custom_header_notfound_notice',
		array(
			'label' => esc_html__( 'Note:', 'superpress' ),
			'description' => esc_html__( 'Elementor is not installed.Please install and activate elementor first.', 'superpress' ),
			'type' => 'error',
			'section' => 'header_customizer_setting',
			'active_callback' => 'superpress_header_layouts_cb'
		)
	) 
);
endif;

//Notice
$wp_customize->add_setting( 'superpress_custom_header_notice',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
 $wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_custom_header_notice',
		array(
			'label' => esc_html__( 'Note:', 'superpress' ),
			'description' => esc_html__( 'Header built from elementor will be applied.', 'superpress' ),
			'type' => 'notice',
			'section' => 'header_customizer_setting',
			'active_callback' => 'superpress_header_layouts_cb'
		)
	) 
); 

$wp_customize->add_setting( 'superpress_sticky_header_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
 $wp_customize->add_control( 
	new Superpress_Toggle_Switch_Custom_control( 
		$wp_customize, 'superpress_sticky_header_switch',
		array(
			'label' => esc_html__( 'Sticky Header', 'superpress' ),
			'section' => 'header_customizer_setting',
			'priority' => 1
		)
	) 
);   

/* Header Button */
$wp_customize->add_setting( 'superpress_header_button_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_header_button_heading',
		array(
			'label' => esc_html__( 'Header Button', 'superpress' ),
			'type' => 'heading',
			'section' => 'header_customizer_setting',
		)
	) 
);
$wp_customize->add_setting( 'superpress_show_search_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
 $wp_customize->add_control( 
	new Superpress_Toggle_Switch_Custom_control( 
		$wp_customize, 'superpress_show_search_switch',
		array(
			'label' => esc_html__( 'Show Search', 'superpress' ),
			'section' => 'header_customizer_setting'
		)
	) 
);  
$wp_customize->add_setting( 'superpress_show_purchase_btn_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
 $wp_customize->add_control( 
	new Superpress_Toggle_Switch_Custom_control( 
		$wp_customize, 'superpress_show_purchase_btn_switch',
		array(
			'label' => esc_html__( 'Show Button', 'superpress' ),
			'section' => 'header_customizer_setting'
		)
	) 
);     
$wp_customize->add_setting( 'superpress_purchase_btn_text', 
	array(
		'default' => __('Purchase','superpress'),
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( 'superpress_purchase_btn_text', 
	array(
		'label' => esc_html__( 'Button Text', 'superpress' ),
		'section' => 'header_customizer_setting',
		'type' => 'text',
		'active_callback' => 'superpress_header_button_cb'
	)
); 
$wp_customize->add_setting( 'superpress_purchase_btn_link', 
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'superpress_purchase_btn_link', 
	array(
		'label' => esc_html__( 'Button link', 'superpress' ),
		'section' => 'header_customizer_setting',
		'type' => 'url',
		'active_callback' => 'superpress_header_button_cb'
	)
); 
$wp_customize->add_setting( 'superpress_purchase_btn_link_open',
array(
	'default' => true,
	'sanitize_callback' => 'superpress_switch_sanitization'
)
);
$wp_customize->add_control(
new Superpress_Toggle_Switch_Custom_control(
	$wp_customize, 'superpress_purchase_btn_link_open',
	array(
		'label' => esc_html__( 'Open link in a new tab', 'superpress' ),
		'section' => 'header_customizer_setting',
		'active_callback' => 'superpress_header_button_cb'
		
	)
)
);

/* Retina Logo */
$wp_customize->add_setting( 
	'superpress_header_retina_logo', 
	array(
		'sanitize_callback' => 'esc_url_raw'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Upload_Control( 
		$wp_customize, 
		'superpress_header_retina_logo', 
		array(
			'label'      => esc_html__( 'Retina Logo', 'superpress' ),
			'priority'   => 9,
			'section'    => 'title_tagline'                   
		)
	) 
);

/* Sticky Logo */
$wp_customize->add_setting( 
	'superpress_header_sticky_logo', 
	array(
		'sanitize_callback' => 'esc_url_raw'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Upload_Control( 
		$wp_customize, 
		'superpress_header_sticky_logo', 
		array(
			'label'      => __( 'Sticky Logo', 'superpress' ),
			'priority'   => 9,
			'section'    => 'title_tagline'                   
		)
	) 
);

// Main Menu
$wp_customize->add_setting( 'superpress_nav_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_nav_font_heading',
		array(
			'label' => esc_html__( 'Primary Menu', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_primary_menu_style',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_nav_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'superpress_google_font_sanitization',
		'transport' => 'refresh',
	)
);
$wp_customize->add_control( 
	new Superpress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'superpress_nav_font_family',
		array(
			'label' => esc_html__( 'Font Family' , 'superpress'),
			'section' => 'superpress_primary_menu_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
			'priority' => 2
		)
	) 
);

$wp_customize->add_setting( 'superpress_nav_font_size',
	array(
		'default' => '15',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new Superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_nav_font_size',
		array(
			'label' => esc_html__( 'Font Size(px)', 'superpress' ),
			'section' => 'superpress_primary_menu_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 4
		)
	) 
);
$wp_customize->add_setting( 'superpress_nav_line_height',
	array(
		'default' => '1.7',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_floatval'
	)
);
$wp_customize->add_control( 
	new Superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_nav_line_height',
		array(
			'label' => esc_html__( 'Line Height(em)', 'superpress' ),
			'section' => 'superpress_primary_menu_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
			),
			'priority' => 5
		)
	) 
);

$wp_customize->add_setting( 'superpress_header_nav_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_header_nav_text_color',
		array(
			'label' => esc_html__( 'Nav Text Color', 'superpress' ),
			'section' => 'superpress_primary_menu_style',
			'priority' => 5
		)
	) 
);
$wp_customize->add_setting( 'superpress_header_nav_text_hcolor',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_header_nav_text_hcolor',
		array(
			'label' => esc_html__( 'Nav Hover Color', 'superpress' ),
			'section' => 'superpress_primary_menu_style',
			'priority' => 5
		)
	) 
);

/* dropdown menu */
$wp_customize->add_setting( 'superpress_nav_drop_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_nav_drop_font_heading',
		array(
			'label' => esc_html__( 'Dropdown', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_primary_menu_style',
			'priority' => 6
		)
	) 
);
$wp_customize->add_setting( 'superpress_nav_drop_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'superpress_google_font_sanitization',
		'transport' => 'refresh',
	)
);
$wp_customize->add_control( 
	new Superpress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'superpress_nav_drop_font_family',
		array(
			'label' => esc_html__( 'Font Family' , 'superpress'),
			'section' => 'superpress_primary_menu_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
			'priority' => 7
		)
	) 
);

$wp_customize->add_setting( 'superpress_nav_drop_font_size',
	array(
		'default' => '15',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new Superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_nav_drop_font_size',
		array(
			'label' => esc_html__( 'Font Size(px)', 'superpress' ),
			'section' => 'superpress_primary_menu_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'priority' => 8
		)
	) 
);
$wp_customize->add_setting( 'superpress_nav_drop_line_height',
	array(
		'default' => '1.7',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_floatval'
	)
);
$wp_customize->add_control( 
	new Superpress_Slider_Custom_Control( 
		$wp_customize, 'superpress_nav_drop_line_height',
		array(
			'label' => esc_html__( 'Line Height(em)', 'superpress' ),
			'section' => 'superpress_primary_menu_style',
			'input_attrs' => array(
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
			),
			'priority' => 9
		)
	) 
);