// JQS: javascript Query Search
const JQS = (function(a) {
    if (a == "") return {};
    var b = {};
    for (var i = 0; i < a.length; ++i)
    {
        var p=a[i].split('=', 2);
        if (p.length == 1)
            b[p[0]] = "";
        else
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }
    return b;
})(window.location.search.substr(1).split('&'));

function resetSearchFooter() {
   jQuery("#tric_nav_bar_search .site_search_input").val('');
}
/*-------------------------------------------
	search page functionality
-------------------------------------------*/
if (window.location.pathname == '/' && typeof JQS['s'] != 'undefined') {
	// console.log('debug: search-page');
	(function() {
		var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
		var element = document.querySelector('.trinity-google-custom-search');
		if (element) {
			var observer = new MutationObserver(function (mutations) {
				mutations.forEach(function (mutation) {
					if (mutation.addedNodes.length) {
						var input = document.querySelector('input.gsc-input');
						if (input) {
							var value = typeof JQS['s'] != 'undefined' ? JQS['s'] : '';
							google.search.cse.element.getElement('storesearch').prefillQuery(value);
							google.search.cse.element.getElement('storesearch').execute();
						}
					}
				});
			});
		}

		observer.observe(element, {
			attributes: true,
			childList: true
		});
	})();
}
/*-------------------------------------------
	new filter function
-------------------------------------------*/
if (window.location.pathname.indexOf('news') > -1) {
	// console.log('debug: news-page');
	(function($) {
		var query = {
		    // fcat: JQS['fcat'] ? JQS['fcat'] : '',
		    // fsearch: JQS['fsearch'] ? JQS['fsearch'] : ''
		    fcat: '',
		    fsearch: ''
		};
		var settingQuery = function(queryName, value) {
			query[queryName] = typeof value === 'undefined' ? '' : value;
			return query;
		}

		var input 		= document.getElementById('search_by_keyword');
		if (input) {
			input.addEventListener('keypress', function(e) {
			    if (e.key === 'Enter') {
					e.preventDefault();
					e.stopPropagation();
			      	window.location.href = location.protocol + '//' + window.location.hostname + '/news/' + '?' + $.param(settingQuery('fsearch', input.value));
			    }
			});
		}

		var input_click = document.getElementsByClassName('filter_search_input_submit')[0];
		if (input_click) {
			input_click.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
		      	window.location.href = location.protocol + '//' + window.location.hostname + '/news/'+ '?' + $.param(settingQuery('fsearch', input.value));
			});
		}

		var categs = document.getElementsByClassName('news-filter-option');
		if (categs) {
			for (var i = categs.length - 1; i >= 0; i--) {
				categs[i].addEventListener('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					window.location.href = location.protocol + '//' + window.location.hostname + '/news/'+ '?' + $.param(settingQuery('fcat', e.target.dataset.filterOptionValue));
				});
			}
		}
	})(jQuery);
}
Site.modules.CustomAlert = (function($, Site) {

	var $alert;
	var $alertClose;
	var $alertTime;
	var cookieName;

	function init() {
		$alert = $(".alert");
		$alertClose = $(".alert_close");
		$alertTime = $alert.data("time");
		cookieName = "alert-cookie";
		var alert = sessionStorage.getItem("tric-alert");

		if (alert == 'close') {
			hideAlert();
		} else {
			showAlert();
		}

		resizeAlert();
		bindUI();
	}

	function bindUI() {
		$alertClose.on("click", function() {
			setCookie();
			sessionStorage.setItem("tric-alert", "close");
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

	function alertResizeTest() {
		if ($alert.hasClass("admin_alert")) {
			adminAlertResize();
		} else {
			standardAlertResize();
		}
	}

	function setCookie() {
		$.cookie(cookieName, $alertTime);
	}

	function showAlert() {
		$alert.addClass("show_alert");

		alertResizeTest();
	}

	function hideAlert() {
		$alert.removeClass("show_alert");

		alertResetSize();
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

	Site.onInit.push(init);

	return {};
})(jQuery, Site);
