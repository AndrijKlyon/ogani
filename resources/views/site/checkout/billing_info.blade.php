<div class="row">
    <div class="col-lg-6">
        <div class="checkout__input form-group has-feedback">
            <p>Имя получателя<span>*</span></p>
            <input type="text"
                    class="form-control @error('firstname') is-invalid @enderror"
                    value="{{ Auth::user() ? Auth::user()->firstname : old('firstname') }}"
                    id="firstname"
                    name="firstname"
                    id="firstname"
                    autocomplete="firstname"
                    required
                    data-required-error="Поле обязательно для заполнения">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
            @error('firstname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="checkout__input form-group has-feedback">
            <p>Фамилия получателя<span>*</span></p>
            <input type="text"
                    class="form-control @error('lastname') is-invalid @enderror"
                    name="lastname"
                    value="{{ Auth::user() ? Auth::user()->lastname : old('lastname') }}"
                    required
                    autocomplete="lastname"
                    data-required-error="Поле обязательно для заполнения"
                    id="lastname">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
            @error('lastname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="checkout__input form-group has-feedback">
    <p>Телефон<span>*</span></p>
    <input type="text"
            class="form-control @error('phone') is-invalid @enderror"
            id="phone"
            name="phone"
            autocomplete="phone"
            value="{{ Auth::user() ? Auth::user()->phone : old('phone') }}"
            required
            data-required-error="Поле обязательно для заполнения">
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="checkout__input form-group has-feedback">
    <p>Адрес получателя (отделения почты)<span>*</span></p>
    <input type="text"
            class="form-control @error('address') is-invalid @enderror"
            name="address"
            value="{{ Auth::user() ? Auth::user()->address : old('address') }}"
            autocomplete="address"
            required
            data-required-error="Поле обязательно для заполнения"
            id="address">
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="checkout__input form-group has-feedback">
    <p>Примечание к заказу</p>
    <textarea class="form-control @error('note') is-invalid @enderror"
            name="note"
            id="note"
            rows="4"
            value="">{{ old('note') }}</textarea>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        <div class="help-block with-errors"></div>
        @error('note')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
