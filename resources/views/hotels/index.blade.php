@extends('layouts.app')

@section('title', 'Отели')

@section('content')

<div class="container frame">
	<h4 class="title">Отели</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>Название отеля</th>
              <th>Размещения</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($hotels as $hotel)
        		<tr onclick="window.location='{{ route('hotels.edit',$hotel->id) }}'">
		            <td>{{$hotel->name}}</td>
		            <td>
						@foreach($hotel->accommodations as $accommodation)
		            		<span class="new badge">{{$accommodation}}</span>
						@endforeach
		            </td>
		            <td class="actions">
		            	<form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
		                	{{ csrf_field() }}
		                	{{ method_field('DELETE') }}
		                	<button class="btn-flat waves-effect" type="submit" name="action">
								<i class="material-icons">clear</i>
							</button>
		            	</form>
		            </td>
		        </tr>
        	@endforeach
        </tbody>
    </table>
    {{ $hotels->links() }}
</div>
<div class="fixed-action-btn">
  <a href="#add_hotel" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_hotel" class="modal">
	<form class="col s12" method="post" action="{{ route('hotels.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление отеля</h4>
		    <div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">apartment</i>
	        		<input id="hotel_name" type="text" name="hotel_name" class="validate">
	        		<label for="hotel_name">Название отеля</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
	        	<div class="fields-wrap col s12">
	        		<p>Размещения</p>
			        <div class="input-field multiple-field col s12">
			        	<i class="material-icons prefix">hotel</i>
			        	<input id="accommodations-1" type="text" name="accommodations[]" class="validate">
			        	<label for="accommodations-1">Размещение 1</label>
			        	<button id="add-field" class="btn-flat inline-button"><i class="material-icons">add</i></button>
			        </div>
		    	</div>
	    	</div>
	    </div>
		<div class="modal-footer">
			<a href="#!" class="modal-close btn-flat waves-effect">Отмена</a>
	    	<button class="btn waves-effect" type="submit" name="action">Добавить</button>
		</div>
	</form>
</div>

@endsection

@push('js')
	<script>
		$(function() {
			var i = 2;

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