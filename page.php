<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */
get_header(); ?>

<div id="main" class="container">
<div class="row">
  <div class="col-sm-8 col-sm-offset-3">
    <ul class="breadcrumb-wrap">
      <li><a href="#">Breadcrumb</a></li>
      <li><a href="#">Breadcrumb</a></li>
    </ul>
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>
    <!-- .entry-header --> 
  </div>
</div>
<div class="row">
  <div class="col-sm-3">
    <div class="ul sidenav">
      <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Pages <span class="arw-right icon-svg"><svg>
        <use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use>
        </svg></span></a></li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a>
        <ul>
          <li><a href="#">Child Link</a></li>
          <li><a href="#">Child Link</a></li>
          <li><a href="#">Child Link</a></li>
        </ul>
      </li>
      <li class="active"><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
    </div>
  </div>
  <div class="col-sm-8">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php endwhile; // End of the loop. ?>
  </div>
</div>
</div>

<?php get_footer(); ?>
