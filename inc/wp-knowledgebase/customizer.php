<?php 
/**
 * Add Knowledgebase settings to the Theme Options in the Customizer
 *
 * @since 0.8.4
 */
function ufclas_ufl_2015_kb_customize_register( $wp_customize ) {
	
	// Newsletter Option
	$wp_customize->add_section( 'theme_options_kb', array(
		'title' => __('Knowledge Base', 'ufclas-ufl-2015'),
		'description' => __('', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'kb_title', array( 'default' => 'Knowledge Base', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_control( 'kb_title', array(
		'label' => __('Knowledge Base Title', 'ufclas-ufl-2015'),
		'description' => __('Title that appears above the search field and in breadcrumbs', 'ufclas-ufl-2015'),
		'section' => 'theme_options_kb',
		'type' => 'text',
	));
	
	$wp_customize->add_setting( 'kb_columns', array( 'default' => 2, 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_control( 'kb_columns', array(
		'label' => __('Columns', 'ufclas-ufl-2015'),
		'description' => __('Number of columns displayed on the home page', 'ufclas-ufl-2015'),
		'section' => 'theme_options_kb',
		'type' => 'select',
		'choices' => array(
			1 => '1',
			2 => '2',
			3 => '3',
			4 => '4',
		),
	));
	
	$wp_customize->add_setting( 'kb_show_count', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_control( 'kb_show_count', array(
		'label' => __('Show Article Count', 'ufclas-ufl-2015'),
		'description' => __('', 'ufclas-ufl-2015'),
		'section' => 'theme_options_kb',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_setting( 'kb_post_order', array( 'default' => 'menu_order', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_control( 'kb_post_order', array(
		'label' => __('Article Order', 'ufclas-ufl-2015'),
		'description' => __('Select order for articles', 'ufclas-ufl-2015'),
		'section' => 'theme_options_kb',
		'type' => 'select',
		'choices' => array(
			'menu_order' => __('Article Sort Order', 'ufclas-ufl-2015'),
			'title' => __('Article Title', 'ufclas-ufl-2015'),
		),
	));
	
	$wp_customize->add_setting( 'kb_term_order', array( 'default' => 'terms_order', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_control( 'kb_term_order', array(
		'label' => __('Category Order', 'ufclas-ufl-2015'),
		'description' => __('Select order for categories', 'ufclas-ufl-2015'),
		'section' => 'theme_options_kb',
		'type' => 'select',
		'choices' => array(
			'terms_order' => __('Category Sort Order', 'ufclas-ufl-2015'),
			'name' => __('Category Title', 'ufclas-ufl-2015'),
		),
	));
	
	$wp_customize->add_setting( 'kb_post_order', array( 'default' => 'menu_order', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_control( 'kb_post_order', array(
		'label' => __('Article Order', 'ufclas-ufl-2015'),
		'description' => __('Select order for articles', 'ufclas-ufl-2015'),
		'section' => 'theme_options_kb',
		'type' => 'select',
		'choices' => array(
			'menu_order' => __('Article Sort Order', 'ufclas-ufl-2015'),
			'title' => __('Article Title', 'ufclas-ufl-2015'),
		),
	));
	
}
add_action('customize_register','ufclas_ufl_2015_kb_customize_register');