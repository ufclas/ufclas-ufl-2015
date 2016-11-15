<?php
/**
 * Template part for displaying an alert message
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UFCLAS_UFL_2015
 */

/**
 * Call to Action / Alert Message
 */

$actionitem_text = get_theme_mod('actionitem_text', '');

if ( !empty( $actionitem_text ) ):
	$actionitem_heading = get_theme_mod('actionitem_heading', '');
	$actionitem_heading = ( !empty( $actionitem_heading ) )? "<strong>{$actionitem_heading}</strong> " : '';
	$actionitem_url = get_theme_mod('actionitem_url', '');
	$actionitem_altcolor = get_theme_mod('actionitem_altcolor', 0);
	$actionitem_class = ( $actionitem_altcolor )? '' : ' alert-default';
?>
    <div class="alert-small<?php echo $actionitem_class; ?>">
        <span class="icon-svg icon-alert"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#alert"></use></svg></span>
        <div class="alert-title"><?php echo $actionitem_heading . $actionitem_text; ?></div>
        <a href="<?php echo $actionitem_url; ?>" class="alert-link">More <span class="hidden-mobile">Information</span> <span class="arw-right icon-svg"><svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/spritemap.svg#arw-right"></use></svg></span></a>
    </div>
<?php
endif;