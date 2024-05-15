@extends('layouts.checkout')

@section('content')
    <div class="order">
        <div class="container">
            <div class="position-relative">
                <h2 class="order-products-title">Содержание заказа</h2>
                @if(isset($products))
                    <div class="d-flex justify-content-between order-products-container">
                        <div class="d-flex flex-column order-products">
                            @foreach($products as $product)
                                <a href="{{route('product.show', $product["id"])}}" class="text-decoration-none">
                                    <div class="product-bg d-flex">
                                        <div class="product-image-container">
                                            <img src="/img/products/{{ $product["image_url"] ?? $product["imageUrl"] }}"
                                                 alt="product img">
                                        </div>
                                        <div class="product-text-block d-flex flex-column justify-content-between">
                                            <div>
                                                <p class="product-title">{{ $product["title"] }}</p>
                                                <p class="product-desc">{{ $product["desc"]}}</p>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <p class="product-price d-flex align-items-center">
                                                            {{ $product["price"] }}
                                                            <img
                                                                class="product-price-rouble" src="/svg/rouble.svg"
                                                                alt="rouble icon">
                                                        </p>
                                                        <span
                                                            class="order-product-quantity">x {{ $product["quantity"] }}</span>
                                                    </div>
                                                    <div class="order-product-total-price d-flex align-items-center">
                                                        Итого: {{ $product["price"] * $product["quantity"] }}<img
                                                            class="product-price-rouble" src="/svg/rouble.svg"
                                                            alt="rouble icon">
                                                    </div>
                                                </div>
                                                <p class="product-amount">{{ $product["amount"]}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="order-form-bg">
                            <form
                                method="post"
                                action="{{ route('order.process-product') }}"
                            >
                                @csrf

                                <input type="hidden" name="products" value="{{ json_encode($products) }}">

                                <h2 class="order-form-title">Оформление</h2>
                                <div class="order-form-input-fields gap-4 d-flex flex-column align-items-center">
                                    <input
                                        placeholder="ФИО"
                                        id="fullname"
                                        type="text"
                                        class="order-form-input"
                                        name="fullname"
                                        value="{{ old('fullname') }}"
                                        required
                                        autocomplete="fullname"
                                        autofocus
                                    >
                                    <input
                                        placeholder="Адрес"
                                        id="address"
                                        type="text"
                                        class="order-form-input"
                                        name="address"
                                        value="{{ old('address') }}"
                                        required
                                        autocomplete="address"
                                        autofocus
                                    >
                                    <input
                                        placeholder="Телефон"
                                        id="phone_number"
                                        type="text"
                                        class="order-form-input"
                                        name="phone_number"
                                        value="{{ old('phone_number') }}"
                                        required
                                        autocomplete="phone_number"
                                        autofocus
                                    >
                                </div>
                                <div class="order-total-price-block d-flex align-items-center">
                                    <p class="order-total-price-block-title">
                                        Общая сумма: <span
                                            class="order-total-price-block-price">{{ $total_price }}</span>
                                    </p>
                                    <span>
                                        <img class="order-total-price-block-rouble" src="/svg/rouble.svg"
                                             alt="rouble icon">
                                    </span>
                                </div>
                                <button type="submit" class="order-form-submit-btn">
                                    Подтвердить
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fullnameInput = document.getElementById('fullname');
            const addressInput = document.getElementById('address');
            const phoneNumberInput = document.getElementById('phone_number');
            const submitBtn = document.querySelector('.order-form-submit-btn');

            function checkFields() {
                const fullname = fullnameInput.value.trim();
                const address = addressInput.value.trim();
                const phoneNumber = phoneNumberInput.value.trim();

                submitBtn.disabled = !fullname || !address || !phoneNumber;
            }

            checkFields();

            fullnameInput.addEventListener('input', checkFields);
            addressInput.addEventListener('input', checkFields);
            phoneNumberInput.addEventListener('input', checkFields);
        });
    </script>
@endsection
