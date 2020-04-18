@extends('layouts.app')

@section('title', 'Редактирование услуги')

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование услуги</h4>
	<form class="col s12" method="post" action="{{ route('services.update', $service->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
        	<div class="input-field col s12">
        		<i class="material-icons prefix">directions</i>
        		<input id="name" type="text" name="service_name" class="validate" value="{{ $service->name }}">
        		<label for="name">Название услуги</label>
        		<span class="helper-text">Обязательное поле</span>
        	</div>
    	</div>
		<a href="{{ route('services.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
	    <button class="btn right" type="submit" name="action">Сохранить</button>
	</form>
	
</div>

@endsection
