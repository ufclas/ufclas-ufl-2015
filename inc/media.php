<?php
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
	
	// UFL sizes
	add_image_size('medium-cropped', 310, 275, array('center', 'top'));
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
		'medium-cropped' => __( 'Medium (cropped)', 'ufclas-ufl-2015' ),
    ) );
}
add_filter( 'image_size_names_choose', 'ufclas_ufl_2015_show_custom_sizes' );

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
 * Add the default gallery styles
 *
 * @param boolean $html5 Whether theme supports html5 
 * @return boolean
 * @since 0.6.0
 */
add_filter( 'use_default_gallery_style', function( $html5 ){ return true; } );
