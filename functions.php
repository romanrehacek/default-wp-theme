<?php

require_once 'inc/disable-comments.php';
require_once 'inc/disable-embeds.php';
require_once 'inc/theme-options.php';
require_once 'inc/menus.php';
require_once 'inc/custom_post_types.php';
require_once 'inc/defaults.php';

add_action( 'init',                     'r_theme_defaults__default' );
//add_action( 'admin_menu',             'r_theme_defaults__remove_menus' );
add_action( 'wp_enqueue_scripts',       'r_theme_defaults__load_styles_scripts',	30);
add_action( 'after_setup_theme',        'r_add_custom_menus');
add_action( 'widgets_init',             'r_add_widget_areas' );
add_action( 'after_setup_theme',        'r_add_theme_support_title');

// set CSS and JS files suffix
$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

/*
 * Functions
 */
function r_add_theme_support_title() {
    add_theme_support( 'title-tag' );
}

function r_theme_defaults__remove_menus(){
    remove_menu_page( 'tools.php' );    //Tools
}

/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function r_theme_defaults__load_styles_scripts() {
	global $suffix;
	
	/**
	 * Styles
	 */
	if (file_exists( get_stylesheet_directory() . '/css/plugins.css' )) {
		wp_enqueue_style('r-plugins',     get_stylesheet_directory_uri() . '/css/plugins.css',  			false, filemtime( get_stylesheet_directory() . '/css/plugins.css' ));
	}
    wp_enqueue_style('r-main',			get_stylesheet_directory_uri() . '/css/main' . $suffix . '.css',	false, filemtime( get_stylesheet_directory() . '/css/main' . $suffix . '.css' ));


	/**
	 * Scripts
	 */
	if (file_exists(( get_stylesheet_directory() . '/js/plugins.js' ))) {
		wp_enqueue_script('r-plugins',	get_stylesheet_directory_uri(). '/js/plugins.js',				array('jquery'), filemtime( get_stylesheet_directory() . '/js/plugins.js' ), true);
	}
    wp_enqueue_script('r-main',			get_stylesheet_directory_uri(). '/js/main' . $suffix . '.js',	array('jquery'), filemtime( get_stylesheet_directory() . '/js/main' . $suffix . '.js' ), true);
    
    wp_localize_script( 'r-main', 	'global_data', array( 
    								'ajax_url' 	=> admin_url( 'admin-ajax.php' ), 
    								'theme_url' => get_stylesheet_directory_uri() ) );
    
    // load jquery in footer
    if( !is_admin()){
        wp_deregister_script('jquery');
        wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
        wp_enqueue_script('jquery');
    }
}

function r_add_custom_menus() {
    register_nav_menus( array(
		'primary'       => 'Top menu',
	) );
}

function r_theme_defaults__default() {
    add_theme_support( 'post-thumbnails' );

    //add_image_size('581x235', 581, 235);

}

function r_add_widget_areas() {
    /*
    register_sidebar(array(
            'name' => '',
            'id' => '',
            'before_widget' => false,
            'after_widget' => false,
            'before_title' => '',
            'after_title' => ''
    ));
    */
}

function vd($result, $var_dump = false, $die = false) {
	echo '<pre>';
	
	if (!$var_dump) {
		print_r($result);
	} else {
		var_dump($result);
	}
	
	echo '</pre>';
	
	if ($die) {
		die();
	}
}
