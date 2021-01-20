<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')
            {{ config('app.name') }}
        @show
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        @if(!Auth::user() || Auth::user()->role === 0)
            <x-header></x-header>
        @elseif(Auth::user()->role === 1)
            <x-headerAdmin></x-headerAdmin>
        @endif
        

        <main role="main" class="container">
            @yield('content')
        </main>

        <x-footer></x-footer>

    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>