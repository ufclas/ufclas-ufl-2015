<?php
/**
 * Template part for displaying posts.
 *
 * @package UFCLAS_PUBS
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-header">
        
		<?php if ( has_post_thumbnail() ): ?>
            <?php
             $image_id = get_post_thumbnail_id();
             $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
             $image_description = get_post(get_post_thumbnail_id())->post_content; ?>
             <?php echo do_shortcode('[ufclas-image-full-width image="' . $image_id . '" caption="' . $image_description . '" credit="' . $image_caption . '"]'); ?>
        <?php else: ?>
            <figure class="container-fluid">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/_temp-landing-a-2.jpg" class="img-responsive" width="100%" alt="Placeholder image">
                <figcaption><?php echo 'Featured placeholder image description. Use the image caption field for the alt text.'; ?></figcaption>
            </figure>
        <?php endif; ?>
        
        
    </div>
    
    <div class="entry-content">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    <?php the_content(); ?>
    </div><!-- .entry-content -->
    
    <footer class="entry-footer">
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ufclas-ufl-2015' ),
            'after'  => '</div>',
        ) );
        ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
