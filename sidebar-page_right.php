<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */

if ( ! is_active_sidebar( 'page_right' ) ): 
	return;
endif;
?>

<div class="col-md-3">

<div id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'page_right' ); ?>
</div><!-- page_right -->

</div>