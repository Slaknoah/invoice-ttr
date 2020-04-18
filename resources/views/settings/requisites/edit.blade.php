@extends('layouts.app')

@section('title', 'Редактирование реквизита')

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование реквизита</h4>
	<form class="col s12" method="post" action="{{ route('requisites.update', $requisite->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
	    	<div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="requisite_name" type="text" name="requisite_name" class="validate" value="{{ $requisite->name }}">
	        		<label for="requisite_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s12">
		        	<i class="material-icons prefix">notes</i>
		        	<textarea id="requisite" class="materialize-textarea" name="requisite" class="validate">{{ $requisite->data }}</textarea>
		        	<label for="requisite">Данные</label>
		        	<span class="helper-text">Обязательное поле</span>
		        </div>
	    	</div>
    	</div>
		<a href="{{ route('requisites.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
	    <button class="btn right" type="submit" name="action">Сохранить</button>
	</form>
	
</div>

@endsection
