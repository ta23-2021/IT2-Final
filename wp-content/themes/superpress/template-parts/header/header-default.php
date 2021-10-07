<?php
$mini_cart_show = get_theme_mod('superpress_mini_cart_switch', true);
$mini_cart_style = get_theme_mod('superpress_mc_diaplay_style', 'dropdown');
$container = get_theme_mod('superpress_header_container_switch', 'default');
$c_class = ($container!='default') ? 'container':'container-fluid';

$tclass = superpress_transparent_menu();
?>
<div class="superpress-default-header <?php echo esc_attr($tclass); ?>">
	<div class="<?php echo esc_attr($c_class); ?>">
		<nav id="site-navigation" class="navbar navbar-expand-lg" role="navigation">
			<a class="navbar-toggler" data-target="#superpress-main-menu" tabindex="0">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</a>
			<div class="navbar-brand">
				<?php
				$page_logo = superpress_get_page_options('page_logo');
				$custom_logo_id = get_theme_mod('custom_logo');
				$custom_logo_image = wp_get_attachment_image_src($custom_logo_id, 'full');
				if ($page_logo) {
					$logo_src = wp_get_attachment_image_src($page_logo, 'full');
					echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home"><img src="' . esc_url($logo_src[0]) . '" class="custom-logo page-logo" alt="' . esc_attr(get_bloginfo("name")) . '"></a>';
				} else {
					$retina_logo = get_theme_mod('superpress_header_retina_logo');
					if (!empty($retina_logo)) {
						echo '<a class="retina-home-link" href="' . esc_url(home_url('/')) . '">';
						echo '<img class="retina-logo" src="' . esc_url($retina_logo) . '" alt="' . esc_attr(get_bloginfo("name")) . '">';
						echo '</a>';
					}
					if (empty($retina_logo) && has_custom_logo() ) {
						echo '<a class="retina-home-link" href="' . esc_url(home_url('/')) . '">';
						echo '<img class="retina-logo" src="' . esc_url($custom_logo_image[0]) . '" alt="' . esc_attr(get_bloginfo("name")) . '">';
						echo '</a>';
						
					}
					the_custom_logo();
				}
				$sticky_logo = get_theme_mod('superpress_header_sticky_logo');
				if ($sticky_logo) {
					echo '<a class="sticky-home-link" href="' . esc_url(home_url('/')) . '">';
					echo '<img class="sticky-logo" src="' . esc_url($sticky_logo) . '" alt="' . esc_attr(get_bloginfo("name")) . '">';
					echo '</a>';
				} 
				if (empty($sticky_logo) && has_custom_logo() ) {
					echo '<a class="sticky-home-link" href="' . esc_url(home_url('/')) . '">';
					echo '<img class="sticky-logo" src="' . esc_url($custom_logo_image[0]) . '" alt="' . esc_attr(get_bloginfo("name")) . '">';
					echo '</a>';
				}
				if (is_front_page() && is_home()) :
				?>
					<h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html(bloginfo('name')); ?></a></h2>
				<?php
				else :
				?>
					<h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html(bloginfo('name')); ?></a></h2>
				<?php
				endif;
				$superpress_description = get_bloginfo('description', 'display');
				if ($superpress_description || is_customize_preview()) :
				?>
					<p class="site-description"><?php echo esc_textarea($superpress_description); ?></p>
				<?php endif; ?>
			</div>
			<div id="superpress-main-menu" class="superpress-main-menu primary-navigation" id="navbarCollapse">
				<a class="navbar-toggler" tabindex="0">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</a>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class' 	 => 'navbar-nav',
						'add_li_class'   => 'nav-item',
						'container'		 => false,
						)
					);
				?>
			</div>
			<?php
			$show_search = get_theme_mod('superpress_show_search_switch', 0);
			if ($show_search == true) {
			?>
				<div class="search-icon">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" tabindex="0">
						<path d="M508.875,493.792L353.089,338.005c32.358-35.927,52.245-83.296,52.245-135.339C405.333,90.917,314.417,0,202.667,0
					S0,90.917,0,202.667s90.917,202.667,202.667,202.667c52.043,0,99.411-19.887,135.339-52.245l155.786,155.786
					c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125C513.042,504.708,513.042,497.958,508.875,493.792z
					 M202.667,384c-99.979,0-181.333-81.344-181.333-181.333S102.688,21.333,202.667,21.333S384,102.677,384,202.667
					S302.646,384,202.667,384z" />
					</svg>
					<div class="search-container">
						<?php echo get_search_form(); ?>
					</div>
				</div>
			<?php } ?>
			<?php
			if (class_exists('WooCommerce') && $mini_cart_show) {	?>
				<div class="mini-cart">
					<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo esc_attr($mini_cart_style); ?>">
						<span class="header-cart-count">
							<?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
						</span>
						<svg xmlns="http://www.w3.org/2000/svg" height="512pt" viewBox="0 -31 512.00026 512" width="512pt">
							<path d="m164.960938 300.003906h.023437c.019531 0 .039063-.003906.058594-.003906h271.957031c6.695312 0 12.582031-4.441406 14.421875-10.878906l60-210c1.292969-4.527344.386719-9.394532-2.445313-13.152344-2.835937-3.757812-7.269531-5.96875-11.976562-5.96875h-366.632812l-10.722657-48.253906c-1.527343-6.863282-7.613281-11.746094-14.644531-11.746094h-90c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15h77.96875c1.898438 8.550781 51.3125 230.917969 54.15625 243.710938-15.941406 6.929687-27.125 22.824218-27.125 41.289062 0 24.8125 20.1875 45 45 45h272c8.285156 0 15-6.714844 15-15s-6.714844-15-15-15h-272c-8.269531 0-15-6.730469-15-15 0-8.257812 6.707031-14.976562 14.960938-14.996094zm312.152343-210.003906-51.429687 180h-248.652344l-40-180zm0 0"></path>
							<path d="m150 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path>
							<path d="m362 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"></path>
						</svg>
					</a>
					<?php
					if ($mini_cart_style == 'dropdown') : ?>
						<div class="widget woocommerce widget_shopping_cart">
							<h4><?php echo esc_html__('Your Shopping Cart', 'superpress'); ?></h4>
							<div class="widget_shopping_cart_content">
								<?php woocommerce_mini_cart(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php } ?>
			<?php
			$show_btn = get_theme_mod('superpress_show_purchase_btn_switch', 0);
			$btn_text = get_theme_mod('superpress_purchase_btn_text', __('Purchase', 'superpress'));
			$btn_link = get_theme_mod('superpress_purchase_btn_link');
			$btn_link_new = get_theme_mod('superpress_purchase_btn_link_open', false);
			$btn_link_new = ($btn_link_new) ? 'target=_blank' : 'target=_self';
			
			if ($show_btn == 1) : ?>
				<div class="menu-btn-wrap">
					<a href="<?php echo esc_url($btn_link); ?>" class="btn btn-primary" <?php echo esc_attr($target); ?>>
						<?php echo esc_html($btn_text); ?>
					</a>
				</div>
			<?php endif; ?>
		</nav>
	</div>
</div>