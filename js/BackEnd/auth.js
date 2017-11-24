const marginHorizontal = 16;

$(document).ready(function() {
	$('input[name=mail]').keyup(function(e) {
		if (checkLogin(true) && e.which == 13)
		{
			$('input[name=verifyLogin]').click();
		}
	});
	
	$('input[name=password]').keyup(function(e) {
		if (checkPassword(true) && e.which == 13) $('input[name=login]').click();
	});
	
	$('input[name=verifyLogin]').click(function(e) {
		$('.background').css('display', 'block');
		
		$.ajax({
			url			: '/ru-ru/admin/authorization/checkLogin/',
			dataType	: "json",
			data		:
			{
				login	: $('input[name=mail]').val()
			},
			method		: 'POST',
			success		: function(json)
			{
				if (json.code !== undefined)
				{
					if (json.code === 200)
					{
						$('.userName').text(json.description);
						
						checkPassword();
						
						$('#login').stop(true, true).hide(500);
						$('#password').stop(true, true).show(500, function() {
							$('input[name=password]').focus();
							var temp = $('input[name=password]').val();
							$('input[name=password]').val('');
							$('input[name=password]').val(temp);
						});
					}
					else
					{
						$('input[name=mail]').inputError('show', json.description);
					}
				}
				
				$('.background').css('display', 'none');
			},
			error		: function(jqXHR, textStatus, errorThrown)
			{
				$('input[name=mail]').inputError('show', 'Ошибка соединения с сервером.');
				
				$('.background').css('display', 'none');
			}
		});
	});
	
	$('input[name=back]').click(function(e) {
		checkLogin(true);
		
		$('#password').stop(true, true).hide(500);
		$('#login').stop(true, true).show(500, function() {
			$('input[name=mail]').focus();
			var temp = $('input[name=mail]').val();
			$('input[name=mail]').val('');
			$('input[name=mail]').val(temp);
		});
	});
	
	$('input[name=login]').click(function(e) {
		$('form').submit();
	});
	
	$('form').submit(function(e) {
		$('.background').css('display', 'block');
		
		$.ajax({
			url			: '/ru-ru/admin/authorization/checkPassword/',
			dataType	: "json",
			data		:
			{
				login		: $('input[name=mail]').val(),
				password	: $('input[name=password]').val()
			},
			method		: 'POST',
			success		: function(json)
			{
				if (json.code !== undefined)
				{
					if (json.code === 200) location.reload();
					else $('input[name=password]').inputError('show', json.description); 
				}
				
				$('.background').css('display', 'none');
			},
			error		: function(jqXHR, textStatus, errorThrown)
			{
				$('input[name=password]').inputError('show', 'Ошибка соединения с сервером.');
				
				$('.background').css('display', 'none');
			}
		});
		
		return false;
	});
	
	$('.blockInCenter').blockInCenter();
	
	$('input[name=mail]').focus();
	var temp = $('input[name=mail]').val();
	$('input[name=mail]').val('');
	$('input[name=mail]').val(temp);
});

$(window).load(function() {
	checkLogin();
});

function checkLogin(errorDisplay) {
	var input = $('input[name=mail]');
	var button = $('input[name=verifyLogin]');
	
	if (input.val() === "")
	{
		button.prop('disabled', true);
		
		if (errorDisplay) input.inputError('show', 'Поле не должно быть пустым.');
	}
	else
	{
		button.prop('disabled', false);
		input.inputError('hide');
	}
	
	$('.background .progress').blockInCenter();
	
	return (input.val() !== "")
};

function checkPassword(errorDisplay) {
	var input = $('input[name=password]');
	var button = $('input[name=login]');
	
	if (input.val() === "")
	{
		button.prop('disabled', true);
		
		if (errorDisplay) input.inputError('show', 'Поле не должно быть пустым.');
	}
	else
	{
		button.prop('disabled', false);
		input.inputError('hide');
	}
	
	$('.background .progress').blockInCenter();
	
	return (input.val() !== "")
};
