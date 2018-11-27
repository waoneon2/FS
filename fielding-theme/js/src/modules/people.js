/*-------------------------------------------
	People Feature
-------------------------------------------*/

	Site.modules.People = (function($, Site) {
		var $overlay,
		$section,
		$mobileNav,
		$open,
		$close,
		$page,
		$captionButton,
		$backButton,
		$defaultView,
		$toggleView;

		function init() {
			$overlay        = Site.$body.find(".people_feature_overlay");
			$section        = Site.$body.find(".people_feature_section");
			$mobileNav      = Site.$body.find(".mobile_navigation");
			$open           = Site.$body.find(".people_feature_mobile_toggle");
			$close          = $overlay.find(".people_feature_overlay_close");
			$page           = Site.$body.find(".page_wrapper");
			$captionButton  = Site.$body.find(".people_feature_caption_button");
			$backButton     = Site.$body.find(".people_feature_name_button");
			$defaultView    = Site.$body.find(".people_feature_view_default");
			$toggleView     = Site.$body.find(".people_feature_view_toggle");

			if ($overlay.length) {
				relocate();
				$open.on("click", showDetails);
				$close.on("click", hideDetails);
				$captionButton.on("click", showMedia);
				$backButton.on("click", hideMedia);
			}
		}

		function relocate() {
			$overlay.insertAfter($mobileNav);
		}

		function showDetails() {
			Site.$body.addClass("fs-navigation-lock");
			$("html").addClass("fs-navigation-lock");
			$overlay
			.addClass("show_people_feature_overlay")
			.attr("aria-hidden", "false");
		}

		function hideDetails() {
			Site.$body.removeClass("fs-navigation-lock");
			$("html").removeClass("fs-navigation-lock");
			$overlay
			.removeClass("show_people_feature_overlay")
			.attr("aria-hidden", "true");
		}

		function showMedia() {
			$defaultView.attr("aria-hidden", "false");
			$toggleView.attr("aria-hidden", "true");
		}

		function hideMedia() {
			$defaultView.attr("aria-hidden", "true");
			$toggleView.attr("aria-hidden", "false");
		}

		Site.onInit.push(init);

		return {

		};
	})(jQuery, Site);
