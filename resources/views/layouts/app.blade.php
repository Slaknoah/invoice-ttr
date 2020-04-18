<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body>
    <div id="app">
        @yield('content')
    </div>

<!-- Scripts -->
{{-- <script src="{{ (env('APP_ENV') === 'development') ? mix('js/app.js') : asset('js/app.js') }}"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')

<script>
    @if(session()->get('success'))
        M.toast({html: '{{ session()->get('success') }}' });
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            M.toast({html: '{{ $error }}' });
        @endforeach
    @endif
</script>
</body>
</html>
