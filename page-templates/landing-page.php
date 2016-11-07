<?php
/**
 * Template Name: Landing Page
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>
<?php 
	if ( has_post_thumbnail() ):
		$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" image="%d" image_height="%s"]%s[/ufl-landing-page-hero]', 
			get_the_title(),
			get_post_thumbnail_id(),
            'half',
			''
		);
		echo do_shortcode( $shortcode );
	endif;
?>
<div id="main" class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php 
				if ( ! has_post_thumbnail() ): 
					the_title( '<h1 class="entry-title">', '</h1>' );
				endif;
			?>
			
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'template-parts/content', 'landing' ); ?>
        
        	<?php endwhile; // End of the loop. ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>