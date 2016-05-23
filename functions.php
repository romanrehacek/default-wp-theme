<?php

require_once 'inc/disable-comments.php';
require_once 'inc/theme-options.php';
require_once 'inc/menus.php';
require_once 'inc/custom_post_types.php';
require_once 'inc/defaults.php';

add_action( 'init',                     'theme_defaults__default' );
//add_action( 'admin_menu',               'theme_defaults__remove_menus' );
add_action( 'wp_enqueue_scripts',       'theme_defaults__load_styles');
add_action( 'wp_enqueue_scripts',       'theme_defaults__load_scripts' );
add_action( 'after_setup_theme',        'add_custom_menus');
add_action( 'widgets_init',             'add_widget_areas' );
add_action( 'after_setup_theme',        'add_theme_support_title');


/*
 * Functions
 */
function add_theme_support_title() {
    add_theme_support( 'title-tag' );
}

function theme_defaults__remove_menus(){
    remove_menu_page( 'tools.php' );    //Tools
}


function theme_defaults__load_styles() {
    wp_enqueue_style('main.min',                get_template_directory_uri() . '/css/main.min.css',       false, filemtime( get_stylesheet_directory() . '/css/main.min.css' ));
    wp_enqueue_style('responsive.min',          get_template_directory_uri() . '/css/responsive.min.css', false, filemtime( get_stylesheet_directory() . '/css/responsive.min.css' ));
}

function theme_defaults__load_scripts() {
    wp_enqueue_script('main.min',                   get_template_directory_uri(). '/js/main.min.js',	array('jquery'), filemtime( get_stylesheet_directory() . '/js/main.min.js' ), true);
    
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

function add_custom_menus() {
    register_nav_menus( array(
		'primary'       => 'Top menu',
	) );
}

function theme_defaults__default() {
    add_theme_support( 'post-thumbnails' );

    //add_image_size('581x235', 581, 235);

}

function add_widget_areas() {
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
