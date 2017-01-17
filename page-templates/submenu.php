<?php
/**
 * Template Name: Submenu Page
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<?php get_sidebar('page_submenu'); ?>  

<div id="main" class="container main-content">
    <div class="row">
        <div class="col-sm-12">
            <?php 
				if ( ! has_post_thumbnail() ): 
					the_title( '<h1 class="entry-title">', '</h1>' );
				endif;
			?>
			
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'template-parts/content', 'landing' ); ?>
        
        	<?php endwhile; // End of the loop. ?>

        </div>
    </div>
    
</div>

<?php get_footer(); ?>