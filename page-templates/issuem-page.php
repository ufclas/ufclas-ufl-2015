<?php
/**
 * Template Name: Newsletter Page
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<?php get_template_part( 'template-parts/issuem', 'header' ); ?>

<div id="main" class="container main-content">
    <div class="row">
        <div class="col-sm-12">
            <?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'template-parts/content', 'landing' ); ?>
        
        	<?php endwhile; // End of the loop. ?>

        </div>
    </div>
    
</div>

<?php get_footer(); ?>