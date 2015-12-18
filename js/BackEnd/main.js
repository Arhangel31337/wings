var articlesAreaWidth = 0;
var asideWidth = 256;
var windowHeight = 0;
var windowWidth = 0;

$(document).ready(function() {
	$('.blockInCenter').blockInCenter();
	
	$('form').formPrepare();
	
	$('aside header .user .select').click(function(e) {
		$('aside header .user').toggleClass('active');
	})
	
	$('nav a').click(function() {
		var ul = $(this).next('ul');
		
		if (ul.length > 0)
		{
			if (ul.css('display') === 'none')
			{
				$('nav ul ul').hide(500);
				ul.show(500);
			}
			else ul.hide(500);
			
			return false;
		}
		else
		{
			
		}
	});
});

$(window).load(function() {
	resize();
});

$(window).resize(function() {
	resize();
});

function resize() {
	windowHeight = $(window).height();
	windowWidth = $(window).width();
	
	articlesAreaWidth = windowWidth - asideWidth;
	
	$('body > section').width(windowWidth);
	$('article.page1').width(articlesAreaWidth);
};