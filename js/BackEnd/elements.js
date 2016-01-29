function extend(Child, Parent)
{
	var F = function() { };
	
	F.prototype = Parent.prototype;
	
	Child.prototype = new F();
	Child.prototype.constructor = Child;
	Child.superclass = Parent.prototype;
};

function Element(data)
{
	this.html;
	
	this.columns = data.columns;
	this.colTurn = {};
	this.currentPage = data.currentPage
	this.item = data.item;
	this.items = data.items;
	this.name = data.name;
	this.turnCol = [];
	
	for (var key in data.columns)
	{
		this.colTurn[key] = data.columns[key].turn - 1;
		this.turnCol[data.columns[key].turn - 1] = key;
	}
};

Element.prototype.getHTML = function()
{
	var el = this;
	
	this.createHTML();
	
	this.html.find('input[type=checkbox]').each(function(i) {
		var el = $(this);
		if (el.hasClass('switch')) el.wrap('<span class="switch" />');
		else el.wrap('<span class="checkbox" />');
		
		if (el.prop('checked')) el.parent().addClass('checked');
	});
	
	this.html.find('input.multiselect').click(function(e) {
		console.log(el.item[$(this).attr('name')]);
	});
	
	return this.html;
};

function Form(data)
{
	Form.superclass.constructor.call(this, data);
};

extend(Form, Element);

Form.prototype.createHTML = function()
{
	var form = this;
	
	if (form.item === undefined)
	{
		var html = $(
			'<h2>' + form.name + '</h2>' +
			'<div class="menu">' +
				'<div class="icon create fl-r"><span>Создать</span></div>' +
				'<div class="cl-b"></div>' +
			'</div>' +
			'<form></form>'
		);
	}
	else
	{
		var html = $(
			'<h2>' + form.name + '</h2>' +
			'<div class="menu">' +
				'<div class="icon remove fl-r"><span>Удалить</span></div>' +
				'<div class="icon save fl-r"><span>Сохранить</span></div>' +
				'<div class="cl-b"></div>' +
			'</div>' +
			'<form></form>'
		);
	}
	
	var formEl = $(html[2]);
	
	for (var i = 0; i < form.turnCol.length; i++)
	{
		var column = form.columns[form.turnCol[i]];
		var input;
		
		if (column.generated !== undefined && column.generated === true && form.item === undefined) continue;
		
		var value = '';
		
		if (form.item !== undefined) value = form.item[form.turnCol[i]];
		
		switch(column.field)
		{
			case 'label':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" type="hidden" value="' + value + '" />');
				break;
			case 'multiselect':
				var label = [];
				value = [];
				
				for (var j = 0; j < form.item[form.turnCol[i]].length; j++)
				{
					if (!form.item[form.turnCol[i]][j].selected) continue;
					
					label[j] = form.item[form.turnCol[i]][j].name;
					value[j] = form.item[form.turnCol[i]][j].id;
				}
				
				input = $('<input class="multiselect" disabled ids="' + value.join(',') + '" key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="' + label.join(', ') + '" />');
				break;
			case 'password':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" type="password" value="" />');
				break;
			case 'string':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="' + value + '" />');
				break;
			case 'switch':
				input = $('<label><input class="switch" id="label_' + form.turnCol[i] + '" key="' + i + '" name="' + form.turnCol[i] + '" type="checkbox" value="' + value + '" />' + column.name + '</label>');
				if (value == 1) input.children().prop('checked', true);
				break;
		}
		
		if (column.validate !== undefined) input.attr('validate', column.validate.join(','));
		
		formEl.append(input);
	}
	
	html.find('input').prepareInput();
	
	html.on('click', '.checkbox,.switch', function(e) {
		var el = $(this).children('input');
		(el.prop('checked')) ? el.prop('checked', false) : el.prop('checked', true);
		$(this).toggleClass('checked');
	});
	
	html.find('.icon.create').click(function(e) {
		if (!formEl.checkForm()) return;
		
		var page = pages[form.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/' + page.method + '/';
		
		var args = {};
		
		formEl.find('input, select, textarea').each(function(i) {
			args[$(this).attr('name')] = $(this).val();
		});
		
		ajax(path, args, function(json) {
			pageHide(form.currentPage);
			updatePage(form.currentPage - 2);
		});
	});
	
	html.find('.icon.save').click(function(e) {
		if (!formEl.checkForm()) return;
		
		var page = pages[form.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/' + page.method + '/';
		
		var args = {};
		
		formEl.find('input, select, textarea').each(function(i) {
			args[$(this).attr('name')] = $(this).val();
		});
		
		ajax(path, args, function(json) {
			pageHide(form.currentPage);
			updatePage(form.currentPage - 2);
		});
	});
	
	html.find('.icon.remove').click(function(e) {
		if (!formEl.checkForm()) return;
		
		var page = pages[form.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/remove/';
		
		var args = {'ids' : []};
		
		formEl.find('input, select, textarea').each(function(i) {
			if ($(this).attr('name') === 'id') args['ids'][0] = $(this).val();
		});
		
		ajax(path, args, function(json) {
			pageHide(form.currentPage);
			updatePage(form.currentPage - 2);
		});
	});
	
	this.html = html;
};

function Table(data)
{
	Table.superclass.constructor.call(this, data);
};

extend(Table, Element);

Table.prototype.createHTML = function()
{
	var table = this;
	
	var html = $(
		'<h2>' + table.name + '</h2>' +
		'<div class="menu">' +
			'<div class="icon filter fl-l"><span>Фильтр</span></div>' +
			'<div class="icon remove fl-r"><span>Удалить</span></div>' +
			'<div class="icon add fl-r"><span>Добавить</span></div>' +
			'<div class="cl-b"></div>' +
		'</div>' +
		'<div class="filters"></div>' +
		'<table><thead></thead><tbody></tbody></table>'
	);
	
	var filters = $(html[2]);
	var ths = $('<tr></tr>');
	
	for (var i = 0; i < table.turnCol.length; i++)
	{
		var column = table.columns[table.turnCol[i]];
		var input = $('<div></div>');
		
		switch(column.field)
		{
			case 'label':
			case 'string':
				input.append('<input key="' + i + '" name="' + table.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="" />');
				break;
		}
		
		filters.append(input);
	}
	
	var input = $('<div><input class="fl-r" name="search" type="button" value="Поиск" /></div>');
	
	filters.append(input);
	
	ths.append($('<th><input type="checkbox" name="trAll" /></th>').width(24));
	
	for (var i = 0; i < table.turnCol.length; i++)
	{
		if (table.columns[table.turnCol[i]].isFormF) continue;
		
		var th = $('<th key="' + i + '">' + table.columns[table.turnCol[i]].name + '</th>');
		
		if (table.columns[table.turnCol[i]].style !== undefined &&
			table.columns[table.turnCol[i]].style.align !== undefined) th.css('text-align', table.columns[table.turnCol[i]].style.align);
		
		ths.append(th);
	}
	
	for (var j = 0; j < table.items.length; j++)
	{
		var tds = $('<tr key="' + table.items[j].id + '"></tr>');
		
		var td = $('<td><input type="checkbox" name="tr' + j + '" /></td>');
		tds.append(td);
		
		for (var i = 0; i < table.turnCol.length; i++)
		{
			if (table.columns[table.turnCol[i]].isFormF) continue;
			
			var value = table.items[j][table.turnCol[i]];
			
			if (table.columns[table.turnCol[i]].field === 'checkbox' ||
				table.columns[table.turnCol[i]].field === 'switch') value = (value == 1) ? 'Да' : 'Нет';
			
			var td = $('<td key="' + i + '">' + value + '</td>');
		
			if (table.columns[table.turnCol[i]].style !== undefined &&
				table.columns[table.turnCol[i]].style.align !== undefined) td.css('text-align', table.columns[table.turnCol[i]].style.align);
			
			tds.append(td);
		}
		
		html.children('tbody').append(tds);
	}
	
	html.children('thead').append(ths);
	
	html.find('.icon.filter').click(function(e) {
		if (filters.css('display') === 'none') filters.show(500);
		else filters.hide(500);
	});
	
	$(html[1]).find('.icon.add').click(function() {
		pages[table.currentPage] =
		{
			method	: 'add',
			model	: pages[table.currentPage - 1].model
		};
		
		html.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) $(this).parent().click();
		});
		
		html.find('.selected').removeClass('selected');
		
		updatePage(table.currentPage)
	});
	
	$(html[1]).find('.icon.remove').click(function() {
		var args = {'ids' : []};
		
		html.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) args.ids[args.ids.length] = $(this).closest('tr').attr('key');
		});
		
		html.find('.selected').removeClass('selected');
		
		var page = pages[table.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/remove/';
		
		ajax(path, args, function(json) {
			updatePage(table.currentPage - 1);
		});
	});
	
	input.click(function(e) {
		var trs = html.find('tbody tr');
		var haveOne = false;
		
		html.find('thead span.up, thead span.down').remove();
		
		trs.css('display', 'none');
		
		filters.find('input[type=text]').each(function(i) {
			var filter = $(this);
			
			if (filter.val() === '') return;
			
			haveOne = true;
			
			var key = filter.attr('key');
			var search = new RegExp('.*' + filter.val() + '.*', 'i');
			
			trs.each(function(j) {
				var tr = $(this);
				
				if (search.test(tr.find('td[key=' + key + ']').text())) tr.css('display', 'table-row');
			});
		})
		
		if (!haveOne) trs.css('display', 'table-row');
	});
	
	html.find('thead th').not(':first-child').click(function(e) {
		var th = $(this);
		var sortDown = th.children('span').hasClass('down');
		
		html.find('thead span.up, thead span.down').remove();
		
		if (sortDown) th.prepend('<span class="icon up"></span>');
		else th.prepend('<span class="icon down"></span>');
		
		var key = th.attr('key');
		var trs = html.find('tbody tr');
		
		trs.sort(function(a, b) {
			var sort = 0;
			
			a = $(a).find('td[key=' + key + ']').text();
			b = $(b).find('td[key=' + key + ']').text();
			
			if (a > b) sort = 1;
			if (a < b) sort = -1;
			
			if (sortDown) sort *= -1;
			
			return sort;
		});
		
		html.find('tbody').html(trs);
	});
	
	html.find('tbody').on('click', 'tr', function(e) {
		if ($(e.target).hasClass('checkbox')) return;
		
		var tr = $(this);
		
		html.find('tr').removeClass('selected');
		
		html.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) $(this).parent().click();
		});
		
		if (!tr.hasClass('selected')) tr.addClass('selected');
		
		pages[table.currentPage] =
		{
			args	: {id : tr.attr('key')},
			method	: 'item',
			model	: pages[table.currentPage - 1].model
		};
		
		updatePage(table.currentPage)
	});
	
	html.find('thead').on('click', '.checkbox', function(e) {
		var checked = $(this).children('input').prop('checked');
		
		html.find('tbody .checkbox input').each(function(i) {
			var input = $(this).parent();
			if ($(this).prop('checked') === checked) $(this).parent().click();
		});
	});
	
	html.find('tbody').on('click', '.checkbox', function(e) {
		var el = $(this).children('input');
		(el.prop('checked')) ? el.prop('checked', false) : el.prop('checked', true);
		el.change();
		$(this).toggleClass('checked');
	});
	
	html.find('tbody').on('change', '.checkbox input', function(e) {
		var el = $(this);
		
		el.closest('tr').toggleClass('checked');
		
		var allChecked = true
		
		html.find('tbody .checkbox input').each(function() {
			if (!$(this).prop('checked')) allChecked = false;
		});
		
		if (allChecked)
		{
			html.find('thead .checkbox').addClass('checked');
			html.find('thead .checkbox input').prop('checked', true);
		}
		else
		{
			html.find('thead .checkbox').removeClass('checked');
			html.find('thead .checkbox input').prop('checked', false);
		}
		
		html.find('tr').removeClass('selected');
	});
	
	table.html = html;
};