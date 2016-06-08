<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); ?>
  
  <div id="main" class="container">
  	<div class="row">
  		<div class="col-sm-12">
  			<h1>Templates</h1>
  			<ul class="big-list">
                <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">View templates <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/home/">Homepage <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/landing-page/">Landing Page A <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/landing-page-b/">Landing Page B <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/programs-list/">Article Directory <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/article-list/">Article List <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/article-list-alt/">Article List Alternative <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/article-page/">Article <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/audience-landing-page/">Audience Landing Page <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/search-result/">Search Results Page <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/home/?alert=small">Small Emergency Alert <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/home/?alert=big">Big Emergency Alert <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/form/">Form style guide <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
                <li><a href="<?php echo site_url(); ?>/unit-header/">Unit Header <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
  			</ul>
  		</div>
  	</div>
  </div>
  
<?php get_footer(); ?>
