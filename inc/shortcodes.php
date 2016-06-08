<?php
/**
 * Theme shortcodes
 *
 *
 * @package UFCLAS_UFL_2015
 */
 
 /**
 * Add Landing Page Hero Image Shortcode
 * 
 * Example [ufclas-landing-page-hero][/ufclas-landing-page-hero]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_landing_hero($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'headline' => __('Enter Headline Here', 'ufclas-ufl-2015'),
			'image1' => get_stylesheet_directory_uri() . '/img/_temp-landing-a-1.jpg',
			'image2' => get_stylesheet_directory_uri() . '/img/_temp-landing-a-2.jpg',
		), $atts )
	);
	
	// Support either image ID or image url
	$image1 = ( is_numeric( $image1 ) )? wp_get_attachment_image_src( $image1, 'large' ) : array($image1);
	$image2 = ( is_numeric( $image2 ) )? wp_get_attachment_image_src( $image2, 'large' ) : array($image2);
	$content = ( !empty( $content ) )? $content : __('Enter Content Here', 'ufclas-ufl-2015');
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
	<div class="landing-page-hero">
  	<div class="container">
  	<div class="row">
        <div class="col-sm-7 col-sm-pull-1">
          <div class="img-hero" style="background-image:url('<?php echo esc_url( $image1[0] ); ?>');"></div>
        </div>
        <div class="col-sm-5 col-sm-offset-5 hero-content">
			<h2><?php echo esc_html( $headline ); ?></h2>
			<?php echo wpautop( wp_kses_post( $content ) ); ?>
        </div>
        <div class="col-sm-7 secondary">
          <div class="img-hero" style="background-image:url('<?php echo esc_url( $image2[0] ); ?>');"></div>
        </div>
  		</div>
  	</div>
  	</div>
    
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-landing-page-hero', 'ufclas_ufl_2015_landing_hero');

 /**
 * Add Landing Page Hero Full Shortcode
 * 
 * Example [ufclas-landing-page-hero-full][/ufclas-landing-page-hero-full]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_landing_hero_full($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'headline' => '',
			'image' => get_stylesheet_directory_uri() . '/img/_temp1.jpg',
			'image_height' => '',
			'hide_button' => false,
			'button_text' => __('Enter Button Text Here', 'ufclas-ufl-2015'),
			'button_link' => '#',
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	$image_class = ( $image_height == 'half' )? ' hero-img-half':'';
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div id="main" class="landing-page-hero-full">
        <div class="hero-img gradient-bg<?php echo $image_class; ?>" style="background-image:url('<?php echo esc_url( $image[0] ); ?>');">
            <?php printf( '<h1>%s</h1>', esc_html( $headline ) ); ?>
        </div>
        
        <?php if ( !empty( $content ) || !$hide_button ): ?>
        <div class="hero-text">
            <div class="container">
                <div class="col-sm-10 col-sm-offset-1">
                    <?php echo wpautop( wp_kses_post( $content ) ); ?>
                    
                    <?php if ( !$hide_button ){ ?>
                    <a href="<?php echo esc_url( $button_link ); ?>" class="btn"><?php echo esc_html( $button_text ); ?> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-landing-page-hero-full', 'ufclas_ufl_2015_landing_hero_full');

/**
 * Add Breaker Shortcode
 * 
 * Example [ufclas-landing-page-hero-full][/ufclas-landing-page-hero-full]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_breaker($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'headline' => __('Enter Headline Here', 'ufclas-ufl-2015'),
			'image' => get_stylesheet_directory_uri() . '/img/bg-breaker.jpg',
			'hide_button' => false,
			'button_text' => __('Enter Button Text Here', 'ufclas-ufl-2015'),
			'button_link' => '#',
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="breaker" style="background-image:url('<?php echo esc_url( $image[0] ); ?>');">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h2><?php echo esc_html( $headline ); ?></h2>
                    <?php echo wpautop( wp_kses_post( $content ) ); ?>
                    
                    <?php if ( !$hide_button ){ ?>
                    <a href="<?php echo esc_url( $button_link ); ?>" class="btn"><?php echo esc_html( $button_text ); ?> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-breaker', 'ufclas_ufl_2015_breaker');

/**
 * Add Content with Left Image and Caption
 * 
 * Example [ufclas-content-image-caption][/ufclas-content-image-caption]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_content_image_caption($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'headline' => '',
			'image' => get_stylesheet_directory_uri() . '/img/_temp-landing-a-1.jpg',
			'caption' => '',
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="gal-list-wrap">
	  <div class="container">
	  	<div class="row">
	  		<div class="col-md-6">
	  			<div class="gal-with-caption">
		  			<div class="gal-img temp-img" style="background-image:url('<?php echo esc_url( $image[0] ); ?>');">
		  				<img src="<?php echo esc_url( $image[0] ); ?>" alt="" class="visuallyhidden">
	  				</div>
	  				<div class="caption"><?php echo esc_html( $caption ); ?></div>
	  			</div>
	  		</div>
	  		<div class="col-md-6">
	  			<h2><?php echo esc_html( $headline ); ?></h2>
                <?php echo wpautop( wp_kses_post( $content ) ); ?>
	  		</div>
	  	</div>
	  </div>
	</div>
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-content-image-caption', 'ufclas_ufl_2015_content_image_caption');

/**
 * Add Breaker with Cards
 * 
 * Example [ufclas-breaker-cards][/ufclas-breaker-cards]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_breaker_cards($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'image' => get_stylesheet_directory_uri() . '/img/bg-breaker.jpg',
			'card_headline1' => __('Enter Card Headline', 'ufclas-ufl-2015'),
			'card_image1' => get_stylesheet_directory_uri() . '/img/_temp-square.jpg',
			'card_text1' => __('Enter Card Text', 'ufclas-ufl-2015'),
			'card_headline2' => __('Enter Card Headline', 'ufclas-ufl-2015'),
			'card_image2' => get_stylesheet_directory_uri() . '/img/_temp-square.jpg',
			'card_text2' => __('Enter Card Text', 'ufclas-ufl-2015'),
			'card_headline3' => __('Enter Card Headline', 'ufclas-ufl-2015'),
			'card_image3' => get_stylesheet_directory_uri() . '/img/_temp-square.jpg',
			'card_text3' => __('Enter Card Text', 'ufclas-ufl-2015'),
			
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	$card_image1 = ( is_numeric( $card_image1 ) )? wp_get_attachment_image_src( $card_image1, 'medium' ) : array($card_image1);
	$card_image2 = ( is_numeric( $card_image2 ) )? wp_get_attachment_image_src( $card_image2, 'medium' ) : array($card_image2);
	$card_image3 = ( is_numeric( $card_image3 ) )? wp_get_attachment_image_src( $card_image3, 'medium' ) : array($card_image3);
	
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="img-callout-wrapper hor-scroll-wrap" style="background-image:url('<?php echo esc_url( $image[0] ); ?>');">
		<div class="container">
			<div class="row">
            
            <?php for($i=1; $i<=3; $i++){
            	$card = array(
					'headline' => ${'card_headline' . $i},
					'image' => ${'card_image' . $i},
					'text' => ${'card_text' . $i},
				);
				
            	?>
				<div class="col-sm-12 col-md-4 img-callout-wrap hor-scroll-el">
					<div class="img-callout">
						<img src="<?php echo esc_url( $card['image'][0] ); ?>" alt="" class="img-full">
						<h2><?php echo esc_html( $card['headline'] ); ?></h2>
						<?php echo esc_html( $card['text'] ); ?>
					</div>
				</div>
            <?php } ?>
                
			</div>
		</div>
	</div>
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-breaker-cards', 'ufclas_ufl_2015_breaker_cards');