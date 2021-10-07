<?php
/**
 * Theme functions related to structure.
 *
 * @package Superpress
 */

if ( ! function_exists( 'superpress_doctype' ) ) :

	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
	function superpress_doctype() {
		?><!DOCTYPE html><html <?php language_attributes(); ?>><?php
	}
endif;

add_action( 'superpress_action_doctype', 'superpress_doctype', 10 );

if ( ! function_exists( 'superpress_buzz_head' ) ) :

	/**
	 * Header Codes.
	 *
	 * @since 1.0.0
	 */
	function superpress_buzz_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open() ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;

add_action( 'superpress_action_head', 'superpress_buzz_head', 10 );

if ( ! function_exists( 'superpress_skip_to_content' ) ) :

	/**
	 * Add skip to content.
	 *
	 * @since 1.0.0
	 */
	function superpress_skip_to_content() {
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'superpress' ); ?></a><?php
	}
endif;

add_action( 'superpress_action_before', 'superpress_skip_to_content');

if ( ! function_exists( 'superpress_page_start' ) ) :

	/**
	 * Page Start.
	 *
	 * @since 1.0.0
	 */
	function superpress_page_start() {
		?><div id="page" class="hfeed site"><?php 
	}
endif;

add_action( 'superpress_action_before', 'superpress_page_start', 15 );

if ( ! function_exists( 'superpress_page_header' ) ) :

	/**
	 * Page Header.
	 *
	 * @since 1.0.0
	 */
	function superpress_page_header() {

		$header_layout = superpress_get_page_options('header_type','default');
		if($header_layout == 'default'){
			$header_layout = get_theme_mod('superpress_header_layouts','default');
		}
	    do_action('superpress_before_header');
		if ($header_layout != 'hide'): ?>
			<header class="site-header">
				<?php get_template_part('template-parts/header/header',$header_layout);?>
			</header>
		<?php endif;?>	
		<?php do_action('superpress_after_header');?>
		<div id="content" class="site-content"> 
	<?php }
endif;

add_action( 'superpress_action_page_startup', 'superpress_page_header');

if ( ! function_exists( 'superpress_footer_section' ) ) :
	function superpress_footer_section(){
		$footer_layout = superpress_get_page_options('footer_type','default');
		if($footer_layout == 'default'){
			$footer_layout = get_theme_mod('superpress_footer_layouts','default');
		}
		if ($footer_layout != 'hide'):
		   get_template_part('template-parts/footer/footer',$footer_layout);
		endif;
	}
endif;

add_action( 'superpress_action_footer_section', 'superpress_footer_section');