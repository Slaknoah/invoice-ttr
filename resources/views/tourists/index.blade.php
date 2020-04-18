@extends('layouts.app')

@section('title', 'Туристы')

@section('content')

<div class="container frame">
	<h4 class="title">Туристы</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>ФИО</th>
              <th>Телефон</th>
              <th>E-mail</th>
              <th>Пометка</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($tourists as $tourist)
        		<tr onclick="window.location='{{ route('tourists.edit',$tourist->id) }}'">
					<td>{{$tourist->name}}</td>
		            <td>{{$tourist->phone}}</td>
		            <td>{{$tourist->email}}</td>
		            <td>{{$tourist->description}}</td>
		            <td class="actions">
		            	<form action="{{ route('tourists.destroy', $tourist->id) }}" method="post">
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
    {{ $tourists->links() }}
</div>
<div class="fixed-action-btn">
  <a href="#add_tourist" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_tourist" class="modal">
	<form class="col s12" method="post" action="{{ route('tourists.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление туриста</h4>
		    <div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">account_circle</i>
	        		<input id="name" type="text" name="name" class="validate">
	        		<label for="name">ФИО</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s6">
		        	<i class="material-icons prefix">phone</i>
		        	<input id="phone" type="tel" name="phone" class="validate">
		        	<label for="phone">Телефон</label>
		        	<span class="helper-text">Обязательное поле</span>
		        </div>
		        <div class="input-field col s6">
		        	<i class="material-icons prefix">email</i>
		        	<input id="email" type="email" name="email" class="validate">
		        	<label for="email">E-mail</label>
		        </div>
		        <div class="input-field col s12">
		        	<i class="material-icons prefix">info</i>
		        	<textarea id="textarea" name="description" class="materialize-textarea" class="validate"></textarea>
		        	<label for="textarea">Описание</label>
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