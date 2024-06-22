@extends('layouts.app')

@section('content')
    <div class="background">
        <div class="auth-form container d-flex justify-content-center">
            <div class="auth-form-bg">
                <form method="post" action="{{ route('login') }}">
                    @csrf

                    <h2 class="auth-form-title">Вход</h2>

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
                    </div>
                    <div class="d-flex align-items-center justify-content-between form-buttons-login">
                        <a href="/register" class="auth-form-register-link">Регистрация</a>
                        <button type="submit" class="auth-form-submit-btn">
                            Войти
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
