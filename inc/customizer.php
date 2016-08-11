<?php 
/**
 * Theme Customization API, requires WordPress 3.4
 *
 */

/**
 * Get category list for a customizer select
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_categories() {
	$args = array('fields' => 'id=>name');
	return get_categories( $args );
}
/**
 * Get range of values for customizer select
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_range( $min = 0, $max = 10 ) {
	$range = array();
	for ($i=$min; $i<=$max; $i++){
		$range[$i] = $i;
	}
	return $range;
}

/**
 * Add Customizer CSS
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_css() {
	$homepage_layout_color = get_theme_mod( 'homepage_layout_color' );
	$background_color = get_theme_mod( 'background_color' );
	
    $custom_css = "body {background-color: {$background_color};}\n";
	$custom_css .= ".home #main {background-color: {$homepage_layout_color};}\n";
    wp_add_inline_style( 'style', $custom_css );
}
add_action('wp_enqueue_scripts', 'ufclas_ufl_2015_customize_css');
 
/**
 * Add custom theme mods to the Customizer
 * @since 0.2.5
 */
function ufclas_ufl_2015_customize_register( $wp_customize ) {
		
	// Homepage
	$wp_customize->add_section( 'homepage', array(
		'title' => __('Homepage', 'ufclas-ufl-2015'),
		'description' => __('Options for modifying the homepage. The below options edit the featured slider.', 'ufclas-ufl-2015'),
		'priority' => '160',
	));
	
	$wp_customize->add_setting( 'featured_category', array( 'default' => 0 ));
	$wp_customize->add_setting( 'story_stacker', array( 'default' => 0 ));
	$wp_customize->add_setting( 'number_of_posts_to_show', array( 'default' => 3 ));
	$wp_customize->add_setting( 'featured_style', array( 'default' => 'slider-dark' ));
	$wp_customize->add_setting( 'featured_speed', array( 'default' => 7 ));
	$wp_customize->add_setting( 'featured_disable_link', array( 'default' => 0 ));
	$wp_customize->add_setting( 'story_stacker_disable_dates', array( 'default' => 0 ));
	$wp_customize->add_setting( 'homepage_layout', array( 'default' => '2c-bias' ));
	$wp_customize->add_setting( 'homepage_layout_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ));
	
	$wp_customize->add_control( 'featured_category', array(
		'label' => __('Select a Category', 'ufclas-ufl-2015'),
		'description' => __('Choose a category for the featured post slider.', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_categories(),
	));
	
	$wp_customize->add_control( 'number_of_posts_to_show', array(
		'label' => __('Number of Posts to Display in Slider', 'ufclas-ufl-2015'),
		'description' => __('Number of posts to display in your slider (Story Stacker is fixed at 3)', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_range( 1, 15 ),
	));
	
	$wp_customize->add_control( 'featured_style', array(
		'label' => __('Featured Slider Style', 'ufclas-ufl-2015'),
		'description' => __('Select a color scheme for the featured slider', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => array(
			'slider-light' => __('Light', 'ufclas-ufl-2015'),
			'slider-dark' => __('Dark', 'ufclas-ufl-2015'),
		),
	));
	
	$wp_customize->add_control( 'featured_speed', array(
		'label' => __('Slider Speed', 'ufclas-ufl-2015'),
		'description' => __('Time in seconds to display each slide', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'number',
	));
	
	$wp_customize->add_control( 'featured_disable_link', array(
		'label' => __('Disable Slider Links', 'ufclas-ufl-2015'),
		'description' => __('Disable links from being created on the homepage slider.', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_control( 'story_stacker', array(
		'label' => __('Story Stacker', 'ufclas-ufl-2015'),
		'description' => __('Change the slider to a large image with three smaller stories', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_control( 'story_stacker_disable_dates', array(
		'label' => __('Story Stacker - Disable Dates', 'ufclas-ufl-2015'),
		'description' => __('Disable dates from appearing underneath your post titles.', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_control( 'homepage_layout', array(
		'label' => __('Homepage Layout for Widgets', 'ufclas-ufl-2015'),
		'description' => __('Select a layout to use for your widgets on the homepage', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => array(
			'3c-default' => __('Three Columns, 1/2 1/4 1/4', 'ufclas-ufl-2015'),
			'3c-thirds' => __('Three Columns, 1/3 1/3 1/3', 'ufclas-ufl-2015'),
			'2c-bias' => __('Two Columns, 2/3, 1/3', 'ufclas-ufl-2015'),
			'2c-half' => __('Two Columns, 1/2 1/2', 'ufclas-ufl-2015'),
			'1c-100' => __('One Column', 'ufclas-ufl-2015'),
			'1c-100-2c-half' => __('One Column w/ Two Columns', 'ufclas-ufl-2015')
		),
	));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'homepage_layout_color', 
		array(
			'label' => __('Homepage Widgets Background', 'ufclas-ufl-2015'),
			'section' => 'colors',
			'settings' => 'homepage_layout_color',
		)
		)
	);
	
}
add_action('customize_register','ufclas_ufl_2015_customize_register');

