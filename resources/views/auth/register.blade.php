@extends('layouts.site')

@section('content')

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Регистрация</h2>
                        <form data-toggle="validator" action="{{ route('register') }}" method="post" >
                            @csrf
                            <div class="group-input form-group has-feedback">
                                <label for="username">Имя пользователя *</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    required
                                    autocomplete="name"
                                    autofocus
                                    data-required-error="Поле обязательно для заполнения"
                                    value="{{ old('name') }}">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="group-input form-group has-feedback">
                                <label for="email">Электронная почта *</label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    data-required-error="Поле обязательно для заполнения">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                    @error('email')
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
                                    value="{{ old('password') }}"
                                    required
                                    autocomplete="password"
                                    minlength="8"
                                    data-required-error="Поле обязательно для заполнения"
                                    data-minlength-error="Пароль менее 8 символов">
                                    <div class="help-block">Минимум 8 символов</div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Повторите пароль *</label>
                                <input type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    data-match="#password"
                                    data-match-error="Пароли не свопадают"
                                    id="password_confirmation">
                                    <div class="help-block with-errors"></div>
                            </div>
                            <button type="submit" class="site-btn register-btn">Создать аккаунт</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{ route('login') }}" class="or-login">Войти</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
@endsection

