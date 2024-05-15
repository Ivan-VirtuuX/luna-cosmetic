@extends('layouts.products')

@section('content')
    <div class="products">
        <div class="container">
            <h2 class="products-title">Все продукты</h2>

            <div class="products-list">
                @foreach($products as $product)
                    <a href="{{route('product.show', $product->id)}}" class="text-decoration-none">
                        <div class="products-list-item d-flex align-items-end"
                             style="background: url('/img/products/{{$product->image_url}}') no-repeat">
                            <div class="products-list-item-text d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <span class="products-list-item-title">{{$product->title}}</span>
                                    <span class="products-list-item-desc">{{$product->desc}}</span>
                                </div>
                                <div class="d-flex flex-column align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                    <span
                                        class="products-list-item-price">{{$product->price}}</span>
                                        <img src="/svg/rouble.svg" alt="rouble icon">
                                    </div>
                                    <span class="products-list-item-amount">{{$product->amount}}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
