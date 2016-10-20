<?php
/**
 * Template Name: Right Sidebar, No Left Navigation
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<div id="main" class="container">
<div class="row">
  <div class="col-sm-12">
    <?php ufclas_ufl_2015_breadcrumbs(); ?>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  
  <div class="<?php echo ufclas_page_column_class(); ?>">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
  </div>
  
  <?php get_sidebar('page_right'); ?> 
  
</div><!-- .row -->
</div><!-- #main -->

<?php get_footer(); ?>
