<?php
 /**
 * IssueM newsletter functions
 * 
 */
//Include issue and article template files

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
	
	} elseif ( is_tax('issuem_issue_categories') ){
	
		// Change template for article pages
		//$template_path = get_stylesheet_directory() . '/inc/issuem/archive-article.php';
	
	} elseif ( is_search() && ( get_query_var('post_type') == 'article' ) ){
	
		// Change template for article pages
		//$template_path = get_stylesheet_directory() . '/inc/issuem/archive-article.php';
	}
	
	return $template_path;
}
add_filter( 'template_include', 'ufclas_ufl_2015_issuem_templates', 1 );

/** 
 * Set the title of the newsletter to be the title of the issue page
 * @return string
 */
function ufclas_ufl_2015_issuem_newsletter_title(){
	$issuem_settings = get_issuem_settings();
	$current_issue = ufclas_ufl_2015_issuem_issue_data();
	
	if ( is_page() && isset($issuem_settings['page_for_articles']) ) {
		// $issue_page_title = get_the_title( $issuem_settings['page_for_articles'] );
		$issue_page_title = $current_issue['title'];
	}
	else {
		$issue_page_title = $current_issue['title'];	
	}
	
	return $issue_page_title;
}

//remove_filter( 'the_content', 'default_issue_content_filter', 10 );

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
 * Allow the 'aside' post format
 * @since 1.1.0
 */
function ufclas_ufl_2015_issuem_setup(){
	/*register_nav_menus( array(
		'newsletter-global' => esc_html__( 'Newsletter Global Menu', 'ufclas-ufl-2015' ),
		'newsletter-primary' => esc_html__( 'Newsletter Primary Menu', 'ufclas-ufl-2015' ),
	) );*/
	
	add_theme_support( 'post-formats', array( 'aside' ) );	
}
add_action( 'after_setup_theme', 'ufclas_ufl_2015_issuem_setup' );

function ufclas_ufl_2015_issuem_global_menu( $items, $args ){
    /*if( $args->theme_location == 'newsletter-global' ){
        $items .= '<li id="search">
            <form role="search" method="get" action="' . home_url('/') . '" class="search-form">
              <div class="form-group has-feedback">
                <label for="search-field" class="sr-only">Search Articles</label>
                <input type="text" class="form-control" name="s" id="search-field" placeholder="Search Articles">
				<input type="hidden" value="article" name="post_type" id="post_type" />
                <i class="mdi mdi-magnify form-control-feedback"></i> </div>
            </form>
          </li>';
    }*/
    return $items;
}
add_filter('wp_nav_menu_items', 'ufclas_ufl_2015_issuem_global_menu', 10, 2);

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
			'description' => term_description( $issue_term ),
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