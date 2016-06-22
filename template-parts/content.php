<?php
/**
 * Template part for displaying general content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( !is_singular() ): ?>
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header><!-- .entry-header -->
	<?php endif; ?>
    
    <?php if ( has_post_thumbnail() ): ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); ?>
        </div>
    <?php endif; ?>
    
    <?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php //ufclas_ufl_2015_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
    
    <div class="entry-content">
        <?php
			if ( is_singular() ):
				the_content();
			else:
				the_excerpt();
			endif;
		?>
	</div><!-- .entry-content -->
    
    <footer class="entry-footer">
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ufclas-ufl-2015' ),
				'after'  => '</div>',
			) );
			
			edit_post_link(
				sprintf(
					esc_html__( 'Edit %s', 'ufclas-ufl-2015' ),
					the_title( '<span class="sr-only">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
    
</article><!-- #post-## -->
