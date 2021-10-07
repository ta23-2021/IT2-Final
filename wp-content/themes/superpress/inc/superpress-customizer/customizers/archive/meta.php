<?php
$wp_customize->add_setting( 'superpress_meta_setting_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_meta_setting_heading',
		array(
			'label' => esc_html__( 'Meta Setting', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_meta_setting_section',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_meta_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Toggle_Switch_Custom_control(
		$wp_customize, 'superpress_meta_switch',
		array(
			'label' => esc_html__( 'Show Meta', 'superpress' ),
			'section' => 'superpress_meta_setting_section',
			'priority' => 2
		)
	)
);
$wp_customize->add_setting( 'superpress_meta_reorder',
	array(
		'default' => 'author,date,category,tags,comments',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( new superpress_Pill_Checkbox_Custom_Control( $wp_customize, 'superpress_meta_reorder',
	array(
		'label' => __( 'Meta Order', 'superpress' ),
		'section' => 'superpress_meta_setting_section',
		'input_attrs' => array(
			'sortable' => true,
			'fullwidth' => false,
		),
		'choices' => array(
			'date' => __( 'Date', 'superpress' ),
			'author' => __( 'Author', 'superpress' ),
			'category' => __( 'Categories', 'superpress'  ),
			'tags' => __( 'Tags', 'superpress'  ),
			'comments' => __( 'Comments', 'superpress'  ),
		),
		'priority' => 3,
		'active_callback'=>'superpress_meta_button_cb',
	)
) );
//styles
$wp_customize->add_setting( 'superpress_meta_style_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_meta_style_heading',
		array(
			'label' => esc_html__( 'Meta Styles', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_meta_setting_section',
			'priority' => 4,
			'active_callback'=>'superpress_meta_button_cb',
		)
	) 
);
 $wp_customize->add_setting( 'superpress_meta_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_hex_rgba_sanitization'
	)
);
 $wp_customize->add_control( 
	new superpress_Customize_Alpha_Color_Control(
		$wp_customize, 'superpress_meta_color',
		array(
			'label' => esc_html__( 'Meta Link Color', 'superpress' ),
			'section' => 'superpress_meta_setting_section',
			'show_opacity' => false,
			'priority' => 5,
			'active_callback'=>'superpress_meta_button_cb',
		)
	) 
);
$wp_customize->add_setting( 'superpress_meta_hcolor',
array(
    'default' => '',
    'transport' => 'refresh',
    'sanitize_callback' => 'superpress_hex_rgba_sanitization'
)
);
$wp_customize->add_control( 
new superpress_Customize_Alpha_Color_Control(
    $wp_customize, 'superpress_meta_hcolor',
    array(
        'label' => esc_html__( 'Meta Link Hover Color', 'superpress' ),
        'section' => 'superpress_meta_setting_section',
        'show_opacity' => false,
		'priority' => 5,
		'active_callback'=>'superpress_meta_button_cb',
    )
) 
);
 $wp_customize->add_setting( 'superpress_meta_font_size',
 	array(
 		'default' => '',
 		'transport' => 'refresh',
 		'sanitize_callback' => 'absint'
 	)
 );
 $wp_customize->add_control( 
 	new superpress_Slider_Custom_Control( 
 		$wp_customize, 'superpress_meta_font_size',
 		array(
 			'label' => esc_html__( 'Font Size(px)', 'superpress' ),
 			'section' => 'superpress_meta_setting_section',
 			'input_attrs' => array(
 				'min' => 0,
 				'max' => 100,
 				'step' => 1,
 			),
			 'priority' => 6,
			 'active_callback'=>'superpress_meta_button_cb',
 		)
 	) 
 );