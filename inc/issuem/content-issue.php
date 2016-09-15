<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ufclas-issuem
 */
 
/**
 * Display each article
*/
while( $issue_query->have_posts() ) : $issue_query->the_post(); 

if( has_post_thumbnail() ){
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
	$article_background = ' style="background-image: url(' . $image_url[0] . ');"';
}
else {
	$article_background = '';	
}
?>
<article class="col-md-4 col-sm-6">
<div id="issuem-article-<?php the_ID(); ?>" class="big-stat-wrap big-stat-img gradient-bg"<?php echo $article_background; ?>>
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

<p><a href="#content" class="read-more btn">Back to top</a></p>
