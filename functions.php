<?php
/**
 * UF CLAS 160over90 2015 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UFCLAS_UFL_2015
 */

if ( ! function_exists( 'ufclas_ufl_2015_setup' ) ) :

// Sets up theme defaults and registers support for various WordPress features.
function ufclas_ufl_2015_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'ufclas-ufl-2015', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ufclas_ufl_2015_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // ufclas_ufl_2015_setup
add_action( 'after_setup_theme', 'ufclas_ufl_2015_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ufclas_ufl_2015_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ufclas_ufl_2015_content_width', 640 );
}
add_action( 'after_setup_theme', 'ufclas_ufl_2015_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function ufclas_ufl_2015_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script('velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js', array('jquery'), false, true);
	wp_enqueue_script('velocity-ui', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js', array('velocity'), false, true);
	wp_enqueue_script('ufclas-ufl-2015-plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array(), false, true);
	wp_enqueue_script('ufclas-ufl-2015-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), false, true);
	
	// Pass site data to Javascript
	wp_localize_script( 'ufclas-ufl-2015-plugins', 'ufclas_ufl_2015_themeurl', get_stylesheet_directory_uri() );
}
add_action( 'wp_enqueue_scripts', 'ufclas_ufl_2015_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 0.0.0
 */
function ufclas_ufl_2015_body_classes( $classes ) {
	
	if ( is_page_template('page-templates/homepage.php') ) {
		$classes[] = 'homepage';
	}

	return $classes;
}
add_filter( 'body_class', 'ufclas_ufl_2015_body_classes' );

/**
 * Registers an editor stylesheet for the theme
 */
function ufclas_ufl_2015_editor_styles() {
	add_editor_style();
}
add_action( 'admin_init', 'ufclas_ufl_2015_editor_styles' );

/**
 * Load custom theme files 
 */

require get_stylesheet_directory() . '/inc/shortcodes.php';

if( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
	require get_stylesheet_directory() . '/inc/shortcodes-ui.php';
}