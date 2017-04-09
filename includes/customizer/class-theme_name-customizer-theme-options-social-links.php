<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Theme_name_Customizer_Theme_Options_Social_Links {
	
	public function __construct() {
		add_action( 'customize_register' , array( $this, 'register' ) );
	}
   
	public function register ( $wp_customize ) {
		
		/**
		 * New section
		 */
		$wp_customize->add_section( 'theme_name_social_links', 
			 array(
				'title' => 'Social Links',
				'capability' => 'edit_theme_options',
				'panel' => 'theme_name_theme_options',
			 ) 
		);
		
		/**
		 * Facebook
		 */
		$wp_customize->add_setting( 'social_link_facebook', array(
				'default' => '',
				'type' => 'option',
		) );      
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_facebook', array(
				'label'          => 'Facebook',
				'section'        => 'theme_name_social_links',
				'settings'       => 'social_link_facebook',
				'type'           => 'url',
				'input_attrs'    => array(
					'placeholder'   => 'https://',
				)
		) ) );
		
		/**
		 * Twitter
		 */
		$wp_customize->add_setting( 'social_link_twitter', array(
				'default' => '',
				'type' => 'option',
		) );      
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_twitter', array(
				'label'          => 'Twitter',
				'section'        => 'theme_name_social_links',
				'settings'       => 'social_link_twitter',
				'type'           => 'text',
				'input_attrs'    => array(
					'placeholder'   => 'https://',
				)
		) ) );
		
		/**
		 * Instagram
		 */
		$wp_customize->add_setting( 'social_link_instagram', array(
				'default' => '',
				'type' => 'option',
		) );      
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_instagram', array(
				'label'          => 'Instagram',
				'section'        => 'theme_name_social_links',
				'settings'       => 'social_link_instagram',
				'type'           => 'text',
				'input_attrs'    => array(
					'placeholder'   => 'https://',
				)
		) ) );
		
		/**
		 * Pinterest
		 */
		$wp_customize->add_setting( 'social_link_pinterest', array(
				'default' => '',
				'type' => 'option',
		) );      
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_pinterest', array(
				'label'          => 'Pinterest',
				'section'        => 'theme_name_social_links',
				'settings'       => 'social_link_pinterest',
				'type'           => 'text',
				'input_attrs'    => array(
					'placeholder'   => 'https://',
				)
		) ) );
		
		/**
		 * Dribbble
		 */
		$wp_customize->add_setting( 'social_link_dribbble', array(
				'default' => '',
				'type' => 'option',
		) );      
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_dribbble', array(
				'label'          => 'Dribbble',
				'section'        => 'theme_name_social_links',
				'settings'       => 'social_link_dribbble',
				'type'           => 'text',
				'input_attrs'    => array(
					'placeholder'   => 'https://',
				)
		) ) );
		
		/**
		 * LinkedIn
		 */
		$wp_customize->add_setting( 'social_link_linkedin', array(
				'default' => '',
				'type' => 'option',
		) );      
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_linkedin', array(
				'label'          => 'LinkedIn',
				'section'        => 'theme_name_social_links',
				'settings'       => 'social_link_linkedin',
				'type'           => 'text',
				'input_attrs'    => array(
					'placeholder'   => 'https://',
				)
		) ) );
	}
}