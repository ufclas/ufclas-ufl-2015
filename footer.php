<!-- START FOOTER -->
<footer class="footer-wrap">
<?php 
  	$disable_global_elements = get_theme_mod('disable_global_elements', 0);
	if ( !$disable_global_elements ): 
?>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-push-8 footer-contact-wrap">
					<a href="http://ufl.edu/" class="footer-logo icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#florida-logo-full"></use></svg><span class="visuallyhidden">University of Florida</span></a>
					<ul class="social-nav">
						<?php ufclas_ufl_2015_socialnetworks(); ?>
					</ul>
                    <?php get_sidebar('footer_right'); ?>
				</div>

				<div class="col-md-8 col-md-pull-4">
					<?php get_sidebar('site_footer'); ?>
				</div>
			</div><!-- .row -->
		</div><!-- .container --> 
	</div><!-- .footer-bottom -->
    
<?php endif; ?>
</footer><!-- .footer-wrap -->
<?php wp_footer(); ?>
</body>
</html>