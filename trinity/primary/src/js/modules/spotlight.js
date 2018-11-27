/*-------------------------------------------
	Spotlight
-------------------------------------------*/

Site.modules.Spotlight = (function($, Site) {

	var lastScroll;

	function init() {
		if ($(".spotlight").length) {
			$(".spotlight_takeover_option").checkbox();

			testQueryString();
			bindUI();
		}
	}

	function testQueryString() {
		var field = 'query';
		var url = window.location.href;

		if (url.indexOf('?query') != -1) {
			$("body").addClass("fs-navigation-lock spotlight-lock");

			if (url.indexOf('programs') != -1) {
				$(".spotlight_items:not('.spotlight_items_clone') .spotlight_item:nth-child(1)").trigger("click");
			} else if (url.indexOf('people') != -1) {
				$(".spotlight_items:not('.spotlight_items_clone') .spotlight_item:nth-child(2)").trigger("click");
			} else if (url.indexOf('places') != -1) {
				$(".spotlight_items:not('.spotlight_items_clone') .spotlight_item:nth-child(3)").trigger("click");
			} else if (url.indexOf('pride') != -1) {
				$(".spotlight_items:not('.spotlight_items_clone') .spotlight_item:nth-child(4)").trigger("click");
			}

			$(".video_item_iframe").remove();
		}
	}

	function bindUI() {
		$(".spotlight_item").hover(function() {
			$(".spotlight").addClass("interested");
		}, function() {
			$(".spotlight").removeClass("interested");
		});

		$(".spotlight_item").on("click", triggerSpotlight);
		$(".spotlight_takeover_item_close").on("click", closeSpotlight);
		$(".spotlight_video_trigger").on("click", updateVideo);
		$(".spotlight_takeover_content").on("scroll", scrollSpotlight);

		$(".spotlight_takeover_content_next").on("click", function() {
			switchSpotlight($(this));
		});

		Site.onScroll.push(hideSpotlight);
	}

	function triggerSpotlight() {
		var item = $(this);
		
		$("body").addClass("fs-navigation-lock spotlight-lock");

		$(".alert, .header, .page_inner, .footer").css("padding-right", getScrollbarWidth());
		$(".spotlight_items_clone").css("width", "");
		$(".spotlight_takeover_item").css("width", "");

		$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
			enter: function() {
				$(".spotlight_takeover_item_close").css("right", "");
			},
			leave: function() {
				$(".spotlight_takeover_item_close").css("right", getScrollbarWidth());
			}
		});

		if ($(item).index() == 0) {
			$("body").addClass("spotlight-active-1");
		}

		$(".spotlight_takeover_content").scrollTop(0);

		$(".video_item_iframe").remove();
	}

	function closeSpotlight() {
		$("body").removeClass("fs-navigation-lock spotlight-lock");
		$("body").removeClass("spotlight-active-1");

		$(".alert, .header, .page_inner, .footer").css("padding-right", "");
		$(".spotlight_items_clone").css("width", "calc(100% - " + (62 - getScrollbarWidth()) + "px)");
		$(".spotlight_takeover_item").css("width", "calc(100% + " + getScrollbarWidth() + "px)");

		$(".spotlight_takeover_content").each(function() {
			$(this).scrollTop(0);
		});

		$(".video_item_iframe").remove();
	}

	function updateVideo() {
		if (!($(".spotlight_video_trigger").hasClass("paused"))) {
			$(".spotlight_body_background").background("pause");
			$(".spotlight_video_trigger").addClass("paused");
			$(".spotlight_video_label").html("Play Video");
		} else {
			$(".spotlight_body_background").background("play");
			$(".spotlight_video_trigger").removeClass("paused");
			$(".spotlight_video_label").html("Pause Video");
		}
	}

	function scrollSpotlight(e) {
		var item = $(this);

		scrollSpotlightProgress(item);
		closeSpotlightScroll(item);
	}

	function scrollSpotlightProgress(item) {
		var progress = $(item).scrollTop() / ($(item)[0].scrollHeight - $(item).innerHeight());
		var appliedWidth = $(window).innerWidth() * progress;

		$(item).find(".spotlight_takeover_content_next_progress").css("width", (progress * 100) + "%");
		
		$.mediaquery("bind", "mq-key", "(min-width: " + Site.minMD + "px)", {
			enter: function() {
				progress = progress * 2;
			}
		});
		
		$(item).closest(".spotlight_takeover_item").find(".spotlight_takeover_content_progress").css("width", appliedWidth + "px");

		if (appliedWidth + 60 >= $(window).innerWidth()) {
			$(item).parent().addClass("done");
		} else {
			$(item).parent().removeClass("done");
		}
	}

	function closeSpotlightScroll(item) {
		$.mediaquery("bind", "mq-key", "(min-width: 1220px) and (min-height: 700px)", {
			enter: function() {
				if ($(item).closest(".spotlight_takeover_item").hasClass("fs-swap-active")) {
					if ($(item)[0].scrollHeight > $(item).innerHeight()) {
						if ($(item)[0].scrollHeight - $(item).innerHeight() <= $(item).scrollTop()) {
							lastScroll = $(item).scrollTop();

							var timer = setTimeout(function() {
								if (lastScroll <= $(item).scrollTop()) {
									switchSpotlight(item);
								}

								clearInterval(timer);
							}, 400);
						}
					}
				}
			}
		});
	}

	function switchSpotlight(item) {
		var index = $(item).closest(".spotlight_takeover_item").index() - 1;

		if (index != 4) {
			$(".spotlight_items_clone .spotlight_item").eq(index).trigger("click");
			$("body").removeClass("spotlight-active-1");
		} else {
			$(item).closest(".spotlight_takeover_item").find(".spotlight_takeover_item_close").trigger("click");
		}

		$(item).scrollTop(0);
	}

	function hideSpotlight() {
		if ($(".spotlight")[0].getBoundingClientRect().bottom < 0) {
			$(".spotlight").addClass("hide");
		} else {
			$(".spotlight").removeClass("hide");
		}
	}

	function getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.width = "100px";
    outer.style.msOverflowStyle = "scrollbar";

    document.body.appendChild(outer);

    var widthNoScroll = outer.offsetWidth;
    // force scrollbars
    outer.style.overflow = "scroll";

    // add innerdiv
    var inner = document.createElement("div");
    inner.style.width = "100%";
    outer.appendChild(inner);

    var widthWithScroll = inner.offsetWidth;

    // remove divs
    outer.parentNode.removeChild(outer);

    return widthNoScroll - widthWithScroll;
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
