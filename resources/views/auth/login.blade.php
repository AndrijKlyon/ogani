@extends('layouts.site')

@section('content')
<!-- Login Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Вход</h2>
                    <form data-toggle="validator" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="group-input form-group has-feedback">
                            <label for="username">Имя пользователя *</label>
                            <input type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                                data-required-error="Поле обязательно для заполнения"
                                class="form-control  @error('name') is-invalid @enderror"
                                id="username">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="group-input form-group has-feedback">
                            <label for="pass">Пароль *</label>
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                required
                                data-required-error="Поле обязательно для заполнения"
                                autocomplete="current-password"
                                id="pass">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="group-input gi-check">
                            <div class="gi-more">
                                <label for="save-pass">
                                    Запомнить меня
                                    <input type="checkbox"
                                        name="remember"
                                        {{ old('remember') ? 'checked' : '' }}
                                        id="save-pass">
                                    <span class="checkmark"></span>
                                </label>
                                <a href="{{ route('password.request') }}" class="forget-pass">Забыли пароль?</a>
                            </div>
                        </div>
                        <button type="submit" class="site-btn login-btn">Войти</button>
                    </form>
                    <div class="switch-login">
                        <a href="{{ route('register') }}" class="or-login">Создать аккаунт</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Form Section End -->
@endsection

