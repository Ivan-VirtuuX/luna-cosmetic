@extends('layouts.app')

@section('content')
    <div class="about">
        <div class="container d-flex">
            <div>
                <h2 class="about-title">О нас</h2>
                <div class="d-flex about-text-block">
                    <div>
                        <p class="about-description">
                            Мы - интернет-магазин косметики Luna, предлагаем вам широкий ассортимент качественной
                            косметики
                            для ухода за кожей лица и тела. Наша косметика производится из натуральных и экологически
                            чистых
                            ингредиентов, чтобы вы могли наслаждаться заботой о своей коже безопасно и эффективно.
                        </p>
                        <p class="about-description">
                            Наша команда состоит из квалифицированных специалистов в области красоты и здоровья, которые
                            следят за последними тенденциями в мире косметологии, чтобы предложить вам самые
                            инновационные и
                            эффективные продукты.
                        </p>
                    </div>
                    <div>
                        <img class="about-img"
                             src="{{asset('img/about/about.png')}}"
                             alt="about img">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

