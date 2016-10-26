<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */

if ( !is_active_sidebar( 'page_sections' ) ){
	return;
} 
?>
<div class="row">
<div class="col-md-12">
    <div id="secondary" class="widget-area page-sections" role="complementary">
		<?php dynamic_sidebar( 'page_sections' ); ?>
    </div><!-- page_sidebar -->    
</div>
</div>