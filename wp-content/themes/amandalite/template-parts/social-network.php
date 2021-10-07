<?php 
    $empty = false;
    $facebook_url   = get_theme_mod('amandalite_facebook_url');
    $twitter_url    = get_theme_mod('amandalite_twitter_url');
    $instagram_url  = get_theme_mod('amandalite_instagram_url');
    $pinterest_url  = get_theme_mod('amandalite_pinterest_url');
    $youtube_url    = get_theme_mod('amandalite_youtube_url');
    $vimeo_url      = get_theme_mod('amandalite_vimeo_url');

    if ( $facebook_url == '' && $twitter_url == '' && $instagram_url =='' && $pinterest_url == '' && $youtube_url == '' && $vimeo_url == '' ) {
        $empty = true;
    }
    if ( ! $empty ) { ?>
        <div class="social-network">
            <?php if( $facebook_url ) { ?>
            <a href="<?php echo esc_url($facebook_url); ?>">
                <i class="fab fa-facebook-f"></i>
                <span class="social-slug"><?php echo esc_html__( 'Facebook', 'amandalite' ) ?></span>
            </a>
            <?php } ?>
            <?php if ( $twitter_url ){ ?>
            <a href="<?php echo esc_url($twitter_url); ?>">
                <i class="fab fa-twitter"></i>
                <span class="social-slug"><?php echo esc_html__( 'Twitter', 'amandalite' ) ?></span>
            </a>
            <?php } ?>
            <?php if( $pinterest_url ){ ?>
            <a href="<?php echo esc_url($pinterest_url); ?>">
                <i class="fab fa-pinterest"></i>
                <span class="social-slug"><?php echo esc_html__( 'Pinterest', 'amandalite' ) ?></span>
            </a>
            <?php } ?>
            <?php if( $instagram_url ){ ?>
            <a href="<?php echo esc_url($instagram_url); ?>">
                <i class="fab fa-instagram"></i>
                <span class="social-slug"><?php echo esc_html__( 'Instagram', 'amandalite' ) ?></span>
            </a>
            <?php } ?>
            <?php if( $youtube_url ){ ?>
            <a href="<?php echo esc_url($youtube_url); ?>">
                <i class="fab fa-youtube"></i>
                <span class="social-slug"><?php echo esc_html__( 'Youtube', 'amandalite' ) ?></span>
            </a>
            <?php } ?> 
            <?php if( $vimeo_url ){ ?>
            <a href="<?php echo esc_url($vimeo_url); ?>">
                <i class="fab fa-vimeo-v"></i>
                <span class="social-slug"><?php echo esc_html__( 'Vimeo', 'amandalite' ) ?></span>
            </a>
            <?php } ?>
        </div><?php
    }
 ?>