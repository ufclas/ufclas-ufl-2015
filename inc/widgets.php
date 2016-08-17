<?php 
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ufclas_ufl_2015_widgets_init() {
	
	$homepage_layout = get_theme_mod('homepage_layout');
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
		'name'          => esc_html__( 'Footer', 'ufclas-ufl-2015' ),
		'id'            => 'site_footer',
		'description'   => '',
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
}
add_action( 'widgets_init', 'ufclas_ufl_2015_widgets_init' );

/**
 * Homepage Secondary Area (Widgets)
 * 
 * @since 0.2.5
 */
function ufandshands_secondary_widget_area() {
	$homepage_layout = get_theme_mod('homepage_layout');
	
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

