@extends('layouts.app')

@section('title', 'Редактирование отеля')

@section('content')

<?php $i = 1; ?>

<div class="container frame">
	<h4 class="title">Редактирование отеля</h4>
	<form class="col s12" method="post" action="{{ route('hotels.update', $hotel->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
	    	<div class="input-field col s12">
        		<i class="material-icons prefix">apartment</i>
        		<input id="hotel_name" type="text" name="hotel_name" class="validate" value="{{ $hotel->name }}">
        		<label for="hotel_name">Название отеля</label>
        		<span class="helper-text">Обязательное поле</span>
        	</div>
        	<div class="fields-wrap col s12">
	        	<p>Размещения</p>
				@if (!empty($hotel->accommodations))
		        	@foreach($hotel->accommodations as $accommodation)
				        <div class="input-field multiple-field col s12">
				        	<i class="material-icons prefix">hotel</i>
				        	<input id="accommodations-{{$i}}" type="text" name="accommodations[]" class="validate" value="{{$accommodation}}">
				        	<label for="accommodations-{{$i}}">Размещение {{$i}}</label>
				        	@if ($i == 1)
				        		<button id="add-field" class="btn-flat inline-button"><i class="material-icons">add</i></button>
				        	@else
				        		<button id="remove-field" class="btn-flat inline-button"><i class="material-icons">clear</i></button>
				        	@endif
				        </div>
				        <?php $i++ ?>
				    @endforeach
				@else
					<div class="input-field multiple-field col s12">
			        	<i class="material-icons prefix">hotel</i>
			        	<input id="accommodations-1" type="text" name="accommodations[]" class="validate">
			        	<label for="accommodations-1">Размещение 1</label>
			        	<button id="add-field" class="btn-flat inline-button"><i class="material-icons">add</i></button>
			        </div>
				@endif
			</div>
    	</div>
		<a href="{{ route('hotels.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
	    <button class="btn right" type="submit" name="action">Сохранить</button>
	</form>
	
</div>

@endsection

@push('js')
	<script>
		$(function() {
			var i = {{$i}};

			$(document).on('click', '#add-field', function(e) {
				e.preventDefault();
				$('.fields-wrap').append('<div class="input-field multiple-field col s12"><i class="material-icons prefix">hotel</i><input id="accommodations-'+i+'" type="text" name="accommodations[]" class="validate"><label for="accommodations-'+i+'">Размещение '+i+'</label><button id="remove-field" class="btn-flat inline-button"><i class="material-icons">clear</i></button></div>');
				i++;
			});

			$(document).on('click', '#remove-field', function(e) {
				$(this).parent('.multiple-field').remove();
				i--;
			});
		});
	</script>
@endpush