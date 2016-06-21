<?php
/**
 * Template Name: Landing Page
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php get_template_part( 'template-parts/content', 'landing' ); ?>

<?php endwhile; // End of the loop. ?>
    
<?php get_footer(); ?>