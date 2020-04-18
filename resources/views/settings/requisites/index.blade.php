@extends('layouts.app')

@section('title', 'Реквизиты компании')

@section('content')

<div class="container frame">
	<h4 class="title">Реквизиты компании</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>Название</th>
              <th>Данные</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($requisites as $requisite)
        		<tr onclick="window.location='{{ route('requisites.edit',$requisite->id) }}'">
		            <td>{{$requisite->name}}</td>
		            <td style="white-space:pre-line">{{$requisite->data}}</td>
		            <td class="actions">
		            	<form action="{{ route('requisites.destroy', $requisite->id) }}" method="post">
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
</div>
<div class="fixed-action-btn">
  <a href="#add_req" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_req" class="modal">
	<form class="col s12" method="post" action="{{ route('requisites.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление реквизита</h4>
		    <div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="requisite_name" type="text" name="requisite_name" class="validate">
	        		<label for="requisite_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s12">
		        	<i class="material-icons prefix">notes</i>
		        	<textarea id="requisite" class="materialize-textarea" name="requisite" class="validate"></textarea>
		        	<label for="requisite">Данные</label>
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