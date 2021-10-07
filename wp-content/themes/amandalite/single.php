<?php 
    get_header();
    $col = ( is_active_sidebar('sidebar') ) ? 'has-sidebar col-md-12 col-lg-8 col-xl-9 px-4' : 'no-sidebar px-4 col-md-12';
 ?>
<div class="main-contaier">
    <div class="container">
        <div class="row wrapper-main-content mx-n4">
            <div class="<?php echo esc_attr($col); ?>">
                <?php
                    while ( have_posts() ) {
                        the_post();
                        ?>
                    <div class="amandalite-single-post">
                        <article <?php post_class('post-single'); ?>>
                            <div class="post-inner">
                                <div class="post-header">
                                    <div class="post-cats"><?php the_category(' '); ?></div>
                                    <h1 class="post-title"><?php the_title(); ?></h1>
                                    <?php get_template_part('template-parts/post', 'meta'); ?>  
                                </div>
                                <?php get_template_part('template-parts/post', 'format'); ?>
                                <div class="post-info">
                                                        
                                    <div class="post-content">
                                        <?php
                                            the_content();
                                            wp_link_pages(
                                                array(
                                                    'before'   => '<p class="page-nav">' . esc_html__( 'Pages:', 'amandalite' ),
                                                    'after'    => '</p>'
                                                )
                                            );
                                        ?>
                                    </div>
                                    <?php get_template_part('template-parts/post', 'footer'); ?>
                                </div>
                            </div>
                        </article>
                        <?php get_template_part( 'template-parts/single', 'post-related' ); ?>
                        <?php
                            if ( comments_open() || get_comments_number() ) :
                                comments_template('', true);
                            endif;
                        ?>    
                    </div>
                <?php } ?>
            </div>
            <?php if ( is_active_sidebar('sidebar') ) { ?>
            <div class="col-md-12 col-lg-4 col-xl-3 px-4">
                <?php get_sidebar() ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
