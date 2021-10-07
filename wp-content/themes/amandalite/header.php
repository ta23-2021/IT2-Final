<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#content">
    <?php esc_html_e( 'Skip to content', 'amandalite' ); ?></a>
    <div class="body-overlay"></div>
    <div class="main-wrapper-boxed">
        <header id="amandalite-header" class="header">
            <div class="header-wrapper">
                <div class="header-maintop">
                    <?php get_template_part( 'template-parts/social', 'network') ?>
                    <div id="nav-wrapper" class="nav-main main-menu-horizontal d-none d-lg-block">
                        <?php
                            wp_nav_menu( array (
                                'container' => false,
                                'theme_location' => 'primary',
                                'menu_class' => 'amandalite-main-menu',
                                'depth' => 10,
                            ) );
                        ?>
                    </div>
                    <div class="header-search">                    
                        <a class="navbar-search toggle-modal" href="javascript:void(0)" data-toggle-target=".inner-search-header" aria-expanded="false" data-toggle-body-class="showing-search-modal" data-set-focus=".inner-search-header .text"><i class="fas fa-search"></i></a>

                        <a class="menu-touch d-lg-none toggle-modal" href="javascript:void(0)" data-toggle-target=".amandalite-menu-touch" data-toggle-body-class="showing-menu-modal" data-set-focus=".logo-navbar a" aria-expanded="false">
                            <div class="navbar-toggle">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        
                    </div>
                </div>
                <div class="amandalite-logo"> 
                    <?php if ( is_front_page() ) { ?>
                    <h1>
                        <?php get_template_part( 'template-parts/logo', 'site' ) ?>
                    </h1>
                    <?php  } else { ?>
                    <h2>
                        <?php get_template_part( 'template-parts/logo', 'site' ) ?>
                    </h2>
                    <?php } ?>
                </div>
            </div>
        </header>
        <?php get_template_part( 'template-parts/searchform', 'box' ) ?>
        <?php get_template_part( 'template-parts/menu', 'touch' ) ?>
        <div id="content" class="amandalite-primary">
    