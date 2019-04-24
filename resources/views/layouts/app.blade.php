<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('header')
    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
            'signedIn' => Auth::check(),
            'user' => Auth::user()
        ]) !!}
    </script>

    <style>
        body {
            padding-bottom: 100px;
        }

        .level {
            display: flex;
            align-items: center;
        }

        .level-item {
            margin-right: 1em;
        }

        .flex {
            flex: 1;
        }

        [v-cloak] {
            display: none;
        }

    </style>
    @yield('head')
</head>
<body style="padding-bottom:100px">
    <div id="app">
        @include('layouts.nav')

        <main class="py-4">
            @yield('content')
        </main>

        <flash message="{{ session('flash') }}"></flash>

    </div>

    @yield('scripts')
</body>
</html>