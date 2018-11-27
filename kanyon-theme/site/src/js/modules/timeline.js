/*-------------------------------------------
	Timeline
-------------------------------------------*/

Site.modules.Timeline = (function($, Site) {

    var $timeline_content = $(".js-timeline-content");
    
	function init() {
        
        if ($timeline_content.length && $(window).width() >= 740) {
            $timeline_content.checkpoint({
                intersect: "center-top",
                offset: -250
            });
        }

    }

	Site.onInit.push(init);

	return {};

})(jQuery, Site);