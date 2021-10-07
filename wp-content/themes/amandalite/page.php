<?php
    get_header();
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            $featured_image = null;
            if ( has_post_thumbnail() ) {
                $featured_image = amandalite_resize_image( get_post_thumbnail_id(), null, 1300, 750, true, false );
            } ?>
        
        <div class="main-contaier">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <div class="page-content">
                    <?php if ( $featured_image ) { ?>                        
                    <div class="page-image">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr__('Featured Image', 'amandalite'); ?>"/>
                    </div>
                    <?php } ?>
                    <div class="row justify-content-md-center">
                        <article <?php post_class('amandalite-page col-md-11 col-lg-10'); ?>>
                            <div class="page-excerpt">
                                <?php the_content(); ?>
                                <?php wp_link_pages(array('before'=>'<p class="page-nav">' . esc_html__( 'Pages:', 'amandalite' ), 'after' =>'</p>')); ?>
                            </div>
                            <?php comments_template( '', true );  ?>
                        </article>
                    </div>
                </div>
            </div>
        </div><?php
        }
    }
	get_footer();
	