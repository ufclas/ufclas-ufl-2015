<?php
/**
 * Full Width Page (no sidebars or widgets)
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<?php 
	$issue_title = ufclas_ufl_2015_issuem_newsletter_title();
	$issue_description = term_description( get_term_by( 'slug', get_active_issuem_issue(), 'issuem_issue' ) );
	
	if ( has_post_thumbnail() ):
		$custom_meta = get_post_meta( get_the_ID() );
		$custom_meta_image_height = ( isset( $custom_meta['custom_meta_image_height']) )? $custom_meta['custom_meta_image_height'][0] : '';
		$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" subtitle="%s" image="%d" image_height="%s"]%s[/ufl-landing-page-hero]', 
			get_the_title(),
			$issue_title,
			get_post_thumbnail_id(),
            $custom_meta_image_height,
			''
		);
		echo do_shortcode( $shortcode );
	endif;
	
	// Newsletter menu
	if ( has_nav_menu( 'newsletter-menu' ) ): ?>
   
        <nav id="newsletter-menu" class="navbar navbar-inverse subnav" role="navigation">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#newsletter-menu-navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Menu   
              </button>
            </div>
        <?php
		wp_nav_menu( array( 
			'theme_location' => 'newsletter-menu',
			'depth' => 2,
			'container' => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id' => 'newsletter-menu-navbar',
			'menu_class' => 'nav navbar-nav',
			'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
			'walker' => new wp_bootstrap_navwalker()
		));
        ?>
        </div>
        </nav>   
	<?php endif; ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <header class="entry-header">
      <?php 
	  	// $issue_title = ufclas_ufl_2015_issuem_newsletter_title();
		// printf( '<h1 class="entry-title">%s</h1>', $issue_title );
		
		/* Display Issue Description, if exists */
		// $issue_description = term_description( get_term_by( 'slug', get_active_issuem_issue(), 'issuem_issue' ) );
		
		if ( !empty($issue_description) ){
			printf( '<div class="taxonomy-description issuem-description">%s</div>', $issue_description );
		}
      ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <?php 
		// Change the query if this is an issue page
		if ( is_page() ){
			$issue_args = array(
				'post_type' => 'article',
				'orderby' => 'menu_order date',
				'order' => 'ASC',
				'posts_per_page' => -1,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'issuem_issue',
						'field' => 'slug',
						'terms' => get_active_issuem_issue()
					),
				),
			);
			$issue_query = new WP_Query( $issue_args );	
		}
		else {
			$issue_query = $wp_query;		
		}
		
		 /* Display each article */
		while( $issue_query->have_posts() ) : $issue_query->the_post(); 
		
		if( has_post_thumbnail() ){
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			$article_background = ' style="background-image: url(' . $image_url[0] . ');"';
		}
		else {
			$article_background = '';	
		}
	?>

    <article id="issuem-article-<?php the_ID(); ?>" class="issuem-article col-lg-4 col-md-6">
    <div class="big-stat-wrap big-stat-img four gradient-bg"<?php echo $article_background; ?>>
    <div class="big-stat-copy">
        <h2><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h2>
       
        <p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read-more">Read more</a></p>
    </div>
    <?php 
        if( has_term('', 'issuem_issue_categories') ){
            $article_terms = get_the_terms( get_the_ID(), 'issuem_issue_categories' );
            echo '<a href="' . get_term_link( $article_terms[0]->term_id, 'issuem_issue_categories' ) . '" class="category-tag">' . $article_terms[0]->name . '</a>';
        }
    ?>
    </div>
    </article>
    <?php endwhile; ?>
  </div>   
</div>
    <div class="row">
    	<div class="col-md-12">
    	<p><a href="#main" class="read-more btn">Back to top</a></p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
