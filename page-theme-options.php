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
  <div class="col-sm-3">
  	
	<?php get_sidebar('page_sidebar'); ?>
    
  </div>
  <div class="col-sm-8">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <div class="entry-content">
        <?php the_content(); ?>
        <pre>
        <?php print_r( get_theme_mods(), false ); ?>
		</pre>
	</div><!-- .entry-content -->
    
    <footer class="entry-footer">
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ufclas-ufl-2015' ),
				'after'  => '</div>',
			) );
			
			edit_post_link(
				sprintf(
					esc_html__( 'Edit %s', 'ufclas-ufl-2015' ),
					the_title( '<span class="sr-only">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
    
</article><!-- #post-## -->

  </div>
</div>
</div>

<?php get_footer(); ?>
