<?php
/**
 * The page sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */

$ufclas_ufl_2015_sidebar_nav = ufclas_ufl_2015_sidebar_navigation();

// Display only if a page menu or Page Left sidebar exists
if ( empty( $ufclas_ufl_2015_sidebar_nav ) && !is_active_sidebar( 'page_sidebar' ) ){
	return;
} 
?>
<div class="col-md-3">
    
    <?php if ( !empty( $ufclas_ufl_2015_sidebar_nav ) ): ?>
    
    <div class="ul sidenav">
      <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Pages <span class="arw-right icon-svg"><svg>
        <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use>
        </svg></span></a></li>
      <?php echo $ufclas_ufl_2015_sidebar_nav; ?>
    </div><!-- .sidenav -->
    
    <?php endif; ?>
    
    <?php if ( is_active_sidebar( 'page_sidebar' ) ): ?>
    
        <div id="secondary" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'page_sidebar' ); ?>
        </div><!-- page_sidebar -->    
    
	<?php endif; ?>

</div>