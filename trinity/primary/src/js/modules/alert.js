/*-------------------------------------------
	Alert
-------------------------------------------*/

Site.modules.Alert = (function($, Site) {

	var $alert;
	var $alertClose;
	var $alertTime;
	var cookieName;

	function init() {
		if ($(".alert").length) {
			$alert = $(".alert");
			$alertClose = $(".alert_close");
			$alertTime = $alert.data("time");
			cookieName = "alert-cookie";

			if ($.cookie(cookieName) === $alertTime) {
				hideAlert();
			} else {
				showAlert();
			}

			resizeAlert();
			bindUI();
		}
	}

	function bindUI() {
		$alertClose.on("click", function() {
			setCookie();
			hideAlert();
		});

		Site.onResize.push(resizeAlert);
	}

	function resizeAlert() {
		if($alert.hasClass("show_alert")) {
			alertResizeTest();
		} else {
			alertResetSize();
		}
	}

	function setCookie() {
		$.cookie(cookieName, $alertTime);
	}

	function alertResizeTest() {
		if ($alert.hasClass("admin_alert")) {
			adminAlertResize();
		} else {
			standardAlertResize();
		}
	}

	function adminAlertResize() {
		$(".mobile_sidebar").css({
			"height": 'calc(100% - ' + $(".header_ribbon").innerHeight() + 'px - ' + $(".alert").innerHeight() + 'px' + '32px)',
			"top": $(".header_ribbon").innerHeight() + $(".alert").innerHeight() + 32 +  'px'
		});

		$(".header").css("top", $(".alert").innerHeight() + 32 + 'px');
		$(".page_feature").css("padding-top", $(".alert").innerHeight());
	}

	function standardAlertResize() {
		$(".mobile_sidebar").css({
			"height": 'calc(100% - ' + $(".header_ribbon").innerHeight() + 'px - ' + $(".alert").innerHeight() + 'px)',
			"top": $(".header_ribbon").innerHeight() + $(".alert").innerHeight() + 'px'
		});

		$(".header").css("top", $(".alert").innerHeight());
		$(".page_feature").css("padding-top", $(".alert").innerHeight());
	}

	function alertResetSize() {
		$(".header").css("top", "");
		$(".mobile_sidebar").css({
			"height": "",
			"top": ""
		});
		$(".page_feature").css("padding-top", "");
	}

	function showAlert() {
		$alert.addClass("show_alert");

		alertResizeTest();
	}

	function hideAlert() {
		$alert.removeClass("show_alert");

		alertResetSize();
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
