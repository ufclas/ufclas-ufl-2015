<?php
	$post_type = KBE_POST_TYPE;
	$taxonomy = KBE_POST_TAXONOMY;
	$max_posts = KBE_ARTICLE_QTY;
	$term_columns = get_theme_mod('kb_columns', 2);
	$term_order = get_theme_mod('kb_term_order', 'terms_order');
	$show_count = get_theme_mod('kb_show_count', 1);
	$post_order = get_theme_mod('kb_post_order', 'menu_order');
	
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
			
			// Query posts by article order
			$post_query = new WP_Query( array(
				'post_type' => $post_type,
				'posts_per_page' => $max_posts,
				'orderby' => $post_order,
				'order' => 'ASC',
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
			
			$term_label = $term->name;
			$term_link = get_term_link( $term->term_id );
					
			printf( '<h3 class="kb-heading"><a href="%s">%s%s</a></h3>', $term_link, $term_label, $article_count );
			
			echo '<ul class="kb-list">';     
				
			if ( $post_query->have_posts() ){
				while ( $post_query->have_posts() ): $post_query->the_post();
					echo '<li class="kb-post-link"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				endwhile;
			}
			
			wp_reset_postdata();
			
			
			echo '</ul>';
			if ( $post_count > $max_posts ){
				printf('<div class="kbe-view-all"><a href="%s" title="%s">%s</a></div>', 
					$term_link,
					__('View articles in ', 'ufclas-ufl-2015') . $term_label,
					__('View All Articles', 'ufclas-ufl-2015')
				);
			}
			echo '</div><!-- .kbe_articles -->';
			
			// Clear the cols if not the same height
			echo ( ($terms_index % $term_columns) == 0 )? '<div class="clearfix hidden-xs"></div>' : '';
			$terms_index++;
		endforeach;
	else:
		echo '<p>' . __('No Knowledge Base Categories found.', 'ufclas-ufl-2015') . '</p>';
	endif;
?>