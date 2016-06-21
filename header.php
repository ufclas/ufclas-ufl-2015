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
  <a href="<?php echo site_url('/'); ?>" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-uf.svg"><span class="icon-svg logo-herbert"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/svg/logo-default.svg#Layer_1"></use></svg></span></a>
  <div class="menu-wrap">
  	<div class="main-menu-wrap">
  		<a href="<?php echo site_url('/'); ?>"><span class="icon-svg logo-herbert"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/svg/logo-default.svg#Layer_1"></use></svg></span></a>
  		<?php 
				wp_nav_menu( array( 
					'theme_location' => 'main_menu',
					'container' => '',
					'depth' => 2, 
					'walker' => new ufclas_ufl_2015_main_nav_menu(),
				)); 
			?>
  	</div>
  	<div class="aux-menu-wrap">
  		<ul class="aux-nav">
	  		<?php 
				wp_nav_menu( array( 
					'theme_location' => 'audience_nav',
					'items_wrap' => '%3$s',
					'container' => '',
					'depth' => 1,
					'fallback_cb' => false,
				)); 
			?>
			<?php 
				wp_nav_menu( array( 
					'theme_location' => 'global_menu',
					'items_wrap' => '%3$s',
					'container' => '',
					'depth' => 1,
				)); 
			?>
  		</ul>
  		<div class="audience-nav-wrap">
  			<a href="#" class="cur-audience">Quick Links</a>
            <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-down"></use></svg></span>
            <ul>
	  			<?php 
					wp_nav_menu( array( 
						'theme_location' => 'audience_nav',
						'items_wrap' => '%3$s',
						'container' => '',
						'depth' => 1,
						'fallback_cb' => false,
					)); 
				?>
	  		</ul>
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
      <?php get_search_form(); ?>
  </div>

  <div class="mobile-dropdown-wrap"></div>

<?php
	/*
	 * Emergency modal demo purposes only
	 */
	if (isset($_GET['alert']) && $_GET['alert'] == 'small') {
		get_template_part( 'template-parts/content', 'alert-small' );
	}
  
	get_search_form(); 
?>

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
</div>
<!-- END HEADER -->
