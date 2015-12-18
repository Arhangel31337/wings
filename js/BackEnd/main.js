var articlesAreaWidth = 0;
var asideWidth = 256;
var pages =
[
	{
		args	: {},
		method	: '',
		model	: ''
	},
	{
		args	: {},
		method	: '',
		model	: ''
	},
	{
		args	: {},
		method	: '',
		model	: ''
	}
];
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
		}
		else
		{
			var page = $(this).attr('page');
			
			if (page !== undefined)
			{
				page = page.split(';');
				
				if (page.length === 3)
				{
					pages[(page[0] - 1)] =
					{
						method	: page[2],
						model	: page[1]
					};
					
					updatePages(page[0])
				}
			}
		}
		
		return false;
	});
});

$(window).load(function() {
	resize();
});

$(window).resize(function() {
	resize();
});

function resize()
{
	windowHeight = $(window).height();
	windowWidth = $(window).width();
	
	articlesAreaWidth = windowWidth - asideWidth;
	
	$('body > section').width(windowWidth);
	$('article.page1').width(articlesAreaWidth);
};

function updatePages(page)
{
	if (page === undefined) page = 0;
	
	for (var i = 0; i < pages.length; i++)
	{
		if (pages[i].model === '' || pages[i].method === '') continue;
		
		$.ajax({
			url			: '/ru-ru/admin/' + pages[i].model + '/' + pages[i].method + '/',
			dataType	: "json",
			data		: pages[i].args,
			method		: 'POST',
			success		: function(json)
			{
				if (json.code !== undefined)
				{
					if (json.code === 200)
					{
						switch(json.dataType)
						{
							case 'table':
								
								break;
						}
					}
					else
					{
						
					}
				}
				
				$('.background').css('display', 'none');
			},
			error		: function(jqXHR, textStatus, errorThrown)
			{
				
			}
		});
	}
};
