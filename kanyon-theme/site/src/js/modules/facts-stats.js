/*-------------------------------------------
	Facts & Stats
-------------------------------------------*/

Site.modules.FactsStats = (function($, Site) {

    var $facts_stats = $(".js-facts-stats");
    var $facts_stats_display = $(".js-facts-stats-display");
    var $facts_stats_items = $(".js-facts-stats-items");

	function init() {
		
		if ($facts_stats.length) {
            
            $facts_stats_display.slick({
                arrows: false,
                centerMode: true,
                centerPadding: '0px',
                dots: true,
                infinite: false,
                mobileFirst: true,
                slidesToShow: 1,
                responsive: [
                    {
                        breakpoint: 740,
                        settings: {
                            centerMode: false,
                            dots: false,
                            draggable: false,
                            fade: true,
                            infinite: true,
                            swipe: false
                        }
                    }
                ]      
            });

            $facts_stats_items.slick({
                asNavFor: '.js-facts-stats-display',
                appendArrows: '.facts_stats_nav',
                prevArrow: '.facts_stats_nav .nav_prev',
                nextArrow: '.facts_stats_nav .nav_next',
                dots: true,
                mobileFirst: true,
                slidesToShow: 1,
                responsive: [
                    {
                        breakpoint: 740,
                        settings: {
                            dots: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 1220,
                        settings: {
                            dots: false,
                            slidesToShow: 3
                        }
                    }
                ]
            });

		}

    }

	Site.onInit.push(init);

	return {};

})(jQuery, Site);