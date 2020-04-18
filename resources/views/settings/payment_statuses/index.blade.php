@extends('layouts.app')

@section('title', 'Статусы платежа')

@section('css')
    <link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container frame">
	<h4 class="title">Статусы платежа</h4>
	<table class="editable">
        <thead>
          <tr>
              <th>Название</th>
              <th style="width:20%" class="center-align">Время уведомления</th>
              <th style="width:20%" class="center-align">Текст уведомления</th>
              <th style="width:50px"></th>
          </tr>
        </thead>

        <tbody>
        	@foreach($payment_statuses as $payment_status)
        		<tr onclick="window.location='{{ route('payment_statuses.edit',$payment_status->id) }}'">
		            <td>{{$payment_status->name}}</td>
		            <td class="center-align">
		            	@if (!empty($payment_status->days))
		            		<span class="new badge">{{$payment_status->days}} д.</span>
		            	@endif
		            </td>
		            <td class="center-align">
		            	@if (!empty($payment_status->notification))
		            		<label>
						        <input type="checkbox" checked="checked" disabled="disabled" />
						        <span></span>
						    </label>
		            	@endif
		            </td>
		            <td class="actions">
		            	<form action="{{ route('payment_statuses.destroy', $payment_status->id) }}" method="post">
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
  <a href="#add_popup" class="btn-floating btn-large red waves-effect waves-light modal-trigger">
    <i class="large material-icons">add</i>
  </a>
</div>

<div id="add_popup" class="modal">
	<form class="col s12" method="post" action="{{ route('payment_statuses.store') }}">
		{{csrf_field()}}
	    <div class="modal-content">
		    <h4>Добавление статуса платежа</h4>
		    <div class="row">
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="payment_status_name" type="text" name="payment_status_name" class="validate">
	        		<label for="payment_status_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
	        	<div class="input-field col s6">
					<select name="days">
				    	<option value="" disabled selected>Выберите кол-во дней</option>
				    	<option value="1">За 1 день</option>
				    	<option value="2">За 2 дня</option>
				    	<option value="3">За 3 дня</option>
				    	<option value="5">За 5 дней</option>
				    	<option value="10">За 10 дней</option>
				    </select>
					<label>Время уведомления</label>
				</div>
		        <div class="input-field col s12">
					<p>Текст уведомления</p>
					<input type="hidden" name="notification">
        			<div class="quill" id="notification"></div>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script>
		$(function() {

			// configure Quill to use inline styles so the email's format properly
	        var DirectionAttribute = Quill.import('attributors/attribute/direction');
	        Quill.register(DirectionAttribute,true);

	        var AlignClass = Quill.import('attributors/class/align');
	        Quill.register(AlignClass,true);

	        var BackgroundClass = Quill.import('attributors/class/background');
	        Quill.register(BackgroundClass,true);

	        var ColorClass = Quill.import('attributors/class/color');
	        Quill.register(ColorClass,true);

	        var DirectionClass = Quill.import('attributors/class/direction');
	        Quill.register(DirectionClass,true);

	        var SizeClass = Quill.import('attributors/class/size');
	        Quill.register(SizeClass,true);

	        var AlignStyle = Quill.import('attributors/style/align');
	        Quill.register(AlignStyle,true);

	        var BackgroundStyle = Quill.import('attributors/style/background');
	        Quill.register(BackgroundStyle,true);

	        var ColorStyle = Quill.import('attributors/style/color');
	        Quill.register(ColorStyle,true);

	        var DirectionStyle = Quill.import('attributors/style/direction');
	        Quill.register(DirectionStyle,true);

	        var SizeStyle = Quill.import('attributors/style/size');
	        Quill.register(SizeStyle,true);

	        var toolbarOptions = [
	          [{ 'header': [1, 2, 3, 4, false] }],
	          [{ 'align': [] }],
			  ['bold', 'italic', 'underline'],
			  
			  [{ 'list': 'ordered'}, { 'list': 'bullet' }],

			  [{ 'color': [] }, { 'background': [] }],

			  ['clean']
			];

			var notification = new Quill('#notification', {
				modules: {
					toolbar: toolbarOptions
				},
				theme: 'snow'
			});

			$('.modal form').submit(function() {
				if (notification.getText().trim().length != 0) {
					$('[name="notification"]').val(JSON.stringify(notification.getContents()));
				}
			});
		});
	</script>
@endpush