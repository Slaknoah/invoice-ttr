@extends('layouts.app')

@section('title', 'Услуги')

@section('content')

<div class="container frame">
	<h4 class="title">Услуги</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>Название услуги</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($services as $service)
        		<tr onclick="window.location='{{ route('services.edit',$service->id) }}'">
		            <td>{{$service->name}}</td>
		            <td class="actions">
		            	<form action="{{ route('services.destroy', $service->id) }}" method="post">
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
    {{ $services->links() }}
</div>
<div class="fixed-action-btn">
  <a href="#add_tourist" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_tourist" class="modal">
	<form class="col s12" method="post" action="{{ route('services.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление услуги</h4>
		    <div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">directions</i>
	        		<input id="name" type="text" name="service_name" class="validate">
	        		<label for="name">Название услуги</label>
	        		<span class="helper-text">Обязательное поле</span>
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
