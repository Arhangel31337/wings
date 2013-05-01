$(document).ready(function() {
	if ($('.page_error').length > 0) {
		var bodyHeight = $('body').height();
		var errorHeight = $('.page_error').outerHeight();
		
		var center = (bodyHeight - errorHeight) / 2;
		
		$('.page_error').css('padding-top', center + 'px');
	}
});