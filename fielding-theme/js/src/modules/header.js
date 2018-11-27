/*-------------------------------------------
	Header
-------------------------------------------*/

	Site.modules.Header = (function($, Site) {

		function init() {
			bindUI();
			adjustMenus();
			pinHeader();
		}

		function bindUI() {
			Site.onResize.push(adjustMenus);
			Site.onScroll.push(pinHeader);
		}

		function adjustMenus() {
			$(".main_nav_group .sub-sub-menu").each(function() {
				if ($(this).closest(".sub-menu").innerHeight() < $(this).innerHeight()) {
					$(this).closest(".sub-menu").css("height", $(this).innerHeight() + 20);
				} else {
					$(this).css("height", $(this).closest(".sub-menu").innerHeight());
				}
			});
		}

		function pinHeader() {
			if ($(window).scrollTop() >= 120) {
				$("body").addClass("pin-header");
			} else {
				$("body").removeClass("pin-header");
			}
		}

		Site.onInit.push(init);

		return {

		};
	})(jQuery, Site);
