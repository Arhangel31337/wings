$(document).ready(function() {
	$('header .menu li a').hover(
		function() {
			var menuName = $(this).attr('menu');
			$('header .subMenu').css('display', 'block');
			$('header .subMenu ul').css('display', 'none');
			$('header .subMenu ul[menu=' + menuName + ']').css('display', 'block');
		},
		function() {
		}
	);
	
	$('a').click(function() {
		blockScreen(true);
	});
	
	$('header').hover(
		function() {
		},
		function() {
			$(this).find('.subMenu ul').css('display', 'none');
			$(this).find('.subMenu').css('display', 'none');
		}
	);
	
	createSelect($('.pseudo-select'));
	
	$('select.multi').each(function() {
		$(this).find('option').each(function(i) {
			if (i % 2) $(this).addClass('first');
			else $(this).addClass('second');
		});
	});
});

function blockInCenter(el)
{
	if (!el.parent().hasClass('wrap')) {
		var parentHeight = el.parent().innerHeight();
		var elHeight = el.outerHeight();
		
		var center = (parentHeight - elHeight) / 2;
		
		el.wrap('<div class="wrap" />');
	}
	else {
		var parentHeight = el.parent().parent().innerHeight();
		var elHeight = el.outerHeight();
		
		var center = (parentHeight - elHeight) / 2;
	}
	
	el.css('margin', '0 auto');
	el.parent().css('padding-top', center + 'px');
};

function blockScreen(block)
{
	var bg = $('.loader-bg');
	var loader = $('.loader');
	
	blockInCenter(loader);
	
	if (block) bg.css('display', 'block');
	else bg.css('display', 'none');
};

function createMultiSelect(el) {
	var parent = el.parent();
	var array = eval( '(' + el.text() + ')' );
	var name = el.attr('field');
	
	var div = $('<div style="margin-bottom: 10px;" />');
	var select = $('<select class="dropdown multi" name="' + name + '[0]" count="0" />');
	
	for (var key in array) {
		var option = $('<option value="' + array[key]['value'] + '">' + array[key]['text'] + '</option>');
		if (array[key]['childrens'] != undefined) option.attr('children', JSON.stringify(array[key]['childrens']));
		select.append(option);
	}
	
	div.append(select);
	parent.append(div);
};

function createSelect(el)
{
	el.each(function() {
		var el = $(this);
		
		var generate = false;
		var pseudo = $('<div class="pseudo-select" />');
		
		pseudo.append('<div class="select">Выбирите значение</div><div class="options" />');
		var options = pseudo.find('.options');
		var selected = el.val();
		
		el.find('option').each(function(j) {
			var pl = $(this).css('padding-left').split('px');
			var option = $('<div style="padding-left: ' + (pl[0] - 0 + 5) + 'px;" value="' + $(this).val() + '">' + $(this).text() + '</div>');
			if ($(this).attr('children') != undefined) option.attr('children', $(this).attr('children'));
			options.append(option);
		});
		
		pseudo.find('.select').click(function(){
			if (options.css('display') == 'block') options.fadeOut('fast');
			else options.fadeIn('fast');
		});
		
		pseudo.mouseleave(function(){
			options.fadeOut('fast');
		});
		
		pseudo.find('.options > div').click(function(){
			var td = $(this).closest('.pseudo-select').parent();
			
			if ($(this).attr('value') == 'other') {
				var name = td.find('select').attr('name');
				td.append('<input class="string" type="text" name="' + name + '_other" value="" />');
			}
			else td.find('input.string').remove();
			
			td.find('.select').html($(this).html());
			td.find('option').removeAttr('selected');
			td.find('select').val($(this).attr('value'));
			
			if (td.find('select').hasClass('multi')) {
				var temp = td.next();
				while(temp.is('div')) {
					var next = temp.next();
					temp.remove();
					temp = next;
				}
				
				if ($(this).attr('children') != undefined) {
					var array = eval( '(' + $(this).attr('children') + ')' );
					var parent = $(this).closest('td');
					var name = parent.find('div.multiselect').attr('field') + '[' + (td.find('select').attr('count') - 0 + 1) + ']';
					
					var div = $('<div style="margin-bottom: 10px;" />');
					var selectTemp = $('<select class="dropdown multi" name="' + name + '" count="' + (td.find('select').attr('count') - 0 + 1) + '" />');
					
					for (var key in array) {
						var option = $('<option value="' + array[key]['value'] + '">' + array[key]['text'] + '</option>');
						if (array[key]['childrens'] != undefined) option.attr('children', JSON.stringify(array[key]['childrens']));
						selectTemp.append(option);
					}
					
					div.append(selectTemp);
					parent.append(div);
					
					createSelect(parent.find(selectTemp));
				}
			}
			
			$.each($(this).parent().children('div.check'), function(){
				$(this).removeClass('check');
			});
			
			$(this).addClass('check');
			$(this).parent().fadeOut('fast');
			
			if (generate) {
				infoGrid(el.parent());
				
				if (el.attr('name') == 'language' || el.attr('name') == 'pageType') {
					var url = location.pathname;
					
					url = url.split('/');
					
					var pathname = url.slice(2, -1).join('/');
					
					url = '/' + url[1] + '/ajax/page-form/' + url[url.length -2] + '/';
					
					$.ajax({
						type	: 'POST',
						url		: url,
						data	: {
							pathname: pathname,
							languageID: $('select[name=language]').closest('td').find('.options div.check').attr('value'),
							pageTypeID: $('select[name=pageType]').closest('td').find('.options div.check').attr('value')
						}
					}).done(function(msg) {
						var newForm = $(msg);
						$('figure.form').html(newForm.html());
						formGenerate();
						switches()
					});
				}
			}
		});
		
		el.parent().append(pseudo);
		pseudo.find('.options > div[value="' + selected + '"]').click();
		generate = true;
		el.css('display', 'none');
		
		options.css('display', 'block');
		var widthNew = options.width() + 10;
		pseudo.find('.select').width(widthNew);
		options.width(widthNew + 10);
		options.css('display', 'none');
	});
};

function selectSort(select) {
	var options = select.find('option');
	
	options.removeClass('first second');
	
	var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
	
	arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
	
	options.each(function(i, o) {
		o.value = arr[i].v;
		$(o).text(arr[i].t);
	});
	
	options.each(function(i) {
		if (i % 2) $(this).addClass('first');
		else $(this).addClass('second');
	});
};
