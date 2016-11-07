<?php
/**
 * Theme shortcodes
 *
 *	[ufclas-landing-page-hero][/ufclas-landing-page-hero]
 *	[ufclas-landing-page-hero-full][/ufclas-landing-page-hero-full]
 *	[ufclas-content-image-caption][/ufclas-content-image-caption]
 *	[ufclas-content-image-right][/ufclas-content-image-right]
 *	[ufclas-breaker-cards][/ufclas-breaker-cards]
 *	[ufclas-icon]
 *	[ufclas-image-right-quote][/ufclas-image-right-quote]
 *	[ufclas-image-full-width]
 *	[ufclas-video-full-width]
 *	[ufclas-image]
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
			'headline' => '',
			'image1' => get_stylesheet_directory_uri() . '/img/_temp-landing-a-1.jpg',
			'image2' => get_stylesheet_directory_uri() . '/img/_temp-landing-a-2.jpg',
		), $atts )
	);
	
	// Support either image ID or image url
	$image1 = ( is_numeric( $image1 ) )? wp_get_attachment_image_src( $image1, 'large' ) : array($image1);
	$image2 = ( is_numeric( $image2 ) )? wp_get_attachment_image_src( $image2, 'large' ) : array($image2);
	
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
			<?php if (!empty( $headline )){ ?>
                <h2><?php echo esc_html( $headline ); ?></h2>
            <?php } ?>
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
			'image_height' => 'large',
			'hide_button' => 1,
			'button_text' => '',
			'button_link' => '#',
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	$image_class = ( $image_height == 'half' )? ' hero-img-half':'';
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="landing-page-hero-full">
        <div class="hero-img gradient-bg<?php echo $image_class; ?>" style="background-image:url('<?php echo esc_url( $image[0] ); ?>');">
            <?php printf( '<h1>%s</h1>', esc_html( $headline ) ); ?>
        </div>
        
        <?php if ( !empty( $content ) ): ?>
        <div class="hero-text">
            <div class="container">
                <div class="col-sm-10 col-sm-offset-1">
                    <?php echo wpautop( wp_kses_post( $content ) ); ?>
                    
                    <?php if ( !empty($button_text) ){ ?>
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
 * Example [ufclas-breaker][/ufclas-breaker]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_breaker($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'headline' => '',
			'image' => get_stylesheet_directory_uri() . '/img/bg-breaker.jpg',
			'hide_button' => 1,
			'button_text' => '',
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
                    
                    <?php if ( !$hide_button || !empty( $button_text ) ){ ?>
                    <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-white"><?php echo esc_html( $button_text ); ?> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a>
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
 * Add Content with Right Image
 * 
 * Example [ufclas-content-image-right][/ufclas-content-image-right]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_content_image_right($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'headline' => '',
			'image' => get_stylesheet_directory_uri() . '/img/_temp-landing-a-1.jpg',
			'label' => '',
		), $atts )
	);
    
	// Support either image ID or image url
    $image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="content-box-module">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 content-box-copy">
                    <?php if (!empty( $headline )){ ?>
                    	<h2><?php echo esc_html( $headline ); ?></h2>
					<?php } ?>
					<?php echo wpautop( wp_kses_post( $content ) ); ?>
					<?php if (!empty( $label )){ ?>
                    	<span class="category-tag orange"><?php echo esc_html( $label ); ?></span>
					<?php } ?>
				</div>
				<div class="col-sm-5 content-box-img" style="background-image:url('<?php echo esc_url( $image[0] ); ?>')">
					<img src="<?php echo esc_url( $image[0] ); ?>" alt="" class="visuallyhidden">
				</div>
			</div>
		</div>
	</div>
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-content-image-right', 'ufclas_ufl_2015_content_image_right');


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
			'card_image1' => '',
			'card_text1' => __('Enter Card Text', 'ufclas-ufl-2015'),
			'card_headline2' => __('Enter Card Headline', 'ufclas-ufl-2015'),
			'card_image2' => '',
			'card_text2' => __('Enter Card Text', 'ufclas-ufl-2015'),
			'card_headline3' => __('Enter Card Headline', 'ufclas-ufl-2015'),
			'card_image3' => '',
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
						<?php if (!empty( $card['image'] )){ ?> 
                        <img src="<?php echo esc_url( $card['image'][0] ); ?>" alt="" class="img-full">
                        <?php } ?>
						<h2><?php echo esc_html( $card['headline'] ); ?></h2>
						<?php echo wpautop( wp_kses_post( $card['text'] ) ); ?>
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

 /**
 * Add Icon Shortcode
 * 
 * Example [ufclas-icon]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_icon($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'name' => 'format-image',
			'xclass' => '',
		), $atts )
	);
	
	$classes = array( 'dashicons dashicons-' . esc_attr( $name ) );
	
	if ( !empty( $xclass ) ){
		$classes[] = esc_attr( $xclass );
	}
	 
	return '<span class="' . join(' ', $classes) . '"></span>';
}
add_shortcode('ufclas-icon', 'ufclas_ufl_2015_icon');

/**
 * Add Left Image with Right Quote and Caption
 * 
 * Example [ufclas-image-right-quote][/ufclas-image-right-quote]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_image_right_quote($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'image' => get_stylesheet_directory_uri() . '/img/ImgResponsive_Placeholder.png',
			'quote' => 'Image quote',
			'caption' => '',
			'credit' => '',
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	$image_alt = ( is_numeric( $image ) )? get_post($image)->post_excerpt : '';
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="container-fluid image-right-quote">
    <div class="row">
    <div class="col-md-6">
    	<img class="center-block img-responsive pic" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
        <p class="text">
			<?php echo esc_html( $caption ); ?> 
            <?php if ( !empty( $credit ) ): ?>
            <img class="img-valign" src="<?php echo get_stylesheet_directory_uri(); ?>/svg/camera.svg" alt="Photo credit" width="13px"> 
            <span style="color:#999999;"><?php echo esc_html( $credit ); ?></span>
            <?php endif; ?>
        </p>
    </div>
 	<div class="col-md-6">
    	<div class="quote">
        	<h3><?php echo esc_html( $quote ); ?></h3>
        </div>
	</div>
    </div>
    </div>
    <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-image-right-quote', 'ufclas_ufl_2015_image_right_quote');

/**
 * Add Full Width Image with Caption
 * 
 * Example [ufclas-image-full-width]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_image_full_width($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'image' => get_stylesheet_directory_uri() . '/img/ImgResponsive_Placeholder.png',
			'caption' => '',
			'credit' => '',
		), $atts )
	);
	
	// Support either image ID or image url
	$image = ( is_numeric( $image ) )? wp_get_attachment_image_src( $image, 'large' ) : array($image);
	$image_alt = ( is_numeric( $image ) )? get_post($image)->post_excerpt : '';
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="container-fluid image-full-width">
    <figure class="image">
    	<img class="img-responsive" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
        <figcaption class="container">
        <?php echo esc_html( $caption ); ?> 
		<?php if ( !empty( $credit ) ): ?>
        <img class="img-valign" src="<?php echo get_stylesheet_directory_uri(); ?>/svg/camera.svg" alt="Photo credit" width="13px"> 
        <span style="color:#999999;"><?php echo esc_html( $credit ); ?></span>
        <?php endif; ?>
        </figcaption>
    </figure>
    </div>
   <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-image-full-width', 'ufclas_ufl_2015_image_full_width');

/**
 * Add Full Width Image with Caption
 * 
 * Example [ufclas-video-full-width]
 * @param  array $atts Shortcode attributes
 * @param  string [$content = ''] Content between shortcode tags
 * @return string Shortcode output
 */
function ufclas_ufl_2015_video_full_width($atts, $content = NULL ) {
	
	extract( shortcode_atts( 
		array(
			'url' => '',
		), $atts )
	);
	
	// Shortcode callbacks must return content, so use output buffering
	ob_start();
	?>
    <div class="container-fluid">
    <div class="embed-responsive embed-responsive-16by9">
    	<?php 
			$shortcode = sprintf('[embed]%s[/embed]', esc_url( $url ));
			echo do_shortcode( $shortcode ); 
		?>
    </div>
    </div>
   <?php 
	return ob_get_clean();
}
add_shortcode('ufclas-video-full-width', 'ufclas_ufl_2015_video_full_width');


