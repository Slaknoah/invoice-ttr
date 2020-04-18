@extends('layouts.app')

@section('title', 'Список поставщиков')

@section('content')

<div class="container frame">
	<h4 class="title">Список поставщиков</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>Название</th>
              <th>Email принятия</th>
              <th>Email отправки</th>
              <th>Телефон</th>
              <th style="width:50px" class="center-align tooltipped" data-position="top" data-tooltip="Отправлять заявку на Email"><i class="material-icons prefix">mail_outline</i></th>
              <th style="width:50px" class="center-align tooltipped" data-position="top" data-tooltip="Отправлять заявку на WhatsApp"><i class="material-icons prefix">message</i></th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($providers as $provider)
        		<tr onclick="window.location='{{ route('providers.edit',$provider->id) }}'">
		            <td>{{$provider->name}}</td>
		            <td>{{$provider->from_email}}</td>
		            <td>{{$provider->to_email}}</td>
		            <td>{{$provider->to_phone}}</td>
		            <td class="center-align">
		            	@if ($provider->send_to_email == 1)
			            	<label>
						        <input type="checkbox" checked="checked" disabled="disabled" />
						        <span></span>
						    </label>
						@endif
		            </td>
		            <td class="center-align">
		            	@if ($provider->send_to_phone == 1)
			            	<label>
						        <input type="checkbox" checked="checked" disabled="disabled" />
						        <span></span>
						    </label>
						@endif
					</td>
		            <td class="actions">
		            	<form action="{{ route('providers.destroy', $provider->id) }}" method="post">
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
	<form class="col s12" method="post" action="{{ route('providers.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление поставщика</h4>
		    <div class="row">
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="provider_name" type="text" name="provider_name" class="validate">
	        		<label for="provider_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s6">
	        		<i class="material-icons prefix">email</i>
	        		<input id="from_email" type="email" name="from_email" class="validate">
	        		<label for="from_email">Email принятия</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">phone</i>
	        		<input id="to_phone" type="text" name="to_phone" class="validate">
	        		<label for="to_phone">Телефон</label>
	        		<p>
				      <label>
				        <input type="checkbox" name="send_to_phone" value="0" />
				        <span>Отправлять заявку на WhatsApp</span>
				      </label>
				    </p>
	        	</div>
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">email</i>
	        		<input id="to_email" type="email" name="to_email" class="validate">
	        		<label for="to_email">Email отправки</label>
	        		<p>
				      <label>
				        <input type="checkbox" name="send_to_email" value="0"/>
				        <span>Отправлять заявку на Email</span>
				      </label>
				    </p>
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