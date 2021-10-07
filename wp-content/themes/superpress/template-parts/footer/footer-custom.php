<?php

/* Custom Header */

$template_id = superpress_get_page_options('custom_footer');
$footer_layout = superpress_get_page_options('footer_type','default');

if($footer_layout == 'default'){
	$footer_layout = get_theme_mod('superpress_footer_layouts','default');
	$template_id = get_theme_mod('superpress_custom_footer');
}

if($footer_layout!='hide'){
    if($footer_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){

        echo '<footer><div class="superpress-custom-footer">';
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( absint($template_id) );
        echo '</div></footer>';
    }
}    