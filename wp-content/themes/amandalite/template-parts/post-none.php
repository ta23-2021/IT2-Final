<div class="main-contaier">
    <div class="container">
    	<div class="row justify-content-md-center">
	    	<div class="page-content error-page col-md-10 col-lg-8">
	    		<h1 class="page-title"><?php echo esc_html__( 'Nothing Found', 'amandalite' ); ?></h1>
				<?php if (is_home() && current_user_can('publish_posts')) : ?>
				<p><?php printf(esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'amandalite'), admin_url('post-new.php')); ?></p>
				<?php elseif (is_search()) : ?>
				<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'amandalite'); ?></p>
				<?php get_search_form(); ?>
				<?php else : ?>
				<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'amandalite'); ?></p>
				<?php get_search_form(); ?>
				<?php endif; ?>
			</div>
		</div>
    </div>
</div>