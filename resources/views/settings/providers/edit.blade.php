@extends('layouts.app')

@section('title', 'Редактирование поставщика')

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование поставщика</h4>
	<form class="col s12" method="post" action="{{ route('providers.update', $provider->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
	    	<div class="row">
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="provider_name" type="text" name="provider_name" class="validate" value="{{$provider->name}}">
	        		<label for="provider_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s6">
	        		<i class="material-icons prefix">email</i>
	        		<input id="from_email" type="email" name="from_email" class="validate" value="{{$provider->from_email}}">
	        		<label for="from_email">Email принятия</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">phone</i>
	        		<input id="to_phone" type="text" name="to_phone" class="validate" value="{{$provider->to_phone}}">
	        		<label for="to_phone">Телефон</label>
	        		<p>
	        			@if ($provider->send_to_phone == 1)
			            	<label>
						        <input type="checkbox" checked="checked" name="send_to_phone" value="1" />
						        <span>Отправлять заявку на WhatsApp</span>
						    </label>
						@else
							<label>
						        <input type="checkbox" name="send_to_phone" value="0" />
						        <span>Отправлять заявку на WhatsApp</span>
						    </label>
						@endif
				    </p>
	        	</div>
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">email</i>
	        		<input id="to_email" type="email" name="to_email" class="validate" value="{{$provider->to_email}}">
	        		<label for="to_email">Email отправки</label>
	        		<p>
	        			@if ($provider->send_to_email == 1)
			            	<label>
						        <input type="checkbox" checked="checked" name="send_to_email" value="1" />
						        <span>Отправлять заявку на Email</span>
						    </label>
						@else
							<label>
						        <input type="checkbox" name="send_to_email" value="0" />
						        <span>Отправлять заявку на Email</span>
						    </label>
						@endif
				    </p>
	        	</div>
	    	</div>
    	</div>
		<a href="{{ route('providers.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
	    <button class="btn right" type="submit" name="action">Сохранить</button>
	</form>
	
</div>

@endsection

@push('js')
	<script>
		$(function() {
			$('input[type="checkbox"]').change( function() {
				if ($(this).is(":checked")) {
					$(this).attr('value', 1);
				}
				else {
					$(this).attr('value', 0);
				}
			});
		});
	</script>
@endpush