@extends('layouts.app')

@section('title', 'Настройки')

@section('css')
    <link href="{{ asset('css/quill.css') }}" rel="stylesheet">
@endsection

@push('js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush

@section('content')

    <form method="post" action="{{ route('settings.store') }}">
        {!! csrf_field() !!}

        @if(count(config('setting_fields', [])) )

            @foreach(config('setting_fields') as $section => $fields)
                <div class="container frame">
                    <div class="row">
                        <div class="col s12">
                            <h4 class="title">{{ $fields['title'] }}</h4>
                        </div>

                        @foreach($fields['elements'] as $field)
                            @includeIf('fields.' . $field['type'] )
                        @endforeach

                    </div>
                </div>
            @endforeach

        @endif
		
		<div class="fixed-action-btn">
		  <button class="btn-floating btn-large red waves-effect waves-light">
		    <i class="large material-icons">save</i>
		  </button>
		</div>

    </form>
@endsection

@push('js')
	<script>
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
	</script>
@endpush