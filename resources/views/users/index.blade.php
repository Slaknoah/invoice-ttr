@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="container frame">
	<h4 class="title">{{$title}}</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>ФИО</th>
              <th>E-mail</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($users as $user)
        		<tr onclick="window.location='{{ route('users.edit',$user->id) }}'">
		            <td>{{$user->name}}</td>
		            <td>{{$user->email}}</td>
		            <td class="actions">
		            	<form action="{{ route('users.destroy', $user->id) }}" method="post">
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
  <a href="#add_user" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_user" class="modal">
	<form class="col s12" method="post" action="{{ Request::url() }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление пользователя</h4>
		    <div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">account_circle</i>
	        		<input id="name" type="text" name="name" class="validate">
	        		<label for="name">ФИО</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s6">
		        	<i class="material-icons prefix">email</i>
		        	<input id="email" type="email" name="email" class="validate">
		        	<label for="email">E-mail</label>
		        	<span class="helper-text">Обязательное поле</span>
		        </div>
		        <div class="input-field col s6">
		        	<i class="material-icons prefix">keyboard</i>
		        	<input id="password" type="password" name="password" class="validate" minlength="8" required>
		        	<label for="password">Пароль</label>
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