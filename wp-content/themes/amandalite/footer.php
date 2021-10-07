    </div><!-- #amandalite-primary -->
    <footer id="amandalite-footer">
        <?php if ( get_theme_mod('amandalite_instagram_show') && is_active_sidebar('footer-ins') ) : ?>
        <div class="footer-ins">
            <div class="container">
            <?php dynamic_sidebar('footer-ins'); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if ( get_theme_mod('amandalite_social_footer_enable') ) { ?>
        <div class="footer-social">
            <div class="container">
            <?php get_template_part( 'template-parts/social', 'network' ) ?>
            </div>
        </div>
        <?php } ?>
        
        <div class="footer-copyright">
            <div class="copyright"><?php echo wp_kses_post( get_theme_mod('amandalite_footer_copyright_text', '&copy; Copyright 2021.') ); ?></div>
        </div>
    </footer>
</div>
<?php wp_footer(); ?>    
</body>
</html>