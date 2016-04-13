<?php

/**
 * Disable comments
 */

check_comment_template();
add_action( 'widgets_init', 'disable_rc_widget' );
add_filter( 'wp_headers', 'filter_wp_headers' );
add_action( 'template_redirect', 'filter_query', 9 );	// before redirect_canonical

// Admin bar filtering has to happen here since WP 3.6
add_action( 'template_redirect', 'filter_admin_bar' );
add_action( 'admin_init', 'filter_admin_bar' );

add_action( 'admin_menu', 'filter_admin_menu', 9999 );	// do this as late as possible
add_action( 'admin_head', 'hide_dashboard_bits' );
add_action( 'wp_dashboard_setup', 'filter_dashboard' );
add_filter( 'pre_option_default_pingback_flag', '__return_zero' );

add_filter( 'comments_open', 'filter_comment_status', 20, 2 );
add_filter( 'pings_open', 'filter_comment_status', 20, 2 );

add_filter( 'plugin_action_links', 'plugin_actions_links', 10, 2 );

function check_comment_template() {
    if( is_singular() ) {
        add_filter( 'comments_template', 'dummy_comments_template', 20 );
        // Remove comment-reply script for themes that include it indiscriminately
        wp_deregister_script( 'comment-reply' );
        // feed_links_extra inserts a comments RSS link
        remove_action( 'wp_head', 'feed_links_extra', 3 );
    }
}

function dummy_comments_template() {
    return dirname( __FILE__ ) . '/comments-template.php';
}

function filter_wp_headers( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}

function filter_query() {
    if( is_comment_feed() ) {
        // we are inside a comment feed
        wp_die( __( 'Comments are closed.' ), '', array( 'response' => 403 ) );
    }
}

function filter_admin_bar() {
    if( is_admin_bar_showing() ) {
        // Remove comments links from admin bar
        remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 50 );	// WP<3.3
        remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );	// WP 3.3
    }
}

function filter_admin_menu(){
    global $pagenow;

    if ( $pagenow == 'comment.php' || $pagenow == 'edit-comments.php' || $pagenow == 'options-discussion.php' )
        wp_die( __( 'Comments are closed.' ), '', array( 'response' => 403 ) );

    remove_menu_page( 'edit-comments.php' );
    remove_submenu_page( 'options-general.php', 'options-discussion.php' );
}

function filter_dashboard(){
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
}

function hide_dashboard_bits(){
    if( 'dashboard' == get_current_screen()->id )
        add_action( 'admin_print_footer_scripts', 'dashboard_js' );
}

function dashboard_js(){
    if( version_compare( $GLOBALS['wp_version'], '3.8', '<' ) ) {
        // getting hold of the discussion box is tricky. The table_discussion class is used for other things in multisite
        echo '<script> jQuery(function($){ $("#dashboard_right_now .table_discussion").has(\'a[href="edit-comments.php"]\').first().hide(); }); </script>';
    }
    else {
        echo '<script> jQuery(function($){ $("#dashboard_right_now .comment-count, #latest-comments").hide(); }); </script>';
    }
}

function filter_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    return false;
}

function disable_rc_widget() {
    // This widget has been removed from the Dashboard in WP 3.8 and can be removed in a future version
    unregister_widget( 'WP_Widget_Recent_Comments' );
}


/**
 * Add links to Settings page
*/
function settings_page_url() {
		$base = admin_url( 'options-general.php' );
		return add_query_arg( 'page', 'disable_comments_settings', $base );
	}
function plugin_actions_links( $links, $file ) {
    static $plugin;
    $plugin = plugin_basename( __FILE__ );
    if( $file == $plugin && current_user_can('manage_options') ) {
        array_unshift(
            $links,
            sprintf( '<a href="%s">%s</a>', esc_attr( settings_page_url() ), __( 'Settings' ) )
        );
    }

    return $links;
}	
