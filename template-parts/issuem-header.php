<?php
/**
 * Newsletter header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UFCLAS_UFL_2015
 */
	
$newsletter_data = ufclas_ufl_2015_newsletter_data();
$issue_data = ufclas_ufl_2015_issuem_issue_data();

$shortcode = sprintf( '[ufl-landing-page-hero headline="%s" subtitle="%s" image="%s" image_height="%s"]%s[/ufl-landing-page-hero]', 
    $newsletter_data['title'],
    $newsletter_data['subtitle'],
    $newsletter_data['cover'],
    $newsletter_data['image_height'],
    ''
);
echo do_shortcode( $shortcode );

// Newsletter menu
if ( has_nav_menu( 'newsletter-menu' ) ): ?>

	<nav id="newsletter-menu" class="navbar navbar-inverse subnav subnav-dark" role="navigation">
	<div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#newsletter-menu-navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Menu   
		  </button>
		</div>
	<?php
	wp_nav_menu( array( 
		'theme_location' => 'newsletter-menu',
		'depth' => 2,
		'container' => 'div',
		'container_class' => 'collapse navbar-collapse',
		'container_id' => 'newsletter-menu-navbar',
		'menu_class' => 'nav navbar-nav',
		'walker' => new wp_bootstrap_navwalker(),
		'fallback_cb' => 'wp_bootstrap_navwalker::fallback'
	));
	?>
	</div>
</nav>

<?php endif; ?>