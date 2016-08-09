<?php 
/**
 * Theme Customization API, requires WordPress 3.4
 *
 */
 
/**
 * Add section to the Customizer
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_register( $wp_customize ) {
	
	
	
	/*// General
	$wp_customize->add_section( 'ufl_2015_general', array(
		'title' => __('General', 'ufclas-ufl-2015'),
		'priority' => 30,
	));
	
	
	// Header
	$wp_customize->add_section( 'ufl_2015_header_section', array(
		'title' => __('Header', 'ufclas-ufl-2015'),
	));
	
	// Alerts
	$wp_customize->add_section( 'ufl_2015_alerts_section', array(
		'title' => __('Alerts', 'ufclas-ufl-2015'),
	));*/
	
	// Homepage
	$wp_customize->add_section( 'homepage', array(
		'title' => __('Homepage', 'ufclas-ufl-2015'),
		'description' => __('Options for modifying the homepage. The below options edit the featured slider.', 'ufclas-ufl-2015'),
		'priority' => '160',
	));
	
	$wp_customize->add_setting( 'featured_category', array( 'default' => 0 ));
	
	$wp_customize->add_control( 'featured_category', array(
		'label' => __('Select a Category', 'ufclas-ufl-2015'),
		'description' => __('Choose a category for the featured post slider.', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => array('c1', 'c2'),
	));
	
	$wp_customize->add_setting( 'story_stacker', array( 'default' => 0 ));
	
	$wp_customize->add_control( 'story_stacker', array(
		'label' => __('Story Stacker', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'checkbox',
	));
	
	/*// Footer
	$wp_customize->add_section( 'ufl_2015_footer_section', array(
		'title' => __('Footer', 'ufclas-ufl-2015'),
	));
	
	// Advanced Settings
	$wp_customize->add_section( 'ufl_2015_advanced_section', array(
		'title' => __('Advanced Settings', 'ufclas-ufl-2015'),
	));*/
}
add_action('customize_register','ufclas_ufl_2015_customize_register');