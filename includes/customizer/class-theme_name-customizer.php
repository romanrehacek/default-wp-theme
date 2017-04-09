<?php

if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Theme_name_Customizer' ) ) :
	
class Theme_name_Customizer {
	
	function __construct() {
		add_action( 'customize_register' , array( $this, 'register' ) );
	
		new Theme_name_Customizer_Theme_Options_Social_Links();
	}
	
	public function register ( $wp_customize ) {
	  
		$wp_customize->add_panel( 'theme_name_theme_options', array(
	        'priority'			=> 300,
	        'capability'		=> 'edit_theme_options',
	        'theme_supports'	=> '',
	        'title' 			=> 'Theme_name Options',
	    ) );
	    
	}
	
}
	
endif;
