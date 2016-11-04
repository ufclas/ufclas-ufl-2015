jQuery(function($){
	// Performs a smooth page scroll to an anchor on the same page.
	// Excludes the carousel control links
	// https://css-tricks.com/snippets/jquery/smooth-scrolling/
	$('a[href*="#"]:not([href="#"]):not(.carousel-control)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
				  scrollTop: target.offset().top - 160
				}, 500);
				return false;
			}
		}
	});
});