/*-------------------------------------------
	Module
-------------------------------------------*/

Site.modules.Module = (function($, Site) {

	var item;
	var creator;
	var destroyer;

	function init() {
		if ($(".js-lightboxing").length) {
			item = $(".js-lightboxing");
			closeLabel = "Close";

			scanPage();
			bindUI();
		}
	}

	function scanPage() {
		$(item).each(function() {
			if ($(this).attr("href").indexOf("youtu") > -1) {
				$(this).addClass("js-video js-youtube");
			} else if ($(this).attr("href").indexOf("vimeo") > -1) {
				$(this).addClass("js-video js-vimeo");
			} else {
				$(this).addClass("js-image");
			}
		});
	}

	function bindUI() {
		$(item).on("click", function(e) {
			e.preventDefault();
			restrictBody();
			prepLightbox();
			showLightbox();
			loadItem($(this));
			toggleBackground();
		});

		Site.onResize.push(resizeYoutube);
	}

	function bindAddedUI() {
		$(".fs-lightboxing-close").on("click", function() {
			reopenBody();
			destroyLightbox();
			toggleBackground();
		});
	}

	function prepLightbox() {
		var html = '<div class="fs-lightboxing hidden">' +
			'<button class="fs-lightboxing-close" title="close lightbox">' +
				'<span class="fs-lightboxing-close-icon">' + Site.icon("close") + '</span>' +
				'<span class="fs-lightboxing-close-label">' + closeLabel + '</span>' +
			'</button>' +
			'<figure class="fs-lightboxing-figure loading">' +
			'</figure>' +
		'</div>';

		$("body").after(html);

		bindAddedUI();
	}

	function showLightbox() {
		creator = setTimeout(function() {
			$(".fs-lightboxing").removeClass("hidden");
		}, 150);
	}

	function loadItem(target) {
		var object = $(target).attr("href");
		
		if ($(target).hasClass("js-youtube")) {
			object = object.replace("watch?v=", "embed/");
			object += "?rel=0&amp;controls=0&amp;showinfo=0&mute=1&autoplay=1";

			$(".fs-lightboxing-figure").append('<div class="fs-lightboxing-iframe-wrapper"><iframe class="fs-lightboxing-object fs-lightboxing-iframe fs-lightboxing-iframe-youtube" src="' + object + '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen /></div>');

			resizeYoutube();
		} else if ($(target).hasClass("js-vimeo")) {
			object = object.replace("vimeo.com", "player.vimeo.com/video");
			object += "?background=1&autoplay=1&loop=1&autopause=0";

			$(".fs-lightboxing-figure").append('<iframe class="fs-lightboxing-object fs-lightboxing-iframe fs-lightboxing-iframe-vimeo" src="' + object + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen />');
		} else {
			$(".fs-lightboxing-figure").append('<img class="fs-lightboxing-object fs-lightboxing-image" src="' + object + '" />');	
		}

		$(".fs-lightboxing-object").on("load", function() {
			$(".fs-lightboxing-figure").removeClass("loading");
		});
	}

	function resizeYoutube() {
		if ($(window).innerWidth() <= 740 ) {
			$(".fs-lightboxing-iframe-youtube").parent().css({
				"width": "100%",
				"padding-bottom": "56.25%"
			});
		} else {
			$(".fs-lightboxing-iframe-youtube").parent().css({
				"width": "70%",
				"padding-bottom": "calc(56.25% * 0.7)"
			});
		}
	}

	function destroyLightbox() {
		$(".fs-lightboxing").addClass("hidden");

		destroyer = setTimeout(function() {
			$(".fs-lightboxing").remove();	
		}, 150);
	}

	function restrictBody() {
		$("body").addClass("fs-navigation-lock");
	}

	function reopenBody() {
		$("body").removeClass("fs-navigation-lock");
	}

	function toggleBackground() {
		$(".js-video-play-pause").trigger("click");
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
