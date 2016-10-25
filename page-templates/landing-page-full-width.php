<?php
/**
 * Template Name: Landing Page (Full-Width)
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<?php 
if ( has_post_thumbnail() ):
	$shortcode = sprintf( '[ufclas-landing-page-hero-full headline="%s" image="%d" image_height="half"][/ufclas-landing-page-hero-full]', 
		get_the_title(),
		get_post_thumbnail_id()
	);
	echo do_shortcode( $shortcode );
endif; 
?>

<div id="main">
    <div class="row">
        <div class="col-sm-12">
			
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'template-parts/content', 'landing' ); ?>
        
        	<?php endwhile; // End of the loop. ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>