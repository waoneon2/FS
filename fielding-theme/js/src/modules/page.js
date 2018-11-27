/*-------------------------------------------
	Page
-------------------------------------------*/

	/* global picturefill */
	/* global HomeFeatureData */

	Site.modules.Page = (function($, Site) {
		var $mainNavItem,
			$linkedCarousel,
			$linkedCarouselSibling,
			$carouselCounter,
			$featureCallout,
			$spotlight;

		function init() {
			$mainNavItem                 = $('.main_nav_item');
			$linkedCarousel              = $('.js-linked-carousel');
			$linkedCarouselSibling       = $('.js-linked-carousel-sibling');
			$carouselCounter             = $('.js-carousel-counter');
			$featureCallout              = $('.feature_callout');
			$spotlight                   = $('.feature_callout_spotlight');

			// Home Feature

			if (typeof HomeFeatureData !== "undefined" && HomeFeatureData.length) {
				var index = Math.floor(Math.random() * HomeFeatureData.length);
				$(".people_feature_section").html( HomeFeatureData[index] ).addClass("loaded");
			}

			/* Plugin Defaults */

			$.lightbox("defaults", {
				mobile: true
			});

			/* Picturefill */

			picturefill();

			/* Analytics */

			$.analytics({
				scrollDepth: true
			});

			/* Mobile Main Navigation */

			Site.$body.find(".js-mobile_navigation").navigation({
				maxWidth: "979px"
			});


			/* Mobile Subnavigation */

			Site.$body.find(".js-navigation")
				.navigation({
					maxWidth: "979px"
				})
				.on("open.navigation", function() {
					trackEvent( $(this).data("analytics-open") );
				}).on("close.navigation", function() {
					trackEvent( $(this).data("analytics-close") );
				});

			Site.$body.find(".js-swap").swap();
			Site.$body.find(".js-background").background();
			Site.$body.find(".js-carousel").carousel();
			Site.$body.find(".js-equalize").equalize();
			Site.$body.find(".js-lightbox").lightbox({ mobile: true });
			Site.$body.find(".js-dropdown").dropdown();
			Site.$body.find(".js-checkbox, .js-radio, input[type=checkbox], input[type=radio]").checkbox();

			Site.$body.find(".vfb-select").dropdown({
				theme: "base_dropdown gray_dropdown"
			});

			/* Wrapper for Tables */

			Site.$body.find("table").wrap('<div class="table_wrapper"></div>');

			/* Generic Toggles */

			Site.$body.find(".js-toggle")
				.not(".js-bound")
				.on("click", ".js-toggle_handle", onToggleClick)
				.addClass("js-bound");


			/* Scroll Nav */

			Site.$body.find(".js-scroll_to")
				.not(".js-bound")
				.on("click", onScrollTo)
				.addClass("js-bound");


			/* Responsive Video */

			$("iframe[src*='vimeo.com'], iframe[src*='youtube.com']", ".typography").each(function() {
				$(this).wrap('<div class="video_frame"></div>');
			});


			/* Dislay children of focused nav items */

			$mainNavItem.find("a").focus(function () {
				$(this).closest(".main_nav_item").addClass("focused");
			});

			$mainNavItem.find("a").blur(function () {
				$(this).closest(".main_nav_item").removeClass("focused");
			});


			// Linked Carousels

			if ($linkedCarousel.length) {
				$linkedCarousel.on("update.carousel", updateCarouselSibling);
				$linkedCarouselSibling.on("update.carousel", updateCarousel);
			}


			// Carousel Counter

			if ($carouselCounter.length) {
				setCarouselCounter();
				$carouselCounter.find(".js-carousel").on("update.carousel", setCarouselCounter);
			}


			/* Scrolling */

			Site.onScroll.push(scroll);
			Site.onResize.push(resize);
			Site.onRespond.push(respond);

			Site.scroll();

			mobileNavToggle();
			quickNavToggle();


			// Media Queries
			$.mediaquery("bind", "mq-key", "(min-width: " + Site.minMD + "px)", {
				enter: function() {
					mqMedium();
				}
			});

			$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
				enter: function() {
					mqLarge();
				},
				leave: function() {
					mqMedium();
				}
			});

		}

		function scroll() {

		}

		function resize() {
			scroll();
		}

		function respond() {
			scroll();
		}

		function onScrollTo(e) {
			Site.killEvent(e);

			var $target = $(e.delegateTarget),
				id = $target.attr("href");

			scrollToElement(id);
		}

		function scrollToElement(id) {
			var $to = $(id);

			if ($to.length) {
				var offset = $to.offset();

				scrollToPosition(offset.top);
			}
		}

		function scrollToPosition(top) {
			$("html, body").animate({ scrollTop: top });
		}

		function onToggleClick(e) {
			Site.killEvent(e);

			var $target   = $(e.delegateTarget),
				activeClass = "js-toggle_active";

			if ($target.hasClass(activeClass)) {
				$target.removeClass(activeClass);
			} else {
				$target.addClass(activeClass);
			}
		}

		function trackEvent(data) {
			if ($.type(data) === "string") {
				data = data.split(",");

				$.analytics.apply(this, data);
			}
		}

		function updateCarouselSibling(e, index) {
			$linkedCarouselSibling.carousel("jump", index + 1, true);

			if ($carouselCounter.length) {
				setCarouselCounter();
			}
		}

		function updateCarousel(e, index) {
			$linkedCarousel.carousel("jump", index + 1, true);

			if ($carouselCounter.length) {
				setCarouselCounter();
			}
		}

		function setCarouselCounter() {
			var $item            = $carouselCounter.find(".fs-carousel-item");
			var $visible         = $carouselCounter.find(".fs-carousel-visible");
			var $counterIndex    = $carouselCounter.find(".carousel_count_index");
			var $counterTotal    = $carouselCounter.find(".carousel_count_total");
			var itemTotal        = $item.length;
			var itemIndex        = $visible.index() + 1;

			$counterIndex.text(itemIndex);
			$counterTotal.text(itemTotal);
		}

		function mobileNavToggle() {
			var $item  = Site.$body.find(".mobile_navigation .main_nav .menu > .menu-item");
			var expand = "<span class='js-swap expand' data-swap-target='.js-mobile_target_one'>Expand</span>";

			$item.prepend(expand);

			$item.each(function(index, el) {
				// var itemIndex = $(this).closest(".menu-item").index();

				var $el   = $(el),
					klass = "js-mobile_target_" + index;

				$el.find(".expand").attr("data-swap-target", "." + klass);
				$el.find(".sub-menu").addClass(klass);
			});

			Site.$body.find(".js-swap").swap();

			$(".mobile_navigation .sub-sub-menu").each(function(index) {
				$(this).addClass("sub-sub-menu-" + index);
				$(this).closest(".menu-item").attr("data-swap-target", ".sub-sub-menu-" + index);
				$(this).closest(".menu-item").attr("data-swap-group", "sub-sub-group");
				$(this).closest(".menu-item").swap();
			});
		}

		function quickNavToggle() {
			$(".quick_nav li:first-child").attr("data-swap-target", ".quick_nav li:first-child > ul");
			$(".quick_nav li:first-child").swap();
		}

		function spotlightMedium() {
			$featureCallout.each(function() {
				$(this).find(".feature_callout_spotlight").appendTo($(this).find(".feature_callout_spotlight_small"));
				$(this).find(".spotlight_carousel").carousel("resize");
			});
		}

		function spotlightLarge() {
			$featureCallout.each(function() {
				$(this).find(".feature_callout_spotlight").appendTo($(this).find(".feature_callout_spotlight_large"));
				$(this).find(".spotlight_carousel").carousel("resize");
			});
		}

		function mqMedium() {
			if ($featureCallout.length) {
				spotlightMedium();
			}
		}

		function mqLarge() {
			if ($featureCallout.length) {
				spotlightLarge();
			}
		}

		/* Hook Into Main init Routine */

		Site.onInit.push(init);

		return {

		};
	})(jQuery, Site);
