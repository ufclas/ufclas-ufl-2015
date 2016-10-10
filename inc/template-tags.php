<?php 
/**
 * Functions used in theme pages
 *
 * @package UFCLAS_UFL_2015
 */
 
 
/**
 * Determine page content class based on presence of sidebars
 *
 * @param array $args Options for classes
 * @return string Classes used on main content column
 * @since 0.3.2
 */
 function ufclas_page_column_class( $args = array() ){
	$classes = array();
	$columns = 12;
	
	$has_sidebar_nav = !empty( ufclas_ufl_2015_sidebar_navigation() );
	$has_page_sidebar = is_active_sidebar( 'page_sidebar' );
	$has_page_right = is_active_sidebar( 'page_right' );
	
	if ( $has_sidebar_nav || $has_page_sidebar ){
		$columns -= 3;	
	}
	else {
		$columns -= 3;
		$classes[] = 'col-md-offset-3';	
	}
	
	if ( $has_page_right ){
		$columns -= 3;
	}
	
	$classes[] = 'col-md-' . $columns;
	
	return join( ' ', $classes ); 
 }