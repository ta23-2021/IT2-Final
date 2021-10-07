<?php
function amandalite_custom_css()
{	
    $custom_css = "";
    if ( get_theme_mod('amandalite_body_color') )
    {
    	$body_color = esc_attr(get_theme_mod('amandalite_body_color'));
        $custom_css .= "
            :root{
                --body-color: {$body_color};
            }";
    }
    if ( get_theme_mod('amandalite_accent_color') )
    {
        $accent_color = esc_attr(get_theme_mod('amandalite_accent_color'));
        $accent_color_rgb = amandalite_hex2rgba( $accent_color);

        $custom_css .= "
            :root{
                --accent-color: {$accent_color};
                --accent-color-rgb: {$accent_color_rgb};
            }
        ";
    }
    wp_add_inline_style( 'amandalite-theme-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'amandalite_custom_css', 15 );
