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
	
	// Allow partial refreshes of widgets in sidebars
	add_theme_support( 'customize-selective-refresh-widgets' );

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ufclas_ufl_2015_custom_background_args', array(
		'default-color' => 'faf8f1',
		'default-image' => '',
	) ) );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'ufclas-ufl-2015' ),
        'global_menu' => esc_html__( 'Global Menu', 'ufclas-ufl-2015' ),
		'rolebased_nav' => esc_html__( 'Role-Based Navigation', 'ufclas-ufl-2015' ),
		'audience_nav' => esc_html__( 'Audience Navigation', 'ufclas-ufl-2015' ),
	) );
	
	// Add support for custom logos in the Customizer, use flex-width/height to skip cropping
	add_theme_support( 'custom-logo', array(
		'width' => 240,
		'height' => 58,
		'flex-width' => true,
		'flex-height' => true,
	) );
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
	$GLOBALS['content_width'] = apply_filters( 'ufclas_ufl_2015_content_width', 960 );
}
add_action( 'after_setup_theme', 'ufclas_ufl_2015_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function ufclas_ufl_2015_scripts() {
	// Bootstrap
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css', array(), null);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);
	
	wp_register_script( 'ie_html5shiv', get_template_directory_uri(). '/js/html5shiv.min.js', array(), null );
	wp_enqueue_script( 'ie_html5shiv');
	wp_script_add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );
	
	wp_register_script( 'ie_respond', get_template_directory_uri() . '/js/respond.min.js', array(), null );
	wp_enqueue_script( 'ie_respond');
	wp_script_add_data( 'ie_respond', 'conditional', 'lt IE 9' );
	
	// PrettyPhoto
	wp_enqueue_style( 'prettyPhoto', get_stylesheet_directory_uri() . '/inc/prettyPhoto/css/prettyPhoto.css', array(), null );
	wp_enqueue_script('prettyPhoto', get_stylesheet_directory_uri() . '/inc/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), null, true);
	
	// Theme
	$theme_data = wp_get_theme();
	$theme_version = $theme_data->get('Version');
	
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_script('ufclas-ufl-2015-plugins', get_stylesheet_directory_uri() . '/js/plugins.min.js', array('jquery'), null, true);
	wp_enqueue_script('ufclas-ufl-2015-scripts', get_stylesheet_directory_uri() . '/js/scripts.min.js', array(), $theme_version, true);
	
	// Pass site data to Javascript
	$site_data = array(
		'home_url' => home_url('/'),
		'theme_url' => get_stylesheet_directory_uri(),
		'max_main_menu_items' => get_theme_mod('max_main_menu_items', 7),
		'mega_menu' => get_theme_mod('mega_menu', 1),
	);
	wp_localize_script( 'ufclas-ufl-2015-plugins', 'ufclas_ufl_2015_sitedata', $site_data );
}
add_action( 'wp_enqueue_scripts', 'ufclas_ufl_2015_scripts' );

/**
 * Enqueue inline styles.
 * @since 0.3.0
 */
function ufclas_ufl_2015_inline_styles() {
	$custom_css = '';
	
	// Adjust main menu width
	if ( has_nav_menu('main_menu') ){
		$menu_item_count = 0;
		$menu_locations = get_nav_menu_locations();
		$menu_items = wp_get_nav_menu_items( $menu_locations[ 'main_menu' ] );
		
		foreach ( $menu_items as $item ) {
			// Only count top level menu items
			if ( $item->menu_item_parent == 0 ){
				$menu_item_count++; 
			}	
		}
		//$custom_css .= '@media screen and (min-width:992px) and (max-width: 1249px){ .header.unit .main-menu-wrap .menu > li > .main-menu-link { padding-left: 15px; padding-right: 15px; }';
		//$custom_css .= '@media screen and (min-width:1250px){ .main-menu-wrap .menu > li { width: calc(100%/' . $menu_item_count . '); }} ';
	}
	
	wp_add_inline_style('style', $custom_css);
}
add_action('wp_enqueue_scripts', 'ufclas_ufl_2015_inline_styles');

/**
 * Registers an editor stylesheet for the theme
 */
function ufclas_ufl_2015_editor_styles() {
	add_editor_style('editor-style.css');
}
add_action( 'admin_init', 'ufclas_ufl_2015_editor_styles' );

/**
 * Load custom theme files 
 */
require get_stylesheet_directory() . '/inc/filters.php';
require get_stylesheet_directory() . '/inc/media.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/walkers.php';
require get_stylesheet_directory() . '/inc/widgets.php';
require get_stylesheet_directory() . '/inc/shibboleth.php';
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/template-tags.php';
require get_stylesheet_directory() . '/inc/navigation.php';

// Add Bootstrap compatible walker
if ( !class_exists('wp_bootstrap_navwalker') ) {
	require_once get_stylesheet_directory() . '/inc/wp-bootstrap-navwalker.php';
}

// The Events Calendar
if ( class_exists('Tribe__Events__Main') ) {
	require get_stylesheet_directory() . '/inc/the-events-calendar.php';
}

// Shortcake Shortcode UI
if( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
	require get_stylesheet_directory() . '/inc/shortcake/shortcodes-ui.php';
}

// IssueM newsletter
if ( class_exists( 'IssueM' ) ) {
	require get_stylesheet_directory() . '/inc/issuem/issuem.php';
}

// Advanced custom fields
if( function_exists( 'register_field_group' )){
	require get_stylesheet_directory() . '/inc/advanced-custom-fields/metaboxes.php';
}
