jQuery(document).ready(function ($) {

	var header_notif = function () {
	  var heightnotif 	= $('.mtsnb').height(),
	      headerDoc 		= document.querySelector('.content-section header'),
	  		mtsnIsHidden	= $('.mtsnb.mtsnb-top').hasClass("mtsnb-hidden"),
	  		classList 		= headerDoc.className.split(' ');

	  if (classList.indexOf('sticky') === -1 && mtsnIsHidden !== true) {
	  	$('.content-section header').css('top', heightnotif + 'px');
	  } else {
	  	remove_heightnotif();
	  }
 	};

 	var remove_heightnotif = function () {
 			$('.content-section header').css('top', 0);
 	}

 	header_notif();
 	$('.mtsnb-hide').on("click", remove_heightnotif);
 	$(window).on("resize", header_notif);
	$(window).on("orientationchange", header_notif);

	// touch-device
	if ("ontouchstart" in window || "ontouch" in window) {
		$('html').addClass('touch');
		FastClick.attach(document.body);
	} else {
		$('html').addClass('no-touch');
	}

	// sticky-header
	//if ($(".no-touch").length) {
		stickyHeader();
		header_notif();
	//}
	function stickyHeader() {
		fixedHeader();
		header_notif();
		$(window).on("scroll", function () {
			fixedHeader();
			header_notif();
		});
		window.addEventListener('scroll', function() {
			fixedHeader();
			header_notif();
		});
		window.addEventListener('touchmove', function() {
			fixedHeader();
			header_notif();
		});
		function fixedHeader(){
			if( window.pageYOffset > 0 ){
				$('.header-animate HEADER').addClass('sticky');
			} else {
				$('.header-animate HEADER').removeClass('sticky');
			}
		}
	}
    // video box
    if ( $('.video-container').length){
        $('.popup-modal').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#username',
            modal: true
        });
    }
    if ( $('.video-box').length){
        $('.popup-modal').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#username',
            modal: true
        });
    }
	//search-form
	showSearchForm();
	function showSearchForm() {
		var wrapper = $(".wrapper"),
			searchBox = $('.search-box');
		searchBox.each(function(){
			var $this = $(this);
			$this.find(".open-btn").on('click',function(event){
				event.preventDefault();
				var $this = $(this);
				if (!$this.parents('.wrapper').hasClass("open-search-form")) {
					$this.parents('.wrapper').addClass("open-search-form");
					$('.close-btn').css('display', 'inline-block');
				}
			});
			$this.find(".close-btn").on('click',function(event){
				event.preventDefault();
				var $this = $(this);
				if ($this.parents('.wrapper').hasClass("open-search-form")) {
					$this.parents('.wrapper').removeClass("open-search-form");
					$('.close-btn').css('display', 'none');
				}

			});
		});
	}

	// push-menu
	if($(".mobile-menu").length){
		var body = $("body"),
			wrapper = $(".wrapper"),
			pushBtn = $(".mobile-menu-btn"),
			pushMenuLeft = $(".mobile-menu");
			pushBtn.on("click",function(event){
				event.preventDefault();
				body.toggleClass("open");
			});
		wrapper.on("click", function(event){
			if ( pushMenuLeft.has(event.target).length == 0 && !pushMenuLeft.is(event.target) && pushBtn.has(event.target).length == 0 && !pushBtn.is(event.target)){
				body.removeClass("open");
			}
		});
	}

	// equal-height
	$('.equal-height-1').matchHeight();

	function check_if_in_view() {
		var $animation_elements = $('.animated');
		var window_height = $(window).height();
		var window_top_position = window.pageYOffset;
		var window_bottom_position = window_top_position + window_height;

		$.each($animation_elements, function() {
			var $element = $(this);
			var stepsAnimate = $element.parents(".steps-animated");
			var class_name = $element.attr("data-animateFunction");
			if (stepsAnimate.length){
				var stepsAnimateHeight = stepsAnimate.outerHeight()*0.3;
				var stepsAnimate_top_position = stepsAnimate.offset().top + stepsAnimateHeight;
				if ((stepsAnimate_top_position < window_bottom_position)) {
					$element.addClass(class_name);
				}
			} else {
				var element_height = $element.outerHeight();
				var element_top_position = $element.offset().top + element_height;
				if ((element_top_position < window_bottom_position)) {
					$element.addClass(class_name);
				}
			}
		});
	}
	if ($(".no-touch").length && $('.animated').length) {
		check_if_in_view();
		$(window).on('scroll resize', check_if_in_view);
		$(window).trigger('scroll');
	}

	// popup
	if ($(".popup-btn").length) {
		$('.popup-btn').magnificPopup({
			fixedContentPos: true,
			midClick: false,
			callbacks: {
				beforeOpen: function() { $('html').addClass('mfp-helper'); },
				close: function() { $('html').removeClass('mfp-helper'); }
			}
		});
	}

	// datepicker
	/*if ($("#datepicker").length) {
		$( "#datepicker" ).datepicker({
			showOn: 'button',
			dateFormat: "mm-dd-yy",
			showOn: 'button',
			onClose: function(dateText, inst) {
				$(this).attr("readonly", false);
			},
			beforeShow: function(input, inst) {
				$(this).attr("readonly", true);
			}
		});
	}*/
	// timepicker1
	/*if ($(".time-pick").length) {
		$('.time-pick').timepicker({
			minuteStep: 1
		});
	}*/



	var headerHeight = 0;
	if ($(window).width()>1023) {
		headerHeight =$('header').outerHeight() + 55;
	} else {
		headerHeight =$('header').outerHeight() + 15;
	}

	$(".apply-btn A").on("click",function(e){
		e.preventDefault();
		var $this = $(this),
		slideBox = $($this.attr("href")),
		applyContent = $(".apply-content"),
		applyBtn = $(".apply-btn A");
		applyContent.slideUp();
		applyBtn.removeClass("active");
		if (slideBox.is(":visible")){
			$this.removeClass("active");
			slideBox.slideUp();
		} else {
			$this.addClass("active");
			slideBox.slideDown(function(){
				var target = slideBox.offset().top;
				target -= headerHeight;
				$('html,body').stop().animate({
					scrollTop: target
				}, 500);
			});

		}
	});

	/**
	* add nav menu on apply page menu on
	**/
	(function () {
		var h3Header = $('.page-template-apply-now #content h3');
		h3Header.each(function(i, el) {
			var element = $(el);
			element.attr('id', 'apply-section-' + i);
			$('div.apply-now ul').append('<li class><a href="#apply-section-'+i+'">'+ element.text() +'</a></li>');
		});
	})();


	//scroll-to-anchor
	if ($(".inside-nav").length) {
		$('.inside-nav a').on('click', function(e){
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
				e.preventDefault();
				if ($(this.hash).length){
					var target = $(this.hash).offset().top;
					target -= headerHeight-1;
					$('html,body').stop().animate({
						scrollTop: target
					}, 500);
				}
			}
		});

		var aChildren = $(".inside-nav  li").children();
		var aArray = [];
		for (var i=0; i < aChildren.length; i++) {
			var aChild = aChildren[i];
			var ahref = $(aChild).attr('href');
			aArray.push(ahref);
		}
		function addClassAnchorActive () {
			var windowPos = $(window).scrollTop() +headerHeight;
			var windowHeight = $(window).height();
			var docHeight = $(document).height();

			for (var i=0; i < aArray.length; i++) {
				var theID = aArray[i];
				if ($(theID).length){
					var divPos = $(theID).offset().top;
				}
				var divHeight = $(theID).height();
				if (windowPos >= divPos && windowPos < (divPos + divHeight)) {
					$("a[href='" + theID + "']").parent().addClass("active");
				} else {
					$("a[href='" + theID + "']").parent().removeClass("active");
				}
			}

			if(windowPos + windowHeight == docHeight) {
				if (!$(".inside-nav li:last-child a").parent().hasClass("active")) {
					var navActiveCurrent = $(".inside-nav .active").children("A").attr("href");
					$("a[href='" + navActiveCurrent + "']").parent().removeClass("active");
					$(".inside-nav li:last-child a").parent().addClass("active");
				}
			}
		}
		addClassAnchorActive();
		$(window).on("resize scroll",function(){
			addClassAnchorActive();
		});
	}

	if ($(".no-touch").length && $(".ellipse-box").length) {
		skrollr.init({
			forceHeight: false
		});
	}

	// tabs
	/*if ($(".tabs").length) {
		$( ".tabs" ).tabs({
			active: 2,
			beforeLoad: function( event, ui ) {
				ui.jqXHR.fail(function() {
					ui.panel.html(
					"Couldn't load this tab. We'll try to fix this as soon as possible. " +
					"If this wouldn't be a demo." );
				});
			}
		});
	}*/
	function imageMoving() {
		if ($(window).width()>767){
			$(".image-color-change .row-box>:nth-child(2n) .wrap-img").each(function(){
				$(this).insertBefore($(this).parent().find(".title-box"));
			});
			$(".image-color-change>:nth-child(2n) .wrap-img").each(function(){
				$(this).insertAfter($(this).parent().find(".title-box"));
			});
		} else {
			$(".image-color-change>:nth-child(2n) .wrap-img").each(function(){
				$(this).insertBefore($(this).parent().find(".title-box"));
			});
			$(".image-color-change .row-box>:nth-child(2n) .wrap-img").each(function(){
				$(this).insertAfter($(this).parent().find(".title-box"));
			});
		}
	}
	if ($(".image-color-change").length){
		imageMoving();
		$(window).on("resize", function(){
			imageMoving();
		});
	}
	if ($(".slider-section").length){
		$( '.slider-section' ).on('init', function (event, slick) {
			$( this ).css( 'visibility', 'visible' );
		});
		$(".slider-section").slick({
			dots: true,
			infinite: false,
		});
	}
	if ($(".carousel-section").length){
		$( '.carousel-section' ).on('init', function (event, slick) {
			$( this ).css( 'visibility', 'visible' );
		});
		$(".carousel-section").slick({
			slidesToShow: 5,
			slidesToScroll: 5,
			infinite: true,
			responsive: [
				{
					breakpoint: 1130,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4,
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 521,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	}

	// range-slider
	if ($("#rangeSlider1").length) {
		var rangeSlider = $("#rangeSlider1"),
		instance,
		min = 5,
		start = 100,
		max = 1000,
		flag=false;

		rangeSlider.ionRangeSlider({
			min: min,
			max: max,
			from: start,
			hide_min_max: true,
			hide_from_to: false,
			prefix: "$",
			onChange: function(){
				if(flag){
					flag = false;
					instance.update({
						hide_from_to: false,
					});
				}
			}
		});

		instance = rangeSlider.data("ionRangeSlider");

        //>>>>>>>> Other Value
        function otherValue(Value) {
            $('.btn-event-other').val(Value).trigger('change');
        }
        $('.btn-event-other').change(function(){
            $("div.btn-event-ot").click();
        })
		$("div.btn-event-ot").on("click", function (event) {
			event.preventDefault();
			var val = $('.btn-event-other').val();
			//console.log(parseInt(val));
			if (val > max) {
					instance.update({
						max:val,
						from:val,
						hide_from_to: false,
					});
			} else {
					instance.update({
						max:max,
						from:val,
						hide_from_to: false,
					});
			}
            $(".btn-event").removeClass("active");
            $(".sponsor-btn").removeClass("active");
            $(this).addClass("active");
		});
        //<<<<<<<<<<<End of Other Value

		$('.donation-purpose input[type=radio]').on('click', function( event ) {
			var $el = $( this );
			var $memo = $( '.donation-purpose input[name=purpose_other]' );
			if ( $el.val() == 'Other' && $memo.val() != '') {
				$( 'input[name=custom]' ).prop( 'value', $memo.val() );
			} else {
				$( 'input[name=custom]' ).prop( 'value', $el.val() );
			}
		});

		$('.donation-purpose input[name=purpose_other]').on('click', function( event ) {
			var $memo = $( '.donation-purpose input[name=purpose_other]' );
			$( '#p3' ).prop( 'checked', true );
			if ( $memo.val() != '' ) {
				$( 'input[name=custom]' ).prop( 'value', $memo.val() );
			}
		});

		$('.donation-purpose input[name=purpose_other]').on('keyup blur', function( event ) {
			var $el = $( this );
			$( 'input[name=custom]' ).prop( 'value', $el.val() );
		});

		$(".btn-event").on("click", function (event) {
			event.preventDefault();
			var val = $(this).attr("data-from");
			instance.update({
				max:max,
				from: val,
				hide_from_to: false,
			});
            $(".btn-event").removeClass("active");
            $(".sponsor-btn").removeClass("active");
            $(this).addClass("active");
		});

		$(".sponsor-btn").on("click", function (event) {
			event.preventDefault();
			flag=true;
            //console.log(max);
			instance.update({
				max:5000,
				from:5000,
				hide_from_to: false
			});
            $(".btn-event").removeClass("active");
            $(this).addClass("active");
		});
	}
});

jQuery(document).ready(function($) {
	var video = document.getElementById('info-video');

	$('a[href="#schedule-tour"]').click(function(e) {
		e.preventDefault();
		$('a[href="#modal-form"]').click();
	});

	$(document).keyup(function(e) {
		if ( e.keyCode == 27 ) {
			$('button.video-close').click();
		}
	});

	$('body').on('click', '.mfp-container', function(e) {
		if ( e.target.id == 'info-video' ) {
			video.paused ? video.play() : video.pause();
		} else {
			$('button.video-close').click();
		}
	});

	$('button.video-close').click(function(e) {
		video.load();
	});

	// play video immediately
	$('.img-video.popup-modal').click(function(e) {
		video.play();
	});

	var videoEnded = function() {
		var video = document.getElementById('info-video');
		if (!video) return
		video.addEventListener('ended', function() {
			$('.video-cta').fadeIn('slow');
		});
	}

	var videoStart = function() {
		var video = document.getElementById('info-video');
		if (!video) return
		video.play();
	}

	setTimeout(videoEnded, 1000);
	//setTimeout(videoStart, 1000);

	// set checkbox for wpcf7, i still dont know how to do this without javascript
	// so we will just inject the html using this. first we will add i tag for all
	// label checkbox then we listen to user click
	var schoolCheckbox = $('.wpcf7-form-control-wrap.checkbox-school .wpcf7-list-item');
	if (schoolCheckbox) {
		$.each(schoolCheckbox, function(i, el) {
			$(el).find('.wpcf7-list-item-label').prepend('<i></i>');
		});
		$('body').on('click', '.wpcf7-list-item', function (e) {
			var input = $(this).find('input');
			//
			if (input.prop('checked')) {
				input.prop('checked', false);
			} else {
				input.prop('checked', true);
			}
		});
	}
});

function submitDonateForm() {
	var purposes = document.getElementsByName('purpose');
	for ( var i = 0; i < purposes.length; i++ ) {
		if ( purposes[i].checked ) {
			return document.getElementById('paypal').submit();
		}
	}
	alert("Please specify a donation purpose. Thanks!");
}
