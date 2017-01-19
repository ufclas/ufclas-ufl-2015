<?php
 /**
 * IssueM newsletter functions
 * 
 */

/** 
 * Customize IssueM defaults for theme
 *
 * @see IssueM::get_settings() For all default settings in issuem-class.php
 * @param array $defaults
 * @return array Updated defaults
 */
function ufclas_ufl_2015_issuem_default_settings( $defaults ){
	$theme_defaults = array(
		'cover_image_width'	=> 320,
		'cover_image_height' => 400,
		'css_style'	=> 'none',
	);
	return array_merge( $defaults, $theme_defaults );
}
add_filter( 'issuem_default_settings', 'ufclas_ufl_2015_issuem_default_settings' );

/** 
 * Add custom templates
 * @return string
 */
function ufclas_ufl_2015_issuem_templates( $template_path ){
	
	$issuem_settings = get_issuem_settings();
	
	if ( is_singular('article') ){
		
		// Change template for article pages
		$template_path = get_stylesheet_directory() . '/inc/issuem/single-article.php';
		
	} elseif ( is_tax('issuem_issue') ){
		
		// Change template for issue pages
		$template_path = get_stylesheet_directory() . '/inc/issuem/taxonomy-issuem_issue.php';
		
	} elseif ( is_page($issuem_settings['page_for_articles']) && !empty($issuem_settings['page_for_articles']) ){
		
		// Change template for the newsletter page
		$template_path = get_stylesheet_directory() . '/inc/issuem/taxonomy-issuem_issue.php';
	
	} elseif ( is_page($issuem_settings['page_for_archives']) && !empty($issuem_settings['page_for_archives']) ){
		
		// Change template for the newsletter page
		$template_path = get_stylesheet_directory() . '/page-templates/issuem-page.php';
	
	} elseif ( is_tax('issuem_issue_categories') ){
	
		// Change template for article pages
		$template_path = get_stylesheet_directory() . '/inc/issuem/taxonomy-archive.php';
	
	} elseif ( is_search() && ( get_query_var('post_type') == 'article' ) ){
	
		// Change template for article pages
		$template_path = get_stylesheet_directory() . '/inc/issuem/taxonomy-archive.php';
	}
	
	return $template_path;
}
add_filter( 'template_include', 'ufclas_ufl_2015_issuem_templates', 1 );

/** 
 * Set the title of the newsletter to be the title of the issue page
 *
 * @return string
 */
function ufclas_ufl_2015_issuem_newsletter_title(){
	$issuem_settings = get_issuem_settings();
	$current_issue = ufclas_ufl_2015_issuem_issue_data();
	
	if ( is_page() && isset($issuem_settings['page_for_articles']) ) {
		$issue_page_title = get_the_title( $issuem_settings['page_for_articles'] );
	}
	else {
		$issue_page_title = $current_issue['title'];	
	}
	
	return $issue_page_title;
}

// Use category order - see issuem-shortcodes.php
function ufclas_ufl_2015_issuem_get_categories(){
	$terms = array();
	$all_terms = get_terms( 'issuem_issue_categories' );
	
	foreach( $all_terms as $term ) {
	
		$issue_cat_meta = get_option( 'issuem_issue_categories_' . $term->term_id . '_meta' );
			
		if ( !empty( $issue_cat_meta['category_order'] ) )
			$terms[ $issue_cat_meta['category_order'] ] = $term;
		else
			$terms[] = $term;
	}
	ksort($terms);
	return $terms;
}

/**
 * Add Newsletter Menu, Allow the 'aside' post format
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_setup(){
	register_nav_menus( array(
		'newsletter-menu' => esc_html__( 'Newsletter Menu', 'ufclas-ufl-2015' ),
	) );
	
}
add_action( 'after_setup_theme', 'ufclas_ufl_2015_issuem_setup' );

/**
 * Modify the main query for issue pages
 * 
 * Display articles by menu order then modified date
 */
function ufclas_ufl_2015_issuem_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;
	
    if ( $query->is_tax('issuem_issue') ) {
        $query->set( 'orderby', 'menu_order date' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'ufclas_ufl_2015_issuem_query', 1 );

/**
 * Remove columns from the article admin screen
 *
 * @param array $columns
 * @return array Columns to display on All articles screen
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_article_posts_columns( $columns ){
	unset($columns['comments']);
	unset($columns['expirationdate']);
	return $columns;
}
add_filter('manage_article_posts_columns', 'ufclas_ufl_2015_issuem_article_posts_columns');

/**
 * Add an 'issue' filter dropdown to the articles screen
 *
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_article_filter_list() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'article' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Issues',
            'taxonomy' => 'issuem_issue',
            'name' => 'issuem_issue',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['issuem_issue'] ) ? $wp_query->query['issuem_issue'] : '' ),
            'hierarchical' => false,
            'depth' => 1,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}
add_action( 'restrict_manage_posts', 'ufclas_ufl_2015_issuem_article_filter_list' );

/**
 * Query for the 'Issue' filter dropdown on the articles screen
 *
 * @param $query
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_article_filter( $query ) {
	if ( is_admin() ){ 
		$qv = &$query->query_vars;
		if( isset( $qv['issuem_issue'] ) ){
			if ( ( $qv['issuem_issue'] ) && is_numeric( $qv['issuem_issue'] ) ) {
				$term = get_term_by( 'id', $qv['issuem_issue'], 'issuem_issue' );
				$qv['issuem_issue'] = $term->slug;
			}
		}
	}
}
add_filter( 'parse_query','ufclas_ufl_2015_issuem_article_filter' );

/**
 * Add a read more link for article excerpts and conent
 *
 * @param string $more
 * @return string Read more text to display
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_readmore( $more ) {
	return '<p class="read-more"><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'ufclas-ufl-2015') . '</a></p>';
}
add_filter('excerpt_more', 'ufclas_ufl_2015_issuem_readmore');
add_filter( 'the_content_more_link', 'ufclas_ufl_2015_issuem_readmore' );

/**
 * Get information about the active issue from the term data
 *
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_issue_data() {
	global $post;
	
	// Get the issue term object assigned to the current post or taxonomy page
	if( is_page() ){
		$issue_terms = get_terms( 'issuem_issue', array('slug' => get_issuem_issue_slug() ));
	}
	else {
		$issue_terms = wp_get_object_terms($post->ID, 'issuem_issue');
	}
	
	if(!empty($issue_terms) && !is_wp_error($issue_terms)){
		
		$issue_term = $issue_terms[0];
		
		$queried_issue = array(
			'title' => $issue_term->name,
			'url' => get_term_link( $issue_term ),
			'description' => term_description( $issue_term )
		);
	}
	else {
		$queried_issue = false;
	}
	return $queried_issue;
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_posted_on() {
	$time_format = '<time class="entry-date published" datetime="%s">%s</time>';
	echo '<span class="posted-on">Posted on ' . sprintf($time_format, esc_attr(get_the_date('c')), esc_html(get_the_date()) ) . '</span>';

}

/**
 * Adds site name to title
 *
 * @since 1.2.0
 */
function ufclas_ufl_2015_issuem_title( $title, $sep ) {
	$issuem_settings = get_issuem_settings();
	
	if( (get_post_type() == 'article') || is_tax('issuem_issue') || is_page($issuem_settings['page_for_articles']) ){
		$title .= get_bloginfo('name');
	}
	return $title;
}
add_filter( 'wp_title', 'ufclas_ufl_2015_issuem_title', 10, 2 );

/**
 * Get newsletter data
 *
 * @return array Newsletter data array based on IssueM settings
 * @since 0.7.0
 */
function ufclas_ufl_2015_newsletter_data() {
	global $post;
	
	$issuem_settings = get_issuem_settings();
	$issue_data = ufclas_ufl_2015_issuem_issue_data();
	
	$newsletter_data = array(
		'title' => __('Newsletter', 'ufclas-ufl-2015'),
		'subtitle' => $issue_data['title'],
		'articles_page' => $issuem_settings['page_for_articles'],
		'archives_page' => $issuem_settings['page_for_archives'],
		/*'cover' => $issuem_settings['default_issue_image'],*/
		'cover' => '',
		'image_height' => 'half'
	);
	
	if ( !empty($newsletter_data['articles_page']) ){
		$newsletter_data['title'] = get_the_title( $newsletter_data['articles_page'] );
		
		$cover = get_post_thumbnail_id( $newsletter_data['articles_page'] );
        if ( !empty( $cover ) ){
            $newsletter_data['cover'] = $cover; 
        }
		
		$custom_meta = get_post_meta( $newsletter_data['articles_page'] );
		if ( isset($custom_meta['custom_meta_image_height']) ){
			$newsletter_data['image_height'] = $custom_meta['custom_meta_image_height'][0];
		}
	}
	
	if ( is_page( $newsletter_data['archives_page'] ) ) {
		$newsletter_data['subtitle'] = get_the_title( $newsletter_data['archives_page'] );	
	}
	
	if ( is_page_template( 'page-templates/issuem-page.php' ) ) {
		$newsletter_data['subtitle'] = get_the_title( $post->ID );	
	}
	
	if ( is_tax('issuem_issue_categories') ){
		$newsletter_data['subtitle'] = get_the_archive_title();
	}
	return $newsletter_data;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 0.7.0
 */
function ufclas_ufl_2015_newsletter_classes( $classes ) {
	
	if ( is_page() ){
		$issuem_settings = get_issuem_settings();
		$articles_page = $issuem_settings['page_for_articles'];
		$archives_page = $issuem_settings['page_for_archives'];
		
		if ( !empty( $articles_page ) && is_page( $articles_page ) ) {
			$classes[] = 'newsletter-page';
			$classes[] = 'newsletter-page-articles';
		}
		if ( !empty( $archives_page ) && is_page( $archives_page ) ) {
			$classes[] = 'newsletter-page';
			$classes[] = 'newsletter-page-articles';
		}
		if ( is_page_template( 'page-templates/issuem-page.php' ) ) {
			$classes[] = 'newsletter-page';
		}
	}
	
	return $classes;
}
add_filter( 'body_class', 'ufclas_ufl_2015_newsletter_classes' );


if(function_exists("register_field_group")) {
	
	$issuem_settings = get_issuem_settings();
	$articles_page = $issuem_settings['page_for_articles'];
	
	/**
	 * Article Options (IssueM)
	 *
	 * @since 0.6.0
	 */
	register_field_group(array (
		'id' => 'acf_article-options',
		'title' => 'Article Options',
		'fields' => array (
			array (
				'key' => 'field_582cea7b9b215',
				'label' => 'Hide Featured Image',
				'name' => 'custom_meta_post_remove_featured',
				'type' => 'checkbox',
				'choices' => array (
					1 => 'Hide the featured image',
				),
				'default_value' => 0,
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'article',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
			),
		),
		'menu_order' => 0,
	));

	/**
	 * Newsletter Options (IssueM)
	 *
	 * @since 0.7.0
	 */
	register_field_group(array (
		'id' => 'acf_newsletter-options',
		'title' => 'Newsletter Options',
		'fields' => array (
			array (
				'key' => 'field_5880124b29884',
				'label' => 'Newsletter Cover Image Height',
				'name' => 'custom_meta_image_height',
				'type' => 'select',
				'instructions' => 'If the newsletter has a default cover image, this sets the height of the image.',
				'choices' => array (
					'large' => 'Large',
					'medium' => 'Medium',
					'half' => 'Small',
				),
				'default_value' => 'half',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => $articles_page,
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
			),
		),
		'menu_order' => 0,
	));
}


