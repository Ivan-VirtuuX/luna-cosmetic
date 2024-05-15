<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Профиль</title>
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('svg/logo.svg') }}">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    @include("layouts.header")

    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
