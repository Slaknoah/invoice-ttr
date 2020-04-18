@extends('layouts.app')

@section('title', 'Редактирование статуса платежа')

@section('css')
    <link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование статуса платежа</h4>
	<form class="col s12" method="post" action="{{ route('payment_statuses.update', $payment_status->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
	    	<div class="row">
	        	<div class="input-field col s6">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="payment_status_name" type="text" name="payment_status_name" class="validate" value="{{$payment_status->name}}">
	        		<label for="payment_status_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
	        	<div class="input-field col s6">
					<select name="days">
						@if($payment_status->days)
				    		<option value="{{$payment_status->days}}" disabled selected>За {{$payment_status->days}} д.</option>
						@else
							<option value="" disabled selected>Выберите кол-во дней</option>
				    	@endif
				    	<option value="1">За 1 д.</option>
				    	<option value="2">За 2 д.</option>
				    	<option value="3">За 3 д.</option>
				    	<option value="5">За 5 д.</option>
				    	<option value="10">За 10 д.</option>
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
		<a href="{{ route('payment_statuses.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
	    <button class="btn right" type="submit" name="action">Сохранить</button>
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

	        var FontClass = Quill.import('attributors/class/font');
	        Quill.register(FontClass,true);

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

	        var FontStyle = Quill.import('attributors/style/font');
	        Quill.register(FontStyle,true);

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

			notification.setContents({!! $payment_status->notification !!});

			$('form').submit(function() {
				if (notification.getText().trim().length != 0) {
					$('[name="notification"]').val(JSON.stringify(notification.getContents()));
				}
			});
		});
	</script>
@endpush