<?php
/**
 * Template part for displaying carousel similar to previous UF theme.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UF_CLAS_2015
 */

$slider_category = get_theme_mod('featured_category');
$slider_number_of_posts = get_theme_mod('number_of_posts_to_show');

$slider_query = new WP_Query(array(
	'cat' => $slider_category,
	'posts_per_page' => $slider_number_of_posts,
));

if ( $slider_query->have_posts() ):

	//$slider_speed = of_get_option('opt_featured_speed');
	$slider_speed = 7000; // debug 
	//$slider_disable_link = of_get_option('opt_featured_disable_link');
	$slider_disable_link = 0; // debug
?>
<div class="carousel-row">
    <div class="container carousel-wrap">
        <div id="featured-carousel" class="carousel slide" data-ride="carousel" data-interval="<?php echo $slider_speed; ?>">
        <!-- Indicators -->
            <?php if ( $slider_query->post_count > 1 ): ?>
                <ol class="carousel-indicators">
                <?php for( $i=0; $i<$slider_query->post_count; $i++){ 
                        $slider_class = (0 == $i)? 'active':''; ?>
                        <li data-target="#featured-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $slider_class; ?>"></li>
                <?php } ?>
                </ol>
            <?php endif; ?>
            <div class="carousel-inner row" role="listbox">
            <?php 
                 while( $slider_query->have_posts() ): $slider_query->the_post();
					$custom_meta = array(
						'custom_meta_image_type' => get_field('custom_meta_image_type'),
					);
					$image_type = ( isset($custom_meta['custom_meta_image_type']) )? $custom_meta['custom_meta_image_type'][0]:NULL;
					$slider_first_id = $slider_query->posts[0]->ID;
                    $slider_class = ( $slider_first_id == get_the_ID() )? 'active':'';
					$slide_url = esc_url( get_permalink() );
					$slide_thumbnail = ( has_post_thumbnail() )? get_the_post_thumbnail( get_the_ID(), 'half-width-thumb'):'';
						
                ?>
                <!-- Full-Size Image Output -->
                <?php if ($image_type): ?>
                <div class="item full-image-feature <?php echo $slider_class; ?>" id="item-<?php the_ID(); ?>">
                    
					<?php if ( has_post_thumbnail() ): ?>
                    <div class="slide-image">
						<?php the_post_thumbnail( 'full-width-thumb' ); ?>
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
                <?php else: ?>
                
                <!-- Half-Width Image Output -->
                <div class="item half-image-feature <?php echo $slider_class; ?>" id="item-<?php the_ID(); ?>">
                    <div class="slide-image">
                        <?php 
						if( !$slider_disable_link ){ // Add link to the image and title
							echo '<a href="' . $slide_url . '">' . $slide_thumbnail . '</a>';
						}
						else{
							echo $slide_thumbnail;
						}
						?>
                    </div>
                    <div class="carousel-caption">
                        <?php 
						if( !$slider_disable_link ){ // Add link to the image and title
							//echo '<div class="slide-image"><a href="' . $slide_url . '">' . $slide_thumbnail . '</a></div>';
							the_title( sprintf('<h3><a href="%s">', $slide_url), '</a></h3>' );
						}
						else{
							//echo '<div class="slide-image">' . $slide_thumbnail . '</div>';
							the_title( '<h3>', '</h3>' );
						}
						?>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </div><!-- .item -->
                <?php endif; ?>
                
            <?php endwhile; ?>
            </div><!-- .carousel-inner -->
            <?php if ( $slider_query->post_count > 1 ): ?>
            <a class="left carousel-control" href="#featured-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only"><?php _e( 'Previous', 'ufclas-ufl-2015' ); ?></span>
            </a>
            <a class="right carousel-control" href="#featured-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only"><?php _e( 'Next', 'ufclas-ufl-2015' ); ?></span>
            </a>
            <?php endif; ?>
        </div><!-- .carousel -->
	</div><!-- .carousel-wrap -->
</div><!-- .carousel-row -->
<?php 
endif;

// Restore original post data
wp_reset_postdata();