/*-------------------------------------------
	Gallery
-------------------------------------------*/

Site.modules.Gallery = (function($, Site) {

	function init() {
		if ($(".media_gallery").length) {
			bindUI();
			switchCaptions();
			resizeCaptions();
		}
	}

	function bindUI() {
		$(".media_gallery_inner, .media_gallery_trigger").on("click", function() {
			$("body").addClass("fs-navigation-lock");
		});

		$(".media_gallery_close").on("click", function() {
			$("body").removeClass("fs-navigation-lock");
		});

		$(".media_gallery_body_inner").on("scroll", function() {
			switchCaptions();
		});

		Site.onResize.push(resizeCaptions);
		Site.onResize.push(determineFit);
	}

	function switchCaptions() {
		$(".media_gallery_item").each(function() {
			var d = $(this)[0].getBoundingClientRect();

			if(d.top < $(window).innerHeight() / 2 && d.bottom > $(window).innerHeight() / 2) {
				$(this).addClass("in-view");
				$(".media_gallery_item_sticker").eq($(this).index()).addClass("current");
			} else {
				$(this).removeClass("in-view");
				$(".media_gallery_item_sticker").eq($(this).index()).removeClass("current");
			}
		});

		if($(".media_gallery_body_inner")[0].scrollHeight - $(".media_gallery_body_inner").scrollTop() == $(".media_gallery_body_inner").outerHeight()) {
			$(".media_gallery_item").removeClass("in-view");
			$(".media_gallery_item_sticker").removeClass("current");

			$(".media_gallery_item").eq($(".media_gallery_item").length - 1).addClass("in-view");
			$(".media_gallery_item_sticker").eq($(".media_gallery_item").length - 1).addClass("current");
		}
	}

	function resizeCaptions() {
		$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
			enter: function() {
				var tallest = 0;

				$(".media_gallery_item_sticker").each(function() {
					if ($(this).innerHeight() > tallest) {
						tallest = $(this).innerHeight();
					}
				});

				$(".media_gallery_item_stickers").css("height", tallest);
			},
			leave: function() {
				$(".media_gallery_item_stickers").css("height", "");
			}
		});
	}

	function determineFit() {
		if ($(".media_gallery_body_header").innerHeight() < $(window).innerHeight()) {
			$(".media_gallery").addClass("fits");
		} else {
			$(".media_gallery").removeClass("fits");
		}
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
