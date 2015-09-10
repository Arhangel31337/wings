(function($) {
        $.datepicker.regional['en-GB'] = {
                renderer: $.ui.datepicker.defaultRenderer,
                monthNames: ['Leden','Únor','Březen','Duben','Květen','Červen','Červenec','Srpen','Září','Říjen','Listopad','Prosinec'],
                monthNamesShort: ['Led','Úno','Bře','Dub','Kvě','Čvn','Čvc','Srp','Zář','Řjn','Lis','Pro'],
                dayNames: ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
                dayNamesShort: ['Ne','Po','Út','St','Čt','Pá','So'],
                dayNamesMin: ['NE','PO','ÚT','ST','ČT','PÁ','SO'],
                dateFormat: 'dd.mm.yy',
                firstDay: 1,
                prevText: '&#x3c;Předchozí', prevStatus: '',
                prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                nextText: 'Následující&#x3e;', nextStatus: '',
                nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                currentText: 'Dnes', currentStatus: '',
                todayText: 'Dnes', todayStatus: '',
                clearText: '-', clearStatus: '',
                closeText: 'Zavřít', closeStatus: '',
                yearStatus: '', monthStatus: '',
                weekText: 'Wk', weekStatus: '',
                dayStatus: 'DD d MM',
                defaultStatus: '',
                isRTL: false
        };
        $.extend($.datepicker.defaults, $.datepicker.regional['en-GB']);
})(jQuery);