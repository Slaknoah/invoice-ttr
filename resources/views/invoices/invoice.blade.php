@extends('layouts.app')

@section('title', 'Инвойс')

@section('content')
	<div id="invoice">
		<div id="main" class="container frame">
			<div class="convert c-f">
				<span data-convert="kzt">₸</span>
				<span data-convert="usd">$</span>
				<span data-convert="eur" class="active">€</span>
			</div>

			<div class="row c-f">
				<div class="col s3">
					<div class="input-field">
						<p>от {{ date('d/m/Y H:i:s') }}</p>
						<p>Менеджер: <span id="manager">Ирина Жегулина</span></p>
						<p><span>Поставщик: </span> 
							<select id="provider">
								@foreach($providers as $provider)
									<option value="{{$provider->id}}">{{$provider->name}}</option>
								@endforeach
						    </select>
						</p>
					</div>
				</div>

				<div class="col s1">
					<div class="input-field">
						<input id="number" name="number" type="text" class="validate" placeholder="">
	          			<label for="number">Счет №</label>
					</div>
				</div>
				
				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="netto" name="netto" type="text" class="validate" placeholder="">
	          			<label for="netto">Нетто</label>
					</div>
				</div>
				
				<div class="col s3">
					<div class="input-field">
						<input id="customer" name="customer" type="text" class="validate autocomplete" placeholder="Агент или турист">
	          			<label for="customer">Заказчик</label>
					</div>
				</div>

				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="commission" name="commission" type="text" class="validate" placeholder="">
	          			<label for="commission">Комиссия</label>
					</div>
				</div>

				<div class="col s3">
					<div class="input-field">
						<input id="transfer" name="transfer" type="text" class="validate autocomplete" placeholder="ФИО или email менеджера">
	          			<label for="transfer">Передать сделку менеджеру</label>
	          			<button class="btn inline-button"><i class="material-icons">send</i></button>
					</div>
				</div>
				
			</div>
		</div>

		<div id="tourists" class="container frame">

			<div class="row">
				<div class="col s6">
					<div class="c-f">
						<div class="input-field input-tourist">
							<input id="tourist" name="tourist" type="text" required class="validate autocomplete" placeholder="ФИО или e-mail туриста">
		          			<label for="tourist">Добавить туриста</label>
						</div>
						<button id="add_tourist" class="btn waves-effect waves-light">Добавить</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div id="tourists_col" class="col s12 hide">
					<h6>Туристы</h6>
					<ol id="tourists_list"></ol>
				</div>
			</div>
		</div>

		<div id="hotels" class="container frame">
			<div class="convert c-f">
				<span data-convert="kzt">₸</span>
				<span data-convert="usd">$</span>
				<span data-convert="eur" class="active">€</span>
			</div>
			<div class="row c-f">
				<div class="col s3">
					<div class="input-field hotel-name-field">
						<input id="hotel_name" name="hotel_name" type="text" required class="validate autocomplete" placeholder="Название отеля">
	          			<label for="hotel_name">Добавить отель</label>
					</div>
				</div>
				<div class="col s3">
					<div class="input-field inline-field">
						<input id="hotel_from" name="hotel_from" type="text" required class="validate datepicker" placeholder="">
	          			<label for="hotel_from">Дата от</label>
					</div>
					<div class="input-field inline-field">
						<input id="hotel_to" name="hotel_to" type="text" required class="validate datepicker" placeholder="">
	          			<label for="hotel_to">Дата до</label>
					</div>
				</div>
				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="hotel_sum" name="hotel_sum" type="text" required class="validate" placeholder="">
	          			<label for="hotel_sum">Сумма</label>
					</div>
				</div>
				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="hotel_discount" name="hotel_discount" required type="text" class="validate" placeholder="">
	          			<label for="hotel_discount">Скидка</label>
					</div>
				</div>
				<div class="col s2">
					<button id="add_hotel" class="btn waves-effect waves-light">Добавить</button>
				</div>
				<div class="col s2">
					<div class="results">
						<p>Сумма: <b class="light-blue-text sum" data-currency="eur">0</b></p>
						<p>Скидка: <b class="green-text discount" data-currency="eur">0</b></p>
						<p>К оплате: <b class="light-blue-text total" data-currency="eur">0</b></p>
					</div>
					
				</div>
			</div>
			<div class="row c-f">
				<div class="col s3">
					<div class="input-field">
						<select id="hotel_accommodation" name="hotel_accommodation" class="validate" required>
					    	<option value="" disabled selected>Выберите размещение</option>
					    </select>
					    <label for="hotel_accommodation">Размещение</label>
					</div>
				</div>
				<div class="col s3">
					<div class="input-field">
						<select id="hotel_status" name="hotel_status">
					    	<option value="" disabled selected>Выберите статус</option>
					    	@foreach($hotel_statuses as $hotel_status)
								<option value="{{$hotel_status->name}}">{{$hotel_status->name}}</option>
					    	@endforeach
					    </select>
					    <label for="hotel_status">Статус</label>
					</div>
				</div>
				<div class="col s3">
					<p>
				      <label>
				        <input type="checkbox" />
				        <span>Отправить статус по e-mail</span>
				      </label>
				    </p>
				    <p>
				      <label>
				        <input type="checkbox" />
				        <span>Отправить статус на WhatsApp</span>
				      </label>
				    </p>
				</div>
				<div class="col s3">
					<button id="send_status" class="btn waves-effect waves-light">Отправить</button>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<h6>Отели</h6>
					<div id="hotels_list"></div>
				</div>
			</div>
		</div>

		<div id="services" class="container frame">
			<div class="convert c-f">
				<span data-convert="kzt">₸</span>
				<span data-convert="usd">$</span>
				<span data-convert="eur" class="active">€</span>
			</div>
			<div class="row c-f">
				<div class="col s3">
					<div class="input-field">
						<input id="service_name" name="service_name" type="text" required class="validate autocomplete" placeholder="Название услуги">
	          			<label for="service_name">Добавить услугу</label>
					</div>
				</div>
				<div class="col s3">
					<div class="input-field inline-field">
						<input id="service_from" name="service_from" type="text" required class="validate datepicker" placeholder="">
	          			<label for="service_from">Дата от</label>
					</div>
					<div class="input-field inline-field">
						<input id="service_to" name="service_to" type="text" required class="validate datepicker" placeholder="">
	          			<label for="service_to">Дата до</label>
					</div>
				</div>
				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="service_sum" name="service_sum" type="text" required class="validate" placeholder="">
	          			<label for="service_sum">Сумма</label>
					</div>
				</div>
				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="service_discount" name="service_discount" required type="text" class="validate" placeholder="">
	          			<label for="service_discount">Скидка</label>
					</div>
				</div>
				<div class="col s2">
					<button id="add_service" class="btn waves-effect waves-light">Добавить</button>
				</div>
				<div class="col s2">
					<div class="results">
						<p>Сумма: <b class="light-blue-text sum" data-currency="eur">0</b></p>
						<p>Скидка: <b class="green-text discount" data-currency="eur">0</b></p>
						<p>К оплате: <b class="light-blue-text total" data-currency="eur">0</b></p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12">
					<h6>Услуги</h6>
					<div id="services_list"></div>
				</div>
			</div>

		</div>

		<div id="payments" class="container frame">

			<div class="convert c-f">
				<span data-convert="kzt">₸</span>
				<span data-convert="usd">$</span>
				<span data-convert="eur" class="active">€</span>
			</div>
			<div class="row c-f">
				<div class="col s3">
					<div class="input-field">
						<input id="payment_name" name="payment_name" type="text" required class="validate autocomplete" placeholder="За что оплата">
	          			<label for="payment_name">Добавить платеж</label>
					</div>
				</div>
				<div class="col s2">
					<div class="input-field">
						<input id="payment_date" name="payment_date" type="text" required class="validate datepicker" placeholder="">
	          			<label for="payment_date">Дата</label>
					</div>
				</div>
				<div class="col s1">
					<div class="input-field create-field" data-currency="eur">
						<input id="payment_sum" name="payment_sum" type="text" required class="validate" placeholder="">
	          			<label for="payment_sum">Сумма</label>
					</div>
				</div>
				<div class="col s2 center-align">
					<button id="add_payment" class="btn btn-width waves-effect waves-light">Добавить</button>
				</div>
				<div class="col s4">
					<div class="results">
						<p>Штрафы: <b class="red-text penalty" data-currency="eur">0</b> <span style="padding-left:20px">Оплаты: <b class="light-blue-text total" data-currency="eur">0</b></span></p>
						<p>Возвраты: <b class="light-blue-text annul" data-currency="eur">0</b></p>
					</div>
				</div>
			</div>
			<div class="row c-f">
				<div class="col s6">
					<div class="input-field">
			        	<textarea id="payment_note" name="payment_note" class="materialize-textarea" placeholder="Напишите примечание к оплате"></textarea>
			        	<label for="payment_note">Примечание</label>
			        </div>
				</div>
				<div class="col s2 center-align">
					<div class="file-field">
						<div class="btn btn-width blue-grey waves-effect waves-light">
					    	<span>Cкан оплаты</span>
					    	<input id="payment_scan" type="file">
					    </div>
					</div>
					<button id="send_payment" class="btn btn-width blue-grey waves-effect waves-light">Отправить</button>
				</div>
				<div class="col s4">
					<p>
				      <label style="padding-right: 20px">
				        <input type="checkbox" id="penalty" name="penalty" class="filled-in red" />
				        <span><b>Штраф</b></span>
				      </label>
				      <label>
				        <input type="checkbox" id="annul" name="annul" class="filled-in red" />
				        <span><b>Аннулировать</b></span>
				      </label>
				    </p>
				    <p>
				      <label>
				        <input type="checkbox" class="filled-in" />
				        <span>Отправить чек на почту заказчику</span>
				      </label>
				    </p>
				    <p>
				      <label>
				        <input type="checkbox" class="filled-in" />
				        <span>Отправить чек на WhatsApp</span>
				      </label>
				    </p>
				    <p>
				      <label>
				        <input type="checkbox" class="filled-in" />
				        <span>Отправить отчёт на почту pdf</span>
				      </label>
				    </p>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<h6>История платежей</h6>
					<div id="payments_list"></div>
				</div>
			</div>
		</div>

		<div id="totals" class="container frame">

			<div class="convert c-f">
				<span data-convert="kzt">₸</span>
				<span data-convert="usd">$</span>
				<span data-convert="eur" class="active">€</span>
			</div>
			<div class="row c-f">
				<div class="col s2">
					<p>Скидка: <b class="green-text">-300 €</b></p>
					<p>Итого: <b class="light-blue-text">4,860 €</b></p>
				</div>
				<div class="col s2">
					<p>Оплачено: <b class="light-blue-text">1,180 €</b></p>
					<p>Всего к оплате: <b class="light-blue-text">3,680 €</b></p>
				</div>
				<div class="col s2">
					<p>Сумма штрафа: <b class="red-text">-500 €</b></p>
					<p>К возврату: <b class="light-blue-text">680 €</b></p>
				</div>
				<div class="col s4">
					<p>
				      <label>
				        <input type="checkbox" class="filled-in" />
				        <span>Отправить заявку поставщику</span>
				      </label>
				    </p>
				</div>
				<div class="col s2">
					<div class="input-field">
						<select id="requisites" name="requisites">
					    	<option value="" disabled selected>Выбрать</option>
					    	<option value="1">Option 1</option>
					    	<option value="2">Option 2</option>
					    	<option value="3">Option 3</option>
					    </select>
					    <label for="requisites">Реквизиты</label>
					</div>
				</div>
			</div>
			<div class="row c-f">
				<div class="col s6">
					<div class="input-field">
			        	<textarea id="invoice_note" name="invoice_note" class="materialize-textarea" placeholder="Напишите примечание для себя"></textarea>
			        	<label for="invoice_note">Примечание</label>
			        </div>
				</div>
				<div class="col s4">
					<p>Что отпавляем для заказчика</p>
					<p>
				      <label style="padding-right: 26px">
				        <input type="checkbox" class="filled-in" />
				        <span><b>invoice на e-mail</b></span>
				      </label>
				      <label>
				        <input type="checkbox" class="filled-in" />
				        <span><b>invoice WhatsApp</b></span>
				      </label>
				    </p>
				    <p>
				      <label style="padding-right: 20px">
				        <input type="checkbox" class="filled-in" />
				        <span><b>voucher на e-mail</b></span>
				      </label>
				      <label>
				        <input type="checkbox" class="filled-in" />
				        <span><b>voucher WhatsApp</b></span>
				      </label>
				    </p>
				</div>
				<div class="col s2">
					<div class="input-field">
						<select id="requisites" name="requisites">
					    	<option value="" disabled selected>Выбрать</option>
					    	<option value="1">Option 1</option>
					    	<option value="2">Option 2</option>
					    	<option value="3">Option 3</option>
					    </select>
					    <label for="requisites">Статус платежа</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 right-align">
					<button id="send_payment" class="btn blue-grey waves-effect waves-light">Отправить</button>
					<button id="cancel" onclick="location.reload()" class="btn blue-grey waves-effect waves-light">Отменить</button>
					<button id="create_voucher" class="btn blue-grey waves-effect waves-light">Ваучер</button>
					<button id="create_invoice" class="btn blue-grey waves-effect waves-light">Инвойс</button>
					<button id="save" class="btn waves-effect waves-light">Сохранить</button>
				</div>
			</div>
		</div>

	</div> <!-- #invoice -->
@endsection

@push('js')
<script src="{{ asset('js/invoice.js') }}"></script>
	
<script>
	$(function() {

		$('#transfer.autocomplete').autocomplete({
			data: {
				@foreach($managers as $manager)
					"{{$manager->name}}" : "{{asset('/uploads/' . $manager->avatar)}}",
				@endforeach
			}
		});

		$('#customer.autocomplete').autocomplete({
			data: {
				@foreach($customers as $customer)
					"{{$customer->name}}" : null,
				@endforeach
			}
		});

		$('#tourist.autocomplete').autocomplete({
			data: {
				@foreach($tourists as $tourist)
					"{{$tourist->name}}" : null,
				@endforeach
			}
		});

		$('#hotel_name').autocomplete({
			data: {
				@foreach($hotels as $hotel)
					"{{$hotel->name}}" : null,
				@endforeach
			},
			onAutocomplete: function() {
				var hotel_name = $('#hotel_name').val();
				$.get( "{{route('getAccommodations', '')}}/" +hotel_name, function(hotel_accommodations) {
					select = $('#hotel_accommodation');
					select.find('option:not(:first)').remove();
					hotel_accommodations.forEach(function(el, i) {
						select.append($('<option></option>').val(el).html(el));
					});
					select.formSelect();
				});
			}
		});

		$('#service_name').autocomplete({
			data: {
				@foreach($services as $service)
					"{{$service->name}}" : null,
				@endforeach
			}
		});

	});
</script>
@endpush