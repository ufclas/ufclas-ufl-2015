/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
	"use strict";
	
	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'content_color', function( value ) {
		value.bind( function( newval ) {
			$('#main.main-content').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'homepage_layout_color', function( value ) {
		value.bind( function( newval ) {
			$('.home #main.main-content').css('background-color', newval );
		} );
	} );
	
} )( jQuery );