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
    <header class="entry-header">
      <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-md-9">
    <?php 
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile; // End of the loop.
		
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'ufclas-ufl-2015' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'ufclas-ufl-2015' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'ufclas-ufl-2015' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'ufclas-ufl-2015' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
	?>
  </div>
  <div class="col-md-3">
    <?php get_sidebar('post_sidebar'); ?>
  </div>
</div>
</div>

<?php get_footer(); ?>
