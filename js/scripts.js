jQuery(function($){
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
		var menuItems = $('.main-menu-wrap>ul>li').length;
		var maxItems = ufclas_ufl_2015_sitedata.max_main_menu_items; // Get max main menu items theme option
		var items = ( menuItems < maxItems )? menuItems : maxItems;
		
		// Add a new 'More' menu item after the maxItem on wide screens
		if ( (menuItems > maxItems) && ($(window).width() > 992) ){
			items++;
			
			// Remove all items after the max number of items
			var $moreMenuItems = $('.main-menu-wrap .menu > li').slice(maxItems).detach();
			$moreMenuItems.find('.dropdown').remove();
			$moreMenuItems.find('a').removeClass('main-menu-link');
			
			var $moreItem = $('<li id="menu-item-more" class="menu-item"><a href="#" class="main-menu-link"><span>More</span></a></li>');
			$moreItem.append('<div class="dropdown"><ul></ul></div>');
			$('.main-menu-wrap .menu').append( $moreItem );
			$('#menu-item-more .dropdown ul').append($moreMenuItems);
		}
		
		$("head").append("<style>@media (min-width: 1220px) { .main-menu-wrap>ul>li { width: calc(99.9% / "+items+"); } }</style>");
	}
	
	function autoMainMenuHelper() {
		var showMenuItemColumns = ufclas_ufl_2015_sitedata.mega_menu; // Get mega menu theme option
		$('.main-menu-wrap>ul>li>a').addClass('main-menu-link').wrapInner('<span></span>').append('<span class="icon-svg icon-caret"><svg><use xlink:href="'+ufclas_ufl_2015_sitedata.theme_url+'/img/spritemap.svg#caret"></use></svg></span>');
		
		mainMenuItemWidth();
		
		if ( showMenuItemColumns == 1 ){
			$('.main-menu-wrap .dropdown ul').each(function(){
				var ul = $(this).addClass('col-md-6');
				var lis = ul.children('li');
				var mid = Math.ceil(lis.length/2);
				newCol = $('<ul />', {"class": "col-md-6"}).insertAfter(ul);
				lis.each(function(i) {
					i >= mid && $(this).appendTo(newCol);
				});
			});
		}
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
					alertContainer.addClass("ufalert").removeClass('big-stat-img').css('background-image','url('+ufclas_ufl_2015_sitedata.theme_url+'/img/bg-big-stat-alert.jpg)');
					alertContainer.children(".category-tag").html('<span class="icon-svg icon-alert"><svg><use xlink:href="'+ufclas_ufl_2015_sitedata.theme_url+'/img/spritemap.svg#alert"></use></svg></span> '+lastAlert.title.rendered);
					alertContainer.children(".big-stat-copy").find("a").attr("href", lastAlert.link).first().text(lastAlert.title.rendered);
				}
			});
		}
	}
	
	// Run menu functions
	autoMainMenuHelper();
	
	/*
	@todo Adjust menu when screen is resized
	https://css-tricks.com/snippets/jquery/done-resizing-event/
	var menuResizeTimer;
	$(window).on('resize', function(e) {
		clearTimeout(menuResizeTimer);
		menuResizeTimer = setTimeout(autoMainMenuHelper, 250);
	});
	*/

	var $searchForm = $('.search-wrap'),
		$menuWrap = $('.menu-wrap'),
		$body = $('body'),
		$mobileDropdown = $('.mobile-dropdown-wrap'),
		$mobileDropdownTimeout;

	// Run svgforeverybody
	svg4everybody();

	// Main menu mobile
	$('.btn-menu').on('click',function(e){
		e.preventDefault();
		$('.aux-menu-wrap a').off('click.mobileNoClick');
		if($body.hasClass('open-mobile-dropdown')){
			$body.removeClass('open-mobile-dropdown');
		} else {
			$body.toggleClass('open-menu');
		}

		// Mobile dropdown height if VH isn't supported
		if(!Modernizr.cssvhunit){
			$menuWrap.height($(window).height() - 60);
		}
	});

	// Remove the loading class to enable transitions
	$('body').removeClass('loading');

	// Show aux menu on smaller width
	$('.btn-show-aux').on('click',function(e){
		e.preventDefault();
		$('.header').toggleClass('show-aux');
	});

	// Dropdown positioning
	function showDropdown(el){
		if($(window).width() > 992){
			var $this = el,
			$offset = $this.offset().left,
			$dropdown = $this.find('.dropdown');

			$('.main-menu-wrap .hover').removeClass('hover');

			$this.addClass('hover');

			$this.removeClass('offscreen full');

			if($dropdown.width() + $offset > $(window).width()){
				$this.addClass('offscreen');
			}

			if($this.hasClass('offscreen') && $dropdown.offset().left < 0 && $(window).width() > 1140){
				$dropdown.css({'transform':'translateX('+Math.abs($dropdown.offset().left)+'px)'});
			}

			$dropdown.find('.col-md-4').velocity('finish').velocity('transition.slideDownIn',{
				duration: 400,
				easing: 'easeOut',
				stagger: 100
			});
		}
	}
	$('.main-menu-wrap > ul > li').hoverIntent({
		over: function(){
			showDropdown($(this))
		},
		out: function(){
			$(this).removeClass('hover');
		}
	}).on('click',function(){
		$this = $(this);
		if(Modernizr.touch){
			if($this.hasClass('hover')){
				$this.removeClass('hover');
			} else {
				showDropdown($this.closest('li'));
			}
		}
	});

	// Main menu focus for accessibility
	$('.main-menu-link').on('focus',function(e){
		showDropdown($(this).closest('li'));
	});

	// Mobile dropdown content
	$('.main-menu-wrap > ul > li > a').on('click',function(e){
		if($(window).width() < 992){
			e.preventDefault();
			$this = $(this);
			window.clearTimeout($mobileDropdownTimeout);
			$menuWrap.off('click.closeMobile');

			if($body.hasClass('open-mobile-dropdown')){
				$body.removeClass('open-mobile-dropdown');
				$mobileDropdown.empty();
				$('.aux-menu-wrap a').off('click.mobileNoClick')
			} else {
				$body.addClass('open-mobile-dropdown');
				var dropdownHtml = ( $this.next('.dropdown').html() != undefined )? $this.next('.dropdown').html():'';
				$mobileDropdown.html('<h2><a href="'+$this.attr('href')+'">'+ $this.text() + '</a></h2>' + dropdownHtml );

				// Mobile dropdown height if VH isn't supported
				if(!Modernizr.cssvhunit){
					$mobileDropdown.height($(window).height() - 60);
				}

				$mobileDropdownTimeout = window.setTimeout(function(){
					$menuWrap.one('click.closeMobile',function(){
						$body.removeClass('open-mobile-dropdown');
						$mobileDropdown.empty();
					});
				},0);

				// Prevent clicks on other links when mobile dropdown is open
				$('.aux-menu-wrap a').one('click.mobileNoClick', function(e){
					e.preventDefault();
				});
			}
		}
	});

	// Header search form
	$searchForm.on('click',function(e){
		if(!$searchForm.hasClass('open-search')){
			e.preventDefault();
			$searchForm.addClass('open-search').find('input').focus();

			if($(window).width() <= 992){
				$('.alert-small').hide();
			}

			// Close the search form on blur
			window.setTimeout(function(){
				$(document).one('click.closeSearch',function(e){
					if(!$(e.target).closest('.search-wrap').length){
						$searchForm.removeClass('open-search').find('input').val('');
						$('.alert-small').show();
					}
				});
			},0);
		}
	})

	// Footer mobile accordian
	$('.footer-menu h2').on('click',function(){
		if($(window).width() <= 767){
			$(this).closest('.footer-menu').toggleClass('open');
		}
	});
	
	/*
	//// Homepage featured story
	// Setting homepage hero story on load
	
	$('.featured-story-img-wrap').each(function(){
		$(this).find('.featured-story-img:first').addClass('active');
	});

	// Switching to a new featured story
	$(document).on('click','.featured-story',function(){
		$this = $(this);

		// Changed featured carousel
		$('.featured-story-img-wrap').each(function(){
			$homeWrap = $(this).closest('.homepage-wrapper');

			// Get this carousel's clicked element
			$el = $homeWrap.find('.featured-story[data-number="'+ $this.attr('data-number') +'"]');

			// Move Carousel
			$(this).find('.featured-story-img').removeClass('active').eq($el.attr('data-number') - 1).addClass('active');

			// Establish container to append to
			$container = $homeWrap.find('.featured-story-content-wrap');

			// Get this carousel's active element
			$active = $homeWrap.find('.featured-story.active');
			$active.removeClass('active');

			// Move active to clicked element, and move clicked element to active
			$el.before($active);
			$el.addClass('active');
			$el.prependTo($container);
		});
	});
	*/

	// Homepage feature bio wrap
	function bioSize(){
		$activeWidth = 370;
		if($(window).width() > 1220){
			$activeWidth = 570;
		}
		$('.feature-bio-wrap').each(function(){
			$this = $(this);

			$('.bio:first',$this).addClass('active').width($activeWidth);

			$('.bio:nth-child(2)',$this).css({
			  left: $activeWidth
			});
			$('.bio:nth-child(3)',$this).css({
			  left: $activeWidth + $('.bio:not(.active)',$this).width()
			});
		});
	}
	if($(window).width() > 992){
		$('.bio:first').addClass('active');

		// Resize bios
		bioSize();
	}
	$(document).on('click','.bio',function(){
		$activeWidth = $('.bio.active').width();
	  $this = $(this);
	  $bioWrap = $this.closest('.feature-bio-wrap');

		if($('.feature-bios .bio.velocity-animating',$bioWrap).length || $(window).width() < 767){
			return;
		}
	  if(!$this.hasClass('active')){
		  $this.velocity({
		    left: 0,
		    height: 638,
		    width: $activeWidth
		  },{
		    duration: 400,
		    queue: false
		  });

		  $curActive = $('.bio.active',$bioWrap).clone();
		  $curActive.appendTo($bioWrap.find('.bio-wrap')).css({
		    left: $activeWidth + $('.bio:not(.active)',$bioWrap).width() * 2,
		    height: '251px',
		    width: '251px'
		  })
		  .removeClass('active')
		  .velocity({
		    left: 900
		  },{
		    duration: 400,
		    queue: false,
		    complete: function(){
		    	// Remove old active
		    	$('.bio.active',$bioWrap).remove();

		      $this.addClass('active');
		      $('.feature-bio-copy-wrap',$bioWrap).html($this.find('.copy-wrap').html());

		      $('.feature-bio-copy-wrap',$bioWrap).find('h2,h3,p').velocity('finish').velocity('transition.slideUpIn',{
		      	duration: 400,
		      	easing: 'easeOut',
		      	stagger: 100
		      });
		    }
		  });

		  $this.nextAll('.bio').velocity({
		    left: '-=251px'
		  },{
		    duration: 400,
		    delay: 0,
		    queue: false,
		    complete: function(){
		      $newActive = $this.clone();
		      $this.remove();
		      $newActive.prependTo($bioWrap.find('.bio-wrap')).addClass('active');
		    }
		  });
		}
	});

	// Position emergecy modal on smaller screens
	if($('.emergency-modal').outerHeight() + parseInt($('.emergency-modal').css('margin-top')) < $(window).height() - $('.header').height()){
		$('.emergency-modal-wrap').addClass('fixed');
	}

	// Close emergency modal
	$('.emergency-modal-close').on('click',function(e){
		e.preventDefault();
		$('.emergency-modal-wrap').velocity(
			{
				opacity: 0,
				duration: 200
			},{
				complete: function(){
					$('.emergency-modal-wrap').remove();
				}
		});
	});

	// Bio hover effects
	$(document).on('mouseenter','.bio',function(){
		if(Modernizr.touch == false && $(window).width() > 767){
			$(this).find('h2,h3,.arw-right').velocity('finish').velocity('transition.slideUpIn',{
				duration: 400,
				easing: 'easeOut',
				stagger: 100
			});
		}
	});

	// Big list mobile toggle
	$('.btn-mobile-toggle').on('click',function(e){
		e.preventDefault();
		$bigList = $(this).parent();

		$bigList.toggleClass('open-list');

	});

	// Stat block animation
	$('.stat-block-wrap').on('mouseenter',function(){
		if(Modernizr.touch == false && $(window).width() > 992){
			$this = $(this);
			$infoCopy = $('.info-copy',this);

			$statHeight = $this.find('.stat').outerHeight();
			$infoHeight = $this.find('.info').outerHeight();

			$statHeight = (($infoHeight / 2 / $statHeight) * 100) + 50;

			$('.stat',this).css({'transform':'translateY(-50%)'}).velocity('finish').velocity({
				marginTop: '-' + parseInt($infoHeight / 2 + 20)
			},{
				duration: 200,
				easing: 'easeOut'
			});

			$('.info',this).velocity('finish').velocity({
				opacity: 1,
				marginTop: parseInt($statHeight / 2 + 20)
			},{
				duration: 200,
				easing: 'easeOut',
				queue: false
			});
		}
	}).on('mouseleave',function(){
		if(Modernizr.touch == false && $(window).width() > 992){
			$('.stat',this).velocity('stop').velocity('reverse');

			$('.info',this).velocity('stop').velocity({
				opacity: 0,
				marginTop: 0
			},{
				duration: 200,
				easing: 'easeOut',
				queue: false
			});
		}
	});

	// Equal height horizontal scroll
	if($(window).width() < 992){
		horScrollSize();
	}

	function horScrollSize(){
		// Reset height of all horizontal elements
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

	// Stat wrap offscreen listener
	$('.stat-wrap').on('mouseenter',function(){
		$this = $(this);
		$classes = $this[0].classList;

		if($classes.contains('in-right') && $this.offset().left + parseInt($this.width() * 2) > $(window).width()){
			$this.removeClass('in-right').addClass('in-left');
		}
		if($classes.contains('in-left') && $this.offset().left - parseInt($this.width() * 2) < 0){
			$this.removeClass('in-left').addClass('in-right');
		}
	});

	// Audience nav wrap arrow hover
	$('.audience-nav-wrap').hover(function(){
		$(this).find('svg use').attr('xlink:href', ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-up');
	},function(){
		$(this).find('svg use').attr('xlink:href', ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-down');
	});

	// Debounced window resize listener
	$(window).smartresize(function(){
		$windowWidth = $(window).width();
		if($windowWidth > 767){
			// Resize bios on window resize
			bioSize();
		}

		if($windowWidth >= 992){
			// Resize hor-scroll-wrap elements
			$('.hor-scroll-el').css({'height':''});
		} else {
			// Equal height hor-scroll elements
			horScrollSize();
		}

		// Position emergecy modal on smaller screens
		if($('.emergency-modal').outerHeight() + 200 < $(window).height() - $('.header').height()){
			$('.emergency-modal-wrap').addClass('fixed');
		} else {
			$('.emergency-modal-wrap').removeClass('fixed');
		}
	});

	// Styled select boxes
	$('select.styled').each(function(i){
		$this = $(this);

		// Make new HTML select box
		var $styledSelect = $('<div class="styled-select" data-select="select'+i+'" tabindex="0"><div class="selected">Standard Dropdown</div><ul></ul><span class="arw-right icon-svg"><svg><use xlink:href="'+ufclas_ufl_2015_sitedata.theme_url+'/img/spritemap.svg#arw-down"></use></svg></span></div>');
		$this.before($styledSelect);

		// Get all options from this select box
		$('option',this).each(function(){
			$styledSelect.find('ul').append('<li><a href="#" data-value="'+$(this).val()+'">'+$(this).text()+'</a></li>')
		});

		// Hide this select box
		$this.hide().attr('data-select','select'+i);
	});
	$(document).on('click','.styled-select a',function(e){
		e.preventDefault();
		$this = $(this);
		$select = $this.closest('.styled-select');

		// Change the text of selected
		$select.find('.selected').text($this.text()).addClass('changed');

		// Hide the dropdown
		$('.styled-select').removeClass('hover').find('svg use').attr('xlink:href', ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-down');

		$('select[data-select="'+$select.attr('data-select')+'"]').val($(this).attr('data-value'));

		// Unbind document close select
		$(document).off('click.closeSelect');
	}).on('click','.styled-select .selected,.styled-select .arw-right',function(){
		$select = $(this).closest('.styled-select');
		$('.styled-select').not($select).removeClass('hover');
		$select.toggleClass('hover');

		// Change the arrow icon
		if($select.hasClass('hover')){
			$select.find('svg use').attr('xlink:href', ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-up');
		} else {
			$select.find('svg use').attr('xlink:href', ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-down');
		}
		// Change the arrow icon
		$('.styled-select').not($select).find('svg use').attr('xlink:href', ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-down');

		// Close the select on blur
		window.setTimeout(function(){
			$(document).one('click.closeSelect',function(e){
				if(!$(e.target).closest('.styled-select').length){
					$select.removeClass('hover');
					$select.find('svg use').attr('xlink:href',ufclas_ufl_2015_sitedata.theme_url + '/img/spritemap.svg#arw-down');
				}
			});
		},0);
	}).on('keydown','.styled-select',function(e){
		if(e.keyCode == 32){
			e.preventDefault();
			$(this).addClass('hover').find('li:first a').focus();
		}
		// Down arrow
		if(e.keyCode == 40){
			e.preventDefault();
			$(this).find('a:focus').closest('li').next('li').find('a').focus();
		}
		// Up arrow
		if(e.keyCode == 38){
			e.preventDefault();
			$(this).find('a:focus').closest('li').prev('li').find('a').focus();
		}
	}).on('blur','.styled-select',function(e){
		if(!$(e.relatedTarget).closest('.styled-select').hasClass('hover')){
			$('.styled-select').removeClass('hover');
		}
	});

	// Custom checkboxes
	$('.uf-check input[type="checkbox"]').each(function(){
		$(this).after('<div><span class="icon-svg"><svg><use xlink:href="'+ufclas_ufl_2015_sitedata.theme_url+'/img/spritemap.svg#close"></use></svg></span></div>')
	});
	// Custom radio buttons
	$('.uf-check input[type="radio"]').each(function(){
		$(this).after('<div></div>')
	});

	//// Homepage infinite scroll
	if($('.homepage .home-section').length>1){
		if($('.homepage').length){
		
			var $firstSection = $('.home-section:first'),
					$lastSection = $('.home-section:last'),
					$home = $('#main');
		
			var intScroll = window.setInterval(homeScroll, 500);
		}
		
		$homeHeight = $('.home-section').outerHeight();
		$('html, body').animate({
		  scrollTop: $homeHeight
		}, 0);
	}
	
	// Add arrows to big lists
	$('.big-list li a').append('<span class="arw-right icon-svg"><svg><use xlink:href="'+ufclas_ufl_2015_sitedata.theme_url+'/img/spritemap.svg#arw-right"></use></svg></span>');
	
	// Add PrettyPhoto for image links
	$('.entry-content a').has('img').prop('rel', 'prettyPhoto');
	
	$('a[rel^="prettyPhoto"]').prettyPhoto();
	
	$('.entry-content a img').click(function (){
		var desc = $(this).parents('.wp-caption').find('.wp-caption-text').html();
		console.log( desc );
		$('.entry-content a').attr('title', desc);
	});
});