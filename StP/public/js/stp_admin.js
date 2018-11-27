jQuery(document).ready(function ($) {
		checkedVal = $("#categorychecklist input[checked='checked']").val();
		var checkedNews = $("#categorychecklist li#category-" + checkedVal + " label").text();
		if (checkedNews.trim() == 'News') {
			setTimeout(function() {
				$('.cfs-tab').removeClass('active');
				$('.cfs-tab[rel="news"]').addClass('active');

				$('.cfs-tab-content').removeClass('active');
				$('.cfs-tab-content.cfs-tab-content-news').addClass('active');

			}, 1000);

		}
});