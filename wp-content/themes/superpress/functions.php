<?php
/**
 * superpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package superpress
 */
if( ! class_exists( 'Superpress_Theme_Setup' ) ){

	final class Superpress_Theme_Setup {

	    // Theme slug Name
	    public static $slug = 'superpress';

	    // Instance
	    private static $_instance = null;

	    /**
	    * SIngletone Instance Method
	    * @since 1.0.0
	    */
	    public static function instance() {
	        if( is_null( self::$_instance ) ) {
	            self::$_instance = new self();
	        }
	        return self::$_instance;
	    }

	    /**
	    * Construct Method
	    * @since 1.0.0
	    */
	    public function __construct() {
	        // Call Constants Method
	        $this->define_constants();
	        $this->superpress_file_includes();
	        add_action( 'init', [ $this, 'i18n' ] );
	        add_action( 'after_setup_theme', [$this,'superpress_setup'] );
			add_action( 'after_setup_theme', [$this,'superpress_content_width'],0);
			add_action( 'widgets_init', [$this,'superpress_widgets_init'] );
			add_action( 'wp_enqueue_scripts', [$this,'scripts_styles'] );
			add_action('enqueue_block_editor_assets', [$this,'superpress_editor_styles']);
	    }

	    /**
	    * Define Theme Constants
	    * @since 1.0.0
	    */
	    public function define_constants() {

	    	// theme name
             $theme_data = wp_get_theme();
             define( 'THEME_NAME', esc_attr( $theme_data->Name ) );
			 if( ! defined( 'theme_ver' ) ) {
				// Replace the version number of the theme on each release.
				define( 'theme_ver', '1.0.0' );
			}
	    }

	    /**
	    * Load Scripts & Styles
	    * @since 1.0.0
	    */
	    public function scripts_styles() {

			/* Styles */
		    wp_enqueue_style( 'superpress-style', get_stylesheet_uri(), array(), theme_ver );
			wp_style_add_data( 'superpress-style', 'rtl', 'replace' );
			wp_enqueue_style('superpress-google-fonts', superpress_google_fonts_url(), array(), null);
			wp_register_style('slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.min.css');
			wp_register_style('slick', get_template_directory_uri() . '/assets/css/slick.min.css');
			wp_register_style('font-awesome', get_template_directory_uri() . '/assets/css/all.min.css');
			wp_enqueue_style('superpress-main-style', get_template_directory_uri() . '/assets/css/style.css');
			wp_enqueue_style('superpress-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

			/* Scripts */
			wp_register_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), theme_ver, true);
			wp_register_script('isotop', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('jquery'), theme_ver, true);

			if (is_archive() || is_home()) {
			wp_enqueue_script('isotop');
			}
			wp_enqueue_script( 'superpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), theme_ver, true );
			wp_enqueue_script('superpress-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), theme_ver, true);
			if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
			}
	    }

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function superpress_widgets_init() {
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar', 'superpress' ),
					'id'            => 'sidebar-1',
					'description'   => esc_html__( 'Add widgets here.', 'superpress' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}

	    /**
	    * Load Text Domain
	    * @since 1.0.0
	    */
	    public function i18n() {
	       load_theme_textdomain( 'superpress', get_template_directory() . '/languages' );
	    }

	    /**
		 * Enqueue editor styles for Gutenberg
		 */
		function superpress_editor_styles(){
			wp_enqueue_style('superpress-gutenberg-editor', get_template_directory_uri() . '/assets/css/style-editor.css');
		}
	    /**
	    * Initialize the Theme
	    * @since 1.0.0
	    */
		public function superpress_setup() {
		
			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( "wp-block-styles" );
			 add_theme_support( "responsive-embeds" );
			// This theme uses wp_nav_menu() in one location.
			add_theme_support('align-wide');
			add_image_size('superpress_archive_thumbnail', 460, 290, true); //update from 365, 230
			add_image_size('superpress_archive_default', 360, 450, true);
			add_image_size('superpress_widget_rcp_size', 300, 150, true);

			register_nav_menus(
				array(
					'menu-1' => esc_html__( 'Primary', 'superpress' ),
				)
			);
			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			$args = 
			add_theme_support('html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'style',
					'script',
				)

			);
			add_theme_support( 'custom-header' );
			// Set up the WordPress core custom background feature.
			add_theme_support('custom-background',apply_filters('superpress_custom_background_args',
					array(
						'default-color' => 'ffffff',
						'default-image' => '',
					)
				)
			);
			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );
			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
			add_theme_support('custom-logo',
				array(
					'height'      => 250,
					'width'       => 250,
					'flex-width'  => true,
					'flex-height' => true,
				)
			);
		}
		 /**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 * Priority 0 to make it available to lower priority callbacks.
		 * @global int $content_width
		 */
		public function superpress_content_width() {
			$GLOBALS['content_width'] = apply_filters( 'superpress_content_width', 640 );
		}
	    // Function to include helper functions
	    public function superpress_file_includes(){

			require get_template_directory() . '/inc/custom-header.php';
			// Load Theme config file
			$theme_paths = array(
				'inc/superpress-functions.php',
				'inc/module/structure.php',
				'inc/superpress-customizer/functions.php',
				'inc/customizer.php',
				'inc/template-functions.php',
				'inc/template-tags.php',
				'inc/custom-header.php',
				'inc/module/dynamic-style.php',
				'inc/module/superpress-google-fonts.php',
				'inc/module/breadcrumb.php',
				'inc/module/dynamic-sidebar.php',
				'inc/widgets/custom-widgets.php',
			);
			foreach ($theme_paths as $theme_path) {
				if(locate_template (array($theme_path))){
					require_once trailingslashit(get_parent_theme_file_path()) . $theme_path;
				}
			}
			/**
			 * Load Jetpack compatibility file.
			 */
			if ( defined( 'JETPACK__VERSION' ) ) {
				require get_template_directory() . '/inc/jetpack.php';
			}

			/**
			 * Load WooCommerce compatibility file.
			 */
			if (class_exists('WooCommerce')) {
				require get_template_directory() . '/inc/module/woocommerce.php';
				require get_template_directory() . '/inc/widgets/woocommerce-widgets.php';
			}
			require get_template_directory() . '/inc/superpress-tgmpa.php';
	    }
	}
}
Superpress_Theme_Setup::instance();
