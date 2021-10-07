<?php
function superpress_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'superpress_woocommerce_setup' );
function superpress_woocommerce_scripts() {
	wp_enqueue_style( 'superpress-woocommerce-style', get_template_directory_uri() . '/assets/css/woo.css' );
}
add_action( 'wp_enqueue_scripts', 'superpress_woocommerce_scripts',10);
function superpress_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';
	return $classes;
}

/**
 * WooCommerce Breadcrumb Modify
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
/* Modified Breadcrumb */
if(!function_exists('superpress_product_breadcrumb')){
    function superpress_product_breadcrumb() {
        $seperator = get_theme_mod('superpress_breadcrumb_separator','/');
        $args = array( 'delimiter' => '<span class="delimiter">'.esc_html($seperator).'</span>' );
        woocommerce_breadcrumb( $args );
    }
}

/**
* Product Archive page & Custom template loop
*/

add_filter( 'loop_shop_per_page', 'superpress_loop_shop_per_page', 20 );
function superpress_loop_shop_per_page( $cols ) {
  $number = get_theme_mod('superpress_product_per_page', 9);
  return $number;
}


/**
 * Woo Commerce Number of row filter Function
**/
add_filter('loop_shop_columns', 'superpress_loop_columns');
if (!function_exists('superpress_loop_columns')) {
    function superpress_loop_columns() {
    	$layout = get_theme_mod('superpress_shop_display_layout','grid');
    	if($layout == 'list'){
    		$col = 1;
    	}else{
        	$col = get_theme_mod('superpress_shop_column_no',3);
        }

        return $col;
    }
}

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
* Add Wrapper to WooCommerce Pages
*/
if ( ! function_exists( 'superpress_woocommerce_wrapper_before' ) ) {
    function superpress_woocommerce_wrapper_before() {

        if(is_product()){
            $sidebar_widget = 'no-sidebar'; 
        }else{
            $sidebar_widget = superpress_sidebar_widget('shop');
        }
		$layout = get_theme_mod('superpress_shop_display_layout','grid');
        $class = $sidebar_widget;
        if(is_shop() || is_product_category() || is_product_tag()){
            $class .= ' '.$layout;
        }
        ?>
        <?php 
        if(is_product()){
            $bread_show = get_theme_mod('superpress_breadcrumb_switch', 1);
            if ($bread_show) {
                $bread_show = superpress_get_page_options('show_breadcrumb', 1);
            }
            if ($bread_show) {
                superpress_breadcrumb();
            }
        }else{
           superpress_breadcrumb(); 
        }

        ?>
        <section class="woocommerce-page-wrap <?php echo esc_attr($class);?>">
        <main id="main" class="site-main product" >
        <div class="container">
        <?php 
            if(is_shop() || is_product_category() || is_product_tag()): ?>
                <span class=" product-filter hr-product-filter">Filter</span>
               <?php $show_filter = get_theme_mod('superpress_horizontal_product_filter_switch',0);
                if($show_filter){
                    get_sidebar();
                }
            endif;
         ?>
     	<div id="primary" class="product-content-wrapper"> 
        <?php
    }
}
add_action( 'woocommerce_before_main_content', 'superpress_woocommerce_wrapper_before' );

if ( ! function_exists( 'superpress_woocommerce_wrapper_after' ) ) {

    function superpress_woocommerce_wrapper_after() {
        ?>
		</div><!--.product-content-wrapper-->
		<?php 
        if(is_product()){
            $sidebar_widget = 'no-sidebar'; 
        }else{
            $sidebar_widget = superpress_sidebar_widget('shop');
        }
        if($sidebar_widget != 'no-sidebar'){
            get_sidebar(); 
        }
        ?>
		</div><!--.container-->
        </main><!-- #main -->
        </section><!--.woocommerce-page-wrap-->
        <?php
    }
}
add_action( 'woocommerce_after_main_content', 'superpress_woocommerce_wrapper_after' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


/* Manage Folder Structure */
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);


function superpress_woo_thumb_wrap_open(){
	echo '<figure>';
	woocommerce_template_loop_product_link_open();
}
add_action('woocommerce_before_shop_loop_item','superpress_woo_thumb_wrap_open',10);

function superpress_woo_thumb_wrap_close(){
	woocommerce_template_loop_product_link_close();
	echo '</figure>';
}
add_action('woocommerce_before_shop_loop_item_title','superpress_woo_thumb_wrap_close',15);

function superpress_woo_content_wrap_open(){
	echo '<div class="woo-content">';
}
add_action('woocommerce_shop_loop_item_title','superpress_woo_content_wrap_open',5);

function superpress_woo_content_wrap_close(){
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item','superpress_woo_content_wrap_close',25);

function superpress_woo_desc_wrap_open(){
	echo '<div class="woo-desc-wrap">';
	woocommerce_template_loop_product_link_open();
}
add_action('woocommerce_shop_loop_item_title','superpress_woo_desc_wrap_open',6);

function superpress_woo_desc_wrap_close(){
	woocommerce_template_loop_product_link_close();
    /* Add short desc */
    $layout = get_theme_mod('superpress_shop_display_layout','grid');
    if($layout == 'list'){
        woocommerce_template_single_excerpt();
    }
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item','superpress_woo_desc_wrap_close',5);

/**
 * Related Products Args.
*/
function superpress_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod('superpress_related_products_per_page',3),
        'columns'        => get_theme_mod('superpress_related_products_column',3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'superpress_related_products_args' );

/* Related title */

add_filter('gettext', 'superpress_change_related_text', 10, 3);
add_filter('ngettext', 'superpress_change_related_text', 10, 3);

function superpress_change_related_text($translated, $text, $domain)
{
    $related_title = get_theme_mod('superpress_related_product_title','Related Products');
    if ($text === 'Related products' && $domain === 'woocommerce') {
       $translated = $related_title;
   }
   return $translated;
}

/* Header Mini Cart */
if ( ! function_exists( 'superpress_woocommerce_cart_link_fragment' ) ) {
	function superpress_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		superpress_woocommerce_cart_link();
		$fragments['span.header-cart-count'] = ob_get_clean();
		return $fragments;
	}
}
 add_filter( 'woocommerce_add_to_cart_fragments', 'superpress_woocommerce_cart_link_fragment' );
if ( ! function_exists( 'superpress_woocommerce_cart_link' ) ) {
 	function superpress_woocommerce_cart_link() {
 		?>
		<span class="header-cart-count">
			<?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
		</span>
 		<?php
 	}
}

/* Off canvas cart */
if(!function_exists('superpress_off_canvas_cart')){
    function superpress_off_canvas_cart(){
        $mini_cart_show = get_theme_mod('superpress_mini_cart_switch',true);
        $mini_cart_style = get_theme_mod('superpress_mc_diaplay_style','dropdown');
        if ($mini_cart_style == 'offcanvas' ): ?>
            <div class="off-canvas-cart">
                <a href="javascript:void(0)" class="off-canvas-close"></a>
                <div class="shopping-list-wrap">
                    <h4><?php echo esc_html('Your Shopping Cart','superpress');?></h4>
                    <div class="widget_shopping_cart_content">
                        <?php woocommerce_mini_cart(); ?>
                    </div>
                </div>
            </div>
            <?php 
        endif;
    }
}
add_action('superpress_after_footer','superpress_off_canvas_cart',20);        

/* Order review wrapper */
function superpress_order_review_wrap_start(){
    echo '<div class="order-review-wrapper">';
}
add_action('woocommerce_checkout_before_order_review_heading','superpress_order_review_wrap_start',5);
function superpress_order_review_wrap_end(){
    echo '</div>';
}
add_action('woocommerce_checkout_after_order_review','superpress_order_review_wrap_end',30);

/* Change default sorting order */
add_filter('woocommerce_default_catalog_orderby', 'superpress_default_catalog_orderby');
 
function superpress_default_catalog_orderby( $sort_by ) {
    return 'date';
}

//
