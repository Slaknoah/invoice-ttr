@extends('layouts.app')

@section('title', 'Редактирование статуса отеля')

@section('css')
    <link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container frame">
	<h4 class="title">Редактирование статуса отеля</h4>
	<form class="col s12" method="post" action="{{ route('hotel_statuses.update', $hotel_status->id) }}">
		{{csrf_field()}}
		{{method_field('PATCH')}}
	    <div class="row">
	    	<div class="row">
	        	<div class="input-field col s12">
	        		<i class="material-icons prefix">edit</i>
	        		<input id="hotel_status_name" type="text" name="hotel_status_name" class="validate" value="{{$hotel_status->name}}">
	        		<label for="hotel_status_name">Название</label>
	        		<span class="helper-text">Обязательное поле</span>
	        	</div>
		        <div class="input-field col s12">
					<p>E-mail текст</p>
					<input type="hidden" name="email_text">
        			<div class="quill" id="email_text"></div>
	        	</div>
	        	<div class="input-field col s12">
	        		<p>WhatsApp текст</p>
	        		<input type="hidden" name="whatsapp_text">
        			<div class="quill" id="whatsapp_text"></div>
	        	</div>
	    	</div>
    	</div>
		<a href="{{ route('hotel_statuses.index') }}" class="btn"><i class="material-icons left">keyboard_backspace</i>Назад</a>
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

			var email_text = new Quill('#email_text', {
				modules: {
					toolbar: toolbarOptions
				},
				theme: 'snow'
			});

			var whatsapp_text = new Quill('#whatsapp_text', {
				modules: {
					toolbar: toolbarOptions
				},
				theme: 'snow'
			});

			email_text.setContents({!! $hotel_status->email_text !!});
			whatsapp_text.setContents({!! $hotel_status->whatsapp_text !!});

			$('form').submit(function() {
				if (email_text.getText().trim().length != 0) {
					$('[name="email_text"]').val(JSON.stringify(email_text.getContents()));
				}
				if (whatsapp_text.getText().trim().length != 0) {
					$('[name="whatsapp_text"]').val(JSON.stringify(whatsapp_text.getContents()));
				}
			});

		});
	</script>
@endpush