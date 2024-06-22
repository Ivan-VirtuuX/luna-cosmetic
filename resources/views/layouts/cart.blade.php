<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Корзина</title>

    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('svg/logo.svg') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background: #F5F5F5">
<div id="app">
    @include("layouts.header")
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="footer-top">
            <div
                class="{{isset($container)  ? 'welcome-container' : 'container'}} d-flex justify-content-between align-items-center gap-4">
                <span class="logo">LUNA</span>
                <ul class="footer-links d-flex">
                    <li>
                        <a href="{{route('product.index')}}">Продукция</a>
                    </li>
                    <li>
                        <a href="{{route('about')}}">О нас</a>
                    </li>
                    <li>
                        <a href="/#contacts">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="{{isset($container)  ? 'welcome-container' : 'container'}}">
            <div class="footer-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center column-gap-1">
                    <span>LUNA</span>
                    <img src="/svg/copyright-icon.svg" alt="copyright">
                    <span>2024 Все права защищены</span>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
