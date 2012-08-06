(function ($) {
	"use strict";
	$(function () {

		// Initially hide the link post format unless this is a Link
		if ('post-format-link' !== $('#post-formats-select').children(':checked').attr('id')) {
			$('#link_format_url').hide();
		} // end if

		// Don't repositing the title container unless we're on a quote post format
		if ('post-format-quote' === $('#post-formats-select').children(':checked').attr('id')) {
			$('#titlediv').insertAfter('#postdivrich');
		} // end if

		// Monitor which post format is selected
		$('#post-formats-select').children()
			.click(function () {

				// If the link post format is selected, toggle the visibility
				if ('post-format-link' === $(this).attr('id')) {
					$('#link_format_url').show();
				} else {
					$('#link_format_url').hide();
				} // end if/else

				// If it's the quote post format, then move the title below the content
				if ('post-format-quote' === $(this).attr('id')) {
					$('#titlediv').insertAfter('#postdivrich');
				} else {
					$('#titlediv').insertBefore('#postdivrich');
				} // end if/else

			});

	});

}(jQuery));