<?php
/**
 * Template Name: Article Directory
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

  <div id="main" class="container">
  	<div class="row">
  		<div class="col-sm-9 col-sm-offset-1">
  			<h1>Article Page Title</h1>
        <div class="kicker">
  		    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat iusto sapiente et unde velit reprehenderit, sunt.</p>
        </div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-sm-10 col-sm-offset-1 col-md-11">
  			<ul class="academic-list">
          <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Filter <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
  				<li><a href="#">Sort item</a></li>
  				<li><a href="#">Another Sort item</a></li>
          <li><a href="#">Sort item</a></li>
          <li><a href="#">Another Sort item</a></li>
  			</ul>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-1">
  			<ul class="majors-list" data-category="A">
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  			</ul>
  			<ul class="majors-list" data-category="B">
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  				<li><a href="#">Another Directory Item Here</a></li>
  				<li><a href="#">Directory Item Here</a></li>
  			</ul>
  		</div>

      <div class="col-sm-10 col-sm-offset-1 col-md-offset-0 col-md-3">
        <div class="filter-wrap">
          <ul>
            <li><a href="#">College of Education</a></li>
            <li><a href="#">College of Nursing</a></li>
            <li><a href="#">College of The Arts</a></li>
            <li><a href="#">College of Education</a></li>
            <li><a href="#">College of Nursing</a></li>
            <li><a href="#">College of The Arts</a></li>
          </ul>
        </div>
      </div>
  	</div>
  </div>

<?php get_footer(); ?>