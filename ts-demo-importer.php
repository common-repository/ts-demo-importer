<?php
/*
  Plugin Name: TS Demo Importer
  Description: TS Demo Importer will allow you to add features of customizer and widgets. Which will be visible on front page of site.
  Version: 0.1.2
  Author: Themeshopy
  Text Domain: ts-demo-importer
  Author URI: http://www.themeshopy.com/
 */
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Version constant for easy CSS refreshes
if( ! function_exists('get_plugin_data') ) {
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
// print_r($plugin_data);
$plugin_data = get_plugin_data( __FILE__ );

define( 'TS_DEMO_IMPOTER', $plugin_data['Version']);
define( 'TS_DEMO_IMPOTER_POSTTYPE', $plugin_data['Version']);
define( 'TS_DEMO_IMPOTER_EXT_FILE', __FILE__ );
define( 'TS_DEMO_IMPOTER_DIR', plugin_dir_path(__FILE__));
define( 'TS_DEMO_IMPOTER_URL', plugin_dir_url(__FILE__));
define( 'TS_DEMO_IMPOTER_LICENSE_API_ENDPOINT', 'https://www.themeshopy.com/wp-json/ibtana-licence/v2/' );
define( 'TS_DEMO_IMPOTER_WP_PLUGINS_DIR', str_replace( 'ts-demo-importer/', '', plugin_dir_path( TS_DEMO_IMPOTER_EXT_FILE ) ) );
define( 'TDI_TEXT_DOMAIN', 'ts-demo-importer' );

if( ! function_exists('get_plugin_data') ) {
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

class TS_Demo_Importer_Initial_Setup {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new TS_Demo_Importer_Initial_Setup();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_all_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_all_templates' )
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_all_template')
		);

		add_filter(
			'single_template',
			array( $this, 'override_single_template')
		);

		// Add your templates to this array.
		$this->templates = array(
			'page-template/home-page.php' => 'Home Page',
			'page-template/blog-fullwidth-extend.php' => 'Blog Fullwidth Extend',
			'page-template/blog-with-left-sidebar.php' => 'Blog With Left Sidebar',
			'page-template/blog-with-right-sidebar.php' => 'Blog With Right Sidebar',
			'page-template/blog-with-left-right-sidebar.php' => 'Blog With Left And Right Sidebar',
			'page-template/page-with-left-sidebar.php' => 'Page With Left Sidebar',
			'page-template/page-with-no-sidebar.php' => 'Page With No Sidebar',
			'page-template/page-with-right-sidebar.php' => 'Page With Right Sidebar',
			'page-template/page-with-left-right-sidebar.php' => 'Page Left / Right Sidebar',
			'page-template/about-us.php' => 'About Us',
			'page-template/team.php' => 'Team',
			'page-template/projects.php' => 'Projects',
			'page-template/hiring.php' => 'Hiring',
			'page-template/blog-page.php' => 'Blog',
			'page-template/contact-us.php' => 'Contact Us'
		);

		if (!is_admin()) {
      		// add_action( 'wp_enqueue_scripts','ts_demo_importer_plugin_assets' );
      		add_action( 'wp_enqueue_scripts',  array($this,'ts_demo_importer_plugin_assets') );
        }

        // add_action('after_setup_theme', 'ts_demo_importer_plugin_load_plugin');
        add_action( 'after_setup_theme',  array($this,'ts_demo_importer_plugin_load_plugin') );

	}

	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_all_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_all_template( $template ) {

		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
		)] ) ) {
			return $template;
		}

		$file = plugin_dir_path( __FILE__ ). get_post_meta(
			$post->ID, '_wp_page_template', true
		);

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}

	function ts_demo_importer_plugin_assets() {

		$custom_css = "";

		wp_enqueue_style( 'ts-demo-importer-basic-style', get_stylesheet_uri() );

    $cssFileStyle = wp_get_theme()->get( 'TextDomain' ) . '-style';
	  	wp_enqueue_style( 'main-style', TS_DEMO_IMPOTER_URL.'assets/css/main-css/'.$cssFileStyle.'.css',true, null,'all' );
	  	wp_style_add_data( 'main-style', 'rtl', 'replace' );

	  	/* Inline style sheet */
		include_once( plugin_dir_path(__FILE__) . 'inline_style.php' );
		wp_add_inline_style( 'main-style',$custom_css );

	  	if(is_rtl()){
		    wp_enqueue_style( 'rtl-plugin-style', plugin_dir_path(__FILE__).'style-rtla.css',true, null,'all');
		    wp_add_inline_style( 'rtl-plugin-style',$custom_css );
	  	}

	  	else{
	      // ---------- CSS Enqueue -----------
        $cssFileOtherPages = wp_get_theme()->get( 'TextDomain' ) . '-other-pages';
	      if(is_front_page() || is_home()){

          $cssFileHomePage = wp_get_theme()->get( 'TextDomain' ) . '-home-page';
	        wp_enqueue_style( 'home-page-style', TS_DEMO_IMPOTER_URL. 'assets/css/main-css/'.$cssFileHomePage.'.css', null, '1.0.0' );
	        wp_add_inline_style( 'home-page-style',$custom_css );

	      }else{

	      	wp_enqueue_style( 'other-page-style', TS_DEMO_IMPOTER_URL. 'assets/css/main-css/'. $cssFileOtherPages .'.css', null, '1.0.0' );
	        wp_add_inline_style( 'other-page-style',$custom_css );
	      }

	      if('post' == get_post_type() && is_home()){
	        wp_enqueue_style( 'other-page-style', TS_DEMO_IMPOTER_URL . 'assets/css/main-css/'. $cssFileOtherPages .'.css',true, null,'all');
	        wp_add_inline_style( 'other-page-style',$custom_css );
	      }

        $cssFileMobileMain = wp_get_theme()->get( 'TextDomain' ) . '-mobile-main';

        wp_enqueue_style( 'responsive-style', TS_DEMO_IMPOTER_URL.'assets/css/main-css/'.$cssFileMobileMain.'.css',true, null,'screen and (max-width: 1920px) and (min-width: 320px)' );

	      wp_add_inline_style( 'header-footer-style',$custom_css );
	      wp_add_inline_style( 'responsive-media-style',$custom_css );
	    }

	    if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
	      wp_enqueue_style( 'amp-style', TS_DEMO_IMPOTER_URL.'/assets/css/main-css/amp-style.css',true, null,'all' );
    	}
    	else{
			wp_enqueue_style( 'owl-carousel-style', TS_DEMO_IMPOTER_URL.'/assets/css/owl.carousel.css' );
			wp_enqueue_style( 'slick-slider-style', TS_DEMO_IMPOTER_URL.'/assets/css/slick.css' );

			wp_enqueue_style( 'aos-css',TS_DEMO_IMPOTER_URL.'/assets/css/aos.css' );
			// ---------- JS Enqueue -----------
			wp_enqueue_script( 'aos.js', TS_DEMO_IMPOTER_URL . '/assets/js/aos.js',array(),TS_DEMO_IMPOTER);
      wp_enqueue_script( 'owl-carousel', TS_DEMO_IMPOTER_URL . '/assets/js/owl.carousel.js',array('jquery'),TS_DEMO_IMPOTER ,true);
      wp_enqueue_script( 'slick-slider-js', TS_DEMO_IMPOTER_URL . '/assets/js/slick.js',array('jquery'),TS_DEMO_IMPOTER ,true);

			wp_enqueue_script( 'smooth-scroll', TS_DEMO_IMPOTER_URL . '/assets/js/SmoothScroll.js', array(), TS_DEMO_IMPOTER);
			//wp_enqueue_script( 'ts-demo-importer-customscripts', TS_DEMO_IMPOTER_URL . '/assets/js/custom.js', array('jquery'), TS_DEMO_IMPOTER, true );

      wp_register_script('ts-demo-importer-customscripts', TS_DEMO_IMPOTER_URL . '/assets/js/custom.js', array('jquery'), TS_DEMO_IMPOTER , true);
    	wp_localize_script(
    		'ts-demo-importer-customscripts',
    		'ts_demo_importer_customscripts',
    		array(
    			'is_rtl' => is_rtl(),
          'theme_text_domain' => wp_get_theme()->get( 'TextDomain' )
    		)
    	);
    	wp_enqueue_script( 'ts-demo-importer-customscripts' );

    	}
	}

	function ts_demo_importer_plugin_load_plugin() {

		// $theme = ts_demo_importer_plugin_text_domain();
		// if(in_array("multi-advance", $theme)){
		// 	include_once( plugin_dir_path(__FILE__) . 'include.php' );
		// }

		include_once( plugin_dir_path(__FILE__) . 'posttype/custom-posttype.php' );

		include_once( plugin_dir_path(__FILE__) . 'page-banner/title-banner-image.php' );

		include_once( plugin_dir_path(__FILE__) . 'inc/customize/customizer.php' );

		include_once( plugin_dir_path(__FILE__) . 'inc/widget/contact-widget.php' );

		include_once( plugin_dir_path(__FILE__) . 'inc/widget/socail-widget.php' );

		include_once( plugin_dir_path(__FILE__) . 'inc/widget/support-widget.php' );

		include_once(plugin_dir_path(__FILE__) . 'theme-wizard/config.php' );

		include_once(plugin_dir_path(__FILE__) . 'inc/breadcrumbs.php' );

		include_once(plugin_dir_path(__FILE__) . 'inc/custom-functions.php' );

		include_once(plugin_dir_path(__FILE__) . 'inc/breadcrumbs.php' );

		include_once(plugin_dir_path(__FILE__) . 'shortcodes/shortcodes.php' );
	}

	function override_single_template( $single_template ){
	    global $post;

	    $file = dirname(__FILE__) .'/posttype/single-'. $post->post_type .'.php';

	    if( file_exists( $file ) ) $single_template = $file;

	    return $single_template;
	}
}

add_action( 'plugins_loaded', array( 'TS_Demo_Importer_Initial_Setup', 'get_instance' ) );

define('TS_buy_now_url','https://www.themeshopy.com/themes/creative-wordpress-theme/');
