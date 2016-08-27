<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( ufl_check_page_visitor_level( get_the_ID() ) > 0 ) {
	
	// Display a login message, depending on login status
	if( !ufl_shibboleth_valid_user() ){
		// User has not logged in
		?>
		<div class="entry-content">
        	<p>This content can only be seen by authorized users. Please login by clicking the button below.</p>
        </div>
		<?php
	}
	else {
		// If logged in and denied access
		$webmaster_email = 'wordpress@clas.ufl.edu';
		$site_admin = ( empty($webmaster_email) )? "site administrator" : "<a href=\"mailto:{$webmaster_email}\">site administrator</a>";
		?>
        <header class="entry-header">
			<h1 class="entry-title"><?php esc_html_e( 'Access Denied', 'ufclas-ufl-2015' ); ?></h1>
		</header><!-- .page-header -->
		<div class="entry-content">
        	<p>Sorry, you do not have permission to view this page.Please contact the <?php echo $site_admin; ?> if you have questions about accessing this content.</p>
        </div>
		<?php	
	}
	
	// Display the correct login button
	if( ufl_check_page_visitor_level( get_the_ID() ) >= 2 ){
		// GatorLink logins
		ufl_shibboleth_login_button();
	}
	else {
		// WordPress login
		?>
		<p><a href="<?php echo wp_login_url( get_permalink() ); ?>" class="btn btn-lg" title="Login"><?php esc_html_e( 'WordPress Login', 'ufclas-ufl-2015' ); ?></a></p>
        <?php
	}
}
?>
</article><!-- #post-## -->
