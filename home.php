<?php
/**
 * Site home page if set to display latest blog posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); 

?>

<?php 
	if ( get_theme_mod('story_stacker', 0) ){
		// Display Featured Story Stacker
		get_template_part( 'template-parts/featured', 'story-stacker' );
	}
	else {
		// Display Featuared Carousel
		get_template_part( 'template-parts/featured', 'carousel' );	
	}
?>

<div id="main" class="container-fluid">
<div class="container">
  <div class="row">
  	
	<div id="secondary" class="widget-area" role="complementary">
		<?php ufandshands_secondary_widget_area(); ?>
    </div><!-- .widget-area -->
    
  </div>
</div>
</div>


<?php get_footer(); ?>
