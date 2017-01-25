<?php
/**
 * The template file for archives.
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

<?php ufclas_ufl_2015_kb_header(); ?>

<div id="main" class="container main-content">
<!--
<div class="row">
  <div class="col-sm-12">
    <?php ufclas_ufl_2015_breadcrumbs(); ?>
    <header class="entry-header">
      <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
    </header>
  </div> 
</div>
-->
<div class="row">
  <div class="col-md-12">
    <?php
		$terms = get_terms( 'kbe_taxonomy' );
 
		echo '<ul>';
		 
		foreach ( $terms as $term ) {
		 
			// The $term is an object, so we don't need to specify the $taxonomy.
			$term_link = get_term_link( $term );
			
			// If there was an error, continue to the next term.
			if ( is_wp_error( $term_link ) ) {
				continue;
			}
		 
			// We successfully got a link. Print it out.
			echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
		}
		 
		echo '</ul>';
	?>
  </div>
</div>
</div>

<?php get_footer(); ?>
