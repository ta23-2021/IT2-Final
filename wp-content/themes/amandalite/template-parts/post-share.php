<?php 
 global $post;
$pin_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); 
?>
<div class="post-share">
	<span><?php echo esc_html__('Share : ','amandalite') ?></span>
    <a target="_blank" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() ); ?>"><i class="fab fa-facebook-f"></i></a>
	<a title="Click to share this post on Twitter" href="<?php echo esc_url( 'http://twitter.com/intent/tweet?text=Currently reading ' . get_the_title() .'&url=' .get_the_permalink() );?>" target="_blank" rel="noopener noreferrer">
		<i class="fab fa-twitter"></i>
	</a>
    <a target="_blank" href="<?php echo esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . esc_url($pin_image) . '&description=' . get_the_title() ); ?>"><i class="fab fa-pinterest"></i></a>
    <a target="_blank" href="<?php echo esc_url( 'http://www.linkedin.com/shareArticle?mini=true&url='. get_the_permalink() . '&title='.get_the_title() . '&source=' . get_bloginfo('name') ); ?>"><i class="fab fa-linkedin-in"></i></a>
</div>