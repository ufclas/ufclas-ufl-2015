<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 0.0.0
 */
function ufclas_ufl_2015_body_classes( $classes ) {
	$classes[] = 'loading';
	
	if ( is_page_template('page-templates/homepage.php') ) {
		$classes[] = 'homepage';
	}
	if ( get_theme_mod('disable_global_elements', 0) ){
		$classes[] = 'disable-global';
	}
	if ( $header_type = get_theme_mod('header_type', 'logo') ){
		$classes[] = 'header-type-' . $header_type;
	}

	return $classes;
}
add_filter( 'body_class', 'ufclas_ufl_2015_body_classes' );

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
 * Adds support for the title override metabox on pages
 * 
 * @param  string  $title Post title
 * @param  integer $id  Post ID
 * @return string  Post title
 */
function ufclas_ufl_2015_title( $title, $id ) {
    
    if ( is_page() ){
      $title_override = get_post_meta( $id, 'custom_meta_page_title_override', true );
      $title = ( !empty($title_override) )? $title_override : $title;
    }
  
    return $title;
}
add_filter( 'the_title', 'ufclas_ufl_2015_title', 10, 2 );