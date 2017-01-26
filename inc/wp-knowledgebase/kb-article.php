<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php ufclas_ufl_2015_kb_breadcrumbs();	?>
    <header class="entry-header">
      <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'inc/wp-knowledgebase/kb', 'content');
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
