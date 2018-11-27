/*-------------------------------------------
	Home Pillars
-------------------------------------------*/

Site.modules.HomePillars = (function($, Site) {

    var $homePillars = $(".js-home-pillars"),
        $homePillarNav,
        $homeVideoControl,
        $homePillarContent,
        $pillarSection,
        $pillarTitleLink,
        $pageContent,
        scrollPos,
        opacityRate,
        opacityValue,
        transitioned,
        transitionPoint;

	function init() {
		
		if ($homePillars.length) {
            
            $pillarSection = $(".js-pillar");
            $pillarTitleLink = $(".js-pillar-title-link");
            $homePillarContent = $(".js-pillar-content");
            $homePillarNav = $(".js-home-pillar-nav");
            $homeVideoControl = $(".js-video-play-pause");
            $pageContent = $(".page_content");
            transitioned = false;

            $pillarSection.hover(function() {
                setPillarPosition($(this));
                $pillarSection.removeClass("active");
                $(this).addClass("active");
            });

            $pillarTitleLink.click(function(event) {
                if ($(window).width() < 980) {
                    
                    event.preventDefault();

                    $(".js-pillar").each(function() {
                        if($(this).hasClass("open")) {
                            $(this).find(".home_pillar_inner_content").slideToggle("1500", function(){
                                $(this).parent().removeClass("open");
                            });
                        }
                    });

                    toggleMobilePillar($(this));
                }
            }); 

            $homeVideoControl.click(function(event) {
                event.preventDefault();
                toggleVideo();
            });

            $(window).on("scroll", function() {

                scrollPos = $(window).scrollTop();

                if($(window).width() >= 980) {
                    
                    if(scrollPos <= ($homePillars.outerHeight() * 0.25)) {

                        if($("body").hasClass("full-nav")) {
                            $("body").removeClass("full-nav");
                            toggleVideo();
                        }
    
                    } else {
                       
                        if(!$("body").hasClass("full-nav")) {
                            toggleVideo();
                            $("body").addClass("full-nav");
                        }
                        
                        if(transitioned === false) {
                            transitionPoint = scrollPos;
                            opacityRate = 1 / ($(".home_pillars_logo").outerHeight() + $(".home_pillars_sections").outerHeight() + 100);
                            transitioned = true;
                        }
                        
                        opacityValue = 1 - ((scrollPos - transitionPoint) * opacityRate);
                        $homePillarContent.css('opacity', opacityValue); 
                    }
                }

            });
		}

    }

    function toggleVideo() {
        if( $(".home_pillars_media").hasClass("paused") ){
            $(".home_pillars_media").background("play").removeClass("paused");
            $(".video_pause_label").text("Pause");
            $(".video_pause").removeClass("paused");
        } else {
            $(".home_pillars_media").background("pause").addClass("paused");
            $(".video_pause_label").text("Play");
            $(".video_pause").addClass("paused");
        }
    }
    
    function setPillarPosition(pillar) {
        if ( pillar.hasClass("pillar_section_1") ){
            $homePillars.attr("data-position", "one");
        } else if ( pillar.hasClass("pillar_section_2")) {
            $homePillars.attr("data-position", "two");
        } else if ( pillar.hasClass("pillar_section_3") ) {
            $homePillars.attr("data-position", "three");
        } else {
            $homePillars.attr("data-position", "one");
        }
    }

    function toggleMobilePillar(pillarLink) {
        var pillarParent = pillarLink.closest(".home_pillar_section");
        var pillarContent = pillarParent.find(".home_pillar_inner_content");

        if(!pillarParent.hasClass("open")) {
            pillarContent.slideToggle('1500', function(){
                pillarParent.addClass("open");
            });
        }
    }

	Site.onInit.push(init);

	return {};

})(jQuery, Site);