<?php
$wp_customize->add_setting( 'superpress_archive_sidebar_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new superpress_Simple_Notice_Custom_Control( 
		$wp_customize, 'superpress_archive_sidebar_heading',
		array(
			'label' => esc_html__( 'Sidebar Setting', 'superpress' ),
			'type' => 'heading',
			'section' => 'superpress_archive_sidebar_section',
		)
	) 
);
$wp_customize->add_setting( 'superpress_archive_sidebar_layout',
	array(
		'default' => 'right-sidebar',
		'transport' => 'refresh',
		'sanitize_callback' => 'superpress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new superpress_Image_Radio_Button_Custom_Control(
		$wp_customize, 'superpress_archive_sidebar_layout',
		array(
			'label' => esc_html__( 'Choose Sidebar Layout', 'superpress' ),
			'section' => 'superpress_archive_sidebar_section',
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
			)
		)
	) 
);
$wp_customize->add_setting('superpress_archive_sidebar', array(
	'default'           =>  'default-sidebar',
	'sanitize_callback' => 'superpress_text_sanitization',
));
$wp_customize->add_control(
	new superpress_Sidebar_Dropdown_Custom_Control(
		$wp_customize, 'superpress_archive_sidebar', array(
			'label'    		=> esc_html__('Choose Sidebar', 'superpress'),
			'section'  		=> 'superpress_archive_sidebar_section',
			'active_callback'  		=> 'superpress_archive_sidebar_cb',
		)
	)
);