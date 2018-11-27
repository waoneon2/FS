/*-------------------------------------------
	Video Appender
-------------------------------------------*/

Site.modules.VideoAppender = (function($, Site) {

	var $Video = $(".js-video-appender");

	function init() {
		if ($Video.length) {
			bindUI();
		}
	}

	function bindUI() {
		$Video.on("click", function(e) {
			e.preventDefault();
			insertVideo($(this));
		});
	}

	function insertVideo(item) {
		var videoService = $(item).data("video-service");
		var videoId = $(item).data("video-id");

		if (videoService == "youtube") {
			$(item).data("embed", "<iframe class='video_item_iframe js-video-item-iframe js-video-item-youtube' tabindex='-1' src='https://www.youtube.com/embed/" + videoId + "?rel=0&controls=0&showinfo=0&autoplay=1&playsinline=1&enablejsapi=1' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>");
		} else if (videoService == "vimeo") {
			$(item).data("embed", "<iframe class='video_item_iframe js-video-item-iframe js-video-item-vimeo' tabindex='-1' src='https://player.vimeo.com/video/" + videoId + "?api=1&autoplay=1&title=0&byline=0&portrait=0' style='position:absolute;top:0;left:0;width:100%;height:100%;' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><script src='https://player.vimeo.com/api/player.js'></script>");
		}

		$(item).after($(item).data("embed"))
			.attr("tabindex", "-1")
			.siblings(".js-video-item-iframe").focus();
	}

	function videoPlay() {
		$(".js-video-item-youtube").each(function() {
			$(this)[0].contentWindow.postMessage('{"event": "command", "func": "playVideo", "args": ""}', '*');
		});
		$(".js-video-item-vimeo").each(function() {
			$(this)[0].contentWindow.postMessage({
				"method": "play"
			}, $(this)[0].src);
		});
	}

	function videoPause() {
		$(".js-video-item-youtube").each(function() {
			$(this)[0].contentWindow.postMessage('{"event": "command", "func": "pauseVideo", "args": ""}', '*');
		});
		$(".js-video-item-vimeo").each(function() {
			$(this)[0].contentWindow.postMessage({
				"method": "pause"
			}, $(this)[0].src);
		});
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
