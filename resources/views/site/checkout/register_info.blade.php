<div>
    <h4>Регистрационная информация</h4>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="checkout__input form-group has-feedback">
            <p>Имя пользователя<span>*</span></p>
            <input type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    data-required-error="Поле обязательно для заполнения">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="checkout__input form-group has-feedback">
            <p>Email<span>*</span></p>
            <input type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    data-error="введите корректный email"
                    data-required-error="Поле обязательно для заполнения">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="checkout__input form-group has-feedback">
            <p>Пароль<span>*</span></p>
            <input type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    id="password"
                    value="{{ old('password') }}"
                    required
                    minlength="8"
                    autocomplete="password"
                    data-required-error="Поле обязательно для заполнения"
                    data-minlength-error="Пароль менее 8 символов">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="checkout__input form-group has-feedback">
            <p>Подтвердите пароль<span>*</span></p>
            <input type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    data-match="#password"
                    data-required-error="Поле обязательно для заполнения"
                    data-match-error="Пароли не совпадают">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
