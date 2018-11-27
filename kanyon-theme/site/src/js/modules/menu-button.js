/*-------------------------------------------
	Menu Button
-------------------------------------------*/

Site.modules.MenuButton = (function($, Site) {

	var $Menu;
	var $MenuTrigger;
	var $MenuPanel;
	var $MenuLink;
	var $CurrentTrigger;
	var TriggerOpens;

	function init() {
		$Menu = $(".js-menu");

		if ($Menu.length) {
			$MenuTrigger = $(".js-menu-trigger");
			$LabelTrigger = $(".js-menu-label-trigger");
			$MenuPanel = $(".js-menu-panel");
			$MenuLink = $(".js-menu-link");

			addAccessibility();
			bindUI();
		}
	}

	function bindUI() {
		$MenuTrigger.on("click", onTriggerClick);
		$MenuTrigger.on("keyup", onTriggerKeyup);
		$MenuPanel.on("keyup", onPanelKeyup);
	}

	function addAccessibility() {
		$MenuTrigger.attr("aria-haspopup", "true").attr("aria-expanded", "false");

		Site.modules.Page.ariaHide($MenuPanel);

		$MenuLink.attr("tabindex", "-1");
	}

	function removeAccessibility() {
		$MenuTrigger.removeAttr("aria-haspopup").removeAttr("aria-expanded");

		Site.modules.Page.ariaShow($MenuPanel);

		$MenuLink.removeAttr("tabindex");
	}

	function onTriggerClick() {
		$CurrentTrigger = $(this);
	 	TriggerOpens = $("#" + $(this).data("menu-opens"));

		if ($CurrentTrigger.attr("aria-expanded") == "false") {
			openPopup();
		} else {
			closePopup();
		}
	}

	function onTriggerKeyup(e) {
		if (e.keyCode === 38) { // up
			e.preventDefault();

			if ($(this).attr("aria-expanded") == "false") {
				$(this).trigger("click");
				TriggerOpens.find(".js-menu-link")
					.last()
					.focus();
			}
		}

		if (e.keyCode === 40) { // down
			e.preventDefault();

			if ($(this).attr("aria-expanded") == "false") {
				$(this).trigger("click");
			}
		}
	}

	function onPanelKeyup(e) {
		var $focusedElement = $(":focus");
		var focusedIndex = $focusedElement.closest(".js-menu-item").index();
		var $triggerOpensLink = TriggerOpens.find(".js-menu-link");

		if ([27, 38, 40, 36, 35].indexOf(e.keyCode) > -1) {
			e.preventDefault();
		}

		if (e.keyCode === 27) { // escape
			closePopup();
		}

		if (e.keyCode === 38) { // up
			if (focusedIndex > 0) {
				$triggerOpensLink
					.eq(focusedIndex - 1)
					.focus();
			} else {
				$triggerOpensLink
					.last()
					.focus();
			}
		}

		if (e.keyCode === 40) { // down
			if (!$focusedElement.closest(".js-menu-item").is(":last-of-type")) {
				$triggerOpensLink
					.eq(focusedIndex + 1)
					.focus();
			} else {
				$triggerOpensLink
					.first()
					.focus();
			}
		}

		if (e.keyCode === 36) { // home
			$triggerOpensLink
				.first()
				.focus();
		}

		if (e.keyCode === 35) { // end
			$triggerOpensLink
				.last()
				.focus();
		}
	}

	function openPopup() {
		$CurrentTrigger.attr("aria-expanded", true);

		Site.modules.Page.ariaShow(TriggerOpens);

		TriggerOpens.find(".js-menu-link")
			.removeAttr("tabindex")
			.first()
			.focus();
	}

	function closePopup() {
		$CurrentTrigger.attr("aria-expanded", false).focus();

		Site.modules.Page.ariaHide(TriggerOpens);

		TriggerOpens.find(".js-menu-item")
			.attr("tabindex", "-1");
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
