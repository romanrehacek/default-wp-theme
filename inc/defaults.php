<?php

add_action( 'init',                     'disable_emojis' );
add_action( 'wp_enqueue_scripts',       'remove_wp_open_sans');
add_action( 'admin_enqueue_scripts',    'remove_wp_open_sans');
add_filter( 'show_admin_bar',           '__return_false');
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
endif;

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function baw_hack_wp_title_for_home( $title ){
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_the_title(get_option('page_on_front')) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}

function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}
