<?php
/**
 * Template Name: Landing Page w/ Title
 * 
 * @package UFCLAS_UFL_2015
 *
 */
get_header(); ?>

<div id="main" class="container">
  	<div class="row">
  		<div class="col-sm-12">
  			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  		</div>
  	</div>
</div>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php get_template_part( 'template-parts/content', 'landing' ); ?>

<?php endwhile; // End of the loop. ?>

	<div class="stat-breaker">
		<div class="hor-scroll-wrap">
			<div class="container">
				<div class="stat-block-wrap hor-scroll-el col-sm-4">
					<div class="stat-block">
						<div class="stat">
				    	<h2>10</h2>
				    </div>
				    <div class="info">
				      <div class="info-copy">
				        <p>A Longer Detailed Stat Description Revealed On Hover Of The Stat lorem ipsum dolar sit amet lorem</p>
				      </div>
				     </div>
					</div>
				</div>

				<div class="stat-block-wrap hor-scroll-el col-sm-4">
					<div class="stat-block">
						<div class="stat large">
				    	<h2>1000</h2>
				    </div>
				    <div class="info">
				      <div class="info-copy">
				        <p>A More Detailed Stat Description Revealed On Hover Of The Stat</p>
				      </div>
				     </div>
					</div>
				</div>

				<div class="stat-block-wrap hor-scroll-el col-sm-4">
					<div class="stat-block">
						<div class="stat larger">
				    	<h2>10000</h2>
				    </div>
				    <div class="info">
				      <div class="info-copy">
				        <p>A More Detailed Stat Description Revealed On Hover Of The Stat</p>
				      </div>
				     </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content-box-module">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 content-box-copy">
					<h2>A Longer Secondary Headline Here Introducing This Section</h2>
					<p>Lorem ised ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
					<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
					<a href="#" class="read-more">learn more</a>
					<span class="category-tag orange">Category</span>
				</div>
				<div class="col-sm-5 content-box-img" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/_temp-landing-a-1.jpg)">
					<img src="http://dummyimage.com/470x532" alt="" class="visuallyhidden">
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>