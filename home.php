<?php
/**
 * Site home page if set to display latest blog posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); 

$story_stacker = 0; // debug
$homepage_layout_color = ( 0 )? ' homepage_layout_white':''; // debug

?>

<?php 
	if ( $story_stacker ){
		// Display Featured Story Stacker
		get_template_part( 'template-parts/featured', 'story-stacker' );
	}
	else {
		// Display Featuared Carousel
		get_template_part( 'template-parts/featured', 'carousel' );	
	}
?>

<div id="main" class="container">
<div class="row">
  <div class="col-sm-12">
    <?php 
		while ( have_posts() ) : the_post();
			//get_template_part( 'template-parts/content', get_post_format() );
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
