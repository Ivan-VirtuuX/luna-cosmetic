@extends('layouts.app')

@section('content')
    <div class="background">
        <div class="auth-form container d-flex justify-content-center">
            <div class="auth-form-bg">
                <form method="post" action="{{ route('register') }}" onsubmit="populateCartItems()">
                    @csrf

                    <input type="hidden" name="cart_items" id="cart_items">

                    <h2 class="auth-form-title">Регистрация</h2>

                    <div class="auth-form-input-fields gap-4 d-flex flex-column align-items-center">
                        <div class="auth-form-input-container">
                            <input placeholder="Email" id="email" type="email"
                                   class="auth-form-input @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="auth-form-input-container">
                            <input placeholder="Пароль" id="password" type="password"
                                   class="auth-form-input @error('password') is-invalid @enderror" name="password"
                                   required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="auth-form-input-container">
                            <input placeholder="Повторите пароль" id="password-confirm" type="password"
                                   class="auth-form-input"
                                   name="password_confirmation" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between gap-2 form-buttons-register">
                        <a href="/login" class="auth-form-register-link">Вход</a>
                        <button type="submit" class="auth-form-submit-btn">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('scripts/productForm.js') }}"></script>
@endsection
