@extends('layouts.app')

@section('title', 'Агенты')

@section('content')

<div class="container frame">
	<h4 class="title">Агенты</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>Имя</th>
              <th>Телефон</th>
              <th>E-mail</th>
              <th>Компания</th>
              <th style="width:15%" class="center-align">Подтвержден</th>
              <th class="center-align">Дата регистрации</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($agents as $agent)
        		<tr onclick="window.location='{{ route('agents.edit',$agent->id) }}'">
		            <td>{{$agent->name}}</td>
		            <td>{{$agent->phone}}</td>
		            <td>{{$agent->email}}</td>
		            <td>{{$agent->company}}</td>
		            <td class="center-align">
		            	@if ($agent->approved)
		            		<label>
						        <input type="checkbox" checked="checked" disabled="disabled" />
						        <span></span>
						    </label>
		            	@endif
		            </td>
		            <td class="center-align">{{date('d/m/y G:i', strtotime($agent->created_at))}}</td>
		            </td>
		            <td class="actions">
		            	<form action="{{ route('agents.destroy', $agent->id) }}" method="post">
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
  <a href="#add_agent" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_agent" class="modal">
	<form class="col s12" method="post" action="{{ route('agents.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление агента</h4>
		    <div class="row">
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">account_circle</i>
	        		<input id="name" type="text" name="name" class="validate" required>
	        		<label for="name">ФИО</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
	        	<div class="input-field col s6">
		        	<i class="material-icons prefix">email</i>
		        	<input id="email" type="email" name="email" class="validate" required>
		        	<label for="email">E-mail</label>
		        	<span class="helper-text">Обязательное поле</span>
		        </div>
	        	<div class="input-field col s6">
		        	<i class="material-icons prefix">phone</i>
		        	<input id="phone" type="tel" name="phone">
		        	<label for="phone">Телефон</label>
		        </div>
	        	
		        <div class="input-field col s6">
		        	<i class="material-icons prefix">business</i>
		        	<input id="company" type="text">
		        	<label for="company">Компания</label>
		        </div>
		        <div class="input-field col s6">
			    	<label>
				        <input name="approved" type="checkbox" value="0" />
				        <span>Агент подтвержден</span>
			    	</label>
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