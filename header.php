<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/client-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/client-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/client-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/client-icon-ipad-retina.png">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png">
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'loading' ); ?>>
<?php include get_stylesheet_directory() . '/inc/google-analytics.php'; ?>
<?php get_template_part( 'template-parts/content', 'svg' );	?>

<a href="#main" id="skip-link" class="visuallyhidden focusable">Skip to main content</a>
<div class="header unit">
  <a href="<?php echo site_url('/'); ?>" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-uf.svg">
  	<span class="icon-svg logo-herbert"><svg><use xlink:href="<?php echo ufclas_ufl_2015_get_custom_logo(); ?>#Layer_1"></use></svg></span>
  </a>
  <div class="menu-wrap">
  	<div class="main-menu-wrap">
  		<a href="<?php echo site_url('/'); ?>">
            <span class="icon-svg logo-herbert"><svg><use xlink:href="<?php echo ufclas_ufl_2015_get_custom_logo(); ?>#Layer_1"></use></svg></span>
        </a>
  		<?php 
				wp_nav_menu( array( 
					'theme_location' => 'main_menu',
					'container' => '',
					'depth' => 2, 
					'walker' => new ufclas_ufl_2015_main_nav_menu(),
					'fallback_cb' => 'ufclas_ufl_2015_main_nav_menu::fallback',
				)); 
			?>
  	</div>
  	<div class="aux-menu-wrap">
  		<ul class="aux-nav">
	  		<?php 
				// Audience menu
				if ( has_nav_menu( 'audience_nav' ) ):
					wp_nav_menu( array( 
						'theme_location' => 'audience_nav',
						'items_wrap' => '%3$s',
						'container' => '',
						'depth' => 1,
						'fallback_cb' => false,
					));
				endif;
				
				// Display parent organization link
				ufclas_global_parent_organization();
				
				// Global menu
				wp_nav_menu( array( 
					'theme_location' => 'global_menu',
					'items_wrap' => '%3$s',
					'container' => '',
					'depth' => 1,
					'fallback_cb' => false,
				)); 
			?>
  		</ul>
  		<div class="audience-nav-wrap">
			<?php 
            if ( has_nav_menu( 'audience_nav' ) ): ?>
                <a href="#" class="cur-audience"><?php echo ufclas_nav_menu_name_by_location( 'audience_nav' ); ?></a>
                <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-down"></use></svg></span>
            <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'audience_nav',
                    'items_wrap' => '<ul>%3$s</ul>',
                    'container' => '',
                    'depth' => 1,
                    'fallback_cb' => false,
                ));
			endif;
            ?>
	  	</div>
  	</div>
  	<a href="#" class="btn-show-aux">
			<span class="icon-svg icon-menu">
	    	<svg>
	      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#menu"></use>
	    	</svg>
	    </span>
			<span class="icon-svg icon-close">
	    	<svg>
	      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#close"></use>
	    	</svg>
	    </span>
	  </a>
      <?php ufclas_get_search_form( 'menu' ); ?>
  </div>

  <div class="mobile-dropdown-wrap"></div>
  
  <?php ufclas_get_search_form( 'mobile' ); ?>
  
  <a href="#" class="btn-menu">
		<span class="icon-svg icon-menu">
    	<svg>
      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#menu"></use>
    	</svg>
    </span>
		<span class="icon-svg icon-close">
    	<svg>
      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#close"></use>
    	</svg>
    </span>
  </a>
  
  </div><!-- .header.unit -->

<!-- END HEADER -->
