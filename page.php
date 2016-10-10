<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); ?>

<div id="main" class="container">
<div class="row">
  <div class="col-sm-8 col-sm-offset-3">
    <?php ufclas_ufl_2015_breadcrumbs(); ?>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  
  <?php get_sidebar('page_sidebar'); ?>  
  
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
