(function($, settings) {
	"use strict";
	$(document).ready(function() {

		function reset_term(type) {
			if (type == 'non-search') {
				$('select.spotlight_takeover_mini_select').val(0);
				$('select.spotlight_takeover_select').val(0);
			} else if (type == 'non-select') {
				$('input#search_by_keyword').val('');
				$('input#search_by_keyword_mini').val('');
			} else if (type == 'search_close') {
				$('input#search_by_keyword').val('').trigger('input');
				$('input#search_by_keyword_mini').val('').trigger('input');
			}
		}

		function initVideo() {
			if ($("#datafetch .video_item_video, #datafetch .quote_item_video").length) {
				$("#datafetch .video_item_video, #datafetch .quote_item_video").on("click", insertVideo);
				$("#datafetch .media_gallery_close").on("click", removeVideos);
			}
		}
		function insertVideo() {
			var video = $(this).data("url");
			$(this).after('<iframe class="video_item_iframe" src="' + video + '?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
		}
		function removeVideos() {
			$("#datafetch .media_gallery_item").each(function() {
				$(this).find("iframe").remove();
			});
		}

		//Close spotlight
		$(".spotlight_takeover_item_close, .spotlight_item").on("click", function(e) {
			reset_term('tax');
			reset_term('search_close');
		});

		//Filter By Search
		$('body').on('input', 'input#search_by_keyword, input#search_by_keyword_mini', function(e) {
			var st_length 	= $(this).val().length;
			var st_val 		= $(this).val();
			var skey 		= $(this).is('#search_by_keyword');
			var skey_m 		= $(this).is('#search_by_keyword_mini');

			if (st_length >= 3) {
				if (skey) {
					$('input#search_by_keyword_mini').val(st_val);
				}
				if (skey_m) {
					$('input#search_by_keyword').val(st_val);
				}

				reset_term('non-search');
				$('#spotlight_takeover_content_default').hide();
				$('#spotlight_takeover_content_js').show();
			    $.ajax({
			        url: settings.ajaxurl,
			        type: 'post',
	                data: {
	                	action: 'data_fetch',
	                	type: 'search',
	                	keyword: st_val
	                },
	                success: function(data) {
	                    $('#datafetch').html( data );
	                    initVideo();
	                }
			    });
			} else {
		    	$('#spotlight_takeover_content_default').show();
		    	$('#spotlight_takeover_content_js').hide();
		    }
		});

		//Filter By Taxonomy Select
		$('body').on('change', 'select.spotlight_takeover_select, select.spotlight_takeover_mini_select', function(e) {
	       	var st_value 	= $(this).val();
	       	var select 		= $(this).hasClass('spotlight_takeover_select');
	       	var select_m 	= $(this).hasClass('spotlight_takeover_mini_select');

			$(".spotlight_takeover_content").scrollTop(0);
			$(".spotlight_takeover_content_progress").css("width", "0px");

	       	if (select) {
	       		var tax_name    = $('select.spotlight_takeover_select option:selected').data( "taxname" );
	       		$('select.spotlight_takeover_mini_select').val(st_value);
	       	}

	       	if (select_m) {
	       		var tax_name    = $('select.spotlight_takeover_mini_select option:selected').data( "taxname" );
	       		$('select.spotlight_takeover_select').val(st_value);
	       	}

       		reset_term('non-select');

		    if (st_value != 0) {
		        $('#spotlight_takeover_content_default').hide();
		        $('#spotlight_takeover_content_js').show();
		        $.ajax({
		            url: settings.ajaxurl,
		            type: 'post',
		            data: {
		                action: 'data_fetch',
		                type: 'taxonomy',
		                keyword: st_value,
	                 	label: tax_name
		            },
		            success: function(data) {
		                $('#datafetch').html( data );
		                initVideo();
		            }
		        });
		    } else {
		        $('#spotlight_takeover_content_default').show();
		        $('#spotlight_takeover_content_js').hide();
		    }
		});

	});
})(jQuery, search_by_keyword);