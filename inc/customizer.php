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
 * Sanitize radio and select boxes using choices
 *
 * @return string Valid input or the default value for the setting 
 * @since 0.3.0
 * @see http://cachingandburning.com/wordpress-theme-customizer-sanitizing-radio-buttons-and-select-lists/
 */
function ufclas_ufl_2015_sanitize_choices( $input, $setting ) {
	global $wp_customize;
	
	$control = $wp_customize->get_control( $setting->id );
	
	if ( array_key_exists( $input, $control->choices ) ){
		return $input;
	}
	else {
		return $setting->default;	
	}
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
	// Colors section
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'homepage_layout_color', 
		array(
			'label' => __('Homepage Widgets Background', 'ufclas-ufl-2015'),
			'section' => 'colors',
			'settings' => 'homepage_layout_color',
		)
		)
	);
	
	// Add a Theme Option panel for backwards compatibility
	$wp_customize->add_panel( 'theme_options', array(
		'title' => __('Theme Options', 'ufclas-ufl-2015'),
		'description' => __('Options for modifying the theme.', 'ufclas-ufl-2015'),
		'priority' => '160',
	));
	
	// General
	$wp_customize->add_section( 'theme_options_general', array(
		'title' => __('General', 'ufclas-ufl-2015'),
		'description' => __('', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'parent_colleges_institutes', array( 'default' => 'None', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	$wp_customize->add_setting( 'analytics_acct', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'mega_menu', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'collapse_sidebar_nav', array( 'default' => 1, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'shibboleth_protocol', array( 'default' => (is_ssl())? 'https':'http', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	
	$wp_customize->add_control( 'parent_colleges_institutes', array(
		'label' => __('Parent College / Institute', 'ufclas-ufl-2015'),
		'description' => __('Select your parent organization.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'select',
		'choices' => array(
			'University of Florida|http://ufl.edu' => __('University of Florida', 'ufclas-ufl-2015'),
			'College of Liberal Arts and Sciences|http://clas.ufl.edu/' => __('CLAS', 'ufclas-ufl-2015'),
			'None' => __('None', 'ufclas-ufl-2015'),
		),
	));
	$wp_customize->add_control( 'analytics_acct', array(
		'label' => __('Google Analytics Account Number', 'ufclas-ufl-2015'),
		'description' => __("(e.g., 'UA-xxxxxxx-x' or 'UA-xxxxxxx-xx' )", 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'text',
	));
	$wp_customize->add_control( 'mega_menu', array(
		'label' => __('Enable Mega Drop Down Menu', 'ufclas-ufl-2015'),
		'description' => __('Main menu items appear in 2 columns', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'checkbox',
	));
	$wp_customize->add_control( 'collapse_sidebar_nav', array(
		'label' => __('Collapse Sidebar Navigation', 'ufclas-ufl-2015'),
		'description' => __('Useful for larger sites - keeps the sidebar navigation a manageable height', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'checkbox',
	));
	$wp_customize->add_control( 'shibboleth_protocol', array(
		'label' => __('Shibboleth Protocol', 'ufclas-ufl-2015'),
		'description' => __('Select the protocol you have Shibboleth enabled on.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_general',
		'type' => 'select',
		'choices' => array(
			'http' => 'http',
			'https' => 'https',
		),
	));

		
	// Homepage
	$wp_customize->add_section( 'theme_options_homepage', array(
		'title' => __('Homepage', 'ufclas-ufl-2015'),
		'description' => __('The options below edit the homepage featured slider.', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'featured_category', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'story_stacker', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'number_of_posts_to_show', array( 'default' => 3, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'featured_style', array( 'default' => 'slider-dark', 'sanitize_callback' => 'sanitize_key' ));
	$wp_customize->add_setting( 'featured_speed', array( 'default' => 7, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'featured_disable_link', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'story_stacker_disable_dates', array( 'default' => 0, 'sanitize_callback' => 'absint' ));
	$wp_customize->add_setting( 'homepage_layout', array( 'default' => '2c-bias', 'sanitize_callback' => 'sanitize_key' ));
	$wp_customize->add_setting( 'homepage_layout_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_hex_color' ));
	
	$wp_customize->add_control( 'featured_category', array(
		'label' => __('Select a Category', 'ufclas-ufl-2015'),
		'description' => __('Choose a category for the featured post slider.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_categories(),
	));
	
	$wp_customize->add_control( 'number_of_posts_to_show', array(
		'label' => __('Number of Posts to Display in Slider', 'ufclas-ufl-2015'),
		'description' => __('Number of posts to display in your slider (Story Stacker is fixed at 3)', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => ufclas_ufl_2015_customize_range( 1, 15 ),
	));
	
	$wp_customize->add_control( 'featured_style', array(
		'label' => __('Featured Slider Style', 'ufclas-ufl-2015'),
		'description' => __('Select a color scheme for the featured slider', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'select',
		'choices' => array(
			'slider-light' => __('Light', 'ufclas-ufl-2015'),
			'slider-dark' => __('Dark', 'ufclas-ufl-2015'),
		),
	));
	
	$wp_customize->add_control( 'featured_speed', array(
		'label' => __('Slider Speed', 'ufclas-ufl-2015'),
		'description' => __('Time in seconds to display each slide', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'number',
	));
	
	$wp_customize->add_control( 'featured_disable_link', array(
		'label' => __('Disable Slider Links', 'ufclas-ufl-2015'),
		'description' => __('Disable links from being created on the homepage slider.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_control( 'story_stacker', array(
		'label' => __('Story Stacker', 'ufclas-ufl-2015'),
		'description' => __('Change the slider to a large image with three smaller stories', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_control( 'story_stacker_disable_dates', array(
		'label' => __('Story Stacker - Disable Dates', 'ufclas-ufl-2015'),
		'description' => __('Disable dates from appearing underneath your post titles.', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_control( 'homepage_layout', array(
		'label' => __('Homepage Layout for Widgets', 'ufclas-ufl-2015'),
		'description' => __('Select a layout to use for your widgets on the homepage', 'ufclas-ufl-2015'),
		'section' => 'theme_options_homepage',
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
	
	// Footer
	$wp_customize->add_section( 'theme_options_footer', array(
		'title' => __('Footer', 'ufclas-ufl-2015'),
		'description' => __('', 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'webmaster_email', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ));
	$wp_customize->add_setting( 'intranet_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'makeagift_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'footer_widgets_visibility', array( 'default' => 'all_pages', 'sanitize_callback' => 'ufclas_ufl_2015_sanitize_choices' ));
	
	$wp_customize->add_control( 'webmaster_email', array(
		'label' => __('Webmaster Email or URL', 'ufclas-ufl-2015'),
		'description' => __("Enter the email address or contact page URL for webmaster contact requests (e.g. webmaster@yourdomain.edu OR http://yourdomain.edu/contact)", 'ufclas-ufl-2015'),
		'section' => 'theme_options_footer',
		'type' => 'text',
	));
	
	$wp_customize->add_control( 'intranet_url', array(
		'label' => __('Intranet URL', 'ufclas-ufl-2015'),
		'description' => __("Enter the URL to your unit's intranet. This will place a link at the bottom of the footer titled 'Intranet'", 'ufclas-ufl-2015'),
		'section' => 'theme_options_footer',
		'type' => 'text',
	));
	
	$wp_customize->add_control( 'makeagift_url', array(
		'label' => __('Make a Gift URL', 'ufclas-ufl-2015'),
		'description' => __("Enter the URL to your unit's specific fund/giving page at the UF Foundation. Find available online funds at the <a href='https://www.uff.ufl.edu/OnlineGiving/Advanced.asp' target='_blank'>UF Foundation</a>", 'ufclas-ufl-2015'),
		'section' => 'theme_options_footer',
		'type' => 'text',
	));
	
	$wp_customize->add_control( 'footer_widgets_visibility', array(
		'label' => __('Footer Widget Visibility', 'ufclas-ufl-2015'),
		'description' => __("Select where to show the Footer Widgets", 'ufclas-ufl-2015'),
		'section' => 'theme_options_footer',
		'type' => 'radio',
		'choices' => array(
			'all_pages' => __('All Pages (including homepage)', 'ufclas-ufl-2015'),
			'homepage_only' => __('Homepage Only', 'ufclas-ufl-2015'),
			'subpages_only' => __('Subpages Only', 'ufclas-ufl-2015'),
		),
	));
	
	// Social 
	$wp_customize->add_section( 'theme_options_social', array(
		'title' => __('Social Media', 'ufclas-ufl-2015'),
		'description' => __("Enter your organization's social media URLs (e.g. https://...). Social media icons are displayed in the footer", 'ufclas-ufl-2015'),
		'panel' => 'theme_options',
	));
	
	$wp_customize->add_setting( 'facebook_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'twitter_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'youtube_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'siteblog_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	$wp_customize->add_setting( 'instagram_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ));
	
	$wp_customize->add_control( 'facebook_url', array(
		'label' => __('Facebook URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'twitter_url', array(
		'label' => __('Twitter URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'youtube_url', array(
		'label' => __('YouTube URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'siteblog_url', array(
		'label' => __('Blog or Feed URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	$wp_customize->add_control( 'instagram_url', array(
		'label' => __('Instagram URL', 'ufclas-ufl-2015'),
		'description' => __("", 'ufclas-ufl-2015'),
		'section' => 'theme_options_social',
		'type' => 'text',
	));
	
}
add_action('customize_register','ufclas_ufl_2015_customize_register');

