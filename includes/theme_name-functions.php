<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function vd($result, $var_dump = false, $die = false) {
	echo '<pre>';
	
	if ( ! $var_dump ) {
		print_r( $result );
	} else {
		var_dump( $result );
	}
	
	echo '</pre>';
	
	if ( $die ) {
		die();
	}
}

function getPostViews( $postID ){
    $count_key = 'post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return 0;
    }
    return $count;
}

function setPostViews( $postID ) {
	session_start();
	$count_key = 'post_views_count';
	$count = get_post_meta( $postID, $count_key, true );
	
	if( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		if( !isset( $_SESSION['post_views_count-' . $postID] ) ) {
			$_SESSION['post_views_count-' . $postID]="si";
			$count++;
			update_post_meta( $postID, $count_key, $count );
		}
	}
}

function custom_excerpt( $text, $count = 150 ) {
	if ( empty( $text ) ) {
		return false;
	}
    $temp = wp_html_excerpt( $text, $count );
    $words_count = explode( ' ', $temp );
    return wp_trim_words( $temp, count( $words_count ) - 1 );
}

function include_external_script( $filename = '' ) {
	if ( empty( $filename ) ) {
		return false;
	}
	
	if ( file_exists( get_template_directory() . '/includes/external/' . $filename . '.php' ) ) {
		include ( get_template_directory() . '/includes/external/' . $filename . '.php' );
	}
}