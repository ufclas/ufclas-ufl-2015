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

<div id="main" class="container">
<div class="row">
  <div class="col-sm-12">
		<?php ufclas_ufl_2015_breadcrumbs(); ?>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', 'post' );
		endwhile; // End of the loop. 
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
