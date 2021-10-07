<?php
/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Superpress
 */
get_header();
superpress_breadcrumb();

$sidebar_widget = superpress_sidebar_widget('page');
?>
<?php do_action('superpress_before_page');?>
<main id="main" class="site-main <?php echo esc_attr($sidebar_widget);?>">

	<div class="<?php superpress_container();?>">

        <?php do_action('superpress_before_page_content');?>

		<div id="primary" class="page-content-wrapper">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile;
			?>
		</div>
		<?php do_action('superpress_after_page_content');?>
		<?php 
		if($sidebar_widget != "no-sidebar"){
			get_sidebar(); 
		}	
		?>
	</div>
</main>
<?php do_action('superpress_after_page');?>
<?php
get_footer();
