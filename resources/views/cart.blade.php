@extends('layouts.cart')

@section('content')
    <div class="cart-products">
        <div class="container">
            <h2 class="cart-products-title">Корзина</h2>
            <div class="cart-products-list-container d-flex justify-content-between">
                <div class="cart-products-list d-flex flex-column">
                    @foreach($cart_products as $cart_product)
                        <div class="cart-products-list-item-container position-relative"
                             data-id="{{ $cart_product['product']->product->id }}"
                             data-amount="{{ $cart_product['product']->amount }}"
                        >
                            <a href="{{route('product.show', $cart_product['product']->product->id)}}"
                               class="text-decoration-none cart-products-list-item">
                                <div class="product-bg d-flex">
                                    <div class="product-image-container">
                                        <img src="/img/products/{{ $cart_product['product']->product->image_url }}"
                                             alt="product img">
                                    </div>
                                    <div class="product-text-block d-flex flex-column justify-content-between">
                                        <div>
                                            <p class="product-title">{{ $cart_product['product']->product->title }}</p>
                                            <p class="product-desc">{{ $cart_product['product']->product->desc }}</p>
                                        </div>
                                        <div>
                                            <p class="product-price d-flex align-items-center">
                                                {{ $cart_product['product']->price }}
                                                <img
                                                    class="product-price-rouble" src="/svg/rouble.svg"
                                                    alt="rouble icon">
                                            </p>
                                            <p class="product-amount">{{ $cart_product['product']->amount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="product-top-actions d-flex">
                                <button
                                    class="product-remove-from-cart-button d-flex align-items-center justify-content-center"
                                    data-id="{{ $cart_product['product']->product->id  }}"
                                    data-amount="{{ $cart_product['product']->amount }}"
                                >
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.6666 2.66667H10.3333L9.66658 2H6.33325L5.66659 2.66667H3.33325V4H12.6666M3.99992 12.6667C3.99992 13.0203 4.14039 13.3594 4.39044 13.6095C4.64049 13.8595 4.97963 14 5.33325 14H10.6666C11.0202 14 11.3593 13.8595 11.6094 13.6095C11.8594 13.3594 11.9999 13.0203 11.9999 12.6667V4.66667H3.99992V12.6667Z"
                                            fill="#AEAEAE"/>
                                    </svg>
                                </button>
                                <input
                                    type="checkbox"
                                    class="product-add-to-cart-checkbox"
                                    data-id="{{ $cart_product['product']->product->id }}"
                                    data-amount="{{ $cart_product['product']->amount }}"
                                >
                            </div>
                            <div class="quantity-controls d-flex align-items-center">
                                <button
                                    class="product-decrease-quantity-btn d-flex align-items-center justify-content-center"
                                    data-id="{{ $cart_product['product']->product->id }}"
                                    data-amount="{{ $cart_product['product']->amount }}"
                                >
                                    <span>-</span>
                                </button>
                                <span
                                    class="product-quantity"
                                    data-id="{{ $cart_product['product']->product->id }}"
                                    data-amount="{{ $cart_product['product']->amount }}"
                                >{{ $cart_product['product']->product->quantity }}</span>
                                <button
                                    class="product-increase-quantity-btn d-flex align-items-center justify-content-center"
                                    data-id="{{ $cart_product['product']->product->id  }}"
                                    data-amount="{{ $cart_product['product']->amount }}"
                                >
                                    <span>+</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form id="checkoutForm" method="post" action="{{ route('order.checkout') }}">
                    @csrf
                    <input type="hidden" name="products">

                    <div class="cart-total">
                        <div class="d-flex gap-4">
                            <div>
                                <p class="cart-total-title">Итог заказа:</p>
                                <div class="d-flex align-items-center">
                                    <span class="cart-total-price"></span>
                                    <img
                                        class="cart-total-rouble" src="/svg/rouble.svg"
                                        alt="rouble icon">
                                </div>
                            </div>
                            <div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <img class="cart-payment-logo" src="/img/payment/mastercard.png" alt="mastercard">
                                    <img class="cart-payment-logo" src="/img/payment/visa.png" alt="visa">
                                    <img class="cart-payment-logo" src="/img/payment/mir.png" alt="mir">
                                </div>
                                <p class="cart-payment-text">МЫ ПРИНИМАЕМ</p>
                            </div>
                        </div>
                        <button class="cart-total-btn" disabled type="submit">Оплатить (<span
                                class="cart-total-amount"></span>)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script> window.Auth = @json(auth()->check()); </script>
    <script src="{{ asset('scripts/getCart.js') }}"></script>
    <script src="{{ asset('scripts/cartProductQuantityHandler.js') }}"></script>
    <script src="{{ asset('scripts/cartItemRemoval.js') }}"></script>
@endsection
