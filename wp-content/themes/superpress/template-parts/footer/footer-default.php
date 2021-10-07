<?php 
$copyright = get_theme_mod('superpress_copyright_text');
$copyright = strtr($copyright, array("[date]"=>date('Y'), "[site-title]"=>get_bloginfo()));

?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="right-resurved">
			<p>
				<?php 
				if($copyright){
					echo wp_kses_post($copyright);
				}else{
					/* translators: %s, %s: Copyright year, Powered by text */
					printf( esc_html__( 'Copyright &copy; %1$s | Powered by %2$s', 'superpress' ), esc_html(date("Y")).' '.esc_html(get_bloginfo()), '<a href=" ' . esc_url('https://prabhavanait.com') . ' " rel="designer" target="_blank">Prabhavanait Theme</a>' );
				}
				?>
			</p>
		</div>
	</div>
</footer><!-- #colophon -->