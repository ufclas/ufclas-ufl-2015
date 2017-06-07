<?php 
$header_type = get_theme_mod('header_type', 'logo');
if ( $header_type != 'logo' ){
	get_template_part( 'header', 'text' );
}
else {
	get_template_part( 'header', 'logo' );
}