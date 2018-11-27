/*-------------------------------------------
	Media Gallery
-------------------------------------------*/

Site.modules.MediaGallery = (function($, Site) {

    var $media_gallery = $(".js-media-gallery");

	function init() {
		
		if ($media_gallery.length) {

            var $media_gallery_items = $(".js-media-gallery-items");
            
            $media_gallery_items.slick({
                appendArrows: ".media_gallery_nav",
                prevArrow: ".media_gallery_nav .media_gallery_nav_prev",
                nextArrow: ".media_gallery_nav .media_gallery_nav_next",
                dots: true,
                infinite: false,
                mobileFirst: true,
                slidesToShow: 1,
                customPaging: function(slider, i) {
                    var slideCurrent = "0" + (i + 1);
                    var slideCount = slider.slideCount;
                    if(slideCount < 10) {
                        slideCount = "0" + slider.slideCount;
                    }
                    return '<span class="slideCount">' + slideCurrent + ' / ' + slideCount + '</span>';
                }, 
                responsive: [
                    {
                        breakpoint: 740,
                        settings: {
                            centerMode: true,
                            centerPadding: "0px",
                            slidesToShow: 1.075
                        }
                    }
                ]
            });
            

		}

    }

	Site.onInit.push(init);

	return {};

})(jQuery, Site);