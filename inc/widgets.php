<?php 

// Include theme widgets
require get_stylesheet_directory() . '/inc/widgets/widget-landing-page-hero.php';
require get_stylesheet_directory() . '/inc/widgets/widget-breaker.php';
require get_stylesheet_directory() . '/inc/widgets/widget-content-image-right.php';

/**
 * Get the number of widget in a specific sidebar
 * 
 * @param string $sidebar_id
 * @return int Number of widgets
 * @since 0.3.0
 * @link https://generatewp.com/snippet/2V0V0gy/
 */
function ufclas_ufl_2015_sidebar_widget_classes( $sidebar_id ){
    global $_wp_sidebars_widgets;
	
	/** 
	 * If loading from front page, consult $_wp_sidebars_widgets rather than options 
	 * to see if wp_convert_widget_settings() has made manipulations in memory.
	 */
	$sidebars_widget_count = ( !empty( $_wp_sidebars_widgets ) )? $_wp_sidebars_widgets : get_option( 'sidebars_widgets', array() );
	
	if ( !isset( $sidebars_widget_count[$sidebar_id] ) ){
		return;		
	}
	else {
		$widget_count_max = 3;
		$widget_count = count( $sidebars_widget_count[$sidebar_id] );
		$widget_count_columns = ( $widget_count < $widget_count_max )? $widget_count : $widget_count_max;
		$widget_count_columns = ( $widget_count_columns > 0 )? $widget_count_columns : 1;
		return 'col-md-' . ceil( 12 / $widget_count_columns );
	}
}

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ufclas_ufl_2015_widgets_init() {
	
	$homepage_layout = get_theme_mod('homepage_layout', '2c-bias');
	$disabled_global_elements = false;
	
	// Legacy Sidebars
	register_sidebar( array(
		'name'          => esc_html__( 'Home Left', 'ufclas-ufl-2015' ),
		'id'            => 'home_left',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget home-left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	if ( $homepage_layout=='3c-default' || $homepage_layout=='3c-thirds'  || $homepage_layout=='1c-100-2c-half' ) {
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle', 'ufclas-ufl-2015' ),
		'id'            => 'home_middle',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget home-middle %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	}
	
	register_sidebar( array(
		'name'          => esc_html__( 'Home Right', 'ufclas-ufl-2015' ),
		'id'            => 'home_right',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget home-right %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Page Left Sidebar', 'ufclas-ufl-2015' ),
		'id'            => 'page_sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Page Right Sidebar', 'ufclas-ufl-2015' ),
		'id'            => 'page_right',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Sidebar', 'ufclas-ufl-2015' ),
		'id'            => 'post_sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left', 'ufclas-ufl-2015' ),
		'id'            => 'site_footer',
		'description'   => 'Content that replaces the institutional links in the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s ' . ufclas_ufl_2015_sidebar_widget_classes('site_footer') . '">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right', 'ufclas-ufl-2015' ),
		'id'            => 'footer_right',
		'description'   => 'Content that appears below the logo and social links in the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	if ( $disabled_global_elements ){
	register_sidebar( array(
		'name'          => esc_html__( 'Site Custom Footer', 'ufclas-ufl-2015' ),
		'id'            => 'site_footer_custom',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	}
	register_sidebar( array(
		'name'          => esc_html__( 'Home Featured Right', 'ufclas-ufl-2015' ),
		'id'            => 'home_featured_right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sections', 'ufclas-ufl-2015' ),
		'id'            => 'page_sections',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	// Register theme widgets
	register_widget( 'UFL_2015_Landing_Page_Hero' );
	register_widget( 'UFL_2015_Breaker' );
	register_widget( 'UFL_2015_Content_Image_Right' );
}
add_action( 'widgets_init', 'ufclas_ufl_2015_widgets_init' );

/**
 * Homepage Secondary Area (Widgets)
 * 
 * @since 0.2.5
 */
function ufandshands_secondary_widget_area() {
	$homepage_layout = get_theme_mod('homepage_layout', '2c-bias');
	
	switch($homepage_layout) {
	
	case "3c-default":
		echo '<div class="col-md-6" role="complementary">';
			dynamic_sidebar('home_left');
		echo "</div>";
		
		echo '<div class="col-md-3" role="complementary">';
			dynamic_sidebar('home_middle');
		echo "</div>";
		
		echo '<div class="col-md-3" role="complementary">';
			dynamic_sidebar('home_right');
		echo "</div>";
	break;		
	
	case "3c-thirds":
		echo '<div class="col-md-4" role="complementary">';
			dynamic_sidebar('home_left');
		echo "</div>";
		
		echo '<div class="col-md-4" role="complementary">';
			dynamic_sidebar('home_middle');
		echo "</div>";
		
		echo '<div class="col-md-4" role="complementary">';
			dynamic_sidebar('home_right');
		echo "</div>";
	break;
		
	case "2c-bias":
		echo '<div class="col-md-8" role="complementary">';
			dynamic_sidebar('home_left');
		echo "</div>";
						
		echo '<div class="col-md-4" role="complementary">';
			dynamic_sidebar('home_right');
		echo "</div>";
	break;
		
	case "2c-half":
		echo '<div class="col-md-6" role="complementary">';
			dynamic_sidebar('home_left');
		echo "</div>";
						
		echo '<div class="col-md-6" role="complementary">';
			dynamic_sidebar('home_right');
		echo "</div>";
	break;
		
	case "1c-100":
		echo '<div class="col-md-12" role="complementary">';
			dynamic_sidebar('home_left');
		echo "</div>";
	break;
		
	case "1c-100-2c-half":
		echo '<div class="col-md-12" role="complementary">';
			dynamic_sidebar('home_left');
		echo "</div>";

		echo '<div class="col-md-6" role="complementary">';
			dynamic_sidebar('home_middle');
		echo "</div>";
						
		echo '<div class="col-md-6" role="complementary">';
			dynamic_sidebar('home_right');
		echo "</div>";
	break;
	}
}
