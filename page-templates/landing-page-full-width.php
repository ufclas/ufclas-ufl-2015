<?php
/**
 * Template Name: Landing Page (Full-Width)
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<div id="main">
    <div class="row">
        <div class="col-sm-12">
			
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'template-parts/content', 'landing' ); ?>
        
        	<?php endwhile; // End of the loop. ?>
            
        </div>
    </div>
    
	<?php get_sidebar('page_sections'); ?>
    
</div>

<?php get_footer(); ?>