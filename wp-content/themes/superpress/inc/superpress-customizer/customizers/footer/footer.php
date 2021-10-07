<?php 
$wp_customize->add_setting( 'superpress_footer_layout_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_footer_layout_heading',
		array(
			'label' => esc_html__( 'Footer Layouts', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_footer_layout_section',
		)
	) 
);

$wp_customize->add_setting( 'superpress_footer_layouts',
	array(
		'default' => 'default',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( new Superpress_Text_Radio_Button_Custom_Control( $wp_customize, 'superpress_footer_layouts',
	array(
		'label' => esc_html__( 'Choose Footer Layouts', 'superpress' ),
		'section' => 'superpress_footer_layout_section',
		'choices' => array(
			'default' => esc_html__('Default','superpress'),
			'custom' => esc_html__('Custom','superpress'),
		),
	)
) );

if (defined('ELEMENTOR_VERSION')):
//Custom footer
$wp_customize->add_setting('superpress_custom_footer',
	array(
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'absint',
    	'transport' => 'refresh',
    )
);
$wp_customize->add_control( 'superpress_custom_footer',
	array(
		'label'  => esc_html__( 'Choose Footer Template', 'superpress' ),
		'section' => 'superpress_footer_layout_section',
		'type' => 'select',
		'choices' => Superpress_get_elementor_templates(),
		'active_callback' => 'superpress_footer_layouts_cb' 
	)
); 
else:
//Notice
$wp_customize->add_setting( 'superpress_custom_footer_notfound_notice',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
 $wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_custom_footer_notfound_notice',
		array(
			'label' => esc_html__( 'Note:', 'superpress' ),
			'description' => esc_html__( 'Elementor is not installed.Please install and activate elementor first.', 'superpress' ),
			'section' => 'superpress_footer_layout_section',
			'active_callback' => 'superpress_footer_layouts_cb'
		)
	) 
);
endif;

//Notice
$wp_customize->add_setting( 'superpress_custom_footer_notice',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
 $wp_customize->add_control( 
	new Superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_custom_footer_notice',
		array(
			'label' => esc_html__( 'Note:', 'superpress' ),
			'description' => esc_html__( 'Footer built from elementor will be applied.', 'superpress' ),
			'section' => 'superpress_footer_layout_section',
			'active_callback' => 'superpress_footer_layouts_cb'
		)
	) 
); 

$wp_customize->add_setting( 
	'superpress_copyright_text', 
	array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post' 
	)
);
$wp_customize->add_control( 
	'superpress_copyright_text', 
	array(
		'label' => esc_html__( 'Copyright Text', 'superpress' ),
		'description' => esc_html__( '[date],[site-title] can be used.', 'superpress' ),
		'section' => 'superpress_footer_layout_section',
		'type' => 'textarea',
		'active_callback' => 'superpress_footer_copyright_cb'
	)
);  


$wp_customize->add_setting( 'superpress_footer_bg_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_footer_bg_color',
		array(
			'label' => esc_html__( 'Background color', 'superpress' ),
			'section' => 'superpress_footer_layout_section',
			'active_callback'  => 'superpress_footer_copyright_cb',
		)
	) 
);
$wp_customize->add_setting( 'superpress_footer_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'superpress_footer_text_color',
		array(
			'label' => esc_html__( 'Text color', 'superpress' ),
			'section' => 'superpress_footer_layout_section',
			'active_callback'  => 'superpress_footer_copyright_cb',
		)
	) 
);
   

