@extends('layouts.welcome')

@section('content')
    <section id="intro" class="d-flex align-items-center justify-content-center">
        <div class="welcome-container">
            <div class="d-flex align-items-center justify-content-between intro-block">
                <img src="{{asset("img/intro/intro-1.png")}}" alt="intro img" class="intro-img">
                <div class="d-flex flex-column align-items-center">
                    <p class="intro-title">LUNA</p>
                    <p class="intro-description text-center">Натуральная косметика<br>для бережного ухода за кожей
                    </p>
                </div>
                <img src="{{asset("img/intro/intro-2.png")}}" alt="intro img" class="intro-img">
            </div>
        </div>
    </section>
    <section id="products" class="d-flex align-items-center justify-content-center">
        <div class="products-inner welcome-container d-flex align-items-center justify-content-between">
            <div class="products-left">
                <p class="products-left-title">ПРОДУКТЫ</p>
                <p class="products-left-description">Лучшая продукция для наших клиентов</p>
                <a class="products-left-btn" href="{{route("product.index")}}">Смотреть все</a>
            </div>
            <div class="products-right d-flex align-items-center">
                <div
                    class="products-right-product products-right-product-1 d-flex flex-column align-items-center justify-content-end">
                    <span class="products-right-product-title">Gentle</span>
                    <span class="products-right-product-description">крем для лица</span>
                    <a href="{{route("product.show", "1")}}" class="products-right-product-btn">Подробнее</a>
                </div>
                <div
                    class="products-right-product products-right-product-2 d-flex flex-column align-items-center justify-content-end">
                    <span class="products-right-product-title">Silk</span>
                    <span class="products-right-product-description">минеральная пудра</span>
                    <a href="{{route("product.show", "2")}}" class="products-right-product-btn">Подробнее</a>
                </div>
                <div
                    class="products-right-product products-right-product-3 d-flex flex-column align-items-center justify-content-end">
                    <span class="products-right-product-title">Rose</span>
                    <span class="products-right-product-description">крем для лица</span>
                    <a href="{{route("product.show", "3")}}" class="products-right-product-btn">Подробнее</a>
                </div>
            </div>
        </div>
    </section>
    <section id="new-collection" class="d-flex align-items-center justify-content-end">
        <div class="welcome-container">
            <div class="new-collection-inner d-flex justify-content-end">
                <div>
                    <p class="new-collection-title">Встречайте весну<br>вместе с нами</p>
                    <p class="new-collection-description">Попробуйте новую коллекцию ухаживающих средств для лица<br>с
                        SPF защитой</p>
                </div>
            </div>
        </div>
    </section>
    <section id="individual-selection" class="d-flex align-items-center justify-content-end">
        <div class="welcome-container d-flex position-relative">
            <div class="individual-selection-left">
                <div>
                    <p class="individual-selection-title">Индивидуальный подбор косметики</p>
                    <div class="individual-selection-description d-flex flex-column">
                        <p class="individual-selection-description-paragraph">Не всегда очевидно, какие элементы<br>и
                            минералы
                            необходимы
                            коже,<br>а многочисленные эксперименты<br>с разными средствами только<br>ухудшают ее
                            качество.<br>
                        </p>
                        <p class="individual-selection-description-paragraph">Заполните
                            анкету, и мы подберем<br>уход, подходящий именно вам, учитывая ваш образ жизни</p>
                    </div>
                </div>
                <button id="openModal" class="individual-selection-btn">Заполнить анкету</button>

                <div id="surveyModal" class="modal cosmetic-survey-modal align-items-center justify-content-center">
                    <div class="modal-content">
                        <div class="modal-title-block d-flex align-items-center justify-content-between">
                            <p class="modal-content-title">Подбор косметики</p>
                            <span class="close">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.0938 8.90625L8.90625 21.0938M8.90625 8.90625L21.0938 21.0938"
                                          stroke="#122947" stroke-width="2.8125"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>

                        <div id="recommendations" class="recommendations" style="display: none;"></div>
                        <button id="resetSurveyButton" onclick="resetSurvey()" class="modal-button"
                                style="display: none;">Заполнить заново
                        </button>

                        <form id="cosmeticSurvey">
                            <div class="form-group">
                                <label for="skinType" class="cosmetic-survey-label">Тип кожи:</label>
                                <select class="form-control" id="skinType">
                                    <option value="normal" selected>Нормальная</option>
                                    <option value="dry">Сухая</option>
                                    <option value="oily">Жирная</option>
                                    <option value="combination">Комбинированная</option>
                                    <option value="sensitive">Чувствительная</option>
                                </select>
                            </div>
                            <div class="form-group skinIssue-block">
                                <label for="skinIssue" class="cosmetic-survey-label">Основные проблемы кожи:</label>
                                <select multiple class="form-control" id="skinIssue">
                                    <option value="acne">Акне</option>
                                    <option value="pigmentation">Пигментация</option>
                                    <option value="wrinkles">Морщины</option>
                                    <option value="sensitivity">Чувствительность</option>
                                    <option value="loss_of_elasticity">Потеря упругости</option>
                                </select>
                            </div>

                            <button type="button" onclick="submitSurvey()" class="modal-button">Подобрать</button>
                        </form>
                    </div>
                </div>
            </div>
            <img class="position-absolute individual-selection-img"
                 src="{{asset("/img/individual-selection/individual-selection-bg.png")}}"
                 alt="individual selection bg">
        </div>
    </section>
    <section id="skin-care">
        <div class="skin-care-inner  d-flex align-items-center justify-content-center">
            <p class="skin-care-text text-center">Мы стремимся сделать уход за кожей доступным
                и приятным ритуалом для всех, кто хочет
                заботиться о себе и своем теле</p>
        </div>
    </section>
    <section id="contacts">
        <div class="contacts container d-flex justify-content-between">
            <div class="contacts-left">
                <p class="contacts-left-title">Контакты</p>
                <ul class="contacts-left-contacts">
                    <li class="contacts-left-contacts-item">
                        <p class="contacts-left-contacts-item-title">Адрес</p>
                        <p class="contacts-left-contacts-item-text">Санкт-Петербург,<br>ул. Большая Конюшенная, 19</p>
                    </li>
                    <li class="contacts-left-contacts-item">
                        <p class="contacts-left-contacts-item-title">Телефон</p>
                        <p class="contacts-left-contacts-item-text">+7 (923) 845-74-67</p>
                    </li>
                    <li class="contacts-left-contacts-item">
                        <p class="contacts-left-contacts-item-title">E-mail</p>
                        <p class="contacts-left-contacts-item-text">info@luna.ru</p>
                    </li>
                </ul>
            </div>
            <img src="{{asset("/img/contacts/contacts-map.png")}}" alt="map">
        </div>
    </section>
    <script src="{{asset("scripts/cosmeticSurvey.js")}}"></script>
@endsection
