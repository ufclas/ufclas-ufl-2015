<?php
	$taxonomy = 'kbe_taxonomy';
	
	$terms = get_terms( $taxonomy, array(
		'orderby'       => 'terms_order', 
		'order'         => 'ASC',
		'hide_empty'    => true,
		'parent'        => 0
	));
	$terms_count = count($terms);
	$terms_index = 1;
	$max_items = 5;
	$page_columns = 2;
	
	foreach ( $terms as $term ):
		
		// Get any child terms
		$child_terms = get_terms( $term->taxonomy, array(
			'orderby'       => 'terms_order', 
			'order'         => 'ASC',
			'hide_empty'    => true,
			'parent'        => $term->term_id
		));
		$child_terms = ( is_wp_error( $child_terms ) )? false : $child_terms; 
		
		echo '<div class="kbe_articles col-md-6">';
		
		// Query most viewed posts for the term
		$post_query = new WP_Query( array(
			'post_type' => 'kbe_knowledgebase',
			'posts_per_page' => $max_items,
			'orderby' => array('menu_order' => 'ASC'),
			'tax_query' => array(
				array(
					'taxonomy' => $term->taxonomy,
					'field' => 'term_id',
					'terms' => $term->term_id,
				),
			),
		) );
		
		$post_count = $post_query->found_posts;
		$count_label = ( $post_count == 1 )? __('Article', 'ufclas-ufl-2015') : __('Articles', 'ufclas-ufl-2015');
				
		// Display the heading for child terms
		printf( '<h3 class="kb-heading"><a href="%s">%s <span class="kbe_count pull-right">%d %s</span></a></h3>', 
			get_term_link( $term->term_id ), $term->name, $post_count, $count_label
		);
		
		echo '<ul class="kb-list">';     
		
		// Show article links if there are no child terms
		if ( !$child_terms && $post_query->have_posts() ):
			while ( $post_query->have_posts() ): $post_query->the_post();
				echo '<li class="kb-post-link"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
			endwhile;
		else:
			// Show child term links instead of articles
			$item_count = 0;
			foreach ( $child_terms as $item_term ){
				if ( $item_count<$max_items ){
					echo '<li class="kb-post-link"><a href="' . get_term_link( $item_term->term_id ) . '">' . $item_term->name . '</a></li>';
					$item_count++;
				}
				else {
					break;	
				}
			}
		endif;
		
		wp_reset_postdata();
		
		
		echo '</ul><!-- -->';
		echo '</div><!-- .kbe_articles -->';
		
		// Clear the cols if not the same height
		echo ( ($terms_index % $page_columns) == 0 )? '<div class="clearfix hidden-xs"></div>' : '';
		$terms_index++;
		
	endforeach;
?>