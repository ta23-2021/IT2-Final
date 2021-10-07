<?php 
/* Header Layouts Callback */
function superpress_header_layouts_cb(){
	$header_layout = get_theme_mod('superpress_header_layouts');
	$data = ($header_layout == 'custom') ? true : false;
	return $data;
}
function superpress_header_layouts_cb_default(){
	$header_layout = get_theme_mod('superpress_header_layouts');
	$data = ($header_layout == 'default') ? true : false;
	return $data;
}

/* Banner Overlay Callback */
function superpress_bread_banner_image_cb(){
	$bg_image = get_theme_mod('superpress_bread_banner_bg_image');
	$data = !empty($bg_image) ? true : false;
	return $data;
}

/* Archive Column Callback */
function superpress_archive_column_cb(){
	$archive_callback_option = get_theme_mod('superpress_archive_layout');
	$data = ($archive_callback_option != 'list') ? true : false;
	return $data;
}
/* Meta Button Callback */
function superpress_meta_button_cb(){
	$show_meta = get_theme_mod('superpress_meta_switch',0);
	$data = ($show_meta) ? true : false;
	return $data;
}
/* Footer Layout Callback */
function superpress_footer_layouts_cb(){
	$footer_layout = get_theme_mod('superpress_footer_layouts');
	$data = ($footer_layout == 'custom') ? true : false;
	return $data;
}

/* Footer Copyright Callback */
function superpress_footer_copyright_cb(){
	$footer_layout = get_theme_mod('superpress_footer_layouts');
	$data = ($footer_layout == 'default') ? true : false;
	return $data;
}
/* Scroll to Top Callback */
function superpress_footer_scrolltotop_cb(){
	$scroll_to_top = get_theme_mod('superpress_scroll_top_switch',true);
	$data = ($scroll_to_top) ? true : false;
	return $data;
}

/* Shop Column Callback */
function superpress_shop_column_cb(){
	$display_layout = get_theme_mod('superpress_shop_display_layout','grid');
	$data = ($display_layout == 'grid') ? true : false;
	return $data;
}
/* header Button Callback */
function superpress_header_button_cb(){
	$show_button = get_theme_mod('superpress_show_purchase_btn_switch',0);
	$data = ($show_button) ? true : false;
	return $data;
}
/* breadcrumb Button Callback */
function superpress_bread_button_cb(){
	$show_button = get_theme_mod('superpress_breadcrumb_switch',0);
	$data = ($show_button) ? true : false;
	return $data;
}
/* breadcrumb Button Callback */
function superpress_banner_button_cb(){
	$show_button = get_theme_mod('superpress_breadcrumb_banner_switch',0);
	$data = ($show_button) ? true : false;
	return $data;
}
/* archive_sidebar Callback */
function superpress_archive_sidebar_cb(){
	$show_sidebar = get_theme_mod('superpress_archive_sidebar_layout','no-sidebar');
	$data = ($show_sidebar!='no-sidebar') ? true : false;
	return $data;
}
function superpress_single_sidebar_cb(){	
	$show_sidebar = get_theme_mod('superpress_post_sidebar_layout','no-sidebar');
	$data = ($show_sidebar!='no-sidebar') ? true : false;
	return $data;
}
function superpress_page_sidebar_cb(){	
	$show_sidebar = get_theme_mod('superpress_page_sidebar_layout','no-sidebar');
	$data = ($show_sidebar!='no-sidebar') ? true : false;
	return $data;
}
function superpress_single_shop_sidebar_cb(){	
	$show_sidebar = get_theme_mod('superpress_shop_sidebar_layout','no-sidebar');
	$data = ($show_sidebar!='no-sidebar') ? true : false;
	return $data;
}
/* cart callback */
function superpress_mini_cart_switch_cb(){	
	$show_cart = get_theme_mod('superpress_mini_cart_switch',0);
	$data = ($show_cart) ? true : false;
	return $data;
}

