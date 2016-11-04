// @koala-prepend "plugins/iframe-resizer.min.js"
// @koala-prepend "plugins/jquery.hoverIntent.min.js"
// @koala-prepend "plugins/js-cookie.js"
// @koala-prepend "plugins/slick.min.js"
// @koala-prepend "plugins/modernizr.min.js"
// @koala-prepend "plugins/svg4everybody.min.js"

/*!
 * UFL Audience Cookies
 * Requires js.cookie.js 
 */
function ufl_audience_preference_set_html(ufl_cookie) {
	if (ufl_cookie) {
		ufl_audience_html_url = $('.audience-link[data-ufl-audience-preference="'+ufl_cookie+'"]').attr('href');
		ufl_audience_html_text = $('.audience-link[data-ufl-audience-preference="'+ufl_cookie+'"]').text();
		if (ufl_audience_html_url && ufl_audience_html_text) {
			$('.cur-audience').attr('href', ufl_audience_html_url).text(ufl_audience_html_text);
		}
	}
}
function ufl_audience_cookie() {
	ufl_cookie = Cookies.get('ufl_audience_preference');
	if (ufl_cookie) {
		ufl_audience_preference_set_html(ufl_cookie);
	}
	$('.audience-nav-wrap .audience-link').click(function(e) {
		ufl_audience_preference = $(this).data('ufl-audience-preference');
		Cookies.set('ufl_audience_preference', ufl_audience_preference, { expires: 90 });
		ufl_audience_preference_set_html(ufl_audience_preference);
	});
}
/*
 * UFL Site Alert Cookies
 * Requires js.cookie.js 
 */
function ufl_site_alert_cookie() {
    ufl_site_alert_cookie = Cookies.get('ufl_site_alert_cookie');
    if (ufl_site_alert_cookie === 'hide') {
        $('.emergency-modal-wrap').hide();
    }
    $('.emergency-modal-wrap .emergency-modal-close').click(function(e) {
        Cookies.set('ufl_site_alert_cookie', 'hide', { expires: 1 });
    });
}
function arrayShuffler(o) {
	for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
	return o;
}

function statLengthClassifier( container, l ) {
	$(container).each(function(){
		var stat = $(this).children('h2').html();
		if (stat.length == l) { $(this).addClass('large'); }
		if (stat.length >= l+1) { $(this).addClass('larger'); }
	});
}

function statBreakerPopulator( stats ) {
	var statIndex = 0;
	$(".stat-breaker.randomized").each(function(  ){
		var contentID = $(this).data("content-id");
		$(this).find(".stat-block-wrap").each(function(  ){
			if (statIndex >= stats.length) { statIndex = 0 }
			var positionID = $(this).data("position");
			$(this).find("h2").html(stats[statIndex].stat);
			$(this).find("p").html(stats[statIndex].info);
			if (stats[statIndex].blue_bg) {
				var styles = $("#style-"+contentID);
				styles.append(".stat-block-wrap.content-"+contentID+positionID+":hover, .touch .stat-block-wrap.content-"+contentID+positionID+" {background-image:url("+stats[statIndex].blue_bg+");}");
			}
			statIndex++;
		});
	});
	$(".homepage-stat-wrap").find(".stat-wrap.randomized").each(function(  ){
		if (statIndex >= stats.length) { statIndex = 0 }
		var position = $(this).data("position");
		$(this).find(".stat h2").html(stats[statIndex].stat);
		$(this).find(".info-copy p").html(stats[statIndex].info);
		if (stats[statIndex].orange_bg) {
			$("head").append("<style>@media (min-width: 992px) { .stat-wrap."+position+".in-bottom .stat, .stat-wrap."+position+".in-bottom .info, .stat-wrap."+position+".in-top .stat, .stat-wrap."+position+".in-top .info, .stat-wrap."+position+" .stat, .stat-wrap."+position+" .info { background-image: url("+stats[statIndex].orange_bg+"); } } @media (max-width: 992px) { .stat-wrap."+position+" { background-image: url("+stats[statIndex].orange_bg+"); } }</style>");
		}
		statIndex++;
	});
}

function randomizeStats(statsjson) {
	$.getJSON(statsjson, function(data){
		var stats = data.data;
		stats.splice(-1,1); // remove end element
		shuffledUFStats = arrayShuffler(stats);
	}).done(function(data){ 
		statBreakerPopulator( shuffledUFStats );
	}).always(function(){
		statLengthClassifier( '.stat-block .stat', 4 );
		statLengthClassifier( '.homepage-stat-wrap .stat', 3 );
	});
}

function bioScrollPopulator( container, affiliation, jsonpath ) {
	$.getJSON(jsonpath)
	.done(function(json){ 
		var bios = json.data;
		bios.splice(-1,1);
		if ( affiliation != 'all' ) {
			var bios = $.grep(bios,function(bio,i){
				return ( bio.affiliation == affiliation );
			});
		}
		var shuffledBios = arrayShuffler(bios);
		$('#'+container).find('.bio').each(function(i){
			var $this = $(this);
			var copy = $this.find('.copy-wrap');
			var featured = $('#'+container+' .feature-bio-copy-wrap');
			$this.find('.bio-img').css({"background-image":"url("+shuffledBios[i].image+")"});
			copy.children('h2').html(shuffledBios[i].bioname);
			copy.children('h3').html(shuffledBios[i].title);
			copy.children('p').html(shuffledBios[i].bio);
			copy.children('span.category-tag').html(shuffledBios[i].affiliation);
			if (i == 0) {
				featured.children('h2').html(shuffledBios[i].bioname);
				featured.children('h3').html(shuffledBios[i].title);
				featured.children('p').html(shuffledBios[i].bio);
				featured.children('span.category-tag').html(shuffledBios[i].affiliation);
			}
		});
		if(window.innerWidth < 992){
			$('.hor-scroll-el').css({'height':'','width':''});
			$('.hor-scroll-wrap').each(function(){
				$horHeight = 0;
				$('.hor-scroll-el',this).each(function(){
					if($(this).outerHeight() >  $horHeight){
						$horHeight = $(this).outerHeight();
					}
				}).height($horHeight);
			});
		}
	})
	.fail(function(){
		$('#'+container).hide();
	});
}

function mainMenuItemWidth() {
	var items = $('.main-menu-wrap>ul>li').length;
	$("head").append("<style>@media (min-width: 1220px) { .main-menu-wrap>ul>li { width: calc(99.9% / "+items+"); } }</style>");
}

function autoMainMenuHelper() {
	$('.main-menu-wrap>ul>li>a').addClass('main-menu-link').wrapInner('<span></span>').append('<span class="icon-svg icon-caret"><svg><use xlink:href="'+ufclas_ufl_2015_themeurl+'/img/spritemap.svg#caret"></use></svg></span>');
	$('.main-menu-wrap .multilevel-linkul-0').wrap('<div class="dropdown"></div>');
	$('.main-menu-wrap .dropdown .multilevel-linkul-0').each(function(){
		var ul = $(this).removeClass('multilevel-linkul-0').addClass('col-md-6');
		var lis = ul.children('li');
		var mid = Math.ceil(lis.length/2);
		newCol = $('<ul />', {"class": "col-md-6"}).insertAfter(ul);
		lis.each(function(i) {
			i >= mid && $(this).appendTo(newCol);
		});
	});
	mainMenuItemWidth();
}

function displayUFAlert() {
	var alertContainer = $(".homepage-stat-wrap .big-stat-wrap.two");
	if (alertContainer) {
		$.getJSON('http://ufalert.ufl.edu/wp-json/wp/v2/posts/?filter[cat]=22').done(function(json){
			var timeThreshold = Math.floor((new Date().getTime() ) - 10800000); // milliseconds
			var lastAlert = json[0];
			var alertDate = new Date(lastAlert.date);
			var alertTime = alertDate.getTime();
			if (alertTime > timeThreshold) {
				alertContainer.addClass("ufalert").removeClass('big-stat-img').css('background-image','url('+ufclas_ufl_2015_themeurl+'/img/bg-big-stat-alert.jpg)');
				alertContainer.children(".category-tag").html('<span class="icon-svg icon-alert"><svg><use xlink:href="'+ufclas_ufl_2015_themeurl+'/img/spritemap.svg#alert"></use></svg></span> '+lastAlert.title.rendered);
				alertContainer.children(".big-stat-copy").find("a").attr("href", lastAlert.link).first().text(lastAlert.title.rendered);
			}
		});
	}
}