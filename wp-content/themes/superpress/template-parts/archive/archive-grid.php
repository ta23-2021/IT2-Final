<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Superpress
 */
$current_post_id = get_the_ID();
$post_order = get_theme_mod('superpress_archive_content_reorder', 'featured_image,title,meta_tag,content,button,social_share');
$post_explodes = explode(',', $post_order);
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card">
		<?php
		foreach ($post_explodes as $post_explode) :
			if ('featured_image' === $post_explode && has_post_thumbnail()) {
				$post_image_url = get_the_post_thumbnail_url($current_post_id, 'superpress_archive_thumbnail');
		?>
				<figure>
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('superpress_archive_thumbnail', array('alt' => get_the_title(), 'class' => 'card-img-top')); ?>
					</a>
				</figure>
			<?php
			} elseif ('title' === $post_explode) {
			?>
				<h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php
			} elseif ('meta_tag' === $post_explode) {
				superpress_post_meta();
			} elseif ('content' === $post_explode) {
			?>
				<div class="card-text">
					<?php
					the_excerpt();
					?>
				</div>
				<?php
			} elseif ('social_share' === $post_explode) {				
				if(function_exists('superpress_social_share')){
					superpress_social_share();					
				}			
			} elseif ('button' === $post_explode) {
				$read_more = get_theme_mod('superpress_archive_button_text', __('Read More', 'superpress'));
				$btype = get_theme_mod('superpress_archive_button_type', 'button');
				if (!empty($read_more)) : ?>
					<a href="<?php the_permalink(); ?>" class="blog-btn <?php echo esc_attr($btype); ?>">
						<?php echo esc_html($read_more); ?>
					</a>
		<?php endif;
			}
		endforeach;
		?>
	</div>
</div>
<!-- <?php the_ID(); ?> -->