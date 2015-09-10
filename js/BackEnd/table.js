$(document).ready(function() {
	$('section.table').each(function() {
		var table = $(this).find('table');
		var headChecked = table.find('thead input[type=checkbox]');
		var bodyChecked = table.find('tbody input[type=checkbox]');
		
		headChecked.click(function() {
			if ($(this).prop('checked')) table.find('tbody input[type=checkbox]').prop('checked', true);
			else table.find('tbody input[type=checkbox]').prop('checked', false);
		});
		
		bodyChecked.click(function() {
			var isChecked = $(this).prop('checked');
			var allChecked = true;
			
			bodyChecked.each(function() {
				if ($(this).prop('checked') !== isChecked) allChecked = false;
			});
			
			if (allChecked && isChecked) headChecked.prop('checked', true);
			else headChecked.prop('checked', false);
		});
		
		if (table.hasClass('sortable'))
		{
			var itemID, prevID, parentID;
			
			table.find('tbody td ul').sortable({
				handle		: '.drag',
				axis		: 'y',
				connectWith	: 'tbody td ul',
				placeholder	: "ui-state-highlight",
				start		: function(event, ui)
				{
					itemID = ui.item.attr('element');
					prevID = ui.item.prev().attr('element');
					parentID = ui.item.parent().parent().attr('element');
					
					table.find('ul').css('min-height', '20px');
					table.find('.ui-state-highlight').height(ui.item.innerHeight());
				},
				stop		: function(event, ui)
				{
					table.find('ul').css('min-height', '0px');
					ui.item.parent().css('height', 'auto');
					redrawTree(table.find('td').children('ul'), 0);
					
					if (prevID != ui.item.prev().attr('element') || parentID != ui.item.parent().parent().attr('element'))
					{
						blockScreen(true);
						
						prevID = ui.item.prev().attr('element');
						parentID = ui.item.parent().parent().attr('element');
						
						if (parentID === undefined) return;
						
						if (prevID === undefined) prevID = parentID;
						
						var url = location.pathname + itemID + '/move/';
						
						$.ajax({
							url: url,
							method: "POST",
							data:
							{
								'parentID'		: parentID,
								'nearNodeID'	: prevID
							},
							dataType: "json"
						})
						.done(function(json) {
							if (json.code === undefined || json.code !== 200) return;
							
							blockScreen(false);
						});
					}
				}
			});
			
			redrawTree(table.find('td').children('ul'), 0);
		}
		else redrawTable($(this));
	});
	
	$('input[action]').click(function() {
		blockScreen(true);
		
		var action = $(this).attr('action');
		var table = $(this).closest('section.table').find('table');
		var url = location.pathname.split('/');
		
		switch (action)
		{
			case 'add':
				url[url.length] = 0;
				url[url.length] = action;
				
				break;
			case 'prev':
				history.back();
				return;
			case 'remove':
				var checkeds = table.find('tbody input[type=checkbox]:checked');
				var ids = [];
				var isList = false;
				
				if (isNaN(url[url.length - 3] - 0)) isList = true;
				
				if (isList)
				{
					var i = 0;
					checkeds.each(function() {
						ids[i] = $(this).attr('elementID');
						i++;
					});
					
					url[(url.length - 1)] = 0;
					url[url.length] = 'remove';
					
					url = url.join('/') + '/';
				}
				else
				{
					ids[0] = url[(url.length - 3)];
					url[(url.length - 2)] = 'remove';
					
					url = url.join('/');
				}
				
				$.ajax({
					url: url,
					method: "POST",
					data: { 'ids' : ids },
					dataType: "json"
				})
				.done(function(json) {
					if (json.code === undefined || json.code !== 200) return;
					
					if (isList)
					{
						checkeds.each(function() {
							$(this).closest('tr').remove();
						});
						
						redrawTable(table);
					}
					else
					{
						var url = location.pathname.split('/');
						url = url.slice(0, (url.length - 3)).join('/') + '/';
					
						location = url;
					}
				});
				
				blockScreen(false);
				
				return;
			default:
				url[url.length - 2] = action;
				break;
		}
		
		url = url.join('/');
		
		location = url;
	});
});

function redrawTable(tables)
{
	tables.each(function() {
		var trs = $(this).find('tbody tr');
		
		trs.removeClass('first second');
		
		trs.each(function(i) {
			if (i % 2) $(this).addClass('second');
			else $(this).addClass('first');
		});
	});
};

function redrawTree(node, level)
{
	node.each(function() {
		var lis = $(this).children('li');
		lis.children('.drag').css('margin-left', (-20 * level - 17) + 'px');
		redrawTree(lis.children('ul'), (level + 1));
	});
};