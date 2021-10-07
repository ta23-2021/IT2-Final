<?php
/**
* Customizer Setup and Custom Controls
*
* Adds the individual sections, settings, and controls to the theme customizer
*/
class Superpress_Initialise_Customizer_Settings {
 	// Get our default values
	private $defaults;
	var $path;
	public function __construct() {
		$this->path = trailingslashit( get_template_directory() ) . 'inc/superpress-customizer/customizers/';
 		// Get our Customizer defaults
		$this->defaults = superpress_generate_defaults();
 		// Register customizer Panel
		add_action( 'customize_register', array( $this, 'superpress_customizer_panels' ) );
 		// Register customizer sections
		add_action( 'customize_register', array( $this, 'superpress_customizer_sections' ) );
 		// Register Header Option Controls
		add_action( 'customize_register', array( $this, 'superpress_register_header_controls' ) );
 	 	// Register Typography Controls
		add_action( 'customize_register', array( $this, 'superpress_register_typography_controls' ) );
    	//Register Bread Banner Controls
		add_action( 'customize_register', array($this,'superpress_register_bread_banner_controls') );
    	//Register Page Option Controls
		add_action( 'customize_register', array($this,'superpress_register_page_settings_controls') );
    	//Register Archive Option Controls
		add_action( 'customize_register', array($this,'superpress_register_archive_settings_controls') );
 		// Register Footer Controls
		add_action( 'customize_register', array( $this, 'superpress_register_footer_settings_controls' ) );
 		// Register Theme Color Controls
		add_action( 'customize_register', array( $this, 'superpress_register_theme_color_controls' ) );
 		// superpress Theme active callback
		add_action( 'customize_register', array( $this, 'superpress_registre_theme_active_callback' ) );
 		// Register woocommerce controls
		if (class_exists('woocommerce')) {
			add_action( 'customize_register', array( $this, 'superpress_woocommerce_controls' ) );
		}
	}
   	/**
 	 * Register the Customizer panels
 	 */
   	public function superpress_customizer_panels( $wp_customize ) {
 		/**
 		 * Add superpress Theme Options Panel
 		 */
 		$wp_customize->add_panel( 'superpress_general_settings_panel',
 			array(
 				'title' => esc_html__( 'General', 'superpress' ),
 				'priority' =>1,
 			)
 		);
	    /**
	     * Header settings
	     */
	    $wp_customize->add_panel( 'superpress_header_panel',
	    	array(
	    		'title' => esc_html__( 'Header', 'superpress' ),
	    		'priority' =>2,
	    	)
	    );
 		/**
 		 * Typography setting
 		 */
 		$wp_customize->add_panel( 'superpress_typography_panel',
 			array(
 				'title' => esc_html__( 'Typography', 'superpress' ),
 				'priority' =>3,
 			)
 		);
	    /**
	     * Breadcrumb Banner setting
	     */
	    $wp_customize->add_panel( 'superpress_breadcrumb_panel',
	    	array(
	    		'title' => esc_html__( 'Breadcrumb', 'superpress' ),
	    		'priority' =>4,
	    	)
	    );
	    /**
	     * Page Settings
	     */
	    $wp_customize->add_panel( 'superpress_page_panel',
	    	array(
	    		'title' => esc_html__( 'Page', 'superpress' ),
	    		'priority' =>5,
	    	)
	    );
	    /**
	     * Archive Settings
	     */
	    $wp_customize->add_panel( 'superpress_archive_panel',
	    	array(
	    		'title' => esc_html__( 'Blog', 'superpress' ),
	    		'priority' =>6,
	    	)
	    );
	    /**
	     * Shop Settings
	     */
	    $wp_customize->add_panel( 'superpress_shop_panel',
	    	array(
	    		'title' => esc_html__( 'Shop', 'superpress' ),
	    		'priority' =>7,
	    	)
	    );
 		/**
 		 * Footer Settings
 		 */
 		$wp_customize->add_panel( 'superpress_footer_panel',
 			array(
 				'title' => esc_html__( 'Footer', 'superpress' ),
 				'priority' =>8,
 			)
 		);
 	}
   	/**
 	 * Register the Customizer sections
 	 */
   	public function superpress_customizer_sections( $wp_customize ) {

 		$wp_customize->add_section( 'body_style',
 			array(
 				'title' => esc_html__( 'Body Style', 'superpress' ),
 				'panel' => 'superpress_typography_panel',
 				'priority' => 10
 			)
 		);
   		/**
 		 * Heading section
 		 */
   		$wp_customize->add_section( 'superpress_heading_style',
   			array(
   				'title' => esc_html__( 'Heading Style', 'superpress' ),
   				'panel' => 'superpress_typography_panel',
   				'priority' => 20
   			)
		   );
   		/**
 		 * Font Awesome
 		 */
   		$wp_customize->add_section( 'superpress_font_awesome_style',
   			array(
   				'title' => esc_html__( 'Font Awesome', 'superpress' ),
   				'panel' => 'superpress_typography_panel',
   				'priority' => 20
   			)
		   );
		/**
 		 * Heading section
 		 */
		  $wp_customize->add_section( 'superpress_primary_menu_style',
		  array(
			  'title' => esc_html__( 'Primary Menu Style', 'superpress' ),
			  'panel' => 'superpress_header_panel',
			  'priority' => 20
		  )
	  );
 		/**
 		 * Header Layout Section
 		 */
 		$wp_customize->add_section('header_customizer_setting',
 			array(
 				'title' 	  => esc_html__('Header Layouts' , 'superpress'),
 				'priority' => 10,
 				'panel'   => 'superpress_header_panel'
 			)
 		);
 		/**
 		 * Header Style Section
 		 */
 		$wp_customize->add_section('superpress_header_styles',
 			array(
 				'title' 	  => esc_html__('Header Styles' , 'superpress'),
 				'priority' => 20,
 				'panel'   => 'superpress_header_panel'
 			)
 		);
	    /**
	     * Breadcrumb Banner Section
	     */
	    $wp_customize->add_section('superpress_breadcrumb_banner_section',
	    	array(
	    		'title'     => esc_html__('Banner Settings' , 'superpress'),
	    		'panel'     => 'superpress_breadcrumb_panel',
	    		'priority' => 10
	    	)
	    );
	    /**
	     * Breadcrumb Settings Section
	     */
	    $wp_customize->add_section('superpress_breadcrumb_section',
	    	array(
	    		'title'     => esc_html__('Breadcrumb Settings' , 'superpress'),
	    		'panel'     => 'superpress_breadcrumb_panel',
	    		'priority' => 20
	    	)
	    );
	    /**
	     * Page Settings Section
	     */
	    $wp_customize->add_section('superpress_page_setting_section',
	    	array(
	    		'title'     => esc_html__('Page Contents' , 'superpress'),
	    		'panel'     => 'superpress_page_panel',
	    		'priority' => 10
	    	)
	    ); 
	    /**
	     * Page Sidebar Settings Section
	     */
	    $wp_customize->add_section('superpress_page_sidebar_section',
	    	array(
	    		'title'     => esc_html__('Sidebar Settings' , 'superpress'),
	    		'panel'     => 'superpress_page_panel',
	    		'priority' => 20
	    	)
	    ); 
	    /**
	     * Blog Page Settings Section
	     */
	    $wp_customize->add_section('superpress_blog_page_section',
	    	array(
	    		'title'     => esc_html__('Archive Settings' , 'superpress'),
	    		'panel'     => 'superpress_archive_panel',
	    		'priority' => 10
	    	)
	    ); 
	    /**
	     * Blog Single Post Settings Section
	     */
	    $wp_customize->add_section('superpress_single_post_section',
	    	array(
	    		'title'     => esc_html__('Single Post Settings' , 'superpress'),
	    		'panel'     => 'superpress_archive_panel',
	    		'priority' => 20
	    	)
	    ); 
	    /**
	     * Archive Sidebar Settings Section
	     */
	    $wp_customize->add_section('superpress_archive_sidebar_section',
	    	array(
	    		'title'     => esc_html__('Sidebar Settings' , 'superpress'),
	    		'panel'     => 'superpress_archive_panel',
	    		'priority' => 30
	    	)
	    ); 
	    /**
	     * Meta Reorder Section
	     */
	    $wp_customize->add_section('superpress_meta_setting_section',
	    	array(
	    		'title'     => esc_html__('Meta Settings' , 'superpress'),
	    		'panel'     => 'superpress_archive_panel',
	    		'priority' => 40
	    	)
	    ); 
	    /**
	     * Shop Settings Section
	     */
	    $wp_customize->add_section('superpress_shop_setting_section',
	    	array(
	    		'title'     => esc_html__('Shop Page' , 'superpress'),
	    		'panel'     => 'superpress_shop_panel',
	    		'priority' => 10
	    	)
	    ); 
	    /**
	     * Related Product Section
	     */
	    $wp_customize->add_section('superpress_shop_related_section',
	    	array(
	    		'title'     => esc_html__('Related Products' , 'superpress'),
	    		'panel'     => 'superpress_shop_panel',
	    		'priority' => 20
	    	)
	    ); 
	    /**
	     * Mini Cart Section
	     */
	    $wp_customize->add_section('superpress_mini_cart_section',
	    	array(
	    		'title'     => esc_html__('Mini Cart' , 'superpress'),
	    		'panel'     => 'superpress_header_panel',
	    		'priority' => 30
	    	)
	    ); 
 		/**
 		 * Footer Layout Section
 		 */
 		$wp_customize->add_section('superpress_footer_layout_section',
 			array(
 				'title' 	  => esc_html__('Footer Layouts' , 'superpress'),
 				'panel' 	  => 'superpress_footer_panel',
 				'priority' => 10
 			)
 		);
	    /**
	     * Footer Scroll Top Section
	     */
	    $wp_customize->add_section('superpress_scroll_top_section',
	    	array(
	    		'title'     => esc_html__('Scroll Top' , 'superpress'),
	    		'panel'     => 'superpress_footer_panel',
	    		'priority' => 20
	    	)
	    );
 		/**
 		 * Theme color
 		 */
 		$wp_customize->add_section( 'superpress_theme_color_section',
 			array(
 				'title' => esc_html__( 'Theme Color', 'superpress' ),
 				'panel'  	  => 'superpress_general_settings_panel'
 			)
		 );
		 /**
 		 * Additional settings
 		 */
		  $wp_customize->add_section( 'superpress_additional_setting_section',
		  array(
			  'title' => esc_html__( 'Additional settings', 'superpress' ),
			  'panel'  	  => 'superpress_general_settings_panel'
		  )
	  );
	  $wp_customize->add_section( 'superpress_additional_setting_section',
		  array(
			  'title' => esc_html__( 'Additional settings', 'superpress' ),
			  'panel'  	  => 'superpress_general_settings_panel'
		  )
	  );

 		/**
 		 * Default Section Management
 		 */
 		$wp_customize ->get_section( 'title_tagline' )->panel = 'superpress_general_settings_panel';
 		$wp_customize ->get_section( 'colors' )->panel = 'superpress_general_settings_panel';
 		$wp_customize ->get_section( 'background_image' )->panel = 'superpress_general_settings_panel';
 		$wp_customize ->get_section( 'static_front_page' )->priority = 40;
 		$wp_customize ->remove_section( 'header_image' );
 	}
 	/**
 	 * Register Header Controls
 	 */
 		
 	public function superpress_register_header_controls( $wp_customize ) {
 		require_once $this->path.'header/header.php';
	 	require_once $this->path.'header/design.php';
 	}
 	/**
 	 * Register Typography Controls
 	 */
 	public function superpress_register_typography_controls( $wp_customize ) {
 		require_once $this->path.'typography/body.php';
 		require_once $this->path.'typography/heading.php';
 	}
	/**
	* Register Breadcrumb Banner controls
	*/
	public function superpress_register_bread_banner_controls( $wp_customize ) {
		require_once $this->path.'bread-banner/banner.php';
		require_once $this->path.'bread-banner/breadcrumb.php';
	}
	/**
	* Register Page controls
	*/
	public function superpress_register_page_settings_controls( $wp_customize ) {
		require_once $this->path.'page/page.php';
		require_once $this->path.'page/sidebar.php';
	}
	/**
	* Register Archive controls
	*/
	public function superpress_register_archive_settings_controls( $wp_customize ) {
		require_once $this->path.'archive/blog.php';
		require_once $this->path.'archive/single.php';
		require_once $this->path.'archive/sidebar.php';
		require_once $this->path.'archive/meta.php';
	}
 	/**
 	 * Register footer controls
 	 */
 	public function superpress_register_footer_settings_controls( $wp_customize ) {
 		require_once $this->path.'footer/footer.php';
 		require_once $this->path.'footer/scroll-top.php';
 	}
 	
 	/**
 	 * Register theme color
 	 */
 	public function superpress_register_theme_color_controls( $wp_customize ){
 		require_once $this->path.'theme-color/theme-color.php';
 	}
 	/**
 	* Register woocommerce control
 	*/
 	public function superpress_woocommerce_controls($wp_customize){
 		require_once $this->path.'woocommerce/shop.php';
 		require_once $this->path.'woocommerce/related.php';
 		require_once $this->path.'woocommerce/mini-cart.php';
 	}
 	/**
 	* Register callback functions
 	*/
 	public function superpress_registre_theme_active_callback() {
 		require_once $this->path.'callback/active-callback.php';
 	}
 }   	
/**
* Load all our Customizer Custom Controls
*/
require_once trailingslashit( dirname(__FILE__) ) . 'custom-controls.php';
/**
* Initialise our Customizer settings
*/
$superpress_settings = new Superpress_Initialise_Customizer_Settings();