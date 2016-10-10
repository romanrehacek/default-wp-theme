<?php

require_once 'inc/disable-comments.php';
require_once 'inc/disable-embeds.php';
require_once 'inc/theme-options.php';
require_once 'inc/menus.php';
require_once 'inc/custom_post_types.php';
require_once 'inc/defaults.php';

add_action( 'init',                     'r_theme_defaults__default' );
//add_action( 'admin_menu',             'r_theme_defaults__remove_menus' );
add_action( 'wp_enqueue_scripts',       'r_theme_defaults__load_styles');
add_action( 'wp_enqueue_scripts',       'r_theme_defaults__load_scripts' );
add_action( 'after_setup_theme',        'r_add_custom_menus');
add_action( 'widgets_init',             'r_add_widget_areas' );
add_action( 'after_setup_theme',        'r_add_theme_support_title');


/*
 * Functions
 */
function r_add_theme_support_title() {
    add_theme_support( 'title-tag' );
}

function r_theme_defaults__remove_menus(){
    remove_menu_page( 'tools.php' );    //Tools
}

$dev = true;	// set false in production
if ($dev) {
	$min = '';
} else {
	$min = '.min';
}

function r_theme_defaults__load_styles() {
	wp_enqueue_style('plugins.min',     get_template_directory_uri() . '/css/plugins'.$min.'.css',    false, filemtime( get_stylesheet_directory() . '/css/plugins'.$min.'.css' ));
    wp_enqueue_style('main.min',		get_template_directory_uri() . '/css/main'.$min.'.css',       false, filemtime( get_stylesheet_directory() . '/css/main'.$min.'.css' ));
}

function r_theme_defaults__load_scripts() {
	wp_enqueue_script('plugins.min',	get_template_directory_uri(). '/js/plugins'.$min.'.js',	array('jquery'), filemtime( get_stylesheet_directory() . '/js/plugins'.$min.'.js' ), true);
    wp_enqueue_script('main.min',		get_template_directory_uri(). '/js/main'.$min.'.js',	array('jquery'), filemtime( get_stylesheet_directory() . '/js/main'.$min.'.js' ), true);
    
    wp_localize_script( 'main.min', 'global_data', array( 
    							'ajax_url' => admin_url( 'admin-ajax.php' ), 
    							'theme_url' => get_template_directory_uri() ) );
    
    // load jquery in footer
    if( !is_admin()){
        wp_deregister_script('jquery');
        //wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"), false, '1.11.2', true);
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
