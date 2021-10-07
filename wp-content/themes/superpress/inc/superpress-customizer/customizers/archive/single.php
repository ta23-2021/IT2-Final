<?php
$content_reorder = array(
			'featured_image' => __( 'Feature Image', 'superpress' ),
			'title' => __( 'Title', 'superpress' ),
			'meta_tag' => __( 'Meta Tags', 'superpress'  ),
			'content' => __( 'Content', 'superpress'  ),			
			'coments' => __( 'Coments', 'superpress'  ),
			'navigation' => __( 'Navigation', 'superpress'  ),
		);
$wp_customize->add_setting( 'superpress_spost_settings_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_spost_settings_heading',
		array(
			'label' => esc_html__( 'Single Post Settings', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_single_post_section',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_single_layout',
	array(
		'default' => 'layout2',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_radio_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Image_Radio_Button_Custom_Control( 
		$wp_customize, 'superpress_single_layout',
		array(
			'label' => esc_html__( 'Single Post Layout', 'superpress' ),
			'section' => 'superpress_single_post_section',
			'choices' => array(
				'layout1' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/post-modern.png',
					'name' => esc_html__( 'Layout1', 'superpress' )
				),
				'layout2' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/post-classic.png',
					'name' => esc_html__( 'Layout2', 'superpress' )
				),
			),
			'priority' => 2
		)
	) 
);
$wp_customize->add_setting( 'superpress_post_content_reorder',
	array(
		'default' => apply_filters('superpress_post_content_reorder_defaults','featured_image,title,meta_tag,content,social_share,coments,navigation'),
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( new superpress_Pill_Checkbox_Custom_Control( $wp_customize, 'superpress_post_content_reorder',
	array(
		'label' => __( 'Post Content Order', 'superpress' ),
		'section' => 'superpress_single_post_section',
		'input_attrs' => array(
			'sortable' => true,
			'fullwidth' => true,
		),
		'choices' => apply_filters( 'superpress_post_content_reorder_array', $content_reorder ),
		'priority' => 3
	)
) );
/* for single post sidebar */

$wp_customize->add_setting( 'superpress_post_sidebar_layout',
	array(
		'default' => 'no-sidebar',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Image_Radio_Button_Custom_Control(
		$wp_customize, 'superpress_post_sidebar_layout',
		array(
			'label' => esc_html__( 'Choose Sidebar Layout', 'superpress' ),
			'section' => 'superpress_single_post_section',
			'choices' => array(
				'left-sidebar' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/sidebar-left.png',
					'name' => esc_html__( 'Left Sidebar', 'superpress' )
				),
				'right-sidebar' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/sidebar-right.png',
					'name' => esc_html__( 'Right Sidebar', 'superpress' )
				),
				'no-sidebar' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/sidebar-none.png',
					'name' => esc_html__( 'No Sidebar', 'superpress' )
				)
			),
			'priority' => 4
		)
	) 
);
$wp_customize->add_setting('superpress_post_sidebar', array(
	'default'           =>  'default-sidebar',
	'sanitize_callback' => 'superpress_text_sanitization',
));
$wp_customize->add_control(
	new superpress_Sidebar_Dropdown_Custom_Control(
		$wp_customize, 'superpress_post_sidebar', array(
			'label'    		=> esc_html__('Choose Sidebar', 'superpress'),
			'section'  		=> 'superpress_single_post_section',
			'priority' => 5,
			'active_callback'  		=> 'superpress_single_sidebar_cb',
		)
	)
);