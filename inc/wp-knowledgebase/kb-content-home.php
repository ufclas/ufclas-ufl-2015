<?php
	$taxonomy = 'kbe_taxonomy';
	$term_columns = get_theme_mod('kb_columns', 2);
	$term_order = get_theme_mod('kb_term_order', 'terms_order');
	$show_count = get_theme_mod('kb_show_count', 1);
	$post_order = get_theme_mod('kb_post_order', 'menu_order');
	$max_posts = 5;
	
	// Get list of only the top level kb categories
	$terms = get_terms( $taxonomy, array(
		'orderby'       => $term_order, 
		'order'         => 'ASC',
		'hide_empty'    => true,
		'parent'        => 0
	));
	
	if ( !is_wp_error($terms) && $terms ):
		
		$terms_count = count($terms) ;
		$terms_index = 1;
		
		foreach ( $terms as $term ):
		
			$term_column_width = 12/$term_columns;
			
			echo '<div class="kbe_articles col-md-' . $term_column_width . '">';
			
			// Query most viewed posts for the term
			$post_query = new WP_Query( array(
				'post_type' => 'kbe_knowledgebase',
				'posts_per_page' => $max_posts,
				'orderby' => $post_order,
				'tax_query' => array(
					array(
						'taxonomy' => $term->taxonomy,
						'field' => 'term_id',
						'terms' => $term->term_id,
					),
				),
			) );
			
			$post_count = $post_query->found_posts;
								
			// Display the heading for child terms
			$article_count_label = ( $post_count == 1 )? __('Article', 'ufclas-ufl-2015') : __('Articles', 'ufclas-ufl-2015');
			$article_count = ( $show_count )?  ' <span class="kbe_count pull-right">' . $post_count . ' ' . $article_count_label . '</span>' : '';
						
			printf( '<h3 class="kb-heading"><a href="%s">%s%s</a></h3>', get_term_link( $term->term_id ), $term->name, $article_count );
			
			echo '<ul class="kb-list">';     
				
			if ( $post_query->have_posts() ){
				while ( $post_query->have_posts() ): $post_query->the_post();
					echo '<li class="kb-post-link"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				endwhile;
			}
			
			wp_reset_postdata();
			
			
			echo '</ul><!-- -->';
			echo '</div><!-- .kbe_articles -->';
			
			// Clear the cols if not the same height
			echo ( ($terms_index % $term_columns) == 0 )? '<div class="clearfix hidden-xs"></div>' : '';
			$terms_index++;
		endforeach;
	else:
		echo '<p>' . __('No Knowledge Base Categories found.', 'ufclas-ufl-2015') . '</p>';
	endif;
?>