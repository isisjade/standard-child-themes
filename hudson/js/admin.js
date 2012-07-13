(function($) {

	$(function() {
	
		// Initially hide the format unless this is a Link
		if( 'post-format-link' !== $('#post-formats-select').children(':checked').attr('id') ) { 
			$('#link_format_url').hide();
		} // end if
		
		// If the post format is selected, toggle the visibility
		$('#post-formats-select').children()
			.click(function() {
				'post-format-link' === $(this).attr('id') ? $('#link_format_url').show() : $('#link_format_url').hide();
			});
	
	});

})(jQuery);