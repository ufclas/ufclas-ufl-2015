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

<div id="main" class="container main-content">

<div class="row">
  <div class="col-sm-12">
    <?php ufclas_ufl_2015_kb_breadcrumbs();	?>
    <header class="entry-header">
    	<h1 class="page-title">
      <?php 
	  	if ( !is_search() ){
			single_term_title();
		}
		else {
			printf( __( 'Search Results for: %s', 'ufclas-ufl-2015' ), '<span>' . get_search_query() . '</span>' );
		}
		?>
        </h1>
    </header>
  </div> 
</div>

<div class="row">
  <div class="col-md-12">
  	<div class="kbe_content">
    
	<?php
		if ( !is_search() ):
			get_template_part( 'inc/wp-knowledgebase/kb', 'content-archive');
		else:
			get_template_part( 'inc/wp-knowledgebase/kb', 'search');
		endif;
	?>
    </div><!-- .kbe_content -->
  </div>
</div>
</div>

<?php get_footer(); ?>
