<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Theme_name' ) ) :
	
	class Theme_name {
		
		protected $suffix = '';
		
		public function __construct() {
			$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			
			$this->init_hooks();
			$this->includes();
			$this->init();
		}
		
		private function init_hooks() {
			add_action( 'wp_enqueue_scripts',   array( $this, 'load_styles_scripts'));
			add_action( 'after_setup_theme',	array( $this, 'setup' ) );
		}
		
		private function includes() {
			include 'class-theme_name-autoloader.php';
		}
		
		private function init() {
			new Theme_name_Customizer();
		}
		
		public function load_styles_scripts() {
			/****************
			 * Load styles
			 ****************/
			 
			if ( file_exists( get_stylesheet_directory() . '/assets/css/plugins' . $this->suffix . '.css' ) ) {
				wp_enqueue_style(	'theme_name-plugins',
									get_stylesheet_directory_uri() . '/assets/css/plugins' . $this->suffix . '.css',
									false,
									filemtime( get_stylesheet_directory() . '/assets/css/plugins' . $this->suffix . '.css' )
								);
			}
			wp_enqueue_style(	'theme_name-style', 
								get_stylesheet_directory_uri() . '/assets/css/main' . $this->suffix . '.css',
								false,
								filemtime( get_stylesheet_directory() . '/assets/css/main' . $this->suffix . '.css' )
							);
			
			/****************
			 * Load scripts
			 ****************/
			if ( file_exists( ( get_stylesheet_directory() . '/assets/js/plugins' . $this->suffix . '.js' ) ) ) {
				wp_enqueue_script(	'theme_name-plugins',	
									get_stylesheet_directory_uri(). '/assets/js/plugins' . $this->suffix . '.js',
									array('jquery'),
									filemtime( get_stylesheet_directory() . '/assets/js/plugins' . $this->suffix . '.js' ),
									true
								);
			}
			
		    wp_enqueue_script(	'theme_name-main',
		    					get_stylesheet_directory_uri(). '/assets/js/main' . $this->suffix . '.js',
		    					array('jquery'),
		    					filemtime( get_stylesheet_directory() . '/assets/js/main' . $this->suffix . '.js' ),
		    					true
		    				);
		    
		    wp_localize_script( 'theme_name-main', 	'global_data', array( 
		    								'ajax_url' 	=> admin_url( 'admin-ajax.php' ), 
		    								'theme_url' => get_stylesheet_directory_uri() ) );
		    
		    /****************
			 * load jquery in footer
			 ****************/
		    if( ! is_admin() ){
		        wp_deregister_script( 'jquery' );
		        wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
		        wp_enqueue_script( 'jquery' );
		    }
		}
		
		public function setup() {
			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */

			// Loads wp-content/languages/themes/theme_name-it_IT.mo.
			load_theme_textdomain( 'theme_name', trailingslashit( WP_LANG_DIR ) . 'themes/' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'theme_name', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/theme_name/languages/it_IT.mo.
			load_theme_textdomain( 'theme_name', get_template_directory() . '/languages' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets',
			) );
			
			/**
		     * Add default posts and comments RSS feed links to <head>.
		     */
		    add_theme_support( 'automatic-feed-links' );
		 

			// Declare WooCommerce support.
			add_theme_support( 'woocommerce' );

			// Declare support for title theme feature.
			add_theme_support( 'title-tag' );

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );
			
			register_nav_menus( array(
				'primary'       => 'Top menu',
			) );
		}
			
	}
	
endif;

return new Theme_name();
