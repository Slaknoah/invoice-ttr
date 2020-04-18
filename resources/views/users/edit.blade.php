@extends('layouts.app')

@section('title', 'Редактирование агента')

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование агента</h4>
	<form class="col s12" method="post" action="{{ route('agents.update', $agent->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
        	<div class="input-field col s6">
        		<i class="material-icons prefix">account_circle</i>
        		<input id="name" type="text" name="name" class="validate" required value="{{ $agent->name }}">
        		<label for="name">ФИО</label>
        		<span class="helper-text">Обязательное поле</span>
        	</div>
	        <div class="input-field col s6">
	        	<i class="material-icons prefix">email</i>
	        	<input id="email" type="email" name="email" class="validate" required value="{{ $agent->email }}">
	        	<label for="email">E-mail</label>
	        	<span class="helper-text">Обязательное поле</span>
	        </div>
	        <div class="input-field col s6">
	        	<i class="material-icons prefix">phone</i>
	        	<input id="phone" type="tel" name="phone" value="{{ $agent->phone }}">
	        	<label for="phone">Телефон</label>
	        </div>
	        <div class="input-field col s6">
	        	<i class="material-icons prefix">business</i>
	        	<input id="company" type="text" name="company" value="{{ $agent->company }}">
	        	<label for="company">Компания</label>
	        </div>
	        <div class="input-field col s6">
	        	<p>
					@if ($agent->approved == 1)
		            	<label>
					        <input type="checkbox" checked="checked" name="approved" value="1" />
					        <span>Агент подтвержден</span>
					    </label>
					@else
						<label>
					        <input type="checkbox" name="approved" value="0" />
					        <span>Агент подтвержден</span>
					    </label>
					@endif
				</p>
	        </div>
    	</div>
		<a href="{{ route('agents.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
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