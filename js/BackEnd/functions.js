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
	
    $.fn.formPrepare = function() {
        return this.each(function() {
			
		});
    };
}(jQuery));