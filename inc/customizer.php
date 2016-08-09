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
	
	$wp_customize->add_control( 'featured_category', array(
		'label' => __('Select a Category', 'ufclas-ufl-2015'),
		'description' => __('Choose a category for the featured post slider.', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_categories(),
	));
	
	$wp_customize->add_setting( 'story_stacker', array( 'default' => 0 ));
	
	$wp_customize->add_control( 'story_stacker', array(
		'label' => __('Story Stacker', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_setting( 'number_of_posts_to_show', array( 'default' => 3 ));
	
	$wp_customize->add_control( 'number_of_posts_to_show', array(
		'label' => __('Number of Posts to Display in Slider', 'ufclas-ufl-2015'),
		'description' => __('Number of posts to display in your slider (Story Stacker is fixed at 3)', 'ufclas-ufl-2015'),
		'section' => 'homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_range( 1, 5 ),
	));
	
	
}
add_action('customize_register','ufclas_ufl_2015_customize_register');

