<?php 

/**
 * Remove the default CSS styles
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_remove_style() {
	wp_dequeue_style('kbe_theme_style');
	wp_deregister_style('kbe_theme_style');
}
add_action( 'wp_enqueue_scripts', 'ufclas_ufl_2015_kb_remove_style', 11 );

/**
 * Remove the default templates
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
	
	if ( is_singular('kbe_knowledgebase') ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-article.php';
	}
	
	if ( is_post_type_archive('kbe_knowledgebase') || is_tax('kbe_taxonomy') || is_tax('kbe_tags') ){
		$template_path = get_stylesheet_directory() . '/inc/wp-knowledgebase/kb-archive.php';
	}
	
	return $template_path;
}
add_action( 'template_include', 'ufclas_ufl_2015_kb_template', 11 );

/**
 * Modify the default rewrite rules
 *
 * @since 0.8.0
 */
function ufclas_ufl_2015_kb_modify_rewrites(){
	// Change the kb article rewrite
	$post_type_args = get_post_type_object( 'kbe_knowledgebase' );
	$post_type_args->rewrite['slug'] = 'kb';
	register_post_type( 'kbe_knowledgebase', (array)$post_type_args );
	
	// Change the kb category rewrite
	$category_args = get_taxonomy( 'kbe_taxonomy' );
	$category_args->rewrite['slug'] = 'kb/category';
	register_taxonomy( 'kbe_taxonomy', 'kbe_knowledgebase', (array) $category_args );
	
	// Change the kb tags rewrite
	$tag_args = get_taxonomy( 'kbe_tags' );
	$tag_args->rewrite['slug'] = 'kb/tag';
	register_taxonomy( 'kbe_tags', 'kbe_knowledgebase', (array) $tag_args );
}
add_action( 'init', 'ufclas_ufl_2015_kb_modify_rewrites', 11 );