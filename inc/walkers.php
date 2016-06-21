<?php
/**
 * Main Menu Walker and filters
 */
class ufclas_ufl_2015_main_nav_menu extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"dropdown\">\n<ul>";
    }
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n</div>";
	}
}

function ufclas_ufl_2015_main_menu_item_args( $args, $item, $depth ){
	if ( ('main_menu' == $args->theme_location) && (0 == $depth) ){
		$args->link_before = '<span>';
		$args->link_after = '</span>';
	}
	return $args;
}
add_filter( 'nav_menu_item_args', 'ufclas_ufl_2015_main_menu_item_args', 10, 3);

function ufclas_ufl_2015_main_menu_link_attrs( $atts, $item, $args, $depth ){
	if ( ('main_menu' == $args->theme_location) && (0 == $depth) ){
		$atts['class'] = 'main-menu-link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'ufclas_ufl_2015_main_menu_link_attrs', 10, 4);


