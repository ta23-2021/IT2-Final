<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
if ( has_custom_logo() && isset($logo[0]) ) { ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo get_bloginfo('name'); ?>">
    <?php if ( !get_theme_mod( 'amandalite_hide_tagline') ) { ?>
	    <span class="tag-line"><?php echo get_bloginfo( 'description'); ?></span>
	<?php  } ?>
    </a>
<?php
} else { ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="text-logo"><?php bloginfo('name'); ?></span>
        
        <?php if ( !get_theme_mod( 'amandalite_hide_tagline') ) { ?>
		   <span class="tag-line"><?php echo get_bloginfo( 'description'); ?></span>
		<?php  } ?>
    </a><?php
}