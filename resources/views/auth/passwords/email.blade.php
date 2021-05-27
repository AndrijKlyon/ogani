@extends('layouts.site', ['meta' => ['title' => config('template_settings.site.title') . ' - Восстановление пароля']])

@section('content')
<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs', ['breadcrumb_title' => 'Восстановление пароля'])
<!-- Breadcrumb Form Section Begin -->

<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Сброс пароля</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form data-toggle="validator"  method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="group-input form-group has-feedback">
                            <label for="pass">Email *</label>
                            <input
                                id="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <div class="help-block with-errors"></div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button type="submit" class="site-btn login-btn">Отправить ссылку</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
