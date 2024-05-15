<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome', ['container' => 'welcome-container']);
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/profile', [ProfileController::class, "show"])->name('profile');

Route::get('/products', [ProductController::class, "products"])->name('product.index');
Route::any('/products/{product}', [ProductController::class, "show"])->name('product.show');

Route::get('/cart', [CartController::class, "show"])->name('cart');

Route::middleware("auth")->group(function () {
    Route::get('/order/create', [OrderController::class, "create"])->name('order.create');
    Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/order/process-product', [OrderController::class, 'processProductOrder'])->name('order.process-product');
    Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');

    Route::post('/cart/add-product', [CartController::class, "add"])->name('cart.add');
    Route::delete('/cart/remove-product', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/get', [CartController::class, "get"])->name('cart.get');
});


