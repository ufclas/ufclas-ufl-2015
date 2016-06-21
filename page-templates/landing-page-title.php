<?php
/**
 * Template Name: Landing Page w/ Title
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<div id="main" class="container">
  	<div class="row">
  		<div class="col-sm-12">
  			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  		</div>
  	</div>
</div>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php get_template_part( 'template-parts/content', 'landing' ); ?>

<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>