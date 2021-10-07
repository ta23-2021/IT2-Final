<?php 
 /********* Google Fonts URL function  ***********/
 if ( ! function_exists( 'superpress_google_fonts_url' ) ){
 	function superpress_google_fonts_url() {
 		$fonts_url = '';
 		$body_font = json_decode(get_theme_mod('superpress_body_font_family','{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'));
 		$heading_font = json_decode(get_theme_mod('superpress_heading_font_family','{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'));
   		$bfont = $body_font->font;
 		$bregularweight = $body_font->regularweight;
 		$bitalicweight = isset($body_font->italicweight) ? $body_font->italicweight : '';
 		$bboldweight = isset($body_font->boldweight) ? $body_font->boldweight : '';
 		$bcategory = isset($body_font->category) ? $body_font->category : '';
   		$hfont = $heading_font->font;
 		$hregularweight = $heading_font->regularweight;
 		$hitalicweight = isset($heading_font->italicweight) ? $heading_font->italicweight : '';
 		$hboldweight = isset($heading_font->boldweight) ? $heading_font->boldweight : '';
 		$hcategory = isset($heading_font->category) ? $heading_font->category : '';
   		$content_font = $bfont .":". $bregularweight.','.$bitalicweight.','.$bboldweight;
 		$header_font = $hfont .":". $hregularweight.','.$hitalicweight.','.$hboldweight;
     		if ( 'off' !== $content_font || 'off' !== $header_font ) {
 			$font_families = array();
   			if ( 'off' !== $content_font ) {
 				$font_families[] = $content_font;
 			}
   			if ( 'off' !== $header_font ) {
 				$font_families[] = $header_font;
 			}
   			$query_args = array(
 				'family' =>  urlencode(implode( '|', array_unique(apply_filters('superpress_font_families',$font_families)) )),
 			);
   			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
 		}
   		return apply_filters('superpress_google_font_args',esc_url_raw( $fonts_url ));
 	}
} 