<?php
/**
 * Template Name: Landing Page Full Width
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
            'full',
			''
		);
		echo do_shortcode( $shortcode );
	endif;
?>
<div id="main">
    
     <?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', 'landing' ); ?>
    
    <?php endwhile; // End of the loop. ?>
    
	<?php get_sidebar('page_sections'); ?>
    
</div>

<?php get_footer(); ?>