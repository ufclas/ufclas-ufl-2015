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
		$current_term = get_queried_object();
		
		$child_terms = get_terms( $current_term->taxonomy, array(
			'orderby'       => 'terms_order', 
			'order'         => 'ASC',
			'hide_empty'    => true,
			'parent'        => $current_term->term_id
		));
		
		$terms = array_merge( array($current_term), $child_terms );
		
		foreach ( $terms as $term ):
			$grandchild_terms = array();
			
			echo '<div class="kbe_articles">';
		 	
			// Display the heading for child terms
			if ( $term != $current_term ){
				$term_link = get_term_link( $term );
				echo '<h3 class="kb-heading term-heading"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></h3>';
				
				// Determine if there are third-level terms
				$grandchild_terms = get_terms( $term->taxonomy, array(
					'orderby'       => 'terms_order', 
					'order'         => 'ASC',
					'hide_empty'    => true,
					'parent'        => $term->term_id
				));
				$class = 'kb-list kb-list-child';	
			}
			else {
				$class = 'kb-list kb-list-parent';	
			}
			
			echo '<ul class="' . $class . '">';
			if ( !empty( $grandchild_terms ) ):
			
				// Display links to sub terms instead of posts
				foreach ( $grandchild_terms as $grandchild ):
					echo '<li class="term-link"><a href="' . get_term_link( $grandchild ) . '">' . $grandchild->name . '</a></li>';
				endforeach;
			
			else:
				// Display links to posts in the term
				$post_query = new WP_Query( array(
					'post_type' => 'kbe_knowledgebase',
					'tax_query' => array(
						array(
							'taxonomy' => $term->taxonomy,
							'field' => 'term_id',
							'terms' => $term->term_id,
							'include_children' => false,
						),
					),
				) );
				
				if ( $post_query->have_posts() ){
					while ( $post_query->have_posts() ): $post_query->the_post();
						echo '<li class="post-link"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					endwhile;
				}
				wp_reset_postdata();
			endif;
			
			echo '</ul><!-- -->';
			echo '</div><!-- .kbe_articles -->';
		endforeach;
	?>
    </div><!-- .kbe_content -->
  </div>
</div>
</div>

<?php get_footer(); ?>
