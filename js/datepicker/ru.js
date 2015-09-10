(function($) {
        $.datepicker.regional['en-GB'] = {
                renderer: $.datepicker.defaultRenderer,
                monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
					'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
					'Июл','Авг','Сен','Окт','Ноя','Дек'],
                dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                dateFormat: 'dd.mm.yy',
                firstDay: 1,
                prevText: '&#x3c;Пред', prevStatus: '',
                prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                nextText: 'След&#x3e;', nextStatus: '',
                nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                currentText: 'Сегодня', currentStatus: '',
                todayText: 'Сегодня', todayStatus: '',
                clearText: '-', clearStatus: '',
                closeText: 'Закрыть', closeStatus: '',
                yearStatus: '', monthStatus: '',
                weekText: 'Wk', weekStatus: '',
                dayStatus: 'DD d MM',
                defaultStatus: '',
                isRTL: false
        };
        $.extend($.datepicker.defaults, $.datepicker.regional['en-GB']);
})(jQuery);