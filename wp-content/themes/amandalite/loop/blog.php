<?php

$post_class_3cols = ( is_active_sidebar('sidebar') ) ? 'col-md-6 col-lg-6' : 'col-md-6 col-lg-4';

$word = 25;

?>
<div class="amandalite-blogs blog-grid">
    <div class="row mx-n4">
    <?php if ( have_posts() ) { $i = 0;?>
        <?php while ( have_posts() ) {
                the_post();
                $i++;
            ?>
                <article <?php post_class($post_class_3cols . ' px-4'); ?>>
                    <div class="post-inner">
                        <?php get_template_part('template-parts/post', 'format'); ?>                            
                        <div class="post-info">
                            <div class="post-cats"><?php the_category(' '); ?></div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php get_template_part('template-parts/post', 'meta'); ?>
                            <div class="post-content"><?php echo wp_trim_words( get_the_excerpt(), $word , '...' ) ?></div>
                            <a class="amandalite-button readmore" href="<?php the_permalink() ?>"><?php echo esc_html__( 'Read More','amandalite' ); ?></a>
                        </div>
                    </div>
                </article>                
        <?php } ?>
    <?php } ?>
    </div>
    <?php amandalite_pagination(); ?>
</div>