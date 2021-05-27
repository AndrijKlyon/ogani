<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Мой профиль</h2>
                    @if(Session::has('message'))
                        <p class="help-block pb-3">{{ Session::get('message') }}</p>
                    @endif
                    <form data-toggle="validator"
                            action="{{ route('cabinet_profile') }}"
                            method="post"
                            enctype="multipart/form-data">
                        @csrf
                        <div class="group-input form-group has-feedback">
                            <label for="name">Имя пользователя *</label>
                            <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') ? old('name') : $user->name  }}"
                                    required
                                    autocomplete="name"
                                    placeholder="Логин"
                                    data-required-error="Поле обязательно для заполнения">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="firstname">Имя *</label>
                            <input type="text"
                                    class="form-control @error('firstname') is-invalid @enderror"
                                    id="firstname"
                                    name="firstname"
                                    value="{{ old('firstname') ? old('firstname') : $user->firstname  }}"
                                    autocomplete="firstname"
                                    placeholder="Имя">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="lastname">Фамилия *</label>
                            <input type="text"
                                    class="form-control @error('lastname') is-invalid @enderror"
                                    id="lastname"
                                    name="lastname"
                                    value="{{ old('lastname') ? old('lastname') : $user->lastname  }}"
                                    autocomplete="lastname"
                                    placeholder="Фамилия">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="email">Электронная почта *</label>
                            <input type="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email"
                                    value="{{ old('email') ? old('email') : $user->email  }}"
                                    required
                                    autocomplete="email"
                                    placeholder="Электронная почта"
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
                            <label for="password">Пароль *</label>
                            <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    value=""
                                    placeholder="Пароль"
                                    minlength="8"
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
                        <div class="group-input form-group has-feedback">
                            <label for="password_confirmation">Повторите пароль *</label>
                            <input id="password-confirm"
                                    placeholder="Повторите пароль"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                    data-match="#password"
                                    data-match-error="Пароли не свопадают" >
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="address">Адрес</label>
                            <input type="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    name="address"
                                    value="{{ old('address') ? old('address') : $user->address  }}"
                                    autocomplete="address"
                                    placeholder="Адрес">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="phone">Телефон</label>
                            <input type="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') ? old('phone') : $user->phone  }}"
                                    autocomplete="phone"
                                    placeholder="Телефон">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="description">Описание</label>
                            <input type="text"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    value="{{ old('description') ? old('description') : $user->description }}"
                                    autocomplete="description"
                                    placeholder="Описание">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group-input form-group has-feedback">
                            <label for="file">Аватар</label>
                            <input name="file" id="file" type='file' value="" onchange="readURL(this);" />
                            <img id="blah" src="{{ $user->img != null ? $user->img : Croppa::url('img/no-image.png', 70,70) }}" alt="User avatar" />
                            <div id="imgtype_error"></div>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="site-btn register-btn">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->





