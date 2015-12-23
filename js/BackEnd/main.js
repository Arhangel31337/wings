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
					pages[0] =
					{
						args	: {},
						method	: page[2],
						model	: page[1]
					};
					pages[1] =
					{
						args	: {},
						method	: '',
						model	: ''
					};
					pages[2] =
					{
						args	: {},
						method	: '',
						model	: ''
					};
					
					updatePage(page[0] - 1);
					
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
			if (path[i][3][j][0] === undefined || path[i][3][j][0] === '') continue;
			pages[path[i][0]].args[path[i][3][j][0]] = path[i][3][j][1];
		}
	}
});

$(window).load(function() {
	resize();
	
	updatePage(0, true);
});

$(window).resize(function() {
	resize();
});

function locationHashUpdate()
{
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
	}
	
	location = location.origin + location.pathname + '#' + path.join('&');
};

function pageHide(pageNumber, changePage)
{
	if (changePage === undefined) changePage = true;
	
	
	for (pageNumber; pageNumber <= pages.length; pageNumber++)
	{
		var prevPage = $('article[page=' + (pageNumber - 1) + ']');
		var prevMenu =  prevPage.find('.menu');
		prevMenu.find('.icon span').show(500);
		prevMenu.find('.icon.fl-r').first().animate({marginRight : 0}, 500);
		prevPage.find('.selected').removeClass('selected');
		
		$('article[page=' + pageNumber + ']').animate({marginLeft : '110%'}, 500);
		
		if (changePage)
		{
			pages[pageNumber - 1] =
			{
				args	: {},
				method	: '',
				model	: ''
			};
		}
	}
	
	locationHashUpdate();
};

function pageShow(pageNumber)
{
	var sum = pageNumber + 1;
	var unvis = articlesAreaWidth / sum;
	
	for (var i = 0; i < pageNumber; i++)
	{
		var prevMenu = $('article[page=' + i + '] .menu');
		prevMenu.find('.icon span').hide(500);
		prevMenu.find('.icon.fl-r').first().animate({marginRight : $('article[page=' + (i + 1) + ']').outerWidth()}, 500);
		$('article[page=' + (i + 1) + ']').animate({marginLeft : asideWidth + (unvis * i)}, 500);
	}
	
	for (pageNumber++; pageNumber <= pages.length; pageNumber++) pageHide(pageNumber, false);
	
	locationHashUpdate();
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
		if (i < pageVisible)
		{
			$('article[page=' + i + '] .menu .icon.fl-r').first().css('margin-right', page.outerWidth());
			page.css('margin-left', asideWidth + (unvis * i));
		}
	}
};

function updatePage(pageNumber, allPage)
{
	if (allPage === undefined) allPage = false;
	
	if (pages[pageNumber].model === '' || pages[pageNumber].method === '') return;
	
	pageShow(pageNumber + 1);
	
	$('article[page=' + (pageNumber + 1) + '] .background').css('display', 'block');
	
	$.ajax({
		url			: '/ru-ru/ajax/' + pages[pageNumber].model + '/' + pages[pageNumber].method + '/',
		dataType	: "json",
		data		: pages[pageNumber].args,
		method		: 'POST',
		pageNumber	: (pageNumber + 1),
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
					
					if (allPage && pages.length > pageNumber) updatePage(pageNumber);
				}
				else if (json.code === 403)
				{
					popupShow(json.description);
					setTimeout(function() {
						location.reload();
					}, 1000);
				}
				else popupShow(json.description);
			}
			else popupShow('Ошибка соединения с сервером.');
			
			$('article[page=' + pageNumber + '] .background').css('display', 'none');
		},
		error		: function(jqXHR, textStatus, errorThrown)
		{
			popupShow('Ошибка соединения с сервером.');
		}
	});
};
