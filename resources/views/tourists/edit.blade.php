@extends('layouts.app')

@section('title', 'Редактирование туриста')

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование туриста</h4>
	<form class="col s12" method="post" action="{{ route('tourists.update', $tourist->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
        	<div class="input-field col s12">
        		<i class="material-icons prefix">account_circle</i>
        		<input id="name" type="text" name="name" class="validate" value="{{ $tourist->name }}">
        		<label for="name">ФИО</label>
        		<span class="helper-text">Обязательное поле</span>
        	</div>
	        <div class="input-field col s6">
	        	<i class="material-icons prefix">phone</i>
	        	<input id="phone" type="tel" name="phone" class="validate" value="{{ $tourist->phone }}">
	        	<label for="phone">Телефон</label>
	        	<span class="helper-text">Обязательное поле</span>
	        </div>
	        <div class="input-field col s6">
	        	<i class="material-icons prefix">email</i>
	        	<input id="email" type="email" name="email" class="validate" value="{{ $tourist->email }}">
	        	<label for="email">E-mail</label>
	        </div>
	        <div class="input-field col s12">
	        	<i class="material-icons prefix">info</i>
	        	<textarea id="textarea" name="description" class="materialize-textarea" class="validate">{{ $tourist->description }}</textarea>
	        	<label for="textarea">Описание</label>
	        </div>
    	</div>
		<a href="{{ route('tourists.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
	    <button class="btn right" type="submit" name="action">Сохранить</button>
	</form>
	
</div>
@endsection
