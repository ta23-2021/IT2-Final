<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Superpress
 */

?><?php
	/**
	 * Hook - superpress_action_doctype.
	 *
	 * @hooked superpress_doctype - 10
	 */
	do_action( 'superpress_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - superpress_action_head.
	 *
	 * @hooked superpress_head - 10
	 */
	do_action( 'superpress_action_head' );
	?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} 
	?>
	<?php
	/**
	 * Hook - superpress_action_before.
	 *
	 * @hooked superpress_page_start - 10
	 * @hooked superpress_skip_to_content - 15
	 */
	do_action( 'superpress_action_before' );
	?>

	<?php 
	//hook for inserting code after container div start
	do_action('superpress_scroll_to_top'); 

	//hook for inserting page header
	do_action('superpress_action_page_startup');
        