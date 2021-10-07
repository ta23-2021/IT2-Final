<?php

/* Custom Header */

$template_id = superpress_get_page_options('custom_header');
$header_layout = superpress_get_page_options('header_type','default');

if($header_layout == 'default'){
	$header_layout = get_theme_mod('superpress_header_layouts','default');
	$template_id = get_theme_mod('superpress_custom_header');
}

if($header_layout!='hide'){
    if($header_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
        echo '<div class="superpress-custom-header">';
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( absint($template_id) );
        echo '</div>';
    }
}    