<?php
/*
Plugin Name: List Category Posts - Template "Recent News"
Description: Template file for List Category Post Plugin for Wordpress which is used by plugin by argument template=value.php
Version: 0.9
*/

/**
* The format for templates changed since version 0.17.  Since this
* code is included inside CatListDisplayer, $this refers to the
* instance of CatListDisplayer that called this file.
*/

/* This is the string which will gather all the information.*/
$lcp_display_output = '';

// Show category link:
$lcp_display_output .= $this->get_category_link('strong');

// Show the conditional title:
$lcp_display_output .= $this->get_conditional_title();

//Add 'starting' tag. Here, I'm using an unordered list (ul) as an example:
$lcp_display_output .= '<ul class="lcp_catlist">';

/* Posts Loop
 *
 * The code here will be executed for every post in the category.  As
 * you can see, the different options are being called from functions
 * on the $this variable which is a CatListDisplayer.
 *
 * CatListDisplayer has a function for each field we want to show.  So
 * you'll see get_excerpt, get_thumbnail, etc.  You can now pass an
 * html tag as a parameter. This tag will sorround the info you want
 * to display. You can also assign a specific CSS class to each field.
*/

global $post;

ob_start();
while ( have_posts() ) : the_post();
 	
	/**
	 * Display posts, this doesn't change when widget options change
	 */
  	echo '<li>';
	the_title( sprintf( '<h3 class="lcp_post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); 
  	
	if ( has_post_thumbnail() ):
  	
	echo '<a href="' . esc_url( get_permalink() ) . '">';
	the_post_thumbnail( 'thumbnail', array( 'class' => '' ) );
	echo '</a>';
	
  	endif;
	
	the_date('', '<span class="lcp_date">', '</span>');
	
	echo '<p class="lcp_excerpt">';
	the_excerpt();
	echo '</p>';
	echo '</li>';
	
endwhile;
 $lcp_display_output .= ob_get_clean();
 
// Close the wrapper I opened at the beginning:
$lcp_display_output .= '</ul>';

// If there's a "more link", show it:
$lcp_display_output .= $this->get_morelink();

// Get category posts count
$lcp_display_output .= $this->get_category_count();

//Pagination
$lcp_display_output .= $this->get_pagination();

$this->lcp_output = $lcp_display_output;


