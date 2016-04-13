<?php

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme options',
		'menu_title'	=> 'Theme options',
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_posts',
		'parent_slug'	=> 'themes.php',
        'position'      => false,
        'icon_url'      => false
	));
	
}