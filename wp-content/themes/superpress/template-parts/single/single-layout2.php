<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Superpress
 */
$post_order = get_theme_mod( 'superpress_post_content_reorder', apply_filters('superpress_post_content_reorder_defaults','featured_image,title,meta_tag,content,social_share,coments,navigation'));
$post_explodes = explode(',', $post_order);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	foreach ($post_explodes as $post_explode):
		if ('featured_image' == $post_explode) {
			superpress_post_thumbnail('full'); 
		}elseif ('title' === $post_explode) {				
			?>
			<header class="entry-header">
				<h1><?php the_title(); ?></h1>
			</header>
			<?php
		}elseif('meta_tag' == $post_explode) {
			superpress_post_meta();
		}elseif('content' === $post_explode) {
			?>
			<div class="entry-content">
				<?php
				the_content();?>
			</div>
			<?php	
		}elseif ('social_share' === $post_explode) {
			if(function_exists('superpress_social_share')){
				superpress_social_share();
			}
		}elseif ('coments' === $post_explode) {
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		}elseif ('navigation' === $post_explode) {
			superpress_single_post_pagination();
		}

		apply_filters( 'superpress_post_reorder_sections', $post_explode );
	endforeach; 
	?>
</article><!-- #post-<?php the_ID(); ?> -->
