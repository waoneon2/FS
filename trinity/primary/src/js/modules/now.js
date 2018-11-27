/*-------------------------------------------
	Now
-------------------------------------------*/

Site.modules.Now = (function($, Site) {

	function init() {
		if ($(".now").length) {
			bindUI();
			bindFirstItem();
			resizeItems();
		}
	}

	function bindUI() {
		Site.onResize.push(resizeItems);
		Site.onResize.push(bindFirstItem);

		$(".now_item").hover(function() {
			$(".now_item").removeClass("active");
			$(this).addClass("active");
		});
	}

	function bindFirstItem() {
		$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
			enter: function() {
				$(".now_item:first-child").addClass("active");
			},
			leave: function() {
				$(".now_item:first-child").removeClass("active");
			}
		});
	}

	function resizeItems() {
		$.mediaquery("bind", "mq-key", "(min-width: " + Site.minLG + "px)", {
			enter: function() {
				$(".now_items").css("min-height", $(".now_item_figure").innerHeight());
			},
			leave: function() {
				$(".now_items").css("min-height", "");
			}
		});
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
