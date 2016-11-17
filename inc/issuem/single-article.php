<?php
/**
 * IssueM Article template
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<div id="main" class="container main-content">
<div class="row">
  <div class="col-sm-12">
    <?php 
		// Get information about the current article's issue, if set
		$article_issue = ufclas_ufl_2015_issuem_issue_data();
		if( $article_issue ){
			printf('<ul class="breadcrumb-wrap"><li><a href="%s">%s</a></li></ul>', $article_issue['url'], $article_issue['title'] );
		}
	?>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php 			
				if( has_post_thumbnail() ){
					$custom_meta = get_post_meta( get_the_ID() );
					$hide_featured = ( isset( $custom_meta['custom_meta_post_remove_featured'] ) )? $custom_meta['custom_meta_post_remove_featured'] : 0;
					if( !$hide_featured ){
						$img_data = wp_prepare_attachment_for_js( get_post_thumbnail_id() );
						$img_size = 'medium';
						$img_align = 'alignleft';
						$img = get_the_post_thumbnail( get_the_ID(), $img_size, array( 'class' => 'img-responsive ' . $img_align ) );
						echo do_shortcode( sprintf('[caption align="%s" width="%d"]%s %s[/caption]', $img_align, $img_data['sizes'][$img_size]['width'], $img, $img_data['description'] ) );
					}
            	}
            ?>
            
            <div class="entry-content">
            	<?php the_content(); ?>
            </div> <!-- .entry-content -->
            
            <footer class="entry-footer">
                 <p class="posted-on">By <?php the_author(); ?>, <?php ufclas_ufl_2015_issuem_posted_on(); ?></p>
                <?php if ( $article_issue ): ?>
                    <p><a href="<?php echo $article_issue['url']; ?>" title="<?php echo $article_issue['title']; ?>" class="btn"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Issue</a></p>
                <?php endif; ?>
                <?php edit_post_link( __( 'Edit Article', 'ufclas-ufl-2015' ), '<p class="edit-link">', '</p>' ); ?>
            </footer> <!-- .entry-footer --> 
        </article>
        <!-- #post-## -->
    <?php endwhile; ?>
  </div>
  
</div>
</div>

<?php get_footer(); ?>
