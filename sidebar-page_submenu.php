<?php
/**
 * The page submenu sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */

if ( !is_active_sidebar( 'page_submenu' ) ):

	if ( has_post_thumbnail() ):
		$custom_meta = get_post_meta( get_the_ID() );
		$custom_meta_image_height = ( isset( $custom_meta['custom_meta_image_height']) )? $custom_meta['custom_meta_image_height'][0] : '';
		$shortcode = sprintf( '[ufl-submenu menu="%s" headline="%s" image="%d" image_height="%s"]', 
			'',
            get_the_title(),
			get_post_thumbnail_id(),
            $custom_meta_image_height
		);
		echo do_shortcode( $shortcode );
	endif;

endif; 
?>

<div id="page-submenu" class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'page_submenu' ); ?>
</div><!-- page_submenu -->    
