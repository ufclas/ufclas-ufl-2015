<?php
/**
 * Template Name: Article
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

  <div id="main" class="container">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-3">
      <ul class="breadcrumb-wrap">
        <li><a href="#">Breadcrumb</a></li>
        <li><a href="#">Breadcrumb</a></li>
      </ul>
      <h1>Article Page Title</h1>
    </div>
  </div>
  	<div class="row">
  		<div class="col-sm-3">
  			<div class="ul sidenav">
          <li class="btn-mobile-toggle" aria-hidden="true" role="presentation"><a href="#">Pages <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a></li>
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
  			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/_temp-rect.jpg" alt="" class="img-full m-bottom">
  			<h2>Heading Two</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate odio iste omnis nihil culpa est pariatur voluptatem neque, eaque maxime reprehenderit rem quo fuga dignissimos quas. Libero, aut, sapiente. Unde.</p>
        <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, fuga sed. Nisi excepturi, odit deleniti officiis quis minus sed placeat mollitia ad qui error voluptates laudantium illo libero expedita itaque!</blockquote>
        <h3>Heading Three</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur nihil beatae minus sunt voluptatum provident quidem possimus voluptate iure odit, id! <a href="#">Inline link</a> Voluptates excepturi sapiente aut sed ullam! Vitae exercitationem, repudiandae!</p>
        <dl>
          <dt>Definition Term</dt>
          <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam accusantium soluta iste nemo, sequi perferendis nesciunt rem ipsam aspernatur hic quos voluptas consequatur, officiis, quod quibusdam deserunt, repudiandae numquam odio!</dd>
          <dt>Definition Term</dt>
          <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam accusantium soluta iste nemo, sequi perferendis nesciunt rem ipsam aspernatur hic quos voluptas consequatur, officiis, quod quibusdam deserunt, repudiandae numquam odio!</dd>
        </dl>
        <h4>Heading Four</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, adipisci, cumque veritatis ipsam, quod eos debitis voluptate ipsum magni consequuntur labore ipsa nisi, ad perspiciatis alias laboriosam quis sequi quibusdam?</p>
        <ul>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
        </ul>
        <h5>Heading Five</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, adipisci, cumque veritatis ipsam, quod eos debitis voluptate ipsum magni consequuntur labore ipsa nisi, ad perspiciatis alias laboriosam quis sequi quibusdam?</p>
        <ol>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
          <li>Consectetuer Adipiscing Elit</li>
        </ol>
  		</div>
  	</div>
  </div>

<?php get_footer(); ?>