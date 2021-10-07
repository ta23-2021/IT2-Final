<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Superpress
 */
?>
 </div><!-- #content -->
<?php
//Hook for Inseting code before footer
do_action('superpress_before_footer');

//Hook for Inseting footer content
do_action('superpress_action_footer_section');

//Hook for Inserting code after footer
do_action('superpress_after_footer');

?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
