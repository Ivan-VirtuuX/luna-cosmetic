@extends('layouts.app')

@section('content')
    <div class="order-success">
        <div class="container d-flex justify-content-center">
            <div class="order-success-bg d-flex flex-column align-items-center">
                <p class="order-success-title text-center">Заказ <span>#{{$order->id}}</span> успешно создан</p>
                <p class="order-success-text text-center">В ближайшее время, по указанному телефону с вами свяжется наш
                    сотрудник</p>
            </div>
        </div>
    </div>
@endsection
