<?php
    get_header();

    $amandalite_blog = amandalite_blog_configs();
    $col = ( !$amandalite_blog['hide_sidebar'] && is_active_sidebar('sidebar') ) ? 'has-sidebar col-md-12 col-lg-8 col-xl-9' : 'no-sidebar col-md-12';
?>

<?php if ( have_posts() ) { ?> 
<div class="main-contaier">
    <div class="container">
        <div class="row wrapper-main-content">
            <div class="<?php echo esc_attr( $col ); ?>">
                <h1 class="page-title"><?php echo esc_html__( 'Search results for "', 'amandalite' ) . get_search_query() . '"'; ?></h1>
                <?php
                    get_template_part( 'loop/blog');
                ?>
            </div>
            <?php if ( !$amandalite_blog['hide_sidebar'] && is_active_sidebar('sidebar') ) { ?>
            <div class="col-md-12 col-lg-4 col-xl-3">
                <aside id="sidebar" class="sidebar">
                    <?php dynamic_sidebar('sidebar'); ?>
                </aside>
            </div>
            <?php } ?>
        </div>
    </div>         
</div>
<?php } else {
    get_template_part('template-parts/post', 'none'); 
} ?>  
<?php get_footer(); ?>