/*-------------------------------------------
	Module
-------------------------------------------*/

Site.modules.Video = (function($, Site) {

	function init() {
		if ($(".video_item_video, .quote_item_video").length) {
			bindUI();
		}
	}

	function bindUI() {
		$(".video_item_video, .quote_item_video").on("click", insertVideo);

		$(".media_gallery_close").on("click", removeVideos);
	}

	function insertVideo() {
		var video = $(this).data("url");

		if ($(".video_item iframe").length) {
			$(".video_item_iframe").remove();
		}

		$(this).after('<iframe class="video_item_iframe" src="' + video + '?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
	}

	function removeVideos() {
		$(".media_gallery_item").each(function() {
			$(this).find("iframe").remove();
		});
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);
