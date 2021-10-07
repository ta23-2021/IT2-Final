<?php 
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) :
	$category_ids = array();
	foreach($categories as $individual_category) {
        $category_ids[] = $individual_category->term_id;
	}
	$args = array(
		'category__in'        => $category_ids,
		'post__not_in'        => array($post->ID),
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => 1,
		'orderby'             => 'rand'
	);
	$new_query = new WP_Query( $args );
?>
    <?php if( $new_query->have_posts() ) : ?>
    <div class="post-related amandalite-blog">
        <h3 class="post-related-title"><?php esc_html_e('Related Posts', 'amandalite'); ?></h3>
        <div class="row">
        <?php while( $new_query->have_posts() ) : $new_query->the_post(); ?>
            <div class="col-md-4 item-relate post">
                <div class="inner-post">
                    <?php $featured_image = amandalite_resize_image( get_post_thumbnail_id(), null, 600, 410, true, true );  ?>
                    <div class="post-format">
                        <a class="post-image" style="background-image: url('<?php echo esc_url($featured_image);?>');" href="<?php the_permalink()?>"></a>
                    </div>
                    <div class="post-info">
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="date-post"><?php echo esc_html( get_the_date() ); ?></span>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
		</div> 
    </div>
    <?php endif; ?>
<?php endif;
$post = $orig_post;
wp_reset_postdata();