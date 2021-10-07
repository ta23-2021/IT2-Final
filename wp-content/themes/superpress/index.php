<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Superpress
 */
get_header();
superpress_breadcrumb();

$sidebar_widget = superpress_sidebar_widget('archive');
$column_no = get_theme_mod('superpress_achive_column_no', 2);
$blog_layout = get_theme_mod('superpress_archive_layout', 'list');
$pagination_layout = get_theme_mod('superpress_blog_pagination_layouts', 'default');

$class = ($blog_layout != 'list') ? $blog_layout . ' col-'. $column_no : $blog_layout;
$class .= ' ' . $sidebar_widget;
?>

<main id="main" class="site-main">
	<section class="blog <?php echo esc_attr($class); ?>">
		<div class="container">
			<div id="primary" class="blog-content-wrapper">
				<?php
				if (have_posts()) :
					echo '<div class="blogs">';
					while (have_posts()) :
						the_post();

						get_template_part('template-parts/archive/archive', $blog_layout);
					endwhile;
					echo '</div>';
					if ($pagination_layout != 'infinite') {
						the_posts_pagination(array(
							'prev_text' => '<',
							'next_text'  => '>',
						));
					}
					do_action('superpress_after_blog_page');
				else :
					get_template_part('template-parts/content', 'none');
				endif;
				?>
			</div>
			<?php
			if ($sidebar_widget != "no-sidebar") {
				get_sidebar();
			}
			?>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();
