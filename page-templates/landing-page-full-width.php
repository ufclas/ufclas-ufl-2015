<?php
/**
 * Template Name: Landing Page (Full-Width)
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>
<?php 
	if ( has_post_thumbnail() ):
		$shortcode = sprintf( '[ufclas-landing-page-hero-full headline="%s" image="%d"]%s[/ufclas-landing-page-hero-full]', 
			get_the_title(),
			get_post_thumbnail_id(),
			''
		);
		echo do_shortcode( $shortcode );
	endif;
?>
<div id="main">
    
	<?php get_sidebar('page_sections'); ?>
    
</div>

<?php get_footer(); ?>