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
	this.delegate = pages[this.currentPage - 1].delegate;
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
		if (el.hasClass('switch'))
		{
			el.wrap('<span class="switch" />');
			
			el.click(function(e) {
				if (this.tagName == 'INPUT') var el = $(this);
				else var el = $(this).find('input');
				
				console.log(el);
				$(this).parent('span').toggleClass('checked');
				
				e.stopPropagation();
			});
		}
		else el.wrap('<span class="checkbox" />');
		
		if (el.prop('checked')) el.parent().addClass('checked');
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
	
	for (var i in form.turnCol)
	{
		var column = form.columns[form.turnCol[i]];
		var input;
		
		if (column.generated !== undefined && column.generated === true && form.item === undefined) continue;
		if (column.isNFormF !== undefined && column.isNFormF == true)
		{
			if (form.item === undefined) continue;
			
			input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" type="hidden" value="' + form.item[form.turnCol[i]] + '" />');
			
			formEl.append(input);
			
			continue;
		}
		
		var value = '';
		
		if (form.item !== undefined) value = form.item[form.turnCol[i]];
		
		switch(column.field)
		{
			case 'datetime':
				input = $('<span class="datetime" key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" value="' + value + '">' + value + '</span>');
				break;
			case 'label':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" type="hidden" value="' + value + '" />');
				break;
			case 'multiselect':
				var labelSelected = [];
				var valueSelected = [];
				
				if (form.item !== undefined)
				{
					for (var j = 0; j < form.item[form.turnCol[i]].length; j++)
					{
						if (!form.item[form.turnCol[i]][j].selected) continue;
						
						labelSelected.push(form.item[form.turnCol[i]][j].name);
						valueSelected.push(form.item[form.turnCol[i]][j].id);
					}
				}
				
				if (valueSelected.length == 0) labelSelected.push('Не выбрано');
				
				input = $(
					'<span class="multiselect" key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' +
					column.name +'" value="' + valueSelected.join(',') + '">' + labelSelected.join(', ') + '</span>'
				);
				break;
			case 'password':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" type="password" value="" />');
				break;
			case 'select':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="' + value + '" />');
				break;
			case 'string':
				input = $('<input key="' + i + '" name="' + form.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="' + value + '" />');
				break;
			case 'switch':
				input = $('<input class="switch" id="label_' + form.turnCol[i] + '" key="' + i + '" name="' + form.turnCol[i] + '"' +
							'type="checkbox" columnName="' + column.name + '" value="' + value + '" />');
				if (value == 1) input.prop('checked', true);
				break;
		}
		
		if (column.validate !== undefined) input.attr('validate', column.validate.join(','));
		
		formEl.append(input);
	}
	
	formEl.find('input[type!=hidden]').prepareInput();
	formEl.find('span').prepareSpan();
	
	html.find('.icon.create').click(function(e) {
		if (!formEl.checkForm()) return;
		
		var page = pages[form.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/' + page.method + '/';
		
		var args = {};
		
		formEl.find('input, select, textarea').each(function(i) {
			if ($(this).attr('type') == 'checkbox')
			{
				if ($(this).prop('checked')) args[$(this).attr('name')] = true;
			}
			else args[$(this).attr('name')] = $(this).val();
		});
		
		formEl.find('span.multiselect').each(function(i) {
			args[$(this).attr('name')] = $(this).attr('value').split(',');
		});
		
		ajax(path, args, function(json) {
			pageHide(form.currentPage);
			updatePage(form.currentPage - 2);
		});
	});
	
	html.find('.icon.save').click(function(e) {
		if (!formEl.checkForm()) return;
		
		var page = pages[form.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/change/';
		
		var args = {};
		
		formEl.find('input, select, textarea').each(function(i) {
			if ($(this).attr('type') == 'checkbox')
			{
				if ($(this).prop('checked')) args[$(this).attr('name')] = true;
			}
			else args[$(this).attr('name')] = $(this).val();
		});
		
		formEl.find('span.multiselect').each(function(i) {
			if ($(this).attr('value') == '') args[$(this).attr('name')] = null;
			else args[$(this).attr('name')] = $(this).attr('value').split(',');
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
	
	html.find('.multiselect').click(function(e) {
		var model = $(this).attr('name');
		
		pages[form.currentPage] =
		{
			args		: {},
			method		: 'list',
			model		: model,
			delegate	: $(this)
		};
		
		updatePage(form.currentPage)
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
			'<div class="cl-b"></div>' +
		'</div>' +
		'<div class="filters"></div>' +
		'<table><thead></thead><tbody></tbody></table>'
	);
	
	if (table.delegate === null)
	{
		$(html[1]).prepend(
			'<div class="icon filter fl-l"><span>Фильтр</span></div>' +
			'<div class="icon remove fl-r"><span>Удалить</span></div>' +
			'<div class="icon add fl-r"><span>Добавить</span></div>'
		);
	}
	
	var filters = $(html[2]);
	var tableData = $(html[3]);
	var ths = $('<tr></tr>');
	
	for (var i = 0; i < table.turnCol.length; i++)
	{
		if (table.columns[table.turnCol[i]].isFormF) continue;
		
		var column = table.columns[table.turnCol[i]];
		
		switch(column.field)
		{
			case 'datetime':
				input = $('<span class="datetime fromTo" key="' + i + '" name="' + table.turnCol[i] + '" placeholder="' + column.name + '" value="">Не выбрано</span>');
				break;
			case 'label':
			case 'string':
				input = $('<input key="' + i + '" name="' + table.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="" />');
				break;
			case 'switch':
				input = $('<input key="' + i + '" name="' + table.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="" />');
				input = $('<input class="switch" id="label_' + table.turnCol[i] + '" key="' + i + '" name="' + table.turnCol[i] + '"' +
						'type="checkbox" columnName="' + column.name + '" value="" checked="checked" />');
				break;
		}
		
		filters.append(input);
	}
	
	filters.find('input').prepareInput(true);
	filters.find('span').prepareSpan(true);
	
	filters.append(
		'<div class="input cl-b" style="margin-top: 20px;">' +
			'<input class="fl-l" name="clear" type="button" value="Очистить" style="margin-right: 24px;" />' +
			'<input class="fl-l" name="search" type="button" value="Поиск" />' +
		'</div>'
	);
	
	filters.append('<div class="cl-b"></div>');
	
	if (table.delegate !== null) ths.append($('<th></th>').width(24));
	else ths.append($('<th><input type="checkbox" name="trAll" /></th>').width(24));
	
	for (var i = 0; i < table.turnCol.length; i++)
	{
		if (table.columns[table.turnCol[i]].isFormF) continue;
		
		var th = $('<th key="' + i + '">' + table.columns[table.turnCol[i]].name + '</th>');
		
		if (table.turnCol[i] == 'id') th.css('width', '50px');
		
		if (table.columns[table.turnCol[i]].style !== undefined &&
			table.columns[table.turnCol[i]].style.align !== undefined) th.css('text-align', table.columns[table.turnCol[i]].style.align);
		
		ths.append(th);
	}
	
	for (var j = 0; j < table.items.length; j++)
	{
		var tds = $('<tr key="' + table.items[j].id + '"></tr>');
		
		var td = $('<td><input type="checkbox" name="tr' + j + '" itemName="' + table.items[j].name + '" itemValue="' + table.items[j].id + '" /></td>');
		
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
		
		tableData.children('tbody').append(tds);
	}
	
	tableData.children('thead').append(ths);
	
	filters.on('click', '.checkbox', function(e) {
		var el = $(this).children('input');
		
		(el.prop('checked')) ? el.prop('checked', false) : el.prop('checked', true);
		
		$(this).toggleClass('checked');
	});
	
	filters.find('input[name=clear]').click(function(e) {
		filters.find('input.filterCheck').each(function() {
			var el = $(this);
			
			if (el.prop('checked'))
			{
				el.prop('checked', false);
				el.parent().toggleClass('checked');
				
				if (el.parent().next()[0].tagName == 'INPUT') el.parent().prev().animateNew({opacity : 0});
			}
		});
		
		filters.find('input[type!=button]').val('');
		filters.find('span.datetime').attr('value', '').text('Не выбрано');
		
		filters.find('input.switch').each(function() {
			var el = $(this);
			
			if (!el.prop('checked')) el.click();
		});
	});
	
	filters.find('input[name=search]').click(function(e) {
		var trs = tableData.find('tbody tr');
		
		var filterArray = [];
		
		filters.find('div.input').each(function(i) {
			var el = $(this);
			
			if (!el.find('.filterCheck').prop('checked')) return;
			console.log(el);
			if (el.hasClass('fromTo'))
			{
				var fromVal = false;
				var toVal = false;
				
				if (el.find('span.from').attr('value') != '') fromVal = new Date(el.find('span.from').attr('value'));
				if (el.find('span.to').attr('value') != '') toVal = new Date(el.find('span.to').attr('value'));
				
				if (!fromVal && !toVal) return;
				
				filterArray[el.attr('key')] =
				{
					type	: 'datetime',
					value	:
					{
						from	: fromVal,
						to		: toVal
					}
				};
			}
			else if (el.find('input.switch').length > 0)
			{
				el = el.find('input.switch')
				
				filterArray[el.attr('key')] =
				{
					type	: 'string',
					value	: (el.prop('checked') ? 'Да' : 'Нет')
				};
			}
			else
			{
				el = el.find('input[type=text]')
				
				filterArray[el.attr('key')] =
				{
					type	: 'string',
					value	: el.val()
				};
			}
		});
		
		if (filterArray.length == 0)
		{
			trs.css('display', 'table-row');
			return;
		}
		
		tableData.find('thead span.up, thead span.down').remove();
		
		trs.css('display', 'none');
		
		trs.each(function() {
			var tr = $(this);
			
			var notFindAll = false;
			
			for (var key in filterArray)
			{
				switch(filterArray[key].type)
				{
					case 'datetime':
						var tdDate = new Date(tr.find('td[key=' + key + ']').text());
						
						if (filterArray[key].value.from !== false && filterArray[key].value.from > tdDate) notFindAll = true;
						if (filterArray[key].value.to !== false && filterArray[key].value.to < tdDate) notFindAll = true;
						
						break;
					case 'string':
						var search = new RegExp('.*' + filterArray[key].value + '.*', 'i');
						
						if (filterArray[key].value == '')
						{
							if (tr.find('td[key=' + key + ']').text() != '') notFindAll = true;
						}
						else if (!search.test(tr.find('td[key=' + key + ']').text())) notFindAll = true;
						
						break;
				}
			}
			
			if (!notFindAll) tr.css('display', 'table-row');
		});
	});
	
	html.find('.icon.filter').click(function(e) {
		if (filters.css('display') === 'none') filters.stop(true, true).animate({height : 'toggle'});
		else filters.stop(true, true).animate({height : 'toggle'});
	});
	
	$(html[1]).find('.icon.add').click(function() {
		pages[table.currentPage] =
		{
			args		: {},
			method		: 'add',
			model		: pages[table.currentPage - 1].model,
			delegate	: null
		};
		
		tableData.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) $(this).parent().click();
		});
		
		tableData.find('.selected').removeClass('selected');
		
		updatePage(table.currentPage)
	});
	
	$(html[1]).find('.icon.remove').click(function() {
		var args = {'ids' : []};
		
		tableData.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) args.ids[args.ids.length] = $(this).closest('tr').attr('key');
		});
		
		tableData.find('.selected').removeClass('selected');
		
		var page = pages[table.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/remove/';
		
		ajax(path, args, function(json) {
			updatePage(table.currentPage - 1);
		});
	});
	
	tableData.find('thead th').not(':first-child').click(function(e) {
		var th = $(this);
		var sortDown = th.children('span').hasClass('down');
		
		tableData.find('thead span.up, thead span.down').remove();
		
		if (sortDown) th.prepend('<span class="icon up"></span>');
		else th.prepend('<span class="icon down"></span>');
		
		var iconWidth = th.find('span.icon').css('width').replace('px', '');
		
		if (th.css('text-align') != 'left') th.find('span.icon').css('margin-left', ((th.outerWidth() - iconWidth) / 2) + 'px');
		else th.find('span.icon').css('margin-left', (th.outerWidth() - iconWidth * 2) + 'px');
		
		var key = th.attr('key');
		var trs = tableData.find('tbody tr');
		
		trs.sort(function(a, b) {
			var sort = 0;
			
			a = $(a).find('td[key=' + key + ']').text();
			b = $(b).find('td[key=' + key + ']').text();
			
			if (a > b) sort = 1;
			if (a < b) sort = -1;
			
			if (sortDown) sort *= -1;
			
			return sort;
		});
		
		tableData.find('tbody').html(trs);
	});
	
	if (table.delegate === null)
	{
		tableData.find('tbody').on('click', 'tr', function(e) {
			if ($(e.target).hasClass('checkbox')) return;
			
			var tr = $(this);
			
			tableData.find('tr').removeClass('selected');
			
			$(html[3]).find('.checkbox input').each(function(i) {
				if ($(this).prop('checked')) $(this).parent().click();
			});
			
			if (!tr.hasClass('selected')) tr.addClass('selected');
			
			pages[table.currentPage] =
			{
				args		: {id : tr.attr('key')},
				method		: 'item',
				model		: pages[table.currentPage - 1].model,
				delegate	: null
			};
			
			updatePage(table.currentPage)
		});
	}
	
	tableData.find('thead').on('click', '.checkbox', function(e) {
		var checked = $(this).children('input').prop('checked');
		
		tableData.find('tbody .checkbox input').each(function(i) {
			var input = $(this).parent();
			if ($(this).prop('checked') === checked) $(this).parent().click();
		});
	});
	
	tableData.find('tbody').on('click', '.checkbox', function(e) {
		var el = $(this).children('input');
		(el.prop('checked')) ? el.prop('checked', false) : el.prop('checked', true);
		el.change();
		$(this).toggleClass('checked');
	});
	
	tableData.find('tbody').on('change', '.checkbox input', function(e) {
		var el = $(this);
		
		el.closest('tr').toggleClass('checked');
		
		var itemNames = [];
		var itemValues = [];
		var allChecked = true
		
		tableData.find('tbody .checkbox input').each(function() {
			if (!$(this).prop('checked')) allChecked = false;
			else
			{
				itemNames.push($(this).attr('itemName'));
				itemValues.push($(this).attr('itemValue'));
			}
		});
		
		if (itemNames.length == 0) itemNames.push('Не выбрано');
		
		if (table.delegate !== null) table.delegate.text(itemNames.join(', ')).attr('value', itemValues.join(','));
		
		if (allChecked)
		{
			tableData.find('thead .checkbox').addClass('checked');
			tableData.find('thead .checkbox input').prop('checked', true);
		}
		else
		{
			tableData.find('thead .checkbox').removeClass('checked');
			tableData.find('thead .checkbox input').prop('checked', false);
		}
		
		tableData.find('tr').removeClass('selected');
	});
	
	if (table.delegate !== null)
	{
		var values = table.delegate.attr('value');
		
		if (values !== '')
		{
			values = values.split(',');
			
			for (var i = 0; i < values.length; i++) tableData.find('tbody tr[key=' + values[i] + '] input').prop('checked', true);
		}
	}
	
	table.html = html;
};

function Tree(data)
{
	Tree.superclass.constructor.call(this, data);
};

extend(Tree, Element);

Tree.prototype.createHTML = function()
{
	var tree = this;
	
	var html = $(
		'<h2>' + tree.name + '</h2>' +
		'<div class="menu">' +
			'<div class="icon filter fl-l"><span>Фильтр</span></div>' +
			'<div class="icon remove fl-r"><span>Удалить</span></div>' +
			'<div class="icon add fl-r"><span>Добавить</span></div>' +
			'<div class="cl-b"></div>' +
		'</div>' +
		'<div class="filters"></div>' +
		'<ul class="tree"></ul>'
	);
	
	var filters = $(html[2]);
	
	for (var i = 0; i < tree.turnCol.length; i++)
	{
		if (tree.turnCol[i] !== 'name') continue;
		
		var column = tree.columns[tree.turnCol[i]];
		var input = $('<div></div>');
		
		switch(column.field)
		{
			case 'label':
			case 'string':
				input.append('<input key="' + i + '" name="' + tree.turnCol[i] + '" placeholder="' + column.name + '" type="text" value="" />');
				break;
		}
		
		filters.append(input);
	}
	
	var input = $('<div><input class="fl-r" name="search" type="button" value="Поиск" /></div>');
	
	filters.append(input);
	
	this.createNode($(html[3]), tree.items, 1);
	
	$(html[3]).find('a.arrow').click(function() {
		var display = ($(this).hasClass('right')) ? true : false;
		
		$(this).toggleClass('right').toggleClass('down');
		
		var li = $(this).closest('li');
		
		if (display) li.children('ul').css('display', 'block');
		else li.children('ul').css('display', 'none');
		
		return false;
	});
	
	html.find('.icon.filter').click(function(e) {
		if (filters.css('display') === 'none') filters.stop(true, true).show(500);
		else filters.stop(true, true).hide(500);
	});
	
	$(html[1]).find('.icon.add').click(function() {
		pages[tree.currentPage] =
		{
			args		: {},
			method		: 'add',
			model		: pages[tree.currentPage - 1].model,
			delegate	: null
		};
		
		html.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) $(this).parent().click();
		});
		
		html.find('.selected').removeClass('selected');
		
		updatePage(tree.currentPage)
	});
	
	$(html[1]).find('.icon.remove').click(function() {
		var args = {'ids' : []};
		
		html.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) args.ids[args.ids.length] = $(this).closest('tr').attr('key');
		});
		
		html.find('.selected').removeClass('selected');
		
		var page = pages[tree.currentPage - 1];
		
		var path = '/ru-ru/ajax/' + page.model + '/remove/';
		
		ajax(path, args, function(json) {
			updatePage(tree.currentPage - 1);
		});
	});
	
	input.click(function(e) {
		var lis = $(html[3]).find('li');
		var haveOne = false;
		
		lis.closest('ul').css('display', 'none');
		
		filters.find('input[type=text]').each(function(i) {
			var filter = $(this);
			
			if (filter.val() === '') return;
			
			haveOne = true;
			
			var search = new RegExp('.*' + filter.val() + '.*', 'i');
			
			lis.each(function(j) {
				var li = $(this);
				
				if (search.test(li.children('label').text()))
				{
					li.parents('ul').prevAll('a').removeClass('right').addClass('down');
					li.parents('ul').css('display', 'block');
				}
			});
		})
		
		if (!haveOne)
		{
			lis.children('a').removeClass('right').addClass('down');
			lis.closest('ul').css('display', 'block');
		}
	});
	
	$(html[3]).on('click', 'li', function(e) {
		if ($(e.target).hasClass('checkbox')) return;
		if ($(e.target).hasClass('arrow')) return;
		
		var li = $(this);
		
		$(html[3]).find('li').removeClass('selected');
		
		html.find('.checkbox input').each(function(i) {
			if ($(this).prop('checked')) $(this).parent().click();
		});
		
		if (!li.hasClass('selected')) li.addClass('selected');
		
		pages[tree.currentPage] =
		{
			args		: {id : li.attr('key')},
			method		: 'item',
			model		: pages[tree.currentPage - 1].model,
			delegate	: null
		};
		
		updatePage(tree.currentPage)
		
		e.stopPropagation();
	});
	
	$(html[3]).on('click', '.checkbox', function(e) {
		var li = $(this).closest('li');
		var lis = li.find('li');
		lis = lis.add(li);
		
		lis.each(function(i) {
			var span = $(this).children('.checkbox');
			var el = span.children('input');
			(el.prop('checked')) ? el.prop('checked', false) : el.prop('checked', true);
			el.change();
			span.toggleClass('checked');
		});
	});
	
	tree.html = html;
};

Tree.prototype.createNode = function(html, items, level)
{
	tree = this;
	
	for (var j = 0; j < items.length; j++)
	{
		var li = $('<li key="' + items[j]['id'] + '"><input type="checkbox" /><label>' + items[j]['name'] + '</label></li>');
		
		if (items[j].childrens !== undefined && items[j].childrens.length > 0)
		{
			li.prepend('<a class="arrow right" href="#"></a>');
			li.append('<ul class="tree"></ul>')
			
			level++;
			this.createNode(li.find('ul'), items[j].childrens, level);
		}
		
		if (level > 1) li.find('ul').css('display', 'none');
		
		html.append(li);
	}
};