<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */

// Determine whether to display home page sections widget area
$widget_area = ( !is_front_page() )? 'page_sections' : 'home_page_sections';

if ( !is_active_sidebar( $widget_area ) ){
	return;
} 
?>
<div>
<div>
    <div id="page-sections" class="widget-area" role="complementary">
		<?php dynamic_sidebar( $widget_area ); ?>
    </div><!-- page_sidebar -->    
</div>
</div>