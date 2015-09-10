$(document).ready(function() {
	$('input[action]').click(function() {
		var action = $(this).attr('action');
		var table = $(this).closest('section.table').find('table');
		var url = location.pathname.split('/');
		
		blockScreen(true);
		
		switch (action)
		{
			case 'add':
				if (url[url.length - 2] === 'add')
				{
					$('section.form form').submit();
					return;
				}
				else
				{
					url[url.length] = 0;
					url[url.length] = action;
				}
				
				break;
			case 'change':
				if (url[url.length - 2] === 'change')
				{
					$('section.form form').submit();
					return;
				}
				else url[url.length - 2] = action;
				
				break;
			case 'prev':
				history.back();
				return;
			default:
				url[url.length - 2] = action;
				break;
		}
		
		url = url.join('/');
		
		location = url;
	});
	
	$('aside .wrapper').css('min-height', $('table').outerHeight());
	
	$('section.form tr').hover(
		function() {
			var mt = $(this).position().top - $(this).closest('table').position().top;
			$('aside .arrow').animate({marginTop : mt}, {queue: false});
			$('aside .wrapper').animate({paddingTop : mt}, {queue: false});
		},
		function() {}
	);
	
	if ($('table .arrows').length > 0) {
		var arrows = $('table .arrows');
		var parentHeight = arrows.parent().height();
		var arrowsHeight = arrows.outerHeight();
		
		if (parentHeight > arrowsHeight) {
			var marginTop = (parentHeight - arrowsHeight) / 2;
			arrows.css('margin-top', marginTop);
		}
	}
	
	$('table .arrows .arrow').click(function() {
		var td = $(this).closest('td');
		var inputsDiv = td.find('.arrows .d-n');
		var selOther = td.find('select.multi.other');
		var selSelected = td.find('select.multi.selected');
		var selOtherSelected = selOther.find(':selected');
		var selSelectedSelected = selSelected.find(':selected');
		
		if ($(this).hasClass('right')) {
			selSelected.append(selOtherSelected);
		}
		else {
			selOther.append(selSelectedSelected);
		}
		
		selectSort(selOther);
		selectSort(selSelected);
		
		inputsDiv.find('input').remove();
		
		selOther.find('option').each(function(i) {
			this.selected = false;
		})
		
		selSelected.find('option').each(function(i) {
			this.selected = false;
			console.log(inputsDiv);
			inputsDiv.append('<input type="hidden" value="' + $(this).val() + '" name="' + inputsDiv.attr('name') + '[' + i + ']">');
		})
	});
});