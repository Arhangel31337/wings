(function($) {
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
	
    $.fn.errorHide = function() {
        return this.each(function(text) {
			$(this).next().hide(500);
		});
    };
	
    $.fn.errorShow = function(text) {
        return this.each(function() {
			var description = $(this).next();
			description.find('.text').text(text);
			description.show(500);
		});
    };
	
    $.fn.prepareInput = function() {
        return this.each(function() {
			var input = $(this);
			var extra = $(
				'<div class="inputExtra">' +
					'<div class="icon"></div>' +
					'<div class="text"></div>' +
				'</div>' +
				'<div class="cl-b"></div>'
			);
			
			switch (input.attr('type'))
			{
				case 'checkbox':
					if (input.parent().parent().nodeName === 'LABEL') input.parent().parent().wrap('<div class="input" />');
					else input.parent().wrap('<div class="input" />');
					
					var parent = input.closest('div.input');
					parent.append(extra);
					
					break;
				case 'password':
				case 'text':
					input.wrap('<div class="input" />');
					input.parent().append(extra);
					break;
			}
			
			input.focusout(function(e) {
				var el = $(this);
				
				var check = validate(el.val(), el.attr('validate'));
				
				if (check === '') el.errorHide();
				else el.errorShow(check);
			});
			
			input.keyup(function(e) {
				var el = $(this);
				
				var check = validate(el.val(), el.attr('validate'));
				
				if (check === '') el.errorHide();
				else el.errorShow(check);
			});
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
	
	required = required.split(',');
	
	for (var i = 0; i < required.length; i++)
	{
		switch (required[i])
		{
			case 'required':
				if (string === '') result = 'Поле не должно быть пустым.';
				break;
		}
	}
	
	return result;
};