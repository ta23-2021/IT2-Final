<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Superpress
 */
$sidebar = '';

if(is_archive() || is_tag() || is_home() || is_author() || is_search()){

	$sidebar = get_theme_mod('archive_sidebar','default-sidebar');
}
if(is_single()){

	$sidebar = get_theme_mod('post_sidebar','default-sidebar');
} 
if( is_page() ){

	$page_sidebar = superpress_get_page_options('registerd_sidebar','default');
    $sidebar = ($page_sidebar=='default') ? get_theme_mod('superpress_page_sidebar','default-sidebar') : $page_sidebar;
}
if(class_exists('woocommerce')){

	if(is_woocommerce() || is_shop() || is_product_category() || is_product_tag()){
		$sidebar = get_theme_mod('superpress_shop_sidebar','default-sidebar');
	}
	if(is_product()){
		$sidebar = '';
	}
}
if($sidebar == '' ){
	return;
}


if( ! is_active_sidebar($sidebar)){
	return;
}

?>
<div id="secondary" class="superpress-sidebar">
	<?php dynamic_sidebar( $sidebar ); ?>
</div>
