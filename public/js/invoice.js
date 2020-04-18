$(function() {
	var rates = {
		'usd' : Number($('#usd').text()),
		'eur' : Number($('#eur').text())
	};

	var i18n_ru = {
		cancel: "Отмена",
		clear: "Очистить",
		done: "Готово",
		months: [ "Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь" ],
		monthsShort: [ "Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек" ],
		weekdays: [ "Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота" ],
		weekdaysShort: [ "вск","пнд","втр","срд","чтв","птн","сбт" ],
		weekdaysAbbrev: [ "Вс","Пн","Вт","Ср","Чт","Пт","Сб" ]
	};

	var datepicker_options = {
		autoClose: true,
		firstDay: 1,
		minDate: new Date(),
		format: 'dd/mm/yyyy',
		i18n: i18n_ru
	};

	$('.datepicker').datepicker(datepicker_options);

	datepicker_options.defaultDate = new Date();
	datepicker_options.setDefaultDate = new Date();

	$('#payment_date').datepicker(datepicker_options);

	$('#add_tourist').on('click', function() {
		if (validate(['tourist'])) {
			var tourist = $('#tourist').val();
			$('#tourists_col').removeClass('hide');
			$('#tourists_list').append('<li><span>'+ tourist +'</span><a class="btn-flat remove-tourist"><i class="material-icons">close</i></a></li>');
			clearFields(['tourist']);
		}
		else {
			M.toast({html: 'Заполните обязательные поля'})
		}
	});

	$('body').on('click', '.remove-tourist', function() {
		$(this).parent().remove();
		if ( $('#tourists_list li').length == 0) {
			$('#tourists_col').addClass('hide');
		}
	});

	// Change currency
	$('.convert > span').on('click', function() {
		var currency = $(this).data('convert');
		var old_currency = $(this).siblings('span.active').data('convert');
		var results = $(this).parent().siblings().find('.results [data-currency]');
		$(this).siblings('span.active').removeClass('active');
		$(this).addClass('active');
		$(this).parent().siblings().find('.create-field[data-currency]').attr('data-currency', currency); // for inputs
		results.attr('data-currency', currency); // for results block
		var input = $(this).parent().siblings().find('.create-field[data-currency] input');
		input.each( function(i, el) {
			var old_value = Number($(el).val());
			exchange(el, currency, old_currency, old_value, true);
		});

		results.each( function(i, el) {
			var old_value = Number($(el).text());
			exchange(el, currency, old_currency, old_value, false);
		});

	});

	$('body').on('click', '.remove_inner', function() {
		let el = $(this).parents().eq(1);
		let id = $(this).parents().eq(5).attr('id');
		el.addClass('scale-out').animate({
			'padding' : 0,
			'margin'  : 0,
			'height'  : 0
		}, 300, function() {
			el.remove();
			if (id == 'payments') {
				countPayments();
			}
			else {
				countResults('#' + id);
			}
			
		});
		
	});

	$('#add_hotel').on('click', function() {
		var hotel_fields = ['hotel_name', 'hotel_from', 'hotel_to', 'hotel_sum', 'hotel_discount', 'hotel_accommodation', 'hotel_status' ];
		if (validate(hotel_fields)) {
			var new_hotel = getValues(hotel_fields);
			var currency = getCurrency($(this));
			$('#hotels_list').append(
				'<div class="inner-container c-f scale-transition"> \
					<div class="col s8"> \
						<p class="name">'+ new_hotel.hotel_name +'</p> \
						<p class="dates">'+ new_hotel.hotel_from +' - '+ new_hotel.hotel_to +'</p> \
						<p class="accommodation">'+ new_hotel.hotel_accommodation +'</p> \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="sum" name="sum" type="text" class="validate" value="'+ new_hotel.hotel_sum +'"> \
		          			<label for="sum" class="active">Сумма</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="discount" name="discount" type="text" class="validate" value="'+ new_hotel.hotel_discount +'"> \
		          			<label for="discount" class="active">Скидка</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="total" name="total" type="text" disabled class="validate" value="'+ Number(new_hotel.hotel_sum - new_hotel.hotel_discount) +'"> \
		          			<label for="total" class="active">Итого</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<a class="remove_inner btn-flat right"><i class="material-icons">close</i></a> \
					</div> \
				</div>');
			clearFields(hotel_fields);
			countResults('#hotels');
		}
		else {
			M.toast({html: 'Заполните обязательные поля'})
		}
	});

	$('#send_status').on('click', function() {

	});

	$('#add_service').on('click', function() {
		var service_fields = ['service_name', 'service_from', 'service_to', 'service_sum', 'service_discount' ];
		if (validate(service_fields)) {
			var new_service = getValues(service_fields);
			var currency = getCurrency($(this));
			$('#services_list').append(
				'<div class="inner-container c-f scale-transition"> \
					<div class="col s7"> \
						<p class="name">'+ new_service.service_name +'</p> \
						<p class="dates">'+ new_service.service_from +' - '+ new_service.service_to +'</p> \
					</div> \
					<div class="col s1"> \
						<div class="input-field"> \
							<input id="qty" name="qty" type="number" min="1" class="validate" value="1"> \
		          			<label for="qty" class="active">Кол-во</label> \
		          			<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div> \
						</div> \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="sum" name="sum" type="text" class="validate" value="'+ new_service.service_sum +'"> \
		          			<label for="sum" class="active">Сумма</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="discount" name="discount" type="text" class="validate" value="'+ new_service.service_discount +'"> \
		          			<label for="discount" class="active">Скидка</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="total" name="total" type="text" disabled class="validate" value="'+ eval(new_service.service_sum - new_service.service_discount) +'"> \
		          			<label for="total" class="active">Итого</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<a class="remove_inner btn-flat right"><i class="material-icons">close</i></a> \
					</div> \
				</div>');
			clearFields(service_fields);
			countResults('#services');
		}
		else {
			M.toast({html: 'Заполните обязательные поля'})
		}
	});

	$('#add_payment').on('click', function() {
		let payment_fields = ['payment_name', 'payment_date', 'payment_sum', 'payment_note' , 'payment_scan' ];
		if (validate(payment_fields)) {
			let new_payment = getValues(payment_fields);
			let currency = getCurrency($(this));
			let icons = '',
				classes = '';
			if( $('#penalty').is(':checked') ) {
				icons = '<i class="material-icons red-text tooltipped" data-position="top" data-tooltip="Штраф">attach_money</i>';
				classes = 'penalty';
			}
			if ( $('#annul').is(':checked') ) {
				icons += '<i class="material-icons red-text tooltipped" data-position="top" data-tooltip="Аннулирован">undo</i>';
				classes += ' annul';
			}
			if ( new_payment.payment_scan != '') {
				icons += '<i class="material-icons tooltipped" data-position="top" data-tooltip="Скан оплаты '+ new_payment.payment_scan +'">insert_drive_file</i>';
			}
			if (classes == '') { classes = 'total';	}

			$('#payments_list').append(
				'<div class="inner-container c-f scale-transition"> \
					<div class="col s4"> \
						<p class="name">'+ new_payment.payment_name +'</p> \
						<p class="dates">'+ new_payment.payment_date +'</p> \
					</div> \
					<div class="col s5"> \
						<div class="input-field"> \
				        	<textarea id="payment_note" name="payment_note" class="materialize-textarea" placeholder="Напишите примечание к оплате" style="height: 45px;">'+ new_payment.payment_note +'</textarea> \
				        </div> \
					</div> \
					<div class="col s1 center-align"> \
						'+ icons +' \
					</div> \
					<div class="col s1"> \
						<div class="input-field" data-currency="'+ currency +'"> \
							<input id="sum" name="sum" type="text" class="validate '+ classes +'" value="'+ new_payment.payment_sum +'"> \
		          			<label for="sum" class="active">Сумма</label> \
						</div> \
					</div> \
					<div class="col s1"> \
						<a class="remove_inner btn-flat right"><i class="material-icons">close</i></a> \
					</div> \
				</div>');
			payment_fields.splice(1, 1);
			clearFields(payment_fields);
			$('.tooltipped').tooltip();
			countPayments();
		}
		else {
			M.toast({html: 'Заполните обязательные поля'})
		}
	});

	$('#send_status').on('click', function() {
		
	});

	$('select').on('change', function() {
		$(this).siblings('input.dropdown-trigger').removeClass('invalid').addClass('valid');
	});

	$('body').on('click', '.quantity-button', function() {
		let number_field = $(this).parent().siblings('input');
		let min = Number(number_field.attr('min'));
		let value = Number(number_field.val());
		if( $(this).hasClass('quantity-down') ) {
			value > min && number_field.val(value - 1);
		}
		else {
			number_field.val(value + 1);
		}
		number_field.trigger("input");
	});

	$('body').on('input', '#hotels_list input, #services_list input', function() {
		let parent = $(this).parents().eq(2);
		let sum = parent.find('#sum').val();
		let discount = parent.find('#discount').val();
		let qty = parent.find('#qty').val();
		let id = (qty === undefined ? '#hotels' : '#services');
		qty = (qty === undefined ? 1 : qty);
		parent.find('#total').val(qty*sum-discount);
		countResults(id);
	});

	function countPayments() {
		let penalty = sumValues($('#payments_list .penalty'));
		let total = sumValues($('#payments_list .total'));
		let annul = sumValues($('#payments_list .annul'));
		$('#payments .results .penalty').text(penalty);
		$('#payments .results .total').text(total);
		$('#payments .results .annul').text(annul);
	}

	function countResults(selector) {
		let sum = sumValues($(selector + ' #sum'));
		let discount = sumValues($(selector + ' #discount'));
		let total = sumValues($(selector + ' #total'));
		$(selector + ' .results .sum').text(sum);
		$(selector + ' .results .discount').text(discount);
		$(selector + ' .results .total').text(total);
		console.log(sum, discount, total);
	}

	function sumValues(obj) {
		let sum = 0;
		obj.each(function() {
			sum += Number($(this).val());
		});
		return sum;
	}

	function getExchange(currency, old_currency, value) {
		if (old_currency == "kzt") {
			return value / rates[currency];
		}
		else if ( (old_currency == "eur" && currency == "usd") || (old_currency == "usd" && currency == "eur") ) {
			return value * (rates[old_currency] / rates[currency]);
		}
		else {
			return value * rates[old_currency];
		}
	}

	function exchange(el, currency, old_currency, old_value, val) {
		let new_value;
		if (old_value) {
			if (old_currency == "kzt") {
				new_value = old_value / rates[currency];
			}
			else if ( (old_currency == "eur" && currency == "usd") || (old_currency == "usd" && currency == "eur") ) {
				new_value = old_value * (rates[old_currency] / rates[currency]);
			}
			else {
				new_value = old_value * rates[old_currency];
			}

			if (val) {
				$(el).val(new_value.toFixed(2));
			}
			else {
				$(el).text(new_value.toFixed(2));
			}
			
		}
	}

	function getCurrency(obj) {
		return obj.parents().eq(2).find('.convert .active').data('convert');
	}

	function getValues(arr) {
		let data = arr.reduce(function(obj, el) {
			obj[el] = document.getElementById(el).value;
			return obj;
		}, {});
		return data;
	}

	function clearFields(arr) {
		arr.forEach(function(el, i) {
			let form_el = document.getElementById(el);
			i == 0 && form_el.focus();
			if (form_el.tagName == "SELECT") {
				form_el.value = '';
				form_el.parentNode.querySelector('input.dropdown-trigger').value = '';
				form_el.parentNode.querySelector('input.dropdown-trigger').classList.remove('valid');
			}
			else {
				form_el.value = '';
				form_el.classList.remove('valid');
			}
		});
	}

	function validate(arr) {
		let validated = true;
		arr.forEach(function(el) {
			var form_el = document.getElementById(el);
			if (form_el.tagName == "SELECT") {
				if (form_el.selectedIndex == 0) {
					form_el.parentNode.querySelector('input.dropdown-trigger').classList.add('invalid');
					validated = false;
				}
			}
			else if(!form_el.checkValidity()) {
				form_el.classList.add('invalid');
				validated = false;
			}
		});
		return validated;
	}

});