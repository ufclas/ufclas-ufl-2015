<?php
/**
 * Template part for displaying general content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */

?>
<!-- content ufclas_syllabus -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_archive() ): ?>
        
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header><!-- .entry-header -->
        
	<?php else: ?>
    
        <div class="entry-meta">
			<?php //ufclas_ufl_2015_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
    
    <div class="entry-content">
        <?php
			if ( is_singular() ):
				the_content(); ?>
				
				<!-- Start Attachments -->
				<?php 
				$attachments_txt = sprintf( '<thead><tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr></thead>', __('Course', 'ufclas-ufl-2015'), __('Section', 'ufclas-ufl-2015'), __('Course Title/Syllabus', 'ufclas-ufl-2015'), __('Instructor(s)', 'ufclas-ufl-2015') );
				if ( class_exists( 'Attachments' ) ):
					$attachments = new Attachments( 'syllabus_attachments' ); /* pass the instance name */
					
					if( $attachments->exist() ) :				    	
						$attachments_txt .= '<tbody>';
						while( $attachments->get() ) :
							$course_url = $attachments->url();
							$course_title = $attachments->field('title');
							$course_number = $attachments->field('syllabus_course_number');
							$course_section = $attachments->field('syllabus_section');
							$course_instructor = $attachments->field('syllabus_instructor');
							$attachments_txt .= sprintf( '<tr><td>%s</td><td>%s</td><td><a href="%s" target="_blank">%s</a></td><td>%s</td></tr>', $course_number, $course_section, $course_url, $course_title, $course_instructor );
						endwhile;
						$attachments_txt .= '</tbody>';
					endif; 
				endif;
				
				$attachments_txt = printf( '<table class="table table-striped">%s</table>', $attachments_txt );
					
				?>
				<!-- End Attachments -->
            <?php    
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
