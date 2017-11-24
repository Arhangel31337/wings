var monthsNameIP = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
var monthsNameRP = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];

(function($) {
	$.fn.animateNew = function(options) {
		$(this).stop(true, true).animate(options);
	};
	
    $.fn.blockInCenter = function() {
        return this.each(function() {
			var el = $(this);
			var parent = el.parent();
			
			if (!parent.hasClass('wrap')) el.wrap('<div class="wrap" />');
			else parent = parent.parent()
			
			var parentHeight = parent.height();
			var elHeight = el.height();
			
			var center = (parentHeight - elHeight) / 2;
			
			if (center < 0) center = 0;
			
			el.css('margin', '0 auto');
			el.parent().css('padding-top', center + 'px');
			
			$(window).resize(function() {
				el.blockInCenter();
			});
		});
    };
	
    $.fn.checkForm = function() {
		var form = $(this);
		var checked = true;
		
		form.find('input[validate]').each(function() {
			var el = $(this);
			
			var check = validate(el.val(), el.attr('validate'));
			
			if (check === '') return;
			
			checked = false;
			el.errorShow(check);
		});
		
		return checked;
    };
	
    $.fn.datetimePicker = function(options) {
    	var settings = $.extend(
    	{
    		displayYear		: true,
    		displayCalendar	: true,
    		displayTime		: true,
    		yearEnd			: '+25',
    		yearHeightLI	: 48,
    		yearHeightUL	: 48,
    		yearStart		: '-25'
    	},
    	options);
    	
    	return this.each(function(i) {
    		var input = $(this);
    		
    		var inputValue = input.attr('value');
    		
    		var data = {};
    		
    		var generateCalendar = function(year, month, day)
    		{
    			var firstDay = new Date(year + '-' + (month + 1) + '-' + 1);
    			var lastDay = new Date(Date.UTC(year, (month + 1), 0));
    			
    			if (firstDay.getDay() == 0) var start = -6;
    			else var start = 1 - firstDay.getDay();
    			var end = lastDay.getDate() + (7 - lastDay.getDay()) + 1;
    			var currentDay = 7;
    			var html = $('<tbody></tbody>');
    			var tr = $('');
    			
    			for (var current = (start + 1); current <= end; current++)
    			{
    				if (currentDay == 7)
    				{
    					html.append(tr);
    					tr = $('<tr></tr>');
    					currentDay = 0;
    				}
    				
    				if (current === day) tr.append('<td class="active">' + current + '</td>');
    				else if (current < 1 || current > lastDay.getDate()) tr.append('<td></td>');
    				else tr.append('<td>' + current + '</td>');
    				
    				currentDay++;
    			}
    			
    			return html.html();
    		};
    		
    		var generateYearList = function(year, yearStart, yearEnd)
    		{
    			year = year - 0;
    			
    			if (yearStart.charAt(0) == '+') yearStart = year - 0 + (yearStart.substring(1) - 0);
    			else if (yearStart.charAt(0) == '-') yearStart = year - (yearStart.substring(1) - 0);
    			else yearStart - 0;
    			
    			if (yearEnd.charAt(0) == '+') yearEnd = year - 0 + (yearEnd.substring(1) - 0);
    			else if (yearEnd.charAt(0) == '-') yearEnd = year - (yearEnd.substring(1) - 0);
    			else yearEnd - 0;
    			
    			var ul = $('<ul></ul>');
    			
    			for (yearStart; yearStart <= yearEnd; yearStart++)
    			{
    				if (yearStart != year) ul.append('<li>' + yearStart + '</li>');
    				else ul.append('<li class="active">' + yearStart + '</li>');
    			}
    			
    			return ul.html();
    		};
    		
    		var updateDialog = function(dialog, data)
    		{
    			dialog.find('output[name=day]').text(data.day);
    			dialog.find('output[name=month]').text(monthsNameRP[data.month]);
    			dialog.find('output[name=year]').text(data.year);
    			dialog.find('output[name=hour]').text(data.hour);
    			dialog.find('output[name=minute]').text(data.minute);
    			dialog.find('output[name=second]').text(data.second);
    			dialog.find('.picker.months td').removeClass('active');
    			dialog.find('.picker.months td:contains("' + monthsNameIP[data.month] + '")').addClass('active');
    			dialog.find('.picker.calendar a.monthChange').text(monthsNameIP[data.month] + ' ' + data.year);
    			dialog.find('.picker.calendar tbody').html(generateCalendar(data.year, data.month, data.day));
    		};
    		
    		input.click(function(e) {
        		var date = new Date(input.attr('value'));
        		if (isNaN(date)) date = new Date();
        		
    			data =
        		{
        			year	: date.getFullYear(),
        			month	: date.getMonth(),
        			day		: date.getDate(),
        			hour	: date.getHours(),
        			minute	: date.getMinutes(),
        			second	: date.getSeconds(),
        		};
        		
        		if (data.hour < 10) data.hour = '0' + data.hour;
        		if (data.minute < 10) data.minute = '0' + data.minute;
        		if (data.second < 10) data.second = '0' + data.second;
        		
    			var dialog = $(
    				'<dialog class="datetimePicker">' +
	    				'<header>' +
	    					'<output name="day">' + data.day+ '</output> ' +
	    					'<output name="month">' + monthsNameRP[data.month] + '</output> ' +
	    					'<output name="year">' + data.year + '</output> года ' +
	    					'<output name="hour">' + data.hour + '</output>:' +
	    					'<output name="minute">' + data.minute + '</output>:' +
	    					'<output name="second">' + data.second + '</output>' +
	    				'</header>' +
	    				'<div class="picker year">' +
	    					'<div class="ta-c"><a class="arrow up" href="#"></a></div>' +
	    					'<div class="overflow"><ul style="top: 0px;"></ul></div>' +
	    					'<div class="ta-c"><a class="arrow down" href="#"></a></div>' +
	    				'</div>' +
	    				'<div class="picker months">' +
	    					'<div><span>Выберите месяц</span></div>' +
	    					'<table class="months"><tbody>' +
		    					'<tr><td key="0">Январь</td><td key="1">Февраль</td><td key="2">Март</td></tr>' +
		    					'<tr><td key="3">Апрель</td><td key="4">Май</td><td key="5">Июнь</td></tr>' +
		    					'<tr><td key="6">Июль</td><td key="7">Август</td><td key="8">Сентябрь</td></tr>' +
		    					'<tr><td key="9">Октябрь</td><td key="10">Ноябрь</td><td key="11">Декабрь</td></tr>' +
	    					'</tbody></table>' +
	    				'</div>' +
	    				'<div class="picker calendar">' +
	    					'<div class="month">' +
		    					'<a class="arrow left fl-l" href="#"></a><a class="arrow right fl-r" href="#"></a>' +
		    					'<a class="monthChange" href="#">' + monthsNameIP[data.month] + ' ' + data.year+ '</a>' +
	    					'</div>' +
		    				'<table class="days">' +
			    				'<thead><tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th></tr></thead>' +
			    				'<tbody></tbody>' +
		    				'</table>' +
	    				'</div>' +
	    				'<div class="picker time">' +
		    				'<input type="text" name="hour" value="' + data.hour + '" oldValue="' + data.hour + '" placeholder="00" maxlength="2" /> : ' +
		    				'<input type="text" name="minute" value="' + data.minute + '" oldValue="' + data.minute + '" placeholder="00" maxlength="2" /> : ' +
		    				'<input type="text" name="second" value="' + data.second + '" oldValue="' + data.second + '" placeholder="00" maxlength="2" />' +
		    				'<br /><span>Часы</span><span>Минуты</span><span>Секунды</span>' +
	    				'</div>' +
	    				'<div class="cl-b"></div>' +
	    				'<footer>' +
		    				'<input class="reverse" type="button" name="cancel" value="Отмена" />' +
		    				'<input class="reverse" type="button" name="ok" value="Выбрать" />' +
	    				'</footer>' +
	    			'</dialog>'
    			);
    			
    			dialog.find('a.arrow').click(function() {
    				return false;
    			});
    			
    			var yearBlock = dialog.find('.picker.year');
    			var monthsBlock = dialog.find('.picker.months');
    			var calendarBlock = dialog.find('.picker.calendar');
    			var timeBlock = dialog.find('.picker.time');
    			
    			var yearUL = yearBlock.find('ul');
    			
    			if (!settings.displayYear) yearBlock.css('display', 'none');
    			if (!settings.displayCalendar) calendarBlock.css('display', 'none');
    			if (!settings.displayTime) timeBlock.css('display', 'none');
    			
    			yearBlock.find('ul').html(generateYearList(data.year, settings.yearStart, settings.yearEnd));
    			
    			updateDialog(dialog, data);
    			
    			settings.yearHeightLI = dialog.find('.picker.year li').outerHeight();
    			settings.yearHeightUL = (dialog.find('.picker.year li').length - 7) * settings.yearHeightLI;
    			
    			var yearULDefault = 0;
    			
    			yearBlock.find('li').each(function(i) {
    				if ($(this).text() == data.year) yearULDefault = i - 3;
    			});
    			
    			yearUL.css('top', (yearULDefault * settings.yearHeightLI * -1) + 'px');
    			
    			yearBlock.find('a.arrow.down').mousedown(function(e) {
    				var margin = yearUL.css('top').replace('px', '') - 0;
					var newMargin = margin - settings.yearHeightLI;
					
					if (newMargin >= (settings.yearHeightUL * -1)) yearUL.css('top', newMargin + 'px');
					else yearUL.css('top', (settings.yearHeightUL * -1) + 'px');
					
    				clearInterval(this.downTimer);
    				
    				this.downTimer = setInterval(function() {
    					var margin = yearUL.css('top').replace('px', '') - 0;
    					var newMargin = margin - settings.yearHeightLI;
    					
    					if (newMargin >= (settings.yearHeightUL * -1)) yearUL.css('top', newMargin + 'px');
    					else yearUL.css('top', (settings.yearHeightUL * -1) + 'px');
    				}, 100);
    			}).mouseup(function(e) {
    				clearInterval(this.downTimer);
    			});
    			
    			yearBlock.find('a.arrow.up').mousedown(function(e) {
    				var margin = yearUL.css('top').replace('px', '') - 0;
					var newMargin = margin + settings.yearHeightLI;
					
					if (newMargin <= 0) yearUL.css('top', newMargin + 'px');
					else yearUL.css('top', '0px');
    				
    				clearInterval(this.downTimer);
    				
    				this.downTimer = setInterval(function() {
    					var margin = yearUL.css('top').replace('px', '') - 0;
    					var newMargin = margin + settings.yearHeightLI;
    					
    					if (newMargin <= 0) yearUL.css('top', newMargin + 'px');
    					else yearUL.css('top', '0px');
    				}, 100);
    			}).mouseup(function(e) {
    				clearInterval(this.downTimer);
    			});
    			
    			yearBlock.find('li').click(function() {
    				var newYear = data.year = $(this).text() - 0;
    				var yearULDefault = 0;
        			
        			yearBlock.find('li').each(function(i) {
        				if ($(this).text() == newYear)
        				{
        					$(this).addClass('active');
        					yearULDefault = i - 3;
        				}
        				else $(this).removeClass('active');
        			});
        			
        			var newMargin = (yearULDefault * settings.yearHeightLI * -1);
        			
        			if (newMargin > 0) yearUL.css('top', '0px');
        			else if (newMargin < (settings.yearHeightUL * -1)) yearUL.css('top', (settings.yearHeightUL * -1) + 'px');
        			else yearUL.css('top', newMargin + 'px');
    				
    				updateDialog(dialog, data);
    			});
    			
    			monthsBlock.find('td').click(function() {
    				data.month = $(this).attr('key') - 0;
    				
    				updateDialog(dialog, data);
    				
    				monthsBlock.animate({opacity : 0}, 100, function() {
    					monthsBlock.css('display', 'none');
    					calendarBlock.css('display', 'block');
    					calendarBlock.animate({opacity : 1}, 100);
    				})
    			});
    			
    			calendarBlock.find('a.arrow.left').click(function() {
    				if (data.month === 0) data.month = 11;
    				else data.month = data.month - 1;
    				
    				updateDialog(dialog, data);
    			});
    			
    			calendarBlock.find('a.arrow.right').click(function() {
    				if (data.month === 11) data.month = 0;
    				else data.month = data.month + 1;
    				
    				updateDialog(dialog, data);
    			});
    			
    			calendarBlock.find('a.monthChange').click(function() {
    				calendarBlock.animate({opacity : 0}, 100, function() {
    					calendarBlock.css('display', 'none');
    					monthsBlock.css('display', 'block');
    					monthsBlock.animate({opacity : 1}, 100);
    				})
    				
    				return false;
    			});
    			
    			calendarBlock.on('click', 'td', function() {
    				if ($(this).text() == '') return;
    				
    				data.day = $(this).text() - 0;
    				
    				updateDialog(dialog, data);
    			});
    			
    			timeBlock.find('input[name=hour]').change(function() {
    				var val = $(this).val();
    				
    				if (isNaN(val) || val < 0 || val > 23)
    				{
    					$(this).val($(this).attr('oldValue'));
    					return;
    				}
    				
    				if (val.length == 0) val = '00';
    				else if (val.length == 1) val = '0' + val;
    				
    				$(this).val(val);
    				$(this).attr('oldValue', val);
    				
    				data.hour = val;
    				
    				updateDialog(dialog, data);
    			});
    			
    			timeBlock.find('input[name=minute]').change(function() {
    				var val = $(this).val();
    				
    				if (isNaN(val) || val < 0 || val > 59)
    				{
    					$(this).val($(this).attr('oldValue'));
    					return;
    				}
    				
    				if (val.length == 0) val = '00';
    				else if (val.length == 1) val = '0' + val;
    				
    				$(this).val(val);
    				$(this).attr('oldValue', val);
    				
    				data.minute = val;
    				
    				updateDialog(dialog, data);
    			});
    			
    			timeBlock.find('input[name=second]').change(function() {
    				var val = $(this).val();
    				
    				if (isNaN(val) || val < 0 || val > 59)
    				{
    					$(this).val($(this).attr('oldValue'));
    					return;
    				}
    				
    				if (val.length == 0) val = '00';
    				else if (val.length == 1) val = '0' + val;
    				
    				$(this).val(val);
    				$(this).attr('oldValue', val);
    				
    				data.second = val;
    				
    				updateDialog(dialog, data);
    			});
    			
    			dialog.find('footer input[name=cancel]').click(function() {
    				date = new Date(input.attr('value'));
    	    		
    				if (!isNaN(data))
    				{
	    	    		data =
	    	    		{
	    	    			year	: date.getFullYear(),
	    	    			month	: date.getMonth(),
	    	    			day		: date.getDate(),
	    	    			hour	: date.getHours(),
	    	    			minute	: date.getMinutes(),
	    	    			second	: date.getSeconds(),
	    	    		};
	    	    		
	    	    		if (data.hour < 10) data.hour = '0' + data.hour;
	    	    		if (data.minute < 10) data.minute = '0' + data.minute;
	    	    		if (data.second < 10) data.second = '0' + data.second;
    				}
    	    		
    				dialog.remove();
    			});
    			
    			dialog.find('footer input[name=ok]').click(function() {
    				var str = data.year;
    				
    				if ((data.month + 1) < 10) str += '-0' + (data.month + 1);
    				else str += '-' + (data.month + 1);
    				if (data.day < 10) str += '-0' + data.day;
    				else str += '-' + data.day;
    				
    				str += ' ' + data.hour + ':' + data.minute + ':' + data.second;
    				
    				input.attr('value', str);
    				input.text(str);
    				
    				dialog.remove();
    			});
    			
    			$('body').prepend(dialog.css('display', 'block'));
    		});
    	});
    };
	
    var inputErrorMethods =
    {
		hide	: function()
		{
			$(this).next().animateNew({height : 0}, 500);
		},
		show	: function(text)
		{
			var description = $(this).next();
			description.find('.text').text(text);
			description.animateNew({height : 26}, 500);
		}
    };
    
    $.fn.inputError = function(method)
    {
    	var args = Array.prototype.slice.call(arguments, 1);
    	
    	if (inputErrorMethods[method])
    	{
	    	return this.each(function()
	    	{
		    	return inputErrorMethods[method].apply(this, args);
	    	});
    	}
    	else $.error('Метод с именем ' +  method + ' не существует для jQuery.inputError');
    };
	
    $.fn.prepareInput = function(needCheckbox) {
        return this.each(function() {
			var el = $(this);
			var extra = $(
				'<div class="inputExtra">' +
					'<div class="icon"></div>' +
					'<div class="text"></div>' +
				'</div>' +
				'<div class="cl-b"></div>'
			);
			
			var label = $('<label class="inputName">' + el.attr('placeholder') + '</label>');
			var checkbox = $('<input type="checkbox" class="filterCheck" />');
			
			if (el.val() == '') label.css('opacity', '0');
			
			el.wrap('<div class="input" />');
			
			if (needCheckbox === true) el.parent().prepend(checkbox);
			
			switch (el.attr('type'))
			{
				case 'checkbox':
					if (el.hasClass('switch'))
					{
						if (needCheckbox === true) el.parent().prepend(label);
						el.wrap('<label class="switch">' + el.attr('columnName') + '</label>');
					}
					break;
				case 'password':
				case 'text':
					
					el.parent().prepend(label);
					el.parent().append(extra);
					break;
			}
			
			el.focusout(function(e) {
				var el = $(this);
				
				if (el.val() == '') label.animateNew({opacity : 0});
				else label.animateNew({opacity : 1});
				
				var check = validate(el.val(), el.attr('validate'));
				
				if (check === '') el.inputError('hide');
				else el.inputError('show', check);
			});
			
			el.keyup(function(e) {
				var el = $(this);
				
				if (el.val() == '') label.animateNew({opacity : 0});
				else label.animateNew({opacity : 1});
				
				var check = validate(el.val(), el.attr('validate'));
				
				if (check === '') el.inputError('hide');
				else el.inputError('show', check);
			});
		});
    };
	
    $.fn.prepareSpan = function(needCheckbox) {
        return this.each(function() {
        	var el = $(this);
        	el.wrap('<div class="input" />');
			
        	if (el.hasClass('fromTo'))
        	{
        		var name = el.attr('name');
        		var to = el.removeClass('fromTo').clone();
        		
        		el.addClass('from').attr('name', name + '[from]');
        		to.addClass('to').attr('name', name + '[to]');
        		
        		el.parent().append(to);
        		el.parent().addClass('fromTo');
        		
        		el.datetimePicker();
        		to.datetimePicker();
        		
        		el.closest('div.input').attr('key', el.attr('key'));
        	}
        	else if (el.hasClass('datetime')) el.datetimePicker();
        	
        	if (needCheckbox) el.parent().prepend('<input type="checkbox" class="filterCheck" />');
        	el.parent().prepend('<label class="inputName">' + el.attr('placeholder') + '</label>');
        	el.parent().append(
				'<div class="inputExtra">' +
					'<div class="icon"></div>' +
					'<div class="text"></div>' +
				'</div>' +
				'<div class="cl-b"></div>'
			);
		});
    };
}(jQuery));

function ajax(path, args, callback)
{
	$.ajax({
		url			: path,
		dataType	: "json",
		data		: args,
		method		: 'POST',
		success		: function(json)
		{
			if (json.code !== undefined)
			{
				if (json.code === 200) callback(json);
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
			
			$('.background').css('display', 'none');
		},
		error		: function(jqXHR, textStatus, errorThrown)
		{
			popupShow('Ошибка соединения с сервером.');
			
			$('.background').css('display', 'none');
		}
	});
};

function validate(string, required)
{
	var result ='';
	
	if (required === undefined) return result;
	
	required = required.split(',');
	
	for (var i = 0; i < required.length; i++)
	{
		switch (required[i])
		{
			case 'required':
				if (string === '') result = 'Поле не должно быть пустым.';
				break;
			case 'mail':
				var reg = /^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,6}$/;
				if (!reg.test(string)) result = 'Это не e-mail.';
				break;
		}
	}
	
	return result;
};