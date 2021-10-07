<?php 
get_header(); 
?>
<div class="main-contaier">
    <div class="container">
    	<div class="row justify-content-md-center">
	    	<div class="page-content error-page col-md-10 col-lg-8">
	    	<h1 class="page-title"><?php echo esc_html__( '404', 'amandalite' ); ?></h1>
            <p><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'amandalite' ); ?></p>
			<?php get_search_form(); ?>
    		</div>
    	</div>
    </div>
</div>
<?php get_footer(); ?>
