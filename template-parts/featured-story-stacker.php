<?php
/**
 * Template part for displaying story stacker similar to previous UF theme.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UF_CLAS_2015
 */

$slider_category = get_theme_mod('featured_category');
$slider_number_of_posts = 3;

$slider_query = new WP_Query(array(
	'cat' => $slider_category,
	'posts_per_page' => $slider_number_of_posts,
));

if ( $slider_query->have_posts() ):

	//$slider_speed = of_get_option('opt_featured_speed');
	//$slider_disable_link = of_get_option('opt_featured_disable_link');
	$slider_speed = 7000; // debug 	
	$slider_disable_link = 0; // debug
	$slider_type = ' carousel-fade'; // debug
	
?>
<div class="carousel-row row">
    <div class="container carousel-wrap">
        <div id="featured-stacker" class="carousel slide<?php echo $slider_type; ?>" data-ride="carousel" data-interval="<?php echo $slider_speed; ?>">
        
            <div class="stacker-main col-sm-7 col-md-8">
            <div class="carousel-inner" role="listbox">
            <?php 
                 while( $slider_query->have_posts() ): $slider_query->the_post();
					$custom_meta = array(
						/*'custom_meta_image_type' => get_field('custom_meta_image_type'),*/
						'custom_meta_image_type' => 1, // debug
					);
					$image_full_width = ( isset($custom_meta['custom_meta_image_type']) )? $custom_meta['custom_meta_image_type'][0]:NULL;
					// $slider_disable_dates = of_get_option('opt_story_stacker_disable_dates');
					$slider_disable_dates = false; // debug
					$slider_first_id = $slider_query->posts[0]->ID;
                    $slide_class = ( $slider_first_id == get_the_ID() )? ' active':'';
					$slide_class .= ( $image_full_width )? ' full-image-feature':' half-image-feature';
					$slide_thumbnail_size = ( $image_full_width )? 'full-width-thumb':'half-width-thumb';
					$slide_url = esc_url( get_permalink() );
                ?>
                <!-- Main Stacker Image -->
                <div class="item<?php echo $slide_class; ?>" id="item-<?php the_ID(); ?>">
                    
					<?php if ( has_post_thumbnail() ): ?>
                    <div class="slide-image">
						<?php the_post_thumbnail( $slide_thumbnail_size ); ?>
					</div>
					<?php endif; ?>
                    
                    <div class="carousel-caption">
                        <?php 
                        if( !$slider_disable_link ){ // Add link to the title
							the_title( sprintf('<h3><a href="%s">', $slide_url), '</a></h3>' );
						}
						else {
							the_title( '<h3>', '</h3>' );
						}
                        ?>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </div><!-- .item -->
                
            <?php endwhile; ?>
            </div><!-- .carousel-inner -->
            </div><!-- .stacker-main -->
            
            <!-- Indicators -->
                <div class="stacker-control col-sm-5 col-md-4">
                <ol class="carousel-indicators">
                <?php 
					$i = 0;
					while( $slider_query->have_posts() ): $slider_query->the_post(); 
						$slide_class = (0 == $i)? 'active':''; 
						?>
                        <li data-target="#featured-stacker" data-slide-to="<?php echo $i; ?>" class="<?php echo $slide_class; ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
                            <div class="excerpt">
                              <h3><?php the_title(); ?></h3>
                              <?php if(!$slider_disable_dates) : ?>
								<span class="meta"><?php the_time('F j, Y'); ?></span>
	  						<?php endif ?>
                            </div>
                        </li>
                <?php 
					$i++;
					endwhile; ?>
                </ol>
                </div>
            
        </div><!-- .carousel -->
	</div><!-- .carousel-wrap -->
</div><!-- .carousel-row -->
<?php 
endif;

// Restore original post data
wp_reset_postdata();