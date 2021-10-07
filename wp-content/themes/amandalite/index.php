<?php
    get_header();

    $col = ( is_active_sidebar('sidebar') ) ? 'has-sidebar col-md-12 col-lg-8 col-xl-9 px-4' : 'no-sidebar px-4 col-md-12';
?>
<?php
    if (is_active_sidebar( 'newsletter' )) {
?>
    <div class="ss-newsletter">
        <div class="container">
            <?php dynamic_sidebar('newsletter'); ?>
        </div>
    </div>
<?php        
    }
?>

<div class="main-contaier">
    <div class="container">
        <div class="row wrapper-main-content mx-n4">
            <div class="<?php echo esc_attr($col); ?>">
                <?php
                    get_template_part( 'loop/blog');
                ?>
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
