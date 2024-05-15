@extends('layouts.product')

@section('content')
    <div class="product">
        <div class="container">
            <div class="product-inner d-flex align-items-center gap-5">
                <div class="product-img-container">
                    <img class="product-img" src="/img/products/{{$product->image_url}}" alt="product img">
                </div>
                <div class="product-info-container">
                    <div class="product-info d-flex flex-column justify-content-between">
                        <div>
                            <div class="product-info-top">
                                <p class="product-info-title">{{$product->title}}</p>
                                <p class="product-info-desc">{{$product->desc}}</p>
                            </div>
                            <p class="product-info-full-desc">{!! nl2br($product->full_desc) !!}</p>
                        </div>
                        <div>
                            <p class="product-info-uses-title">Способ применения</p>
                            <p class="product-info-uses-text">{{ $product->uses }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <form class="product-info-form" method="post"
                                  action="{{ route('order.checkout') }}"
                            >
                                @csrf

                                <input type="hidden" name="amount" value="{{ $product->amount }}">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <input type="hidden" name="products" value="{{ json_encode([$product]) }}">

                                <div class="d-flex align-items-center">
                                    <span class="product-info-amount-title">Объем:</span>
                                    <div class="d-flex align-items-center gap-3">
                                        @foreach($product->volumes as $volume)
                                            <div class="d-flex align-items-center gap-2">
                                                <input
                                                    class="product-info-amount-radio-btn"
                                                    type="radio"
                                                    name="amount"
                                                    value="{{ $volume->volume }}"
                                                    id="volume-{{ $volume->id }}"
                                                    {{ $product->volumes[0]->id === $volume->id ? 'checked' : '' }}
                                                    data-price="{{ $volume->price }}"
                                                    data-amount="{{ $volume->volume }}"
                                                    data-productId="{{ $volume->product_id }}"
                                                >
                                                <label
                                                    class="product-info-amount"
                                                    for="volume-{{ $volume->id }}">{{ $volume->volume }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center justify-content-between product-info-btn-container">
                                    <p class="product-info-price d-flex align-items-center">
                                        <span id="price"></span>
                                        <img class="product-info-price-rouble" src="/svg/rouble.svg" alt="rouble icon">
                                    </p>
                                    <div class="d-flex gap-3 flex-wrap">
                                        <button
                                            id="addToCartButton"
                                            data-productId="{{ $product->id }}"
                                            onclick="toggleCartItem(this,
                                            {{ $product->id }},
                                            '{{ $product->title }}',
                                            '{{ $product->desc }}',
                                            '{{ $product->image_url }}',
                                            getSelectedAmount())"
                                            class="product-info-btn product-info-btn-cart"
                                            type="button">Добавить в
                                            корзину
                                        </button>
                                        <button
                                            class="product-info-btn product-info-btn-buy" type="submit">Купить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script> window.Auth = @json(auth()->check()); </script>
    <script src="{{ asset('scripts/getCart.js') }}"></script>
    <script src="{{ asset('scripts/productForm.js') }}"></script>
@endsection
