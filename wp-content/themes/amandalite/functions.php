<?php
# Define
define('AMANDALITE_LIBS_URI', get_template_directory_uri() . '/libs/');
define('AMANDALITE_CORE_PATH', get_template_directory() . '/core/');
define('AMANDALITE_CORE_URI', get_template_directory_uri() . '/core/');
define('AMANDALITE_CORE_CLASSES', AMANDALITE_CORE_PATH . 'classes/');
define('AMANDALITE_CORE_FUNCTIONS', AMANDALITE_CORE_PATH . 'functions/');

# Set Content Width
if ( ! isset( $content_width ) ) { $content_width = 1530; }

# After setup theme
add_action('after_setup_theme', 'amandalite_setup');
function amandalite_setup()
{
    load_theme_textdomain('amandalite', get_template_directory().'/languages');
    add_theme_support( 'custom-logo' );
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
	register_nav_menus(array('primary' => esc_html__('Main Menu', 'amandalite')));
	add_theme_support('post-formats', array( 'image', 'video', 'audio', 'gallery'));
    add_theme_support( 'custom-background' );
    add_theme_support( 'woocommerce' );
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');
}


# Google Fonts
add_action( 'wp_enqueue_scripts', 'amandalite_enqueue_googlefonts' );
function amandalite_enqueue_googlefonts()
{
    $fonts_url = '';
    $Quicksand = _x( 'on', 'Quicksand: on or off', 'amandalite' );
    $Cormorant_Garamond = _x( 'on', 'Cormorant Garamond: on or off', 'amandalite' );
    if( 'off' != $Quicksand  || 'off' != $Cormorant_Garamond )
    {
        $font_families = array();
        if ( 'off' !== $Quicksand ) $font_families[] = 'Quicksand:400,600';
        if ( 'off' !== $Cormorant_Garamond ) $font_families[] = 'Cormorant Garamond:700';
        $query_args = array('family' => urlencode(implode('|', $font_families)), 'subset' => urlencode('latin,latin-ext'));
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    wp_enqueue_style('amandalite-googlefonts', esc_url_raw($fonts_url), array(), null);
}

add_action( 'enqueue_block_editor_assets', 'amandalite_enqueue_googlefonts' );

# Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'amandalite_load_scripts' );
function amandalite_load_scripts()
{
    # CSS
    wp_enqueue_style('bootstrap', AMANDALITE_LIBS_URI . 'bootstrap/bootstrap.css');
    wp_enqueue_style('amandaliet-font-awesome', AMANDALITE_LIBS_URI . 'font-awesome/css/all.css');
    wp_enqueue_style('chosen', AMANDALITE_LIBS_URI . 'chosen/chosen.css');
     wp_enqueue_style('amandalite-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('amandalite-theme-style', get_template_directory_uri() . '/assets/css/theme.css');

    # JS
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_script('fitvids', AMANDALITE_LIBS_URI . 'fitvids/fitvids.js', array(), false, true);
    wp_enqueue_script('chosen', AMANDALITE_LIBS_URI . 'chosen/chosen.js', array(), false, true);
    wp_enqueue_script('amandalite-scripts', get_template_directory_uri() . '/assets/js/amandalite-scripts.js', array(), false, true);
    
    if ( is_singular() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}


# Register Sidebar
add_action( 'widgets_init', 'amandalite_widgets_init' );
function amandalite_widgets_init() {
    register_sidebar(array(
		'name'            => esc_html__('Sidebar', 'amandalite'),
		'id'              => 'sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
    register_sidebar(array(
		'name'            => esc_html__('Footer Instagram', 'amandalite'),
		'id'              => 'footer-ins',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
    register_sidebar(array(
        'name'            => esc_html__('Newsletter Widget', 'amandalite'),
        'id'              => 'newsletter',
        'before_widget'   => '<div id="%1$s" class="widget %2$s">',
        'after_widget'    => '</div>',
        'before_title'    => '<h4 class="widget-title">',
        'after_title'     => '</h4>'
    ));
}

# Check file exists
function amandalite_require_file( $path ) {
    if ( file_exists($path) ) {
        require $path;
    }
}

# Require file
amandalite_require_file( get_template_directory() . '/core/init.php' );


# Comment Layout
function amandalite_custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		<div class="comment-author">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="comment-content">
		    <h4 class="author-name"><?php echo get_comment_author_link(); ?></h4>
			<div class="date-comment">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( esc_html__('%1$s at %2$s', 'amandalite'), get_comment_date(),  get_comment_time() ); ?></a>
			</div>
			<div class="reply">
				<?php edit_comment_link( esc_html__( '(Edit)', 'amandalite' ), '  ', '' );?>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'amandalite' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

# Pagination
function amandalite_pagination()
{
    if ( get_the_posts_pagination() ) : ?>
    <div class="amandalite-pagination"><?php
        $args = array(
            'prev_text' => '<span class="fa fa-angle-left"></span>',
            'next_text' => '<span class="fa fa-angle-right"></span>'
        );
        the_posts_pagination($args);
    ?>
    </div>
    <?php
    endif;
}

/* Convert hexdec color string to rgb(a) string */
 
function amandalite_hex2rgba($color) {
 
    $default = 'rgb(0,0,0)';
 
    //Return default if no color provided
    if(empty($color))
          return $default; 
 
    //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        $output = implode(",",$rgb);
        //Return rgb color string
        return $output;
}

# Include the TGM_Plugin_Activation class
add_action('tgmpa_register', 'amandalite_register_required_plugins');
function amandalite_register_required_plugins()
{
	$plugins = array(

		array(
			'name'   => esc_html__('Contact Form 7', 'amandalite'),
			'slug'   => 'contact-form-7'
		),       
        array(
			'name'   => esc_html__('MailChimp for WordPress', 'amandalite'),
			'slug'   => 'mailchimp-for-wp'
		),
        array(
            'name'   => esc_html__('Smash Balloon Instagram Feed', 'amandalite'),
            'slug'   => 'instagram-feed'
        ),
        
	);

	$config = array(
		'id'           => 'amandalite',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => ''
	);
	tgmpa($plugins, $config);
}