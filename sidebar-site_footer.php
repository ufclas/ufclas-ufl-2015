<?php
/**
 * The template for the site_footer widget area.
 *
 * @package UFCLAS_UFL_2015
 * @since 0.3.0
 */

// Default content
if ( ! is_active_sidebar( 'site_footer' ) ) : ?>

<div id="site-footer" class="row">
    <div class="col-md-4 col-sm-4 footer-menu">
        <h2>Resources <span class="icon-svg icon-caret"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#caret"></use></svg></span></h2>
        <ul>
            <li><a href="http://news.ufl.edu/">UF News</a></li>
            <li><a href="http://calendar.ufl.edu/">UF Calendar</a></li>
            <li><a href="https://my.ufl.edu/ps/signon.html">myUFL</a></li>
            <li><a href="https://one.uf.edu/">One.UF</a></li>
            <li><a href="https://phonebook.ufl.edu/">Directory</a></li>
        </ul>
    </div>
    <div class="col-md-4 col-sm-4 footer-menu">
        <h2>Campus <span class="icon-svg icon-caret"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#caret"></use></svg></span></h2>
        <ul>
            <li><a href="http://www.ufweather.org/">Weather</a></li>
            <li><a href="http://campusmap.ufl.edu/">Campus Map</a></li>
            <li><a href="http://www.virtualtour.ufl.edu/">Student Tours</a></li>
            <li><a href="https://catalog.ufl.edu/ugrad/current/Pages/dates-and-deadlines.aspx">Academic Calendar</a></li>
            <li><a href="http://calendar.ufl.edu/">Events</a></li>
        </ul>
    </div>
    <div class="col-md-4 col-sm-4 footer-menu">
        <h2>Website <span class="icon-svg icon-caret"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#caret"></use></svg></span></h2>
        <ul>
            <li><a href="http://www.clas.ufl.edu/">CLAS</a></li>
            <li><a href="http://www.ufl.edu/websites/">Website Listing</a></li>
            <li><a href="http://accessibility.ufl.edu/">Accessibility</a></li>
            <li><a href="http://privacy.ufl.edu/privacystatement.html">Privacy Policy</a></li>
            <li><a href="http://regulations.ufl.edu/">Regulations</a></li>
        </ul>
    </div>
</div><!-- #site-footer -->
<?php endif; ?>

<?php // If we get this far, we have widgets. Let's do this. ?>

<div id="site-footer" class="row">
    <div class="widget-area">
		<?php dynamic_sidebar( 'site_footer' ); ?>
	</div><!-- .widget-area -->
</div><!-- #site-footer -->
