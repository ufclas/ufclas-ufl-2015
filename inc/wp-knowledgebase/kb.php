<?php 

/**
 * Remove the default CSS styles
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_remove_style() {
	wp_dequeue_style('kbe_theme_style');
	wp_deregister_style('kbe_theme_style');
	
	// Replacing the default live search
	wp_dequeue_script('kbe_live_search');
	wp_enqueue_style('awesomplete', get_stylesheet_directory_uri() . '/inc/awesomplete/awesomplete.css', array(), null );
	wp_enqueue_script('awesomplete', get_stylesheet_directory_uri() . '/inc/awesomplete/awesomplete.js', array(), null, true);
	wp_enqueue_script('ufclas-ufl-2015-kb', get_stylesheet_directory_uri() . '/inc/wp-knowledgebase/kb.js', array('awesomplete'), null, true);
	
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
	
	if ( is_search() && ( get_query_var('post_type') == 'kbe_knowledgebase' ) ){
		if ( isset($_GET['ajax']) ){
			$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-search.php';
		}
		else {
			$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-archive.php';   
		}
	}
	
	elseif ( is_singular('kbe_knowledgebase') ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-article.php';
	}
	
	elseif ( is_tax('kbe_taxonomy') || is_tax('kbe_tags') ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-archive.php';
	}
	
	elseif ( is_post_type_archive('kbe_knowledgebase') ){
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
	
	// Redefine the kb article
	$post_type_args = get_post_type_object( 'kbe_knowledgebase' );
	$post_type_args->rewrite['slug'] = 'kb';
    $post_type_args->labels->name = 'Knowledge Base';
	$post_type_args->show_in_rest = true;
	$post_type_args->rest_base = 'kb';
	
	dbgx_trace_var( $post_type_args );
	
	register_post_type( 'kbe_knowledgebase', (array)$post_type_args );
	
	// Redefine the kb category
	$category_args = get_taxonomy( 'kbe_taxonomy' );
	$category_args->rewrite['slug'] = 'kb/category';
	register_taxonomy( 'kbe_taxonomy', 'kbe_knowledgebase', (array) $category_args );
	
	// Redefine the kb tags
	$tag_args = get_taxonomy( 'kbe_tags' );
	$tag_args->rewrite['slug'] = 'kb/tag';
	register_taxonomy( 'kbe_tags', 'kbe_knowledgebase', (array) $tag_args );
}
add_action( 'init', 'ufclas_ufl_2015_kb_modify_custom', 11 );

/**
 * Modify the kb category and tags rewrite rules to show articles
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_modify_rewrite( $rules ){
	
	$rules['kb/category/([^/]+)/?$'] = 'index.php?post_type=kbe_knowledgebase&kbe_taxonomy=$matches[1]';
	$rules['kb/tag/([^/]+)/?$'] = 'index.php?post_type=kbe_knowledgebase&kbe_tags=$matches[1]';

	return $rules;
}
add_filter( 'rewrite_rules_array', 'ufclas_ufl_2015_kb_modify_rewrite' );

/**
 * Template tag to display the header and search form
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_header(){
	$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" subtitle="%s" image="%s" image_height="%s"]%s[/ufl-landing-page-hero]', 
        'Help and How-to',
        '',
        '',
        'half',
        'FORM'
    );
    
    ob_start(); ?>
    
    <form id="live-search" action="<?php echo home_url('/'); ?>" method="get" class="search-form" role="search" autocomplete="off">
    <label for="s" class="visuallyhidden"><?php esc_html_e('Search', 'ufclas-ufl-2015'); ?></label>
    <input type="text" id="s" name="s" class="awesomplete" placeholder="<?php esc_attr_e('Search', 'ufclas-ufl-2015'); ?>" />
    <button type="submit" class="btn-search">
        <span class="icon-svg">
        <svg>
            <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#search"></use>
        </svg>
      </span>
    </button>
    <input type="hidden" name="post_type" value="kbe_knowledgebase" />
    </form>

    <?php
    $form = ob_get_clean();
    
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
	
	if ( is_post_type_archive('kbe_knowledgebase') && !is_tax('kbe_taxonomy') && !is_tax('kbe_tags') ){
		$classes[] = 'kb-homepage';
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
		$post_type = 'kbe_knowledgebase';
		$post_type_obj = get_post_type_object( 'kbe_knowledgebase' );
		$taxonomy = 'kbe_taxonomy';
		$crumbs = array();
		
		echo '<ul class="kb-breadcrumbs">';
		
		echo '<li><a href="' . get_post_type_archive_link( $post_type ) . '">' . $post_type_obj->labels->name . '</a></li>';
		
		// Get the correct term ID
		if ( is_single() ){
			$current_terms = get_the_terms( $current->ID, $taxonomy );
			$current_id = ( $current_terms )? $current_terms[0]->term_id : false;
		}
		elseif ( !is_search() ) {
			$current_id = $current->term_id;
		}
		
		// Add term and any term ancestors to array of crumbs
		if ( isset($current_id) ){
			
			$current_ancestors = get_ancestors( $current_id, $taxonomy, 'taxonomy' );
			
			if ( empty($current_ancestors) ){
				$crumbs = ( is_single() )? array($current_id) : array();
			}
			else {
				$crumbs = array_merge( $crumbs, $current_ancestors );
				$crumbs = array_reverse( $crumbs );
			}
			
			// Display the breadcrumbs list
			foreach ( $crumbs as $crumb_id ){
				echo '<li><a href="' . get_term_link( $crumb_id ) . '">' . get_term( $crumb_id, $taxonomy )->name . '</a></li>';
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
