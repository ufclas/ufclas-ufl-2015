<?php 
/**
 * Functions used in theme pages
 *
 * @package UFCLAS_UFL_2015
 */
 
/**
 * Custom logo backwards compatibility with WordPress versions older than 4.5
 * @since 0.2.3
 */
function ufclas_ufl_2015_get_custom_logo() {
	$custom_logo = '';
	
	if ( function_exists( 'the_custom_logo' ) ) {
		$blog_id = get_current_blog_id();
		if ( has_custom_logo( $blog_id ) ){
		  $custom_logo = get_custom_logo();
		  $custom_logo = preg_replace("/(.+)src=\"([^\"]*)\"(.+)/", "$2", $custom_logo);
		}
		else {
		 $custom_logo = get_stylesheet_directory_uri() . '/svg/clas-logo.svg';
		}	
   }
   return $custom_logo;
}
 
/**
 * Determine page content class based on presence of sidebars
 *
 * @param array $args Options for classes
 * @return string Classes used on main content column
 * @since 0.3.2
 */
 function ufclas_page_column_class(){
	$classes = array();
	$columns = 12;
	
	if ( is_page_template('page-templates/right-two-columns.php') ){
		$columns -= 3;
	}
	elseif ( is_page_template('page-templates/full-width.php') ) {
		$columns = 12;
	}
	else {
		
		// Default page template
		$sidebar_nav = ufclas_ufl_2015_sidebar_navigation();
		$has_sidebar_nav = !empty( $sidebar_nav );
		$has_page_sidebar = is_active_sidebar( 'page_sidebar' );
		$has_page_right = is_active_sidebar( 'page_right' );
		
		$columns -= 3;
		
		if ( !$has_sidebar_nav && !$has_page_sidebar ){
			$classes[] = 'col-md-offset-3';		
		}
		if ( $has_page_right ){
			$columns -= 3;
		}
	}
	
	$classes[] = 'col-md-' . $columns;
	
	return join( ' ', $classes ); 
 }
 
/**
 * Display a custom version of the search form based on location
 *
 * @since 0.3.2
 */
 function ufclas_get_search_form( $location = '' ){
	 $form = get_search_form( false );
	 
	 if ( 'mobile' == $location ){
		$form = str_replace( 'search-form', 'search-wrap mobile', $form );
	 }
	 
	 if ( 'menu' == $location ){
		$form = str_replace( 'search-form', 'search-wrap', $form );
	 }
	 
	 echo $form;	 
 }
 
/**
 * Get a nav menu's name by location
 *
 * @param string $location Nav menu location
 * @return string Nav menu name or empty string
 * @since 0.3.3
 */
function ufclas_nav_menu_name_by_location( $location ){
	$menu_locations = get_nav_menu_locations();
	
	if ( !isset( $menu_locations[$location] ) ){
		return '';
	}
	else {	
		$menu_id = $menu_locations[$location];
		$menu = wp_get_nav_menu_object( $menu_id );
		return ( $menu )? $menu->name : '';
	}
}

/**
 * Displays a parent organization menu link
 *
 * @since 0.3.3
 */
function ufclas_global_parent_organization(){
	$parent_organization = get_theme_mod( 'parent_colleges_institutes', 'None' );
	
	if ( 'None' != $parent_organization ){
		$parent_org = explode( '|', $parent_organization );
		$org_title = esc_html( trim($parent_org[0]) );
		$org_link = esc_url( trim($parent_org[1]) );
		
		printf( '<li id="global-menu-title" class="menu-item"><a href="%s">%s</a></li>', $org_link, $org_title );
	}
}