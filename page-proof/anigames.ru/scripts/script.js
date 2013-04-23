$(document).ready(function() {
	if ((navigator.userAgent.indexOf('Firefox') + 1) || (navigator.userAgent.indexOf('Chrome') + 1)) $('.footer .start a img').css('margin-left', '-90px');
	
	$('img.dinamic').hover(
		function() {
			$(this).attr('src', $(this).attr('srcHover'));
		}, 
		function() {
			$(this).attr('src', $(this).attr('srcOut'));
		}
	);
});