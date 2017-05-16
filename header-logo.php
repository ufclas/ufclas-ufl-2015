<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php include get_stylesheet_directory() . '/inc/google-analytics.php'; ?>

<a href="#main" id="skip-link" class="visuallyhidden focusable">Skip to main content</a>
<div class="header unit">
  <?php 
  	$disable_global_elements = get_theme_mod('disable_global_elements', 0);
	if ( !$disable_global_elements ): 
  ?>
      <a href="http://ufl.edu/" class="logo">
      	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-uf.svg" alt="University of Florida">
      </a>
      <h1 class="screen-reader-title">
      <a href="<?php echo site_url('/'); ?>" class="logo mobile">
      	<span class="screen-reader-text"><?php echo bloginfo('name'); ?></span>
        <span class="icon-svg logo-herbert"><svg><use xlink:href="<?php echo ufclas_ufl_2015_get_custom_logo(); ?>#Layer_1"></use></svg></span>
      </a>
      </h1>
  <?php endif; ?>
  
  <div class="menu-wrap">
  	<div class="main-menu-wrap">
  		<h1 class="screen-reader-title">
        <a href="<?php echo site_url('/'); ?>">
            <span class="screen-reader-text"><?php echo bloginfo('name'); ?></span>
            <span class="icon-svg logo-herbert"><svg><use xlink:href="<?php echo ufclas_ufl_2015_get_custom_logo(); ?>#Layer_1"></use></svg></span>
        </a>
        </h1>
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
    <?php if ( !$disable_global_elements ): ?>
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
      <?php endif; ?>
  </div>

  <div class="mobile-dropdown-wrap"></div>
  
  <?php get_template_part( 'template-parts/content', 'alert-small' );  ?>
  
  <?php ufclas_get_search_form( 'mobile' ); ?>
  
  <a href="#" class="btn-menu" role="button" aria-haspopup="true" aria-expanded="false">
		<span class="icon-svg icon-menu">
    	<svg>
      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#menu"></use>
    	</svg>
    </span>
		<span class="icon-svg icon-close" role="button">
    	<svg>
      	<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#close"></use>
    	</svg>
    </span>
  </a>
  
  </div><!-- .header.unit -->

<!-- END HEADER -->
