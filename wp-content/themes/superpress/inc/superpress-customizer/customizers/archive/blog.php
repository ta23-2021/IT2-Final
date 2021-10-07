<?php
$wp_customize->add_setting( 'superpress_blog_settings_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_blog_settings_heading',
		array(
			'label' => esc_html__( 'Archive Setting', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_blog_page_section',
			'priority' => 1
		)
	) 
);
$wp_customize->add_setting( 'superpress_archive_layout',
	array(
		'default' => 'list',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_radio_sanitization'
	)
);
$wp_customize->add_control( 
	new superpress_Image_Radio_Button_Custom_Control( 
		$wp_customize, 'superpress_archive_layout',
		array(
			'label' => esc_html__( 'Archive Layout', 'superpress' ),
			'section' => 'superpress_blog_page_section',
			'choices' => array(
				'grid' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/archive-layout.png',
					'name' => esc_html__( 'Grid', 'superpress' )
				),
				'list' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/archive-layout3.png',
					'name' => esc_html__( 'List', 'superpress' )
				),
				'fancy' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/superpress-customizer/images/archive-layout1.png',
					'name' => esc_html__( 'Masonry', 'superpress' )
				)
			),
			'priority' => 2
		)
	) 
);
$wp_customize->add_setting( 'superpress_achive_column_no',
	array(
		'default' => '2',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control('superpress_achive_column_no',
	array(
		'label' => esc_html__( 'Select Column', 'superpress' ),
		'type' => 'select',
		'choices' => array(
			'2' => esc_html__( '2', 'superpress' ),
			'3' => esc_html__( '3', 'superpress' ),
			'4' => esc_html__( '4', 'superpress' ),
		),
		'section' => 'superpress_blog_page_section',
		'active_callback'  => 'superpress_archive_column_cb',
		'priority' => 3
	)
);
$wp_customize->add_setting( 
	'superpress_archive_excerpt_lenghth', 
	array(
		'default' =>35,
		'sanitize_callback' => 'absint' 
	)
);
$wp_customize->add_control( 
	'superpress_archive_excerpt_lenghth', 
	array(
		'label' => esc_html__( 'Excerpt Length', 'superpress' ),
		'section' => 'superpress_blog_page_section',
		'type' => 'number',
		'priority' => 4
	)
); 
$wp_customize->add_setting( 
	'superpress_archive_button_text', 
	array(
		'default' => esc_html__( 'Read More', 'superpress' ),
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	'superpress_archive_button_text', 
	array(
		'label' => esc_html__( 'Read More Text', 'superpress' ),
		'section' => 'superpress_blog_page_section',
		'type' => 'text',
		'priority' => 5
	)
); 
$wp_customize->add_setting('superpress_archive_button_type',
	array(
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'superpress_sanitize_select',
    	'transport' => 'refresh',
    	'default' => 'button'
    )
);
$wp_customize->add_control( 'superpress_archive_button_type',
	array(
		'label'  => esc_html__( 'Button Type', 'superpress' ),
		'section' => 'superpress_blog_page_section',
		'type' => 'select',
		'choices' => array(
			'link' => __('Normal Link','superpress'),
			'button' => __('Button','superpress'),
		),
		'priority' => 6
	)
); 
$wp_customize->add_setting( 'superpress_archive_content_reorder',
	array(
		'default' => 'featured_image,title,meta_tag,content,button,social_share',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_text_sanitization'
	)
);
$wp_customize->add_control( new superpress_Pill_Checkbox_Custom_Control( $wp_customize, 'superpress_archive_content_reorder',
	array(
		'label' => __( 'Content Order', 'superpress' ),
		'section' => 'superpress_blog_page_section',
		'input_attrs' => array(
			'sortable' => true,
			'fullwidth' => true,
		),
		'choices' => array(
			'featured_image' => __( 'Feature Image', 'superpress' ),
			'title' => __( 'Title', 'superpress' ),
			'meta_tag' => __( 'Meta Tags', 'superpress'  ),
			'content' => __( 'Content', 'superpress'  ),
			'button' => __( 'Button', 'superpress'  ),
			
		),
		'priority' => 7
	)
) );