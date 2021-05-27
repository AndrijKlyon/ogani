<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Напишите нам</h2>
                    <div>
                        @if(Session::has('message'))
                            <div class="with-success p-2">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('contact') }}" method="post" data-toggle="validator">
            @csrf
            <div class="row">
                @guest
                    <div class="col-lg-6 col-md-6 form-group has-feedback">
                        <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                id="name"
                                required
                                data-required-error="Поле обязательно для заполнения"
                                autocomplete="name"
                                value="{{ old('name') }}"
                                placeholder="Ваше имя">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-6 form-group has-feedback">
                        <input  type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                autocomplete="email"
                                required
                                data-required-error="Поле обязательно для заполнения"
                                data-error="Введите корректный email"
                                value="{{ old('email') }}"
                                placeholder="Email">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endguest
                <div class="col-lg-12 text-center form-group has-feedback">
                    <textarea placeholder="Сообщение"
                            class="form-control @error('text') is-invalid @enderror"
                            name="text"
                            id="text"
                            cols="30"
                            rows="9"
                            required
                            data-required-error="Поле обязательно для заполнения"
                    >{{ old('text') }}</textarea>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="col-lg-12 text-center">
                    <button type="submit" class="site-btn">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>
