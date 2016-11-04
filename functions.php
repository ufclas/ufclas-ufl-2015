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
	
	// Theme
	$theme_data = wp_get_theme();
	$theme_version = $theme_data->get('Version');
	
	wp_enqueue_style( 'style', get_stylesheet_uri(), array('dashicons'), $theme_version );
	wp_enqueue_script('velocity', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js', array('jquery'), null, true);
	wp_enqueue_script('velocity-ui', 'https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js', array('velocity'), null, true);
	wp_enqueue_script('ufclas-ufl-2015-plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array(), $theme_version, true);
	wp_enqueue_script('ufclas-ufl-2015-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), $theme_version, true);
	
	// Pass site data to Javascript
	$site_data = array(
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
		$custom_css .= '@media screen and (min-width:992px) and (max-width: 1249px){ .header.unit .main-menu-wrap .menu > li > .main-menu-link { padding-left: 15px; padding-right: 15px; }';
		$custom_css .= '@media screen and (min-width:1250px){ .main-menu-wrap .menu > li { width: calc(100%/' . $menu_item_count . '); } ';
	}
	
	// Custom css for sidenav
	$collapse_sidebar_nav = get_theme_mod('collapse_sidebar_nav', 1);
	if ( $collapse_sidebar_nav ) {
		$custom_css  .= '.sidenav .page_item_has_children .children {display: none;} ';	
  	}
	
	wp_add_inline_style('style', $custom_css);
}
add_action('wp_enqueue_scripts', 'ufclas_ufl_2015_inline_styles');


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
	
	if ( get_theme_mod('disable_global_elements') ){
		$classes[] = 'disable-global';
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
 * Displays breadcrumb navigation for current page
 * 
 * @since 0.0.0
 */
function ufclas_ufl_2015_breadcrumbs() {
  	global $post;

	$breadcrumb = '<ul class="breadcrumb-wrap">';
	
	$post_ancestors = get_post_ancestors($post);
	
	if ( !$post_ancestors ) {
		$breadcrumb .= '<li>&nbsp;</li>';
	}
	else {
		$post_ancestors = array_reverse($post_ancestors);
		foreach ( $post_ancestors as $crumb_id ){
			$breadcrumb .= '<li><a href="' . get_permalink( $crumb_id ) . '">' . get_the_title( $crumb_id ) . '</a></li>';
		}
	}
	$breadcrumb .= "</ul>";
	
	echo $breadcrumb;
}

/**
 * Page Menu Navigation
 *
 * @return string List of page links
 * @since 0.1.0
 */
function ufclas_ufl_2015_sidebar_navigation() {
	global $post;
	
	$post_ancestors = get_post_ancestors( $post );
	$depth = count($post_ancestors);
	$top_page = $post->ID;
	
	if ( $depth ){
		$top_page = $post_ancestors[0];
	}
	
	$children = wp_list_pages(array(
		'title_li' => '',
		'child_of' => $top_page,
		'echo' => false,
		'depth' => 2,
	));
	
	return $children;
}

/**
 * Filter the CSS class for the menu list items <li>
 *
 * @return array Menu item classes
 * @since 0.0.0
 */
function ufclas_ufl_2015_nav_classes( $classes, $item, $args, $depth ) {
	if ( 'audience_nav' == $args->theme_location ){
		$classes[] = 'audience-link';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'ufclas_ufl_2015_nav_classes', 10, 4 );

/**
 * Adds feed link to category title
 * 
 * @since 0.1.0
 */
function ufclas_ufl_2015_archive_title( $title ){
	if ( is_category() ) {
        $queried_obj = get_queried_object();
		$title = sprintf( __( '%s', 'ufclas-ufl-2015' ), single_cat_title( '', false ) );
		$title .= sprintf('<a href="%s"><i class="mdi mdi-rss"></i></a>', get_category_feed_link( $queried_obj->term_id ) );
    }
	else {
		$title = str_replace( __('Archives: ', 'ufclas-ufl-2015'), '', $title);	
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'ufclas_ufl_2015_archive_title' );

/**
 * Change the default embed height to 16:9 dimensions
 * 
 * @since 0.1.0
 */
function ufclas_ufl_2015_embed_defaults( $size, $url ) {
	$width = (int) $GLOBALS['content_width'];
	$height = min( ceil( $width * 0.5625 ), 1000 );
	
	return compact( 'width', 'height' );
}
add_filter( 'embed_defaults', 'ufclas_ufl_2015_embed_defaults', 2, 10 );

/**
 * Custom image sizes, 
 *
 * @since 0.2.5
 */
function ufclas_ufl_2015_image_sizes(){
	// Legacy sizes
	add_image_size('full-width-thumb', 1140, 399, array('center', 'top'));
	add_image_size('half-width-thumb', 570, 399, array('center', 'top'));
	add_image_size('page_header', 750, 399, array('center', 'top'));
	add_image_size('ufl_post_thumb', 600, 210, false);	
}
add_action( 'after_setup_theme', 'ufclas_ufl_2015_image_sizes' );

/**
 * Show additional sizes in the insert image dialog
 *
 * @param array $sizes	All defined image sizes
 * @since 0.2.5
 */
function ufclas_ufl_2015_show_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
		'full-width-thumb' => __( 'Full Width Thumbnail', 'ufclas-ufl-2015' ),
		'half-width-thumb' => __( 'Half Width Thumbnail', 'ufclas-ufl-2015' ),
		'page_header' => __( 'Page Header', 'ufclas-ufl-2015' ),
		'ufl_post_thumb' => __( 'Post Thumbnail', 'ufclas-ufl-2015' ),
    ) );
}
add_filter( 'image_size_names_choose', 'ufclas_ufl_2015_show_custom_sizes' );

/**
 * Change the Read More Text from the default (legacy)
 */
function ufclas_ufl_2015_excerpt_more( $more ){
	$custom_meta = get_post_custom( get_the_ID() );
	$custom_button_text = ( isset($custom_meta['custom_meta_featured_content_button_text']) )? $custom_meta['custom_meta_featured_content_button_text'][0]:'';
	$label = ( empty($custom_button_text) )? __('Read&nbsp;More', 'ufclas-ufl-2015'):$custom_button_text;
	return '&hellip; <a href="'. get_permalink() . '" title="'. get_the_title() . '" class="read-more">' . $label . '</a>';
}
add_filter('excerpt_more', 'ufclas_ufl_2015_excerpt_more');
add_filter('the_content_more_link', 'ufclas_ufl_2015_excerpt_more');

/**
 * Show either the_content or the_excerpt based on whether post contains the <!--more--> tag (legacy)
 */
function ufclas_ufl_2015_teaser_excerpt( $excerpt ){
	
	global $post;
	$has_teaser = (strpos($post->post_content, '<!--more') !== false);
	if ($has_teaser){
		// Remove extra formatting from the content
		return strip_tags( get_the_content(), '<a><br><br/>' );
	}
	else {
		return $excerpt;
	}
}
add_filter( 'get_the_excerpt', 'ufclas_ufl_2015_teaser_excerpt', 9, 1);

/**
 * Change the default excerpt length of 55 words
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function ufclas_ufl_2015_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'ufclas_ufl_2015_excerpt_length', 999 );

/**
 * Get featured image html
 *
 * @return string Figure tag or empty string.
 * @since 0.2.8
 */
function ufclas_ufl_2015_post_featured_image(){
	global $post;
	$html = '';
	$details = array(
		'id' => '',
		'caption' => '',
		'description' => '',
	);
	
	// Get the image id, caption, and description
	$id = get_post_thumbnail_id();
	$image = get_post( $id );
	$details['id'] = $id;
	$details['caption'] = $image->post_excerpt;
	$details['description'] = $image->post_content;
	
	$custom_meta = get_post_custom( $post->ID );
	$img_full_width = ( isset($custom_meta['custom_meta_image_type']) )? $custom_meta['custom_meta_image_type'][0]:NULL;
	$details['size'] = ( $img_full_width )? 'full_width_thumb':'half-width-thumb';
	$details['classes'] = ( $img_full_width )? array('full-width','img-responsive'):array('alignleft');
	
	$html .= get_the_post_thumbnail( $post->ID, $details['size'] );
	$html .= sprintf( '<figcaption>%s</figcaption>', $details['caption'] );
	$html = sprintf( '<figure class="%s">%s</figure>', implode(' ', $details['classes']), $html );
		
	return $html;
}

/**
 * Template tag to display list of social network links only if they are set in the Customizer theme options
 * @since 0.3.0
 */
function ufclas_ufl_2015_socialnetworks() {
	$social_networks = array(
		'facebook' => 'Facebook',
		'twitter' => 'Twitter',
		'youtube' => 'YouTube',
		'instagram' => 'Instagram',
		'siteblog' => 'Blog',
	);
	
	foreach( $social_networks as $name => $title ){
		$link = esc_url( get_theme_mod("{$name}_url") );
		$icon = get_stylesheet_directory_uri();
		$icon .= ( 'siteblog' != $name )? "/img/spritemap.svg#{$name}" : '/svg/menu.svg#Layer_1';
		if( !empty($link) ){
			printf('<li><a href="%s" class="btn-circle icon-svg icon-%s"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="%s"></use></svg><span class="visuallyhidden">%s</span></a></li>', $link, $name, $icon, $title );
		}
	}
}

/**
 * Set a default favicon image
 *
 * @param string $url Site icon image url
 * @param int $size Size of the image
 * @param int $blog_id 
 * @return string Url of the site icon
 * @since 0.3.4
 */
function ufclas_ufl_2015_icon_url( $url, $size, $blog_id ){
	if ( empty($url) ){
		$url = get_stylesheet_directory_uri() . '/favicon.png';
	}
	return $url;
}
add_filter( 'get_site_icon_url', 'ufclas_ufl_2015_icon_url', 10, 3 );

/**
 * Load custom theme files 
 */
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/walkers.php';
require get_stylesheet_directory() . '/inc/widgets.php';
require get_stylesheet_directory() . '/inc/metaboxes.php';
require get_stylesheet_directory() . '/inc/shibboleth.php';
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/template-tags.php';

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

