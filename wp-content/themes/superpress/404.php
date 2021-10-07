<?php
/**
* The template for displaying 404 pages (not found)
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package Superpress
*/
get_header();
$custom_404 = get_theme_mod('superpress_404_layouts','default');
if($custom_404 == 'custom'){
	do_action('superpress_custom_404');
}else{
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<div class="container">
					<div class="page-header">
						<h1 class="page-title"><?php esc_html_e( '404 Error', 'superpress' ); ?></h1>
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'superpress' ); ?></p>
					</div><!-- .page-header -->
					<div class="page-content">
						<a class="btn btn-404" href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e('Back to Home' , 'superpress')?></a>
					</div><!-- .page-content -->
				</div>
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
}
get_footer();
