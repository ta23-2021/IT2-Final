<div  id="amandalite-menumodal" class="amandalite-menu-touch cover-modal d-lg-none">
    <div class="logo-navbar">
        <?php get_template_part( 'template-parts/logo', 'site' ) ?>
    </div>
    <div class="main-menu-vertical">
        <?php
            wp_nav_menu( array (
                'container' => false,
                'theme_location' => 'primary',
                'menu_class' => 'amandalite-main-menu amandalite-menu-vertical',
                'depth' => 10,
            ) );
        ?>
    </div>
</div>