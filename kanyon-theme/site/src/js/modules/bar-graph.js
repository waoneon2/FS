/*-------------------------------------------
	BarGraph
-------------------------------------------*/

Site.modules.BarGraph = (function($, Site) {

	function init() {
		
		if ($(".js-bar-graph").length) {
			
			$(".js-bar-graph").each(function(){
				var $barGraph = $(this);
				var barGraphFull = $(this).find(".js-bargraph-fullwidth");
				var valueLabel = $barGraph.find(".bar_graph_value_label").text();
				var denominator = $barGraph.find(".bar_graph_denominator").text();

				valueNum = stripValues(valueLabel);
				denominatorNum = stripValues(denominator);
				var barWidth = barGraphFull.width();
				var percent = valueNum / denominatorNum * 100; 

				$(window).on("load", function(){
					applySmall($barGraph, percent, barWidth);
					if ($barGraph[0].getBoundingClientRect().top < $(window).innerHeight() / 1.5){
						applyWidth($barGraph, percent);
					}
				});

				$(window).on("resize", function(){
					applySmall($barGraph, percent, barWidth);
					if ($barGraph[0].getBoundingClientRect().top < $(window).innerHeight() / 1.5){
						applyWidth($barGraph, percent);
					}
				});

				$(window).on("scroll", function(){
					if ($barGraph[0].getBoundingClientRect().top < $(window).innerHeight() / 1.5){
						applyWidth($barGraph, percent);
					}
				});
			});
			
		}

	}

	function stripValues(valueArg) {
		return parseInt(valueArg.replace(/\$|,/g, ""));
	}

	function applyWidth(element, percent) {
		if(percent > 100) {
			element.find(".bar_graph_value").addClass("evaluated").css("width", "100%");
		} else {
			element.find(".bar_graph_value").addClass("evaluated").css("width", percent + "%");
		}
	} 

	function applySmall(element, percent, barWidth) {
		var calculatedWidth = (barWidth * (percent / 100));
		if( calculatedWidth < 190 ) {
			element.find(".bar_graph_value_label").addClass("small_value");
		} else {
			element.find(".bar_graph_value_label").removeClass("small_value");
		}
	}

	Site.onInit.push(init);

	return {};

})(jQuery, Site);