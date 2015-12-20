var articlesAreaWidth = 0;
var asideWidth = 256;
var padding = 16;
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
var popup;
var windowHeight = 0;
var windowWidth = 0;

$(document).ready(function() {
	$('.blockInCenter').blockInCenter();
	
	$('form').formPrepare();
	
	popup = $('.popup');
	
	popup.find('section > input').click(function() {
		popup.css('display', 'none');
	});
	
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
			$('nav a').removeClass('active');
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
					
					updatePages(page[0] - 0);
					
					$(this).addClass('active');
				}
			}
		}
		
		return false;
	});
	
	$('article').on('mouseenter', '.menu .icon', function() {
		$(this).addClass('active');
	})
	
	$('article').on('mouseleave', '.menu .icon', function() {
		$(this).removeClass('active');
	})
	
	var path = location.hash.replace('#', '').split('&');
	
	for (var i = 0; i < path.length; i++)
	{
		path[i] = path[i].split(';');
		
		if (path[i].length !== 4) continue;
		
		pages[path[i][0]].model = path[i][1];
		pages[path[i][0]].method = path[i][2];
		
		path[i][3] = path[i][3].split(',');
		
		for (var j = 0; j < path[i][3].length; j++)
		{
			path[i][3][j] = path[i][3][j].split('=');
			pages[path[i][0]].args[path[i][3][j][0]] = path[i][3][j][1];
		}
	}
});

$(window).load(function() {
	resize();
	
	updatePages(0);
});

$(window).resize(function() {
	resize();
});

function pageHide(pageNumber)
{
	for (pageNumber; pageNumber <= pages.length; pageNumber++)
	{
		$('article[page=' + pageNumber + ']').animate({marginLeft : '110%'}, 500);
	}
};

function pageShow(pageNumber)
{
	var sum = pageNumber + 1;
	var unvis = articlesAreaWidth / sum;
	
	for (var i = 0; i < pageNumber; i++)
	{
		$('article[page=' + (i + 1) + ']').animate({marginLeft : asideWidth + (unvis * i)});
	}
	
	for (pageNumber++; pageNumber <= pages.length; pageNumber++) pageHide(pageNumber);
};

function popupShow(content, title, button)
{
	if (title === undefined) title = 'Ошибка';
	if (button === undefined) button = 'Продолжить';
	
	popup.find('section > h3').text(title);
	popup.find('section > article').html(content);
	popup.find('section > input').val(button);
	
	popup.css('display', 'block');
	
	popup.find('.blockInCenter').blockInCenter();
};

function resize()
{
	windowHeight = $(window).height();
	windowWidth = $(window).width();
	
	articlesAreaWidth = windowWidth - asideWidth - padding * 2;
	
	$('body > section').width(windowWidth);
	
	var pageVisible = 0;
	
	for (var i = 0; i < pages.length; i++)
	{
		if ($('body').width() > ($('article[page=' + (i + 1) + ']').css('margin-left').replace('px', '') - 0)) pageVisible++;
	}
	
	var sum = pageVisible + 1;
	var unvis = articlesAreaWidth / pages.length;
	
	for (var i = 0; i < pages.length; i++)
	{
		var page = $('article[page=' + (i + 1) + ']');
		
		page.width(unvis * (pages.length - i));
		if (i < pageVisible) page.css('margin-left', asideWidth + (unvis * i));
	}
};

function updatePages(pageNumber)
{
	if (pageNumber === undefined) pageNumber = 0;
	
	var path = [];
	
	for (var i = 0; i < pages.length; i++)
	{
		if (pages[i].model === '' || pages[i].method === '') continue;
		
		var args = [];
		var j = 0;
		
		for (var key in pages[i].args)
		{
			args[j] = key + '=' + pages[i].args[key];
			j++;
		}
		
		path[i] = i + ';' + pages[i].model + ';' + pages[i].method + ';' + args.join(',');
		
		if (pageNumber !== 0  && pageNumber !== (i + 1)) continue;
		
		pageShow(i + 1);
		
		$('article[page=' + (i + 1) + '] .background').css('display', 'block');
		
		$.ajax({
			url			: '/ru-ru/ajax/' + pages[i].model + '/' + pages[i].method + '/',
			dataType	: "json",
			data		: pages[i].args,
			method		: 'POST',
			pageNumber	: (i + 1),
			success		: function(json)
			{
				if (json.code !== undefined)
				{
					if (json.code === 200)
					{
						var pageNumber = this.pageNumber;
						
						json.data.currentPage = pageNumber;
						
						var page = $('article[page=' + pageNumber + ']');
						var content;
						
						switch(json.data.type)
						{
							case 'form':
								content = new Form(json.data);
								break;
							case 'list':
								content = new Table(json.data);
								break;
						}
						
						page.children('section').html(content.getHTML());
						
						if (pageNumber > 1)
						{
							var backButton = $('<div class="icon back fl-l"><span>Назад</span></div>');
							
							backButton.click(function(e) {
								pageHide(pageNumber);
							});
							
							page.find('.menu').prepend(backButton);
						}
					}
					else
					{
						popupShow('Ошибка соединения с сервером.');
					}
				}
				
				$('article[page=' + pageNumber + '] .background').css('display', 'none');
			},
			error		: function(jqXHR, textStatus, errorThrown)
			{
				popupShow('Ошибка соединения с сервером.');
			}
		});
	}
	
	location = location.origin + location.pathname + '#' + path.join('&');
};
