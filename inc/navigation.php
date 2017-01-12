<?php
/**
 * Navigation functions
 *
 * @package UFCLAS_UFL_2015
 */
 
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
function ufclas_ufl_2015_nav_classes( $classes, $item, $args ) {
	if ( 'audience_nav' == $args->theme_location ){
		$classes[] = 'audience-link';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'ufclas_ufl_2015_nav_classes', 10, 3 );



