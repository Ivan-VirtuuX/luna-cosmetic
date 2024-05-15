@extends('layouts.profile')

@section('content')
    <div class="profile">
        <div class="container">
            <h2 class="profile-title">Мои заказы</h2>
            <div class="">
                <a class="logout-link d-flex align-items-center" href="{{ route('logout') }}">
                    <span>Выйти</span>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.3333 10.6667L14 7.99999M14 7.99999L11.3333 5.33332M14 7.99999H4.66667M8.66667 10.6667V11.3333C8.66667 11.8638 8.45595 12.3725 8.08088 12.7475C7.70581 13.1226 7.1971 13.3333 6.66667 13.3333H4C3.46957 13.3333 2.96086 13.1226 2.58579 12.7475C2.21071 12.3725 2 11.8638 2 11.3333V4.66666C2 4.13622 2.21071 3.62752 2.58579 3.25244C2.96086 2.87737 3.46957 2.66666 4 2.66666H6.66667C7.1971 2.66666 7.70581 2.87737 8.08088 3.25244C8.45595 3.62752 8.66667 4.13622 8.66667 4.66666V5.33332"
                            stroke="black" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

            <div class="profile-orders d-flex flex-column">
                @foreach($orders as $order)
                    @php
                        $total_price = 0;

                        foreach ($order->items as $item) if ($item->order_id === $order->id) $total_price += $item->price * $item->quantity;
                    @endphp
                    <div>
                        <div class="profile-order-header">
                            <div>
                                <div
                                    class="d-flex align-items-center justify-content-between profile-order-header-info">
                                    <div class="d-flex align-items-center">
                                        <p class="order-number-title">Заказ #{{ $order->id }}</p>
                                        @if($order->status === "processing")
                                            <span class="order-status-processing">В процессе</span>
                                        @elseif($order->status === "completed")
                                            <span class="order-status-completed">Выполнен</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="order-date">{{ $order->created_at->format('d.m.Y') }}
                                            в {{ $order->created_at->format('H:i') }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="order-total-price">Итого: {{ $total_price }}</p>
                                    <img class="order-rouble" src="/svg/rouble.svg" alt="rouble icon">
                                </div>
                            </div>
                        </div>
                        <div class="profile-order-products d-flex flex-column">
                            @foreach($order->items as $item)
                                <a href="{{route('product.show', $item->product->id)}}"
                                   class="product-container text-decoration-none">
                                    <div class="product-bg d-flex">
                                        <div class="product-image-container">
                                            <img src="/img/products/{{ $item->product->image_url }}"
                                                 alt="product img">
                                        </div>
                                        <div class="product-text-block d-flex flex-column justify-content-between">
                                            <div>
                                                <p class="product-title">{{ $item->product->title }}</p>
                                                <p class="product-desc">{{ $item->product->desc }}</p>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <p class="product-price d-flex align-items-center">
                                                        {{ $item->price }}
                                                        <img
                                                            class="product-price-rouble" src="/svg/rouble.svg"
                                                            alt="rouble icon">
                                                    </p>
                                                    <span
                                                        class="order-product-quantity">x {{ $item->quantity }}</span>
                                                </div>
                                                <div class="order-product-total-price d-flex align-items-center">
                                                    Итого: {{ $item->price * $item->quantity }}<img
                                                        class="product-price-rouble" src="/svg/rouble.svg"
                                                        alt="rouble icon">
                                                </div>
                                            </div>

                                            <p class="product-amount">{{ $item->amount }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <script src="{{ asset('scripts/logout.js') }}"></script>
        </div>
@endsection
