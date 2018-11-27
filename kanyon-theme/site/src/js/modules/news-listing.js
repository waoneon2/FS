/*-------------------------------------------
	News Listing
-------------------------------------------*/

Site.modules.NewsListing = (function($, Site) {

    var $news_listing = $(".js-stories-item");
    
	function init() {
        
        if ($news_listing.length) {
            $news_listing.each(function(){
                applyHover($(this));
            });
        }

    }

    function applyHover(article) {

        article.find(".story_item_image_link, .story_title_link, .story_link").hover(function() {
            article.addClass("hovered");
        }, function() {
            article.removeClass("hovered");
        });
        
    }

	Site.onInit.push(init);

	return {};

})(jQuery, Site);