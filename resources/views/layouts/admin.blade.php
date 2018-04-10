<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('before-vue-init')
    <script>
        //window.csrf = {{-- csrf_token() --}}
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @if(Auth::check() && auth()->user()->hasAdminbar())
        <div class="view with-adminbar">
            @include('partials.navbars.navbar_admin')
            @yield('navbar')
            <main>
                @yield('content')
            </main>
        </div>
    @else
        <div class="view without-adminbar">
            @yield('navbar')
            <main>
                @yield('content')
            </main>
        </div>
    @endif
</div>
</body>
</html>

