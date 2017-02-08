<?php

$current_term = get_queried_object();

$post_type = KBE_POST_TYPE;
$term_order = get_theme_mod('kb_term_order', 'terms_order');
$post_order = get_theme_mod('kb_post_order', 'menu_order');

$child_terms = get_terms( $current_term->taxonomy, array(
	'orderby'       => $term_order, 
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
		echo '<h3 class="kb-heading"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></h3>';
		
		// Determine if there are third-level terms
		$grandchild_terms = get_terms( $term->taxonomy, array(
			'orderby'       => $term_order, 
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
			'post_type' => $post_type,
			'order' => 'ASC',
			'orderby' => $post_order,
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