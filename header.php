<?php 

$header_type = get_theme_mod('header_type', 'logo');

locate_template( "header-{$header_type}.php", true );