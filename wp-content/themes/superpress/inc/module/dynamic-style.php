<?php
function superpress_dynamic_styles()
{
    ob_start();
    /* Anchor styles */
    $acolor = get_theme_mod('superpress_anchor_color');
    $ahover = get_theme_mod('superpress_anchor_hover_color');
    if ($acolor) {
?>
        a, .meta-info>span:hover a, .meta-info>span:hover, .widget ul li a:hover, .breadcumb-section.wide .title-banner-wrapper a:hover, .blog-btn.link, .link, .slick-slider button.slick-arrow:hover:before, .slick-slider button.slick-arrow:hover:after, a.blog-btn.link:hover
        { color: <?php echo superpress_esc_color($acolor) ?>;}
    <?php
    }
    if ($ahover) {
    ?>
        a:hover, a:focus, a:visited, .meta-info>span:hover a, .meta-info>span:hover, a h1:hover, a h2:hover, a h3:hover, a h4:hover, a h5:hover, a h6:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .breadcumb-section.wide .title-banner-wrapper a:hover, .blog-btn.link:hover, .link:hover, .slick-slider button.slick-arrow:hover:before, .slick-slider button.slick-arrow:hover:after,a.link:hover,
a.blog-btn.link:hover
        { color: <?php echo superpress_esc_color($ahover) ?>;}
    <?php
    }

    /* Theme Color */
    $theme_color = get_theme_mod('superpress_theme_skin_color');
    if ($theme_color) {
    ?>
        .input[type="submit"], .mini-cart span.header-cart-count, .widget .widget-title:before,.right-resurved a{ color: <?php echo superpress_esc_color($theme_color) ?>;}
    <?php
    }

    /* Title Banner Styles */
    $banner_styles = superpress_breadcrumb_styles();
    ?>
    section.breadcumb-section{
    <?php if (!empty($banner_styles['b-color'])) { ?>
        background-color: <?php echo superpress_esc_color($banner_styles['b-color']) ?>;
    <?php }
    if (!empty($banner_styles['b-image'])) { ?>
        background-image: url(<?php echo esc_url($banner_styles['b-image']) ?>);
    <?php }
    if (!empty($banner_styles['b-height'])) { ?>
        min-height: <?php echo absint($banner_styles['b-height']) ?>px;
        height: <?php echo absint($banner_styles['b-height']) ?>px;
    <?php } ?>
    }
    <?php
    if (!empty($banner_styles['b-overlay'])) {
    ?>
        .breadcumb-section.overlay:before{
        background: <?php echo superpress_esc_color($banner_styles['b-overlay']) ?>;
        }
    <?php
    }
    if (!empty($banner_styles['t-color'])) {
    ?>
        h1.breadcrumb-title,.custom-title-wrap p{
        color: <?php echo superpress_esc_color($banner_styles['t-color']) ?>;
        }
    <?php
    }
    if (!empty($banner_styles['t-size'])) {
    ?>
        h1.breadcrumb-title{
        font-size: <?php echo absint($banner_styles['t-size']) ?>px;
        }
    <?php
    }
    if (!empty($banner_styles['bread-color'])) {
    ?>
        #superpress-breadcrumb a,#superpress-breadcrumb .current,.woocommerce nav.woocommerce-breadcrumb, .woocommerce nav.woocommerce-breadcrumb a, .woocommerce nav.woocommerce-breadcrumb span, .woocommerce .breadcumb-section .title-banner-wrapper nav.woocommerce-breadcrumb a{
        color: <?php echo superpress_esc_color($banner_styles['bread-color']) ?>;
        }
    <?php
    }
    if (!empty($banner_styles['bread-sep-color'])) {
    ?>
        #superpress-breadcrumb .delimiter, .woocommerce .woocommerce-breadcrumb span.delimiter{
        color: <?php echo superpress_esc_color($banner_styles['bread-sep-color']) ?>;
        }
    <?php
    }
    if (!empty($banner_styles['bread-hover'])) {
    ?>
        #superpress-breadcrumb a:hover, .woocommerce nav.woocommerce-breadcrumb a:hover, .woocommerce .breadcumb-section .title-banner-wrapper nav.woocommerce-breadcrumb a:hover{
        color: <?php echo superpress_esc_color($banner_styles['bread-hover']) ?>;
        }
    <?php
    }

    /* Typography Styles */
    $body_font = json_decode(get_theme_mod('superpress_body_font_family', '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'), true);
    if ($body_font['boldweight'] == 'regular') {
        unset($body_font['boldweight']);
        $body_font['boldweight'] = 'normal';
    }
    $body_fsize = get_theme_mod('superpress_body_font_size');
    $b_lheight = get_theme_mod('superpress_body_line_height');
    $b_tcolor = get_theme_mod('superpress_body_font_color');
    $heading_font = json_decode(get_theme_mod('superpress_heading_font_family', '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'), true);
    if ($heading_font['boldweight'] == 'regular') {
        unset($heading_font['boldweight']);
        $heading_font['boldweight'] = 'normal';
    }
    $h_tcolor = get_theme_mod('superpress_heading_font_color');
    $h1 = get_theme_mod('superpress_h1_font_size');
    $h2 = get_theme_mod('superpress_h2_font_size');
    $h3 = get_theme_mod('superpress_h3_font_size');
    $h4 = get_theme_mod('superpress_h4_font_size');
    $h5 = get_theme_mod('superpress_h5_font_size');
    $h6 = get_theme_mod('superpress_h6_font_size');
    if ($body_font) {
    ?>
        body,button, input, select, optgroup, textarea{
        font-family: "<?php echo esc_attr($body_font['font']); ?>";
        font-weight: <?php echo esc_attr($body_font['boldweight']); ?>;
        <?php if ($body_fsize) { ?>
            font-size: <?php echo absint($body_fsize); ?>px;
        <?php }
        if ($b_lheight) { ?>
            line-height: <?php echo floatval($b_lheight); ?>em;
        <?php }
        if ($b_tcolor) { ?>
            color: <?php echo superpress_esc_color($b_tcolor); ?>;
        <?php } ?>
        }
    <?php
    }
    if ($heading_font) {
    ?>
        h1,h2,h3,h4,h5,h6,a h1,a h2,a h3,a h4,a h5,a h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a {
        font-family: "<?php echo esc_attr($heading_font['font']); ?>";
        font-weight: <?php echo esc_attr($heading_font['boldweight']); ?>;
        <?php if ($h_tcolor) { ?>
            color: <?php echo superpress_esc_color($h_tcolor); ?>;
        <?php } ?>
        }
    <?php
    }
    if ($h1) {
    ?>
        h1{ font-size: <?php echo absint($h1); ?>px;}
    <?php
    }
    if ($h2) {
    ?>
        h2,.widget h2.widget-title{ font-size: <?php echo absint($h2); ?>px;}
    <?php
    }
    if ($h3) {
    ?>
        h3{ font-size: <?php echo absint($h3); ?>px;}
    <?php
    }
    if ($h4) {
    ?>
        h4{ font-size: <?php echo absint($h4); ?>px;}
    <?php
    }
    if ($h5) {
    ?>
        h5{ font-size: <?php echo absint($h5); ?>px;}
    <?php
    }
    if ($h6) {
    ?>
        h6{ font-size: <?php echo absint($h6); ?>px;}
    <?php
    }
    /* Blockquote Styles */
    $bquote_font = json_decode(get_theme_mod('superpress_bquote_font_family', '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'), true);
    if ($bquote_font['boldweight'] == 'regular') {
        unset($bquote_font['boldweight']);
        $bquote_font['boldweight'] = 'normal';
    }
    $bquote_font_size = get_theme_mod('superpress_bquote_font_size', 19);
    if ($bquote_font || $bquote_font_size) { ?>
        body blockquote, body blockquote p{
        <?php if (isset($bquote_font)) { ?>
            font-family: "<?php echo esc_attr($bquote_font['font']); ?>";
            font-style: <?php echo esc_attr($bquote_font['regularweight']); ?>;
            font-weight: <?php echo esc_attr($bquote_font['boldweight']); ?>;
        <?php } ?>
        <?php if ($bquote_font_size) { ?>
            font-size: <?php echo absint($bquote_font_size); ?>px;
        <?php } ?>
        }
    <?php  }


    /* Preformatted Styles */
    $preform_font = json_decode(get_theme_mod('superpress_preform_font_family', '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'), true);
    if ($preform_font['boldweight'] == 'regular') {
        unset($preform_font['boldweight']);
        $preform_font['boldweight'] = 'normal';
    }
    $preform_font_size = get_theme_mod('superpress_preform_font_size');
    if ($preform_font || $preform_font_size) { ?>
        body pre{
        <?php if ($preform_font) { ?>
            font-family: "<?php echo esc_attr($preform_font['font']); ?>";
            font-style: <?php echo esc_attr($preform_font['regularweight']); ?>;
            font-weight: <?php echo esc_attr($preform_font['boldweight']); ?>;
        <?php } ?>
        <?php if ($preform_font_size) { ?>
            font-size: <?php echo absint($preform_font_size); ?>px;
        <?php } ?>
        }
    <?php  }
    /* Header Styles */
    $header_bg = get_theme_mod('superpress_header_background');
    $header_border = get_theme_mod('superpress_header_layouts_border');
    $header_border_color = get_theme_mod('superpress_header_layouts_border_color');
    $header_bg_color = get_theme_mod('superpress_header_layouts_bg_color');
    $header_bg_image = get_theme_mod('superpress_header_layouts_bg_img');

    $nav_color = get_theme_mod('superpress_header_nav_text_color');
    $nav_hcolor = get_theme_mod('superpress_header_nav_text_hcolor');

    $nav_font = json_decode(get_theme_mod('superpress_nav_font_family', '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'), true);
    if ($nav_font['boldweight'] == 'regular') {
        unset($nav_font['boldweight']);
        $nav_font['boldweight'] = 'normal';
    }
    $nav_size = get_theme_mod('superpress_nav_font_size');
    $nav_lheight = get_theme_mod('superpress_nav_line_height');

    $nav_drop_font = json_decode(get_theme_mod('superpress_nav_drop_font_family', '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'), true);
    if ($nav_drop_font['boldweight'] == 'regular') {
        unset($nav_drop_font['boldweight']);
        $nav_drop_font['boldweight'] = 'normal';
    }
    $nav_drop_size = get_theme_mod('superpress_nav_drop_font_size');
    $nav_drop_lheight = get_theme_mod('superpress_nav_drop_line_height');

    $btn_bg = get_theme_mod('superpress_purchase_btn_background');
    $btn_hbg = get_theme_mod('superpress_purchase_btn_hover_background');
    $btn_color = get_theme_mod('superpress_purchase_btn_text_color');
    $btn_hcolor = get_theme_mod('superpress_purchase_btn_text_hover_color');
    $btn_border = get_theme_mod('superpress_purchase_btn_border_color');
    $btn_border_radius = get_theme_mod('superpress_purchase_btn_bradious');

    if ($btn_color || $btn_bg || $btn_border_radius) {
    ?>
        .comments-area .form-submit input#submit,
        .btn.btn-secondary,
        .widget_search .search-form input.search-submit,
        .woocommerce #respond input#submit, 
         form.woocommerce-cart-form table.shop_table.woocommerce-cart-form__contents td.actions .button,
         .woocommerce .widget_price_filter .price_slider_amount .button,
         .woocommerce .woocommerce-error .button, 
        .woocommerce .woocommerce-info .button, 
        .woocommerce .woocommerce-message .button, 
        .woocommerce-page .woocommerce-error .button, 
        .woocommerce-page .woocommerce-info .button, 
        .woocommerce-page .woocommerce-message .button,
        .woocommerce form.checkout_coupon p.form-row.form-row-last button.button{
        color: <?php echo superpress_esc_color($btn_color); ?>;
        background-color: <?php echo superpress_esc_color($btn_bg); ?>;
        <?php if ($btn_border) { ?>
            border-color: <?php echo superpress_esc_color($btn_border); ?>;
        <?php } ?>
        <?php if ($btn_border_radius) { ?>
            border-radius: <?php echo floatval($btn_border_radius); ?>px !important;
        <?php } ?>
        }
    <?php
    }
    if ($btn_hcolor || $btn_hbg) {
    ?>
        .comments-area .form-submit input#submit:hover,
        .btn-secondary:hover,
        .widget_search .search-fsorm input.search-submit:hover,
        .woocommerce #respond input#submit:hover, 
         form.woocommerce-cart-form table.shop_table.woocommerce-cart-form__contents td.actions .button:hover,
         .woocommerce .widget_price_filter .price_slider_amount .button:hover,
         .woocommerce .woocommerce-error .button:hover, 
        .woocommerce .woocommerce-info .button:hover, 
        .woocommerce .woocommerce-message .button:hover, 
        .woocommerce-page .woocommerce-error .button:hover, 
        .woocommerce-page .woocommerce-info .button:hover, 
        .woocommerce-page .woocommerce-message .button:hover,
        .woocommerce form.checkout_coupon p.form-row.form-row-last button.button:hover{
        color: <?php echo superpress_esc_color($btn_hcolor); ?>;
        background-color: <?php echo superpress_esc_color($btn_hbg); ?>;
        <?php if ($btn_border) { ?>
            border-color: <?php echo superpress_esc_color($btn_border); ?> !important;
        <?php } ?>
        }
    <?php
    }

    if ($header_border || $header_border_color || $header_bg_color || $header_bg_image) {
    ?>
        .site-header .superpress-default-header, .site-header .superpress-default-header.is-sticky{
        <?php if ($header_border) { ?>
            border-bottom-width: <?php echo floatval($header_border); ?>px;
        <?php } ?>
        border-bottom-style: solid;
        <?php if ($header_border_color) { ?>
            border-bottom-color: <?php echo superpress_esc_color($header_border_color); ?>;
        <?php } ?>
        <?php if ($header_bg_color) { ?>
            background-color: <?php echo superpress_esc_color($header_bg_color); ?>;
        <?php } ?>
        <?php if ($header_bg_image) { ?>
            background-image: url("<?php echo esc_url($header_bg_image); ?>");
        <?php } ?>
        }
    <?php
    }
    if ($nav_font || $nav_size || $nav_lheight) {
    ?>
        body .navbar-nav>li>a, body .site-header .superpress-default-header.is-sticky .navbar-nav>li>a {
        <?php if ($nav_font) { ?>
            font-family: "<?php echo esc_attr($nav_font['font']); ?>";
            font-style: <?php echo esc_attr($nav_font['regularweight']); ?>;
            font-weight: <?php echo esc_attr($nav_font['boldweight']); ?>;
        <?php } ?>
        <?php if ($nav_lheight) { ?>
            line-height: <?php echo floatval($nav_lheight); ?>;
        <?php } ?>
        <?php if ($nav_size) { ?>
            font-size: <?php echo absint($nav_size); ?>px;
        <?php } ?>
        }
    <?php
    }
    if ($nav_drop_font || $nav_drop_size || $nav_drop_lheight) {
    ?>
        body .navbar-nav>li> ul li a, body .site-header .superpress-default-header.is-sticky .navbar-nav>li> ul li a{
        <?php if (!empty($nav_drop_font)) { ?>
            font-family: "<?php echo esc_attr($nav_drop_font['font']); ?>";
            font-style: <?php echo esc_attr($nav_drop_font['regularweight']); ?>;
            font-weight: <?php echo esc_attr($nav_drop_font['boldweight']); ?>;
        <?php } ?>
        <?php if ($nav_drop_lheight) { ?>
            line-height: <?php echo floatval($nav_drop_lheight); ?>;
        <?php } ?>
        <?php if (!empty($nav_drop_size)) { ?>
            font-size: <?php echo absint($nav_drop_size); ?>px;
        <?php } ?>
        }
    <?php
    }
    if ($nav_color) {
    ?>
        body .navbar-nav>li>a, 
        body .site-header .superpress-default-header.is-sticky .navbar-nav>li>a,
        body .navbar-nav>li>a,
        body .superpress-default-header.is-sticky .navbar-nav>li>a,
        body.single-layout1 .site-header .superpress-default-header.is-sticky .navbar-nav>li>a {
        color: <?php echo superpress_esc_color($nav_color); ?>;
        }
        .superpress-default-header.is-sticky .mini-cart a.dropdown svg, .mini-cart a.dropdown svg{
        fill: <?php echo superpress_esc_color($nav_color); ?>;
        }
    <?php
    }
    if ($nav_hcolor) {
    ?>
        body .navbar-nav li>a:hover,body .site-header .navbar-nav>li.current_page_item>a,body .site-header .navbar-nav>li>a:hover, .superpress-default-header.is-sticky nav.navbar ul.navbar-nav > li.menu-item > a:hover,.superpress-default-header.is-sticky nav.navbar ul.navbar-nav > li.menu-item.current_page_item > a, body .site-header .navbar-nav>li>a:hover,
        body .site-header .navbar-nav>li.current_page_item>a,
        body .site-header .superpress-default-header.is-sticky>.navbar-nav>li>a:hover,
        body .site-header .superpress-default-header.is-sticky>.navbar-nav>li.current_page_item>a,
        body .superpress-default-header.is-transparent .navbar-nav>li>a:hover,
        body.single-layout1 .site-header .superpress-default-header.is-sticky .navbar-nav>li>a:hover,
        body.single-layout1 .site-header .superpress-default-header .navbar-nav>li>a:hover,
        .superpress-default-header.is-transparent .navbar-nav>li>a:hover{
        color: <?php echo superpress_esc_color($nav_hcolor); ?>;
        }
        .superpress-default-header.is-sticky .mini-cart a:hover svg, 
        .superpress-default-header.is-transparent .mini-cart a:hover svg,
        .mini-cart a:hover svg,
        body.single-layout1 .site-header .superpress-default-header .mini-cart a:hover svg,
        .superpress-default-header.is-sticky .search-icon:hover svg, 
        .superpress-default-header.is-transparent .search-icon:hover svg,
        .search-icon:hover svg,
        body.single-layout1 .site-header .superpress-default-header .search-icon:hover svg{
        fill: <?php echo superpress_esc_color($nav_hcolor); ?>;
        }
        ul.navbar-nav>li.menu-item>a:before, ul.navbar-nav>li.menu-item.current_page_item>a:before, ul.navbar-nav>li.menu-item.current_page_parent>a:before,.superpress-default-header.is-sticky nav.navbar ul.navbar-nav>li.menu-item>a:before, .link:before, body.single-layout1 .site-header .superpress-default-header .mini-cart:hover span.header-cart-count, .superpress-default-header.is-transparent .mini-cart:hover span.header-cart-count{
        background-color: <?php echo superpress_esc_color($nav_hcolor); ?>;
        }
    <?php
    }

    /* Meta Styles */
    $meta_color = get_theme_mod('superpress_meta_color');
    $meta_size = get_theme_mod('superpress_meta_font_size');
    if ($meta_color || $meta_size) {
    ?>
        .meta-info>span a,.meta-info>span{
        <?php if ($meta_color) { ?>
            color: <?php echo superpress_esc_color($meta_color); ?>;
        <?php }
        if ($meta_size) { ?>
            font-size: <?php echo absint($meta_size); ?>px;
        <?php } ?>
        }
    <?php
    }
    /* archive meta hover */
    $meta_hcolor = get_theme_mod('superpress_meta_hcolor');
    if ($meta_hcolor) {
    ?>
        .meta-info > span a:hover {
        color: <?php echo superpress_esc_color($meta_hcolor); ?>;
        }
    <?php
    }

    /* Button Styles */
    $btn_color = get_theme_mod('superpress_theme_btn_text_color');
    $btn_hcolor = get_theme_mod('superpress_theme_btn_text_hcolor');
    $btn_bg = get_theme_mod('superpress_theme_btn_color');
    $btn_hbg = get_theme_mod('superpress_theme_btn_hcolor');
    if ($btn_color || $btn_bg) {
    ?>
        .btn-primary,
        button,
        a.blog-btn,
        .btn,
        a.btn,
        input[type="submit"],
        input[type="button"],
        .button,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product a.add_to_cart_button,
        .woocommerce ul.products li.product a.added_to_cart,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce .widget_shopping_cart .buttons a,
        .woocommerce.widget_shopping_cart .buttons a,
        .elementor-button
        {
        color: <?php echo superpress_esc_color($btn_color); ?>;
        background-color: <?php echo superpress_esc_color($btn_bg); ?>;
        }
    <?php
    }
    if ($btn_hcolor || $btn_hbg) {
    ?>
        .btn-primary:hover,
        button:hover,
        a.blog-btn:hover,
        .btn:hover,
        a.btn:hover,
        input[type="submit"]:hover,
        input[type="button"]:hover,
        .button:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button:hover,
        .woocommerce input.button:hover,
        .woocommerce ul.products li.product a.add_to_cart_button:hover,
        .woocommerce ul.products li.product a.added_to_cart:hover,
        .woocommerce a.button.alt:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce input.button.alt:hover,
        .woocommerce .widget_shopping_cart .buttons a:hover,
        .woocommerce.widget_shopping_cart .buttons a:hover,
        .elementor-button:hover
        {
        color: <?php echo superpress_esc_color($btn_hcolor); ?>;
        background-color: <?php echo superpress_esc_color($btn_hbg); ?>;
        }
    <?php
    }

    /* Mini cart buttons */
    $mini_btn_bg = get_theme_mod('superpress_mc_button_bg_color');
    $mini_btn_hbg = get_theme_mod('superpress_mc_button_bg_hcolor');
    $mini_btn_txt = get_theme_mod('superpress_mc_button_text_color');
    $mini_btn_htxt = get_theme_mod('superpress_mc_button_text_hcolor');
    if ($mini_btn_bg || $mini_btn_txt) {
    ?>
        body .mini-cart .widget_shopping_cart_content p.woocommerce-mini-cart__buttons.buttons a.button{
        <?php if ($mini_btn_bg) { ?>
            background-color: <?php echo superpress_esc_color($mini_btn_bg); ?>;
        <?php }
        if ($mini_btn_txt) { ?>
            color: <?php echo superpress_esc_color($mini_btn_txt); ?>;
        <?php } ?>
        }
    <?php
    }
    if ($mini_btn_hbg || $mini_btn_htxt) {
    ?>

        body .mini-cart .widget_shopping_cart_content p.woocommerce-mini-cart__buttons.buttons a.button:hover{
        <?php if ($mini_btn_hbg) { ?>
            background-color: <?php echo superpress_esc_color($mini_btn_hbg); ?>;
        <?php }
        if ($mini_btn_htxt) { ?>
            color: <?php echo superpress_esc_color($mini_btn_htxt); ?>;
        <?php } ?>
        }
    <?php
    }

    /* Scroll Top */
    $scroll_bg = get_theme_mod('superpress_scroll_top_bg');
    $scroll_hbg = get_theme_mod('superpress_scroll_top_bg_hover');
    $scroll_color = get_theme_mod('superpress_scroll_top_color');
    $scroll_hcolor = get_theme_mod('superpress_scroll_top_hover_color');
    if ($scroll_bg || $scroll_color) {
    ?>
        a.scroll-to-top{
        background-color: <?php echo superpress_esc_color($scroll_bg); ?>;
        }
        .scroll-to-top span{
        background-color: <?php echo superpress_esc_color($scroll_color); ?>;
        }
    <?php
    }
    if ($scroll_hcolor || $scroll_hbg) {
    ?>
        a.scroll-to-top:hover{
        background-color: <?php echo superpress_esc_color($scroll_hbg); ?>;
        }
        .scroll-to-top:hover span{
        background-color: <?php echo superpress_esc_color($scroll_hcolor); ?>;
        }
    <?php
    }

    /* Footer Styles */
    $footer_bg = get_theme_mod('superpress_footer_bg_color');
    $footer_text = get_theme_mod('superpress_footer_text_color');
    if ($footer_bg) {
    ?>
        .site-footer{ background-color: <?php echo superpress_esc_color($footer_bg); ?>; }
    <?php
    }
    if ($footer_text) {
    ?>
        .site-footer .right-resurved p{ color: <?php echo superpress_esc_color($footer_text); ?>;}
<?php
    }

    $css = ob_get_clean();
    $css = superpress_css_strip_whitespace(apply_filters('superpress_dynamic_css', $css));
    wp_add_inline_style('superpress-responsive', $css);
}
add_action('wp_enqueue_scripts', 'superpress_dynamic_styles', 999);
