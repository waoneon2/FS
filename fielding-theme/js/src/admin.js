(function($) {

	$(document).ready(function() {

		// Moves main content to ACF block

		var $editor             = $("#postdivrich"),
			$pageContent        = $(".acf-field-56a79bbc6ddd2"),
			$newsContent        = $(".acf-field-56b0e422b869f");

		if ( $editor.length ) {
			if ( $pageContent.length ) {
				$editor.show().appendTo( $pageContent.find(".acf-input") );
			}

			if ( $newsContent.length ) {
				$editor.show().appendTo( $newsContent.find(".acf-input") );
			}
		}

		// Adds read only field support

		var $readOnlyFields = $(".field_readonly");

		if ( $readOnlyFields.length ) {
			$readOnlyFields.find("input, textarea, select").prop("readonly", true);
		}

		// Sync Services

/*
		var $syncOutput = $("#sync-output"),
			syncAction  = $syncOutput.data("action");

		if ( $syncOutput.length ) {
			$.ajax({
				url: ajaxurl,
				data: {
					action: syncAction,
				},
				success: function() {
					$syncOutput.html("Complete!");
				}
			});
		}
*/
	});

})(jQuery);