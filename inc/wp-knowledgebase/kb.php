<?php 

require get_stylesheet_directory() . '/inc/wp-knowledgebase/customizer.php';

/**
 * Remove the default CSS styles
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_remove_style() {
	
	wp_dequeue_style('kbe_theme_style');
	wp_deregister_style('kbe_theme_style');
	
	// Replacing the default live search only on the kb home page
	// Set the search setting to Off
	wp_dequeue_script('kbe_live_search');
	
	if ( is_post_type_archive( KBE_POST_TYPE ) && !( is_tax( KBE_POST_TAXONOMY ) || is_tax( KBE_POST_TAGS ) || is_search() ) ){
		wp_enqueue_style('awesomplete', get_stylesheet_directory_uri() . '/inc/awesomplete/awesomplete.css', array(), null );
		wp_enqueue_script('awesomplete', get_stylesheet_directory_uri() . '/inc/awesomplete/awesomplete.js', array(), null, true);
		wp_enqueue_script('ufclas-ufl-2015-kb', get_stylesheet_directory_uri() . '/inc/wp-knowledgebase/kb.js', array('awesomplete'), null, true);
	}
}
add_action( 'wp_enqueue_scripts', 'ufclas_ufl_2015_kb_remove_style', 11 );

/**
 * Bypass the default templates
 *
 * @since 0.8.0
 */
remove_action( 'init', 'register_kbe_shortcodes' );
remove_filter( 'template_include', 'kbe_template_chooser' );
remove_filter( 'template_include', 'template_chooser' );

/**
 * Add custom kb templates
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_template( $template_path ) {
	
	if ( is_search() && ( get_query_var('post_type') == KBE_POST_TYPE ) ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-archive.php';
	}
	
	elseif ( is_singular( KBE_POST_TYPE ) ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-article.php';
	}
	
	elseif ( is_tax( KBE_POST_TAXONOMY ) || is_tax( KBE_POST_TAGS ) ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-archive.php';
	}
	
	elseif ( is_post_type_archive( KBE_POST_TYPE ) ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-home.php';
	}

	return $template_path;
}
add_action( 'template_include', 'ufclas_ufl_2015_kb_template', 11 );

/**
 * Modify the custom post types and taxonomies
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_modify_custom(){
	$label = get_theme_mod('kb_title', __('Knowledge Base', 'ufclas-ufl-2015'));
	
	// Redefine the kb article
	$post_type_args = get_post_type_object( KBE_POST_TYPE );
	$post_type_args->rewrite['slug'] = KBE_PLUGIN_SLUG;
    $post_type_args->labels->name = $label;
	$post_type_args->show_in_rest = true;
	$post_type_args->rest_base = KBE_PLUGIN_SLUG;
	
	register_post_type( KBE_POST_TYPE, (array)$post_type_args );
	
	// Redefine the kb category
	$category_args = get_taxonomy( KBE_POST_TAXONOMY );
	$category_args->rewrite['slug'] = KBE_PLUGIN_SLUG . '/category';
	register_taxonomy( KBE_POST_TAXONOMY, KBE_POST_TYPE, (array) $category_args );
	
	// Redefine the kb tags
	$tag_args = get_taxonomy( KBE_POST_TAGS );
	$tag_args->rewrite['slug'] = KBE_PLUGIN_SLUG . '/tag';
	register_taxonomy( KBE_POST_TAGS, KBE_POST_TYPE, (array) $tag_args );
}
add_action( 'init', 'ufclas_ufl_2015_kb_modify_custom', 11 );

/**
 * Modify the kb category and tags rewrite rules to show articles
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_modify_rewrite( $rules ){
	
	$rules[ KBE_PLUGIN_SLUG . '/category/([^/]+)/?$'] = 'index.php?post_type=kbe_knowledgebase&kbe_taxonomy=$matches[1]';
	$rules[ KBE_PLUGIN_SLUG . '/tag/([^/]+)/?$'] = 'index.php?post_type=kbe_knowledgebase&kbe_tags=$matches[1]';

	return $rules;
}
add_filter( 'rewrite_rules_array', 'ufclas_ufl_2015_kb_modify_rewrite' );

/**
 * Template tag to display the header and search form
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_header(){
	$title = get_theme_mod('kb_title', __('Knowledge Base', 'ufclas-ufl-2015'));
	
	$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" subtitle="%s" image="%s" image_height="%s"]%s[/ufl-landing-page-hero]', 
        $title,
        '',
        '',
        'half',
        'FORM'
    );
    // Grab the form HTML
	$form = get_search_form( false );
	
	// Add a form ID and input ID
	$form = str_replace( 'role="search"', 'id="live-search" autocomplete="off" role="search"', $form );
	$form = str_replace( 'name="query"', 'id="s" name="query"', $form );
    
    echo str_replace('<p>FORM</p>', $form, do_shortcode( $shortcode ) );   
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_classes( $classes ) {
	
	if ( is_post_type_archive('kbe_knowledgebase') ){
		
		if ( is_tax('kbe_taxonomy') ){
			$classes[] = 'kbe_taxonomy-' . get_queried_object_id();
		}
		elseif ( !is_tax('kbe_taxonomy') && !is_tax('kbe_tags') ){
			$classes[] = 'kb-homepage';
		}
	}
	
	return $classes;
}
add_filter( 'body_class', 'ufclas_ufl_2015_kb_classes' );

/**
 * Template tag to add custom breadcrumbs
 * 
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_breadcrumbs() {
  	
	// Check the kb breadcrumbs setting
	if( KBE_BREADCRUMBS_SETTING == 1 ){
		
		$current = get_queried_object();
		$post_type_obj = get_post_type_object( KBE_POST_TYPE );
		$post_type_title = get_theme_mod( 'kb_title', $post_type_obj->labels->name);
		$crumbs = array();
		$current_id = false;
		
		echo '<ul class="kb-breadcrumbs">';
		
		echo '<li><a href="' . get_post_type_archive_link( KBE_POST_TYPE ) . '">' . $post_type_title . '</a></li>';
		
		// Get the correct term ID
		if ( is_single() ){
			$current_terms = get_the_terms( $current->ID, KBE_POST_TAXONOMY );
			$current_id = ( empty($current_terms) || is_wp_error($current_terms) )? false : $current_terms[0]->term_id;
		}
		elseif ( !is_search() ) {
			$current_id = $current->term_id;
		}
		
		// Add term and any term ancestors to array of crumbs
		if ( $current_id ){
			
			$current_ancestors = get_ancestors( $current_id, KBE_POST_TAXONOMY, 'taxonomy' );
			if ( !empty($current_ancestors) ){
				$crumbs = array_merge( $crumbs, $current_ancestors );
				$crumbs = array_reverse( $crumbs );
			}
			// Add current term to the list on article pages
			$crumbs[] = ( is_single() )? $current_id : null;
			
			// Display the breadcrumbs list
			foreach ( $crumbs as $crumb_id ){
				$crumb_term = get_term( $crumb_id, KBE_POST_TAXONOMY );
				if ( !is_wp_error( $crumb_term ) ) {
					echo '<li><a href="' . get_term_link( $crumb_id ) . '">' . $crumb_term->name . '</a></li>';
				}
			}
		}	
		
		echo '</ul>';
	}
}

/**
 * Template tag to update the post view count
 * 
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_set_post_views() {
  	global $post;
	
	if ( !is_user_logged_in() ){
		kbe_set_post_views( $post->ID );
	}
}

/**
 * Template tag to display article category/tag/date
 * 
 * @since 0.8.8
 */
function ufclas_ufl_2015_kb_entry_meta() {
  	
	// Get Tags for posts.
	$tags_list = get_the_term_list( get_the_ID(), KBE_POST_TAGS, '<ul class="term-list list-inline"><li>', '</li><li>', '</li></ul>' );

	if ( $tags_list && !is_wp_error($tags_list)  ) { 
	?>
		
		<div class="entry-meta cat-tags-links">
			<div class="tags-links">
				<span class="screen-reader-text"><?php echo __( 'Tags:', 'ufclas-ufl-2015' ); ?></span>
                <?php echo $tags_list; ?>
            </div>
		</div>

	<?php
	}
}

/**
 * Create a default value for the post view count when a new post is created
 * 
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_post_views_default( $post_id, $post, $update ) {
  	
	if ( !$update ){
		kbe_set_post_views( $post_id );
	}
}
add_action( 'save_post_kbe_knowledgebase', 'ufclas_ufl_2015_kb_post_views_default', 10, 3 );

/**
 * Remove columns from the kb article admin screen
 *
 * Filter is 'manage_{$screen->id}_columns' 
 *
 * @param array $columns
 * @return array Columns to display on All articles screen
 * @since 0.8.2
 */
function ufclas_ufl_2015_kb_article_columns( $columns ){
	unset($columns['comment']);
	return $columns;
}
add_filter('manage_edit-kbe_knowledgebase_columns', 'ufclas_ufl_2015_kb_article_columns');

/**
 * Add a 'category' filter dropdown to the articles screen
 *
 * @since 0.8.2
 */
function ufclas_ufl_2015_kb_article_filter_list() {
    global $wp_query;
	$screen = get_current_screen();
    
    if ( $screen->post_type == KBE_POST_TYPE ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Categories',
            'taxonomy' => KBE_POST_TAXONOMY,
            'name' => KBE_POST_TAXONOMY,
			'value_field' => 'slug',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query[KBE_POST_TAXONOMY] ) ? $wp_query->query[KBE_POST_TAXONOMY] : '' ),
            'hierarchical' => true,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}
add_action( 'restrict_manage_posts', 'ufclas_ufl_2015_kb_article_filter_list' );

/**
 * Modify the knowledgebase titles to add the user post type title
 *
 * @param array 	$title Title parts: title, page, tagline, site
 * @return array 	Modified title parts
 * @since 0.8.6
 */
function ufclas_ufl_2015_kb_title( $title ) {
    
	$post_type_title = get_theme_mod( 'kb_title' );
	
	// Add the tax title and post type title
	if ( is_tax(KBE_POST_TAXONOMY) || is_tax(KBE_POST_TAGS) ){
		$custom_title = array(
			'term_title' => single_term_title('', false),
			'post_type_title' => $post_type_title, 
		);
		array_splice( $title, 0, 1, $custom_title );	
	}
	
	// Add the post type title after the page title
	elseif ( is_singular(KBE_POST_TYPE) ){
		$custom_title = array(
			'post_type_title' => $post_type_title, 
		);
		array_splice( $title, 1, 0, $custom_title );	
	}
	
	// Replace the post type title
	elseif ( is_post_type_archive(KBE_POST_TYPE) ){
		$custom_title = array(
			'post_type_title' => $post_type_title, 
		);
		
		if ( !is_search() ){
			array_splice( $title, 0, 1, $custom_title );
		}
		else {
			array_splice( $title, 1, 0, $custom_title );
		}
	}
		
	return $title;
}
add_filter( 'document_title_parts', 'ufclas_ufl_2015_kb_title' );

/**
 * Register the /wp-json/kb/v2/search route
 *
 * @since 0.8.7
 */
function ufclas_ufl_2015_kb_register_routes(){
	register_rest_route( 'wp/v2/kb', 'search', array(
		'methods' => 'GET',
		'callback' => 'ufclas_ufl_2015_kb_serve_search',
	) );
}
add_action( 'rest_api_init', 'ufclas_ufl_2015_kb_register_routes' );

/**
 * Generate results for the /wp-json/kb/v2/search route, saves to transient
 *
 * @param WP_REST_Request $request Full details about the request.
 * @return WP_REST_Response|WP_Error The response for the request.
 *
 * @since 0.8.7
 */
function ufclas_ufl_2015_kb_serve_search( WP_REST_Request $request ){
	$transient_key = 'ufclas_ufl_2015_kb_search';
	
	// Get transient data from database, or generate if it doesn't exist 
	if ( WP_DEBUG || false === ( $response = get_transient($transient_key) ) ):
		
		$post_order = get_theme_mod('kb_post_order', 'menu_order');
		$term_order = get_theme_mod('kb_term_order', 'terms_order');
		$response = array();
		
		// Get list of posts
		$post_query = new WP_Query( array(
			'post_type' => KBE_POST_TYPE,
			'posts_per_page' => -1,
			'orderby' => $post_order,
			'order' => 'ASC',
		) );
		if ( $post_query->have_posts() ){
			while ( $post_query->have_posts() ): $post_query->the_post();
				$response[] = array(
					'title' => get_the_title(),
					'link' => get_the_permalink(),
					'type' => 'article',
				);
			endwhile;
		}
		wp_reset_postdata();
		
		// Get categories and tags
		$taxonomy_types = array(
			array(
				'tax' => KBE_POST_TAXONOMY,
				'args' => array( 'orderby' => $term_order, 'order' => 'ASC', 'hide_empty' => true ),
				'type' => 'Category',
			),
			array(
				'tax' => KBE_POST_TAGS,
				'args' => array( 'orderby' => $term_order, 'order' => 'ASC', 'hide_empty' => true ),
				'type' => 'Tag',
			),
		);
		foreach ( $taxonomy_types as $tax_type ):
			$terms = get_terms( $tax_type['tax'], $tax_type['args']);
			if ( !is_wp_error($terms) && $terms ):
				foreach ( $terms as $term ):
					$response[] = array(
						'title' => $term->name,
						'link' => get_term_link( $term->term_id ),
						'type' => $tax_type['type'],
					);
				endforeach;
			endif;
		endforeach;
		
		// Set/update the value of the transient
		set_transient( $transient_key, $response, 12 * HOUR_IN_SECONDS );
	endif;
	
	// Return error if no response data
	if ( empty( $response ) ){
		return new WP_Error( 'kb_no_articles', 'No articles available', array( 'status' => 404 ) );
	}
	
	// Return either a WP_REST_Response or WP_Error object
	return $response;
}
