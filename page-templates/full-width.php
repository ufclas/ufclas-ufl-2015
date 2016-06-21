<?php
/**
 * Template Name: Full Width Page (no sidebars or widgets)
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
  <div class="col-sm-12">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
