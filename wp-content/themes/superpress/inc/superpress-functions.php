<?php 


/* Get Page Meta Options */
if (!function_exists('superpress_get_page_options')) {
	function superpress_get_page_options($key, $default = '')
	{
		$id = get_the_ID();
		$page_meta = get_post_meta($id, 'superpress_page_options', true);
		if (is_serialized($page_meta)) {
			$page_meta = unserialize($page_meta);
		}
		if (isset($page_meta[$key])) {
			return $page_meta[$key];
		} else {
			return $default;
		}
	}
}

/* Get Elementor Templates */
if (!function_exists('superpress_get_elementor_templates')) {
	function superpress_get_elementor_templates($type = '')
	{
		$args = [
			'post_type'         => 'elementor_library',
			'posts_per_page'    => -1,
		];

		if ($type) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms' => $type,
				]
			];
		}

		$page_templates = get_posts($args);

		$options = array();
		if (!empty($page_templates) && !is_wp_error($page_templates)) {
			$options[''] = esc_html__('Choose Template', 'superpress');
			foreach ($page_templates as $post) {
				$options[$post->ID] = $post->post_title;
			}
		}
		return $options;
	}
}

/**
 * Strip whitespace in dynamic style
 */
if (!function_exists('superpress_css_strip_whitespace')) {
	function superpress_css_strip_whitespace($css)
	{
		$replace = array(
			"#/\*.*?\*/#s" => "",  // Strip C style comments.
			"#\s\s+#"      => " ", // Strip excess whitespace.
		);
		$search = array_keys($replace);
		$css = preg_replace($search, $replace, $css);

		$replace = array(
			": "  => ":",
			"; "  => ";",
			" {"  => "{",
			" }"  => "}",
			", "  => ",",
			"{ "  => "{",
			";}"  => "}", // Strip optional semicolons.
			",\n" => ",", // Don't wrap multiple selectors.
			"\n}" => "}", // Don't wrap closing braces.
			//"} "  => "}\n", // Put each rule on it's own line.
		);
		$search = array_keys($replace);
		$css = str_replace($search, $replace, $css);

		return trim($css);
	}
}

function superpress_color_range($input, $min, $max)
{
	if ($input < $min) {
		$input = $min;
	}
	if ($input > $max) {
		$input = $max;
	}
	return $input;
}

function superpress_esc_color($input)
{

	if (false === strpos($input, 'rgba')) {
		// If string doesn't start with 'rgba' then santize as hex color
		$input = sanitize_hex_color($input);
	} else {
		// Sanitize as RGBa color
		$input = str_replace(' ', '', $input);
		sscanf($input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha);
		$input = 'rgba(' . superpress_color_range($red, 0, 255) . ',' . superpress_color_range($green, 0, 255) . ',' . superpress_color_range($blue, 0, 255) . ',' . superpress_color_range($alpha, 0, 1) . ')';
	}
	return $input;
}

/*superpress banner enable check */
if (!function_exists('superpress_is_banner_enable')) {
	function superpress_is_banner_enable()
	{

		$enable_banner_default = get_theme_mod('superpress_breadcrumb_banner_switch', true);
		if (is_page()) {
			$meta_banner = superpress_get_page_options('show_banner', 1);
			$enable_banner = ($enable_banner_default == true && $meta_banner) ? $meta_banner : false;
		} else {
			$enable_banner = $enable_banner_default;
		}

		return $enable_banner;
	}
}


/* Get Cat Lists */
$allowed_html = array(
		'span' => array(
			'class'
		)
	);
if (!function_exists('superpress_post_cat_lists')) :
	function superpress_post_cat_lists()
	{

		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			global $post;
			$label = get_theme_mod('superpress_meta_label_switch', true);
			if ($label == true) {
				$label_class = "meta-icon";
				$label_content = '';
			} else {
				$label_class = "meta-label";
				$label_content = '<span class="cat-label">Posted in: </span> ';
			}
			$categories = get_the_category();
			$output = '';
			if ($categories) {
				echo '<span class="post-cats ' . esc_attr($label_class) . '">' . wp_kses_post($label_content);

				$count = 0;
				foreach ($categories as $category) {
					$count++;
					if ($count > 1) {
						echo ', &nbsp;';
					}
					echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="cat-links cat-' . esc_attr($category->term_id) . '" rel="category">' . esc_html($category->cat_name) . '</a>';
				}
				echo '</span>';
			}
		}
	}
endif;

/* Get Post Tags */
if (!function_exists('superpress_get_post_tags')) :
	function superpress_get_post_tags()
	{
		if ('post' === get_post_type()) {
			$posttags = get_the_tags();
			if ($posttags) {
				$label = get_theme_mod('superpress_meta_label_switch', true);
				if ($label == true) {
					$label_class = "meta-icon";
					$label_content = '';
				} else {
					$label_class = "meta-label";
					$label_content = '<span class="tag-label">Tagged: </span> ';
				}
				echo '<span class="post-tags ' . esc_attr($label_class) . '">' . wp_kses_post($label_content);
				$count = 0;
				foreach ($posttags as $tag) {
					$count++;
					if ($count > 1) {
						echo ', &nbsp;';
					}
					echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-links tag-' . esc_attr($tag->term_id) . '" rel="tag">' . esc_html($tag->name) . '</a>';
				}
				echo '</span>';
			}
		}
	}
endif;

/* Superpress Container Check */
if (!function_exists('superpress_container')) {
	function superpress_container()
	{

		$container_disable = superpress_get_page_options('disable_container', 0);
		$container_type = superpress_get_page_options('container_width', 'container');
		$class = ($container_disable == 1) ? 'no-container' : $container_type;
		echo esc_attr($class);
	}
}

/* Get Author image */
if (!function_exists('superpress_get_by_author')) {
	function superpress_get_by_author()
	{
		global $post;
		$author_id = $post->post_author;
		$label = get_theme_mod('superpress_meta_label_switch', true);
		if ($label == true) {
			$label_content = '<span class="author-img">' . get_avatar(get_the_author_meta('ID'), 50) . '</span>';
		} else {
			$label_content = '<span class="author-by">By: </span> ';
		}
		$byline = sprintf(
			/*translators: author link */
			esc_html('%s'),
			'<span class="author vcard post-author"><a class="url" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . wp_kses_post( $label_content ) . '<span class="author-name">' . esc_html(get_the_author_meta('nickname', $author_id)) . '</span></a></span>'
		);
		echo '<span class="post-author">' . $byline . '</span>'; // phpcs:ignore
	}
}

/* superpress Post Meta */
if (!function_exists('superpress_post_meta')) {
	function superpress_post_meta()
	{
		$meta_show = get_theme_mod('superpress_meta_switch', true);
		if ($meta_show) :
			$meta_order = get_theme_mod('superpress_meta_reorder', 'author,date,category,tags,comments');
			$meta_explodes = explode(',', $meta_order);
			echo '<div class="meta-info">';
			foreach ($meta_explodes as $meta_explode) {
				if ('comments' === $meta_explode) {
					$label = get_theme_mod('superpress_meta_label_switch', true);
					if ($label == true) {
						$label_class = "meta-icon";
						$label_content = '';
					} else {
						$label_class = "meta-label";
						$label_content = '<span class="cat-label">Comments: </span> ';
					}
			?>
					<span class="post-comment <?php echo esc_attr($label_class); ?>">
						<?php echo wp_kses_post($label_content); ?>
						<a href="<?php echo esc_url(get_permalink()) ?>#comments">
							<?php
							echo absint(number_format_i18n(get_comments_number()));
							?>
						</a>
					</span>
				<?php
				} elseif ('category' === $meta_explode) {

					superpress_post_cat_lists();
				} elseif ('author' === $meta_explode) {

					superpress_get_by_author();
				} elseif ('date' === $meta_explode) {
					$label = get_theme_mod('superpress_meta_label_switch', true);
					if ($label == true) {
						$label_class = "meta-icon";
						$label_content = '';
					} else {
						$label_class = "meta-label";
						$label_content = '<span class="post-label">Posted on: </span> ';
					}
					echo '<span class="post-date ' . esc_attr($label_class) . '">' . wp_kses_post( $label_content );
					echo get_the_date();
					echo '</span>';
				} elseif ('tags' === $meta_explode) {
					superpress_get_post_tags();
				}
			}

			echo '</div>';
		endif;
	}
}
/* superpress Post Meta for layout 3 and 4*/
if (!function_exists('superpress_post_meta2')) {
	function superpress_post_meta2()
	{
		$meta_show = get_theme_mod('superpress_meta_switch', true);
		if ($meta_show) :
			$meta_order = get_theme_mod('superpress_meta_reorder', 'author,date,tags,comments');
			$meta_explodes = explode(',', $meta_order);
			echo '<div class="meta-info">';
			foreach ($meta_explodes as $meta_explode) {
				if ('comments' === $meta_explode) {
					$label = get_theme_mod('superpress_meta_label_switch', true);
					if ($label == true) {
						$label_class = "meta-icon";
						$label_content = '';
					} else {
						$label_class = "meta-label";
						$label_content = '<span class="cat-label">Comments: </span> ';
					}
				?>
					<span class="post-comment <?php echo esc_attr($label_class); ?>">
						<?php echo wp_kses_post($label_content); ?>
						<a href="<?php echo esc_url(get_permalink()) ?>#comments">
							<?php
							echo absint(number_format_i18n(get_comments_number()));
							?>
						</a>
					</span>
				<?php
				} elseif ('author' === $meta_explode) {

					superpress_get_by_author();
				} elseif ('date' === $meta_explode) {
					$label = get_theme_mod('superpress_meta_label_switch', true);
					if ($label == true) {
						$label_class = "meta-icon";
						$label_content = '';
					} else {
						$label_class = "meta-label";
						$label_content = '<span class="post-label">Posted on: </span> ';
					}
					echo '<span class="post-date ' . esc_attr($label_class) . '">' . wp_kses_post( $label_content );
					echo get_the_date();
					echo '</span>';
				} elseif ('tags' === $meta_explode) {
					superpress_get_post_tags();
				}
			}

			echo '</div>';
		endif;
	}
}

/* superpress archive excerpt length */
function superpress_excerpt_length($length)
{
	$excerpt_length =  get_theme_mod('superpress_archive_excerpt_lenghth', 35);
	return $excerpt_length;
}
add_filter('excerpt_length', 'superpress_excerpt_length', 999);

function superpress_excerpt_readmore()
{
	return ' ...';
}
add_filter('excerpt_more', 'superpress_excerpt_readmore');

/* superpress Sidebar Layouts */
if (!function_exists('superpress_sidebar_widget')) {
	function superpress_sidebar_widget($page = ''){
		switch ($page) {
			case 'page':
				$layout = superpress_get_page_options('sidebar_positions', 'default');
				$sidebar_layout = get_theme_mod('superpress_page_sidebar_layout','no-sidebar');
				$sidebar = ($layout == 'default') ? $sidebar_layout : $layout;
			break;

			case 'post':
				$single_sidebar = get_theme_mod('superpress_post_sidebar_layout', 'no-sidebar');
				$sidebar_layout = get_theme_mod('superpress_archive_sidebar_layout', 'right-sidebar');
				$no_sidebar = get_theme_mod('superpress_post_sidebar_layout', 'no-sidebar');
				$sidebar = empty($single_sidebar) ? $sidebar_layout : $no_sidebar;
				break;

			case 'archive':
				$sidebar = get_theme_mod('superpress_archive_sidebar_layout', 'right-sidebar');
				break;

			case 'shop':
				$sidebar = get_theme_mod('superpress_shop_sidebar_layout', 'right-sidebar');
				break;

			default:
				$sidebar = get_theme_mod('superpress_page_sidebar_layout', 'no-sidebar');
				break;
		}

		$sidebar_data = ($sidebar == 'no-sidebar') ? $sidebar : $sidebar .' has-sidebar';
		return $sidebar_data;
	}
}

/* superpress Banner Styles */
if (!function_exists('superpress_breadcrumb_styles')) {
	function superpress_breadcrumb_styles()
	{
		$b_color = get_theme_mod('superpress_bread_banner_bg_color');
		$b_image = get_theme_mod('superpress_bread_banner_bg_image');
		$b_overlay = get_theme_mod('superpress_bread_banner_bg_overlay', 'rgba(0, 0, 0, 0.1)');
		$b_height = get_theme_mod('superpress_bread_banner_height', 76);
		$text_color = get_theme_mod('superpress_bread_title_color');
		$text_size = get_theme_mod('superpress_bread_title_size');
		$bread_nav = get_theme_mod('superpress_bread_nav_color');
		$bread_nav_sep = get_theme_mod('superpress_bread_sep_color');
		$bread_nav_hover = get_theme_mod('superpress_bread_nav_hover_color');

		$bp_bgcolor = superpress_get_page_options('banner_bgcolor');
		$bp_image = superpress_get_page_options('banner_bgimage');
		if (!empty($bp_image)) {
			$bp_image = wp_get_attachment_image_url($bp_image, 'large');
		}
		$bp_height = superpress_get_page_options('banner_height');
		$bp_color = superpress_get_page_options('banner_textcolor');

		$bg_styles = array(
			'b-color' => !empty($bp_bgcolor) ? $bp_bgcolor : $b_color,
			'b-image' => !empty($bp_image) ? $bp_image : $b_image,
			'b-height' => !empty($bp_height) ? $bp_height : $b_height,
			'b-overlay' => $b_overlay,
			't-color' => !empty($bp_color) ? $bp_color : $text_color,
			't-size' => $text_size,
			'bread-sep-color' => $bread_nav_sep,
			'bread-color' => !empty($bp_color) ? $bp_color : $bread_nav,
			'bread-hover' => $bread_nav_hover
		);

		return $bg_styles;
	}
}


/* superpress Page Banner */
if (!function_exists('superpress_breadcrumb')) {
	function superpress_breadcrumb()
	{
		$bread_show = get_theme_mod('superpress_breadcrumb_switch', 1);
		if ($bread_show) {
			$bread_show = superpress_get_page_options('show_breadcrumb', 1);
		}
		$banner_styles = superpress_breadcrumb_styles();
		$title_position = get_theme_mod('superpress_banner_title_position', 'wide');

		if (!empty($banner_styles['b-image'])) {
			$title_position .= ' overlay has-bg-image';
		}

		$title_position .= ' header-' . superpress_transparent_menu();
		if (superpress_is_banner_enable()) : ?>
			<section class="breadcumb-section <?php echo esc_attr($title_position); ?>">
				<div class="container">
					<div class="title-banner-wrapper">
						<?php
						if (is_home()) {

							$title =  get_option('page_for_posts');
							if ($title) {
								echo '<h1 class="breadcrumb-title">' .  wp_kses_post(get_the_title($title)) . '</h1>';
							} else {
								echo '<h1 class="breadcrumb-title">' . esc_html__('Blog', 'superpress') . '</h1>';
							}
						} elseif (class_exists('woocommerce') && is_shop()) {
							echo '<h1 class="breadcrumb-title">';
							woocommerce_page_title();
							echo '</h1>';
						} elseif (class_exists('woocommerce') && is_product()) {

							the_title('<h1 class="breadcrumb-title">', '</h1>');
						} elseif (is_archive()) {
							the_archive_title('<h1 class="breadcrumb-title">', '</h1>');
						} elseif (is_single()) {
							the_title('<h1 class="breadcrumb-title">', '</h1>');
						} elseif (is_singular('page')) {
							wp_reset_postdata();
							$meta = get_post_meta(get_the_ID(), 'superpress_page_options', true);
							$custom_title = superpress_get_page_options('custom_title');
							$custom_subtitle = superpress_get_page_options('custom_subtitle');
							if ($custom_subtitle) {
								echo '<div class="custom-title-wrap">';
							}
							if ($custom_title) {
								echo '<h1 class="breadcrumb-title">' . esc_html($custom_title) . '</h1>';
							} else {
								echo '<h1 class="breadcrumb-title">' . esc_html(get_the_title()) . '</h1>';
							}
							if ($custom_subtitle) {
								echo '<p>' . wp_kses_post($custom_subtitle) . '</p>';
								echo '</div>';
							}
						} elseif (is_search()) {
						?>
							<h1 class="breadcrumb-title">
								<?php
								/* translators: %s: search term */
								printf(esc_html__('Search Results for: %s', 'superpress'), '<span>' . get_search_query() . '</span>'); ?>
							</h1>
						<?php
						} elseif (is_404()) {
						?>
							<h1 class="breadcrumb-title"><?php esc_html_e('404 Error', 'superpress'); ?></h1>
						<?php
						} else {
							the_archive_title('<h1 class="breadcrumb-title">', '</h1>');
						}
						if ($bread_show) {
							if (class_exists('woocommerce') && is_woocommerce()) {
								superpress_product_breadcrumb();
							} else {
								superpress_breadcrumbs();
							}
						}
						?>
					</div>
				</div>
			</section>
			<?php
		else :
			if ($bread_show) {
				echo '<div class="superpress-breadcrumb-wrap"><div class="container">';
				if (class_exists('woocommerce') && is_woocommerce()) {
					superpress_product_breadcrumb();
				} else {
					superpress_breadcrumbs();
				}
			}
			echo '</div></div>';
		endif;
	}
}

/* Superpress Transparent Header Check */
if (!function_exists('superpress_transparent_menu')) {
	function superpress_transparent_menu()
	{

		$trans_header = superpress_get_page_options('trans_header', 0);
		$trans_single = get_theme_mod('superpress_single_layout', 'layout2');

		if ($trans_header) {
			$class = 'is-transparent';
		} elseif ($trans_single == 'layout1' && is_single()) {
			$class = 'is-transparent';
		} else {
			$is_transparent = get_theme_mod('superpress_trans_header_switch', 0);
			$class = ($is_transparent == 1) ? 'is-transparent' :'';
		}
		if (class_exists('woocommerce') && is_product()) {
			$class = '';
		}
		return esc_attr($class);
	}
}

/* adding extra page options style and js assets */
if(!function_exists('superpress_meta_admin_assets') ) {
	function superpress_meta_admin_assets() {
		wp_enqueue_style('superpress-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array('wp-color-picker'));
		wp_enqueue_script('superpress-admin-js', get_template_directory_uri() . '/assets/js/admin.js', array('jquery', 'media-upload', 'thickbox', 'wp-color-picker'), '4.3.1', true);
	}
}
add_action('admin_enqueue_scripts', 'superpress_meta_admin_assets');

global $superpress_sidebar_widget;
$superpress_sidebar_widget = array(
	'default' => array(
		'value'     => 'default',
		'label'     => esc_html__('Default', 'superpress'),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/superpress-customizer/images/sidebar-none.png',
	),
	'left-sidebar' => array(
		'value'     => 'left-sidebar',
		'label'     => esc_html__('Left Sidebar', 'superpress'),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/superpress-customizer/images/sidebar-left.png',
	),
	'right-sidebar' => array(
		'value'     => 'right-sidebar',
		'label'     => esc_html__('Right Sidebar', 'superpress'),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/superpress-customizer/images/sidebar-right.png',
	),
	'no-sidebar' => array(
		'value'     => 'no-sidebar',
		'label'     => esc_html__('Full width', 'superpress'),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/superpress-customizer/images/full-width.png',
	),
);

add_action('add_meta_boxes', 'superpress_add_meta_box');
if (!function_exists('superpress_add_meta_box')) {
	function superpress_add_meta_box()
	{
		add_meta_box('additional-page-metabox-options', esc_html__('Superpress Page Options', 'superpress'), 'superpress_metabox_controls', 'page', 'normal', 'low');
	}
}

	function page_meta_int($key,$default){

		$data =isset($key) ? (int)$key : $default;
		return $data;
	}
	function page_meta_txt($key,$default){
		$data = isset($key) ? sanitize_text_field($key) : $default;
		return $data;
	}
	function page_meta_hex($key,$default){
		$data = isset($key) ? sanitize_hex_color($key) : $default;
	}

	function superpress_metabox_controls($post, $value = '')
	{
		global $superpress_sidebar_widget;
		$meta = get_post_meta($post->ID);
		$templates = superpress_get_elementor_templates();

		wp_nonce_field('superpress_control_meta_box', 'superpress_control_meta_box_nonce'); 
		// Always add nonce to your meta boxes!

		$page_meta = unserialize(get_post_meta($post->ID, 'superpress_page_options', true));

		$custom_header 		=isset($page_meta['custom_header']) ? $page_meta['custom_header'] :'';
		$trans_header 		=isset($page_meta['trans_header']) ? $page_meta['trans_header'] : 0;
		$page_logo 			=isset($page_meta['page_logo']) ?  $page_meta['page_logo'] : '';
		$show_banner 		=isset($page_meta['show_banner']) ? $page_meta['show_banner'] : 1;
		$show_breadcrumb 	=isset($page_meta['show_breadcrumb']) ? $page_meta['show_breadcrumb'] : 1;
		$banner_bgimage 	=isset($page_meta['banner_bgimage']) ? $page_meta['banner_bgimage'] : '';
		$disable_container 	=isset($page_meta['disable_container']) ? $page_meta['disable_container'] : 0;
		$custom_footer 		=isset($page_meta['custom_footer']) ? $page_meta['custom_footer'] : '';

		$header_type 		= isset($page_meta['header_type']) ? $page_meta['header_type'] : 'default';
		$custom_title 		= isset($page_meta['custom_title']) ? $page_meta['custom_title'] : '';
		$custom_subtitle 	= isset($page_meta['custom_subtitle']) ? $page_meta['custom_subtitle'] : '';
		$banner_height 		= isset($page_meta['banner_height']) ? $page_meta['banner_height'] : '';
		$container_width 	= isset($page_meta['container_width']) ? $page_meta['container_width'] : 'container';
		$sidebar_positions 	= isset($page_meta['sidebar_positions']) ?  $page_meta['sidebar_positions'] : 'default';
		$registerd_sidebar 	= isset($page_meta['registerd_sidebar']) ? $page_meta['registerd_sidebar'] : 'default';
		$footer_type 		= isset($page_meta['footer_type']) ? $page_meta['footer_type'] : 'default';

		$banner_bgcolor 	= isset($page_meta['banner_bgcolor']) ? $page_meta['banner_bgcolor']: '';
		$banner_textcolor 	= isset($page_meta['banner_textcolor']) ? $page_meta['banner_textcolor'] : '';
		

		
?>
		<div class="superpress-options-wrapper tabs">
			<ul class="tabs-nav">
				<li><a href="#header"><?php esc_html_e('Header', 'superpress') ?></a></li>
				<li><a href="#breadcrumb"><?php esc_html_e('Title Banner', 'superpress') ?></a></li>
				<li><a href="#container"><?php esc_html_e('Container', 'superpress') ?></a></li>
				<li><a href="#sidebar"><?php esc_html_e('Sidebar', 'superpress') ?></a></li>
				<li><a href="#footer"><?php esc_html_e('Footer', 'superpress') ?></a></li>
			</ul>
			<div class="tabs-stage">
				<div id="header" class="admin-tab">
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Header Type', 'superpress') ?></span>
						<select name="superpress_page_options[header_type]" id="superpress_header_layouts">
							<option value="default" <?php selected($header_type, 'default'); ?>><?php esc_html_e('Default', 'superpress'); ?></option>
							<option value="custom" <?php selected($header_type, 'custom'); ?>><?php esc_html_e('Custom', 'superpress'); ?></option>
							<option value="hide" <?php selected($header_type, 'hide'); ?>><?php esc_html_e('Hide', 'superpress'); ?></option>
						</select>
					</div>
					<?php if (defined('ELEMENTOR_VERSION')) : ?>
						<div class="superpress-option-wrap">
							<span class="title"><?php esc_html_e('Choose Custom Template', 'superpress') ?></span>
							<select name="superpress_page_options[custom_header]" id="superpress_custom_header">
								<?php
								if ($templates) {
									foreach ($templates as $ID => $template) :
								?>
										<option value="<?php echo esc_attr($ID); ?>" <?php selected($custom_header, $ID); ?>><?php echo esc_html($template); ?></option>
								<?php
									endforeach;
								}
								?>
							</select>
							<em><?php esc_html_e('Choose if custom header is selected.', 'superpress'); ?></em>
						</div>
					<?php endif ?>
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Transparent Header', 'superpress') ?> </span>
						<input type="checkbox" name="superpress_page_options[trans_header]" value="1" <?php checked($trans_header, 1); ?> />
					</div>
					<div class="superpress-option-wrap wordpress-uploader">
						<span class="title"><?php esc_html_e('Upload Page Logo', 'superpress') ?></span>
						<?php
						$image = __('Upload Logo', 'superpress');
						$image_size = 'full';
						$display = 'none';
						$class = 'button';
						$image_attributes = wp_get_attachment_image_src($page_logo, $image_size);
						if ($image_attributes) {
							$image = '<img src="' . esc_url($image_attributes[0]) . '"/>';
							$display = 'inline-block';
							$class = 'has-image';
						}
						?>
						<a href="#" class="superpress_upload_image_button <?php echo esc_attr($class); ?>"><?php echo wp_kses_post($image); ?></a>
						<input type="hidden" name="superpress_page_options[page_logo]" id="superpress_logo_image" value="<?php echo esc_attr($page_logo); ?> " />
						<a href="#" class="superpress_remove_image_button" style="display:inline-block;display:<?php echo esc_attr($display); ?>"><?php esc_html_e('Remove Image', 'superpress'); ?></a>
					</div>
				</div>
				<div id="breadcrumb" class="admin-tab">
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Show Banner', 'superpress') ?> </span>
						<div class="superpress-checkbox">
							<input id="show_banner" type="checkbox" name="superpress_page_options[show_banner]" value="1" <?php checked($show_banner, 1); ?> />
							<label for="show_banner"></label>
						</div>
						<?php
						$banner_en = esc_attr(get_theme_mod('superpress_breadcrumb_banner_switch', true));
						if (!$banner_en) {
						?>
							<span class="info">
								<em><?php esc_html_e('Banner is disabled from global setting in customizer.', 'superpress'); ?></em>
							</span>
						<?php } ?>
					</div>
					<div class="same-line-option">
						<div class="superpress-option-wrap">
							<span class="title"><?php esc_html_e('Custom Title', 'superpress') ?></span>
							<input type="text" name="superpress_page_options[custom_title]" value="<?php echo esc_attr($custom_title) ?>" />
						</div>
						<div class="superpress-option-wrap">
							<span class="title"><?php esc_html_e('Custom SubTitle', 'superpress') ?></span>
							<input type="text" name="superpress_page_options[custom_subtitle]" value="<?php echo esc_attr($custom_subtitle) ?>" />
						</div>
					</div>
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Banner Height', 'superpress') ?></span>
						<input type="number" name="superpress_page_options[banner_height]" value="<?php echo esc_attr($banner_height) ?>" />
					</div>
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Show Breadcrumb', 'superpress') ?> </span>
						<div class="superpress-checkbox">
							<input id="show_breadcrumb" type="checkbox" name="superpress_page_options[show_breadcrumb]" value="1" <?php checked($show_breadcrumb, 1); ?> />
							<label for="show_breadcrumb"></label>
						</div>
					</div>
					<div class="same-line-option">
						<div class="superpress-option-wrap">
							<span class="title"><?php esc_html_e('Background Color', 'superpress') ?></span>
							<input class="color-field" name="superpress_page_options[banner_bgcolor]" type="text" value="<?php echo esc_attr($banner_bgcolor); ?>">
						</div>
						<div class="superpress-option-wrap">
							<span class="title"><?php esc_html_e('Text Color', 'superpress') ?></span>
							<input class="color-field" name="superpress_page_options[banner_textcolor]" type="text" value="<?php echo esc_attr($banner_textcolor); ?>">
						</div>
					</div>
					<div class="superpress-option-wrap wordpress-uploader">
						<span class="title"><?php esc_html_e('Background Image', 'superpress') ?></span>
						<?php
						$image = __('Upload Image', 'superpress');
						$image_size = 'full';
						$display = 'none';
						$class = 'button';
						$image_attributes = wp_get_attachment_image_src($banner_bgimage, $image_size);
						if ($image_attributes) {
							$image = '<img src="' . esc_url($image_attributes[0]) . '"/>';
							$display = 'inline-block';
							$class = 'has-image';
						}
						?>
						<a href="#" class="superpress_upload_image_button <?php echo esc_attr($class); ?>"><?php echo wp_kses_post($image); ?></a>
						<input type="hidden" name="superpress_page_options[banner_bgimage]" id="superpress_banner_image" value="<?php echo esc_attr($banner_bgimage); ?> " />
						<a href="#" class="superpress_remove_image_button" style="display:inline-block;display:<?php echo esc_attr($display); ?>"><?php esc_html_e('Remove Image', 'superpress'); ?></a>
					</div>
				</div>
				<div id="container" class="admin-tab">
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Disable Container', 'superpress') ?> </span>
						<input type="checkbox" name="superpress_page_options[disable_container]" value="1" <?php checked($disable_container, 1); ?> />
					</div>
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Container Width', 'superpress') ?></span>
						<select name="superpress_page_options[container_width]" id="container_width">
							<option value="container" <?php selected($container_width, 'container'); ?>><?php esc_html_e('Container', 'superpress') ?></option>
							<option value="container-fluid" <?php selected($container_width, 'container-fluid'); ?>><?php esc_html_e('Container Fluid', 'superpress') ?></option>
						</select>
					</div>
				</div>
				<div id="sidebar" class="admin-tab">
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Sidebar position', 'superpress') ?></span>
						<table class="form-table">
							<tr>
								<td>
									<?php
									$i = 0;
									foreach ($superpress_sidebar_widget as $field) {
									?>
										<div class="radio-image-wrapper slidercat" id="slider-<?php echo esc_attr($i); ?>">
											<label for="img-radio-<?php echo esc_attr($i); ?>" class="description">
												<input id="img-radio-<?php echo esc_attr($i); ?>" type="radio" name="superpress_page_options[sidebar_positions]" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_attr( $field['value'] ), $sidebar_positions ); if(empty($sidebar_positions) && esc_attr( $field['value'] )=='default'){ echo "checked='checked'";  } ?>/>
												<span>
													<img title="<?php echo esc_html($field['label']); ?>" src="<?php echo esc_url($field['thumbnail']); ?>" />
												</span>
											</div>
									<?php $i++;
									}  ?>
								</td>
							</tr>
						</table>
					</div>
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Choose Sidebar', 'superpress') ?></span>
						<select name="superpress_page_options[registerd_sidebar]" id="registerd_sidebar">
							<option value="default"><?php esc_html_e('Default', 'superpress'); ?></option>
							<?php foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
								$sidebar_id = $sidebar['id'];
								$sidebar_name = $sidebar['name'];
							?>
								<option value="<?php echo esc_attr($sidebar_id); ?>" <?php selected($registerd_sidebar, $sidebar_id); ?>><?php echo esc_html($sidebar_name) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div id="footer" class="admin-tab">
					<div class="superpress-option-wrap">
						<span class="title"><?php esc_html_e('Footer Type', 'superpress') ?></span>
							<select name="superpress_page_options[footer_type]" id="superpress_footer_layouts">
								<option value="default" <?php selected($footer_type, 'default'); ?>><?php esc_html_e('Default', 'superpress'); ?></option>
								<option value="custom" <?php selected($footer_type, 'custom'); ?>><?php esc_html_e('Custom', 'superpress'); ?></option>
								<option value="hide" <?php selected($footer_type, 'hide'); ?>><?php esc_html_e('Hide', 'superpress'); ?></option>
							</select>
						</div>
						<?php if (defined('ELEMENTOR_VERSION')) : ?>
							<div class="superpress-option-wrap">
								<span class="title"><?php esc_html_e('Choose Footer Template', 'superpress') ?> </span>
								<select name="superpress_page_options[custom_footer]" id="superpress_custom_footer">
									<?php
									if ($templates) {
										foreach ($templates as $ID => $template) :
									?>
											<option value="<?php echo esc_attr($ID); ?>" <?php selected($custom_footer, $ID); ?>><?php echo esc_html($template); ?></option>
									<?php
										endforeach;
									}
									?>
								</select>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
<?php
	}

add_action('save_post', 'superpress_save_metaboxes');
if (!function_exists('superpress_save_metaboxes')) {
	/**
	 * Save controls from the meta boxes
	 *
	 * @param  int $post_id Current post id.
	 * @since 1.0.0
	 */
	function superpress_save_metaboxes($post_id)
	{
		/*
 		 * We need to verify this came from the our screen and with proper authorization,
 		 * because save_post can be triggered at other times. Add as many nonces, as you
 		 * have metaboxes.
 		 */
		if (!isset($_POST['superpress_control_meta_box_nonce']) || !wp_verify_nonce(sanitize_key($_POST['superpress_control_meta_box_nonce']), 'superpress_control_meta_box')) { // Input var okay.
			return $post_id;
		}
		// Check the user's permissions.
		if (isset($_POST['post_type']) && 'page' === $_POST['post_type']) { // Input var okay.
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}
		/*
 		 * If this is an autosave, our form has not been submitted,
 		 * so we don't want to do anything.
 		 */
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (isset($_POST['superpress_page_options'])) {
			//Sanitize Meta Fields
			$page_meta = wp_unslash($_POST['superpress_page_options']);

			$data['custom_header'] 		= page_meta_int($page_meta['custom_header'], 0);
			$data['trans_header'] 		= page_meta_int($page_meta['trans_header'], 0);
			$data['page_logo'] 			= page_meta_int($page_meta['page_logo'], '');
			$data['show_banner'] 		= page_meta_int($page_meta['show_banner'], 0);
			$data['show_breadcrumb'] 	= page_meta_int($page_meta['show_breadcrumb'], 0);
			$data['banner_bgimage'] 	= page_meta_int($page_meta['banner_bgimage'],'');
			$data['disable_container'] 	= page_meta_int($page_meta['disable_container'], 0);
			$data['custom_footer'] 		= page_meta_int($page_meta['custom_footer'],'');

			$data['header_type'] 		= page_meta_txt($page_meta['header_type'],'default');
			$data['custom_title'] 		= page_meta_txt($page_meta['custom_title'], '');
			$data['custom_subtitle'] 	= page_meta_txt($page_meta['custom_subtitle'], '');
			$data['banner_height'] 		= page_meta_txt($page_meta['banner_height'], '');
			$data['container_width'] 	= page_meta_txt($page_meta['container_width'], 'container');
			$data['sidebar_positions'] 	= page_meta_txt($page_meta['sidebar_positions'], 'default');
			$data['registerd_sidebar'] 	= page_meta_txt($page_meta['registerd_sidebar'], 'default');
			$data['footer_type'] 		= page_meta_txt($page_meta['footer_type'], 'default');

			$data['banner_bgcolor'] 	= page_meta_hex($page_meta['banner_bgcolor'], '');
			$data['banner_textcolor'] 	= page_meta_hex($page_meta['banner_textcolor'], '');
			//Save Meta Fields
			update_post_meta($post_id, 'superpress_page_options', serialize($data));
		}
	}
}



































