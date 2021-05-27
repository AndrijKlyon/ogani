    <p class="pb-4">Вы вошли на сайт как неавторизированный пользователь.
        @if($auth_mode == 'product' || $auth_mode == 'post')
            Чтобы оставлять отзывы и комментарии, необходимо
            <a href="{{ route('login') }}">войти в свой аккаунт</a> или
            <a href="{{ route('register') }}">зарегистрироваться</a>
        @elseif($auth_mode == 'checkout')
            Пожалуйста, войдите в свой аккаунт.
            Если у Вас нет аккаунта на нашем сайте, пожалуйста, пропустите этот шаг и заполните регистрационную информацию ниже.
        @endif
    </p>
    <form class="form-contact comment_form"
            data-toggle="validator"
            action="{{ route('login_modal') }}"
            method="post"
            id="login_modal"
            novalidate="novalidate">
            @csrf
        <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group has-feedback">
                    <input type="text" class="form-control"
                        name="name"
                        id = "modallogin_name"
                        autocomplete = "name"
                        required
                        data-required-error = "Поле обязательно для заполнения"
                        value = "{{ old("name") ? old("name") : '' }}"
                        placeholder="Имя пользователя" />

                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors">
                        <div class="server_error">
                            @if($errors->any())
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

            </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="form-group has-feedback">
            <input type = "password"
                    name="password"
                    class="form-control"
                    id = "modallogin_password"
                    required
                    autocomplete = "password"
                    data-required-error = "Поле обязательно для заполнения"
                    placeholder="Пароль" />
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors">
                    </div>
          </div>
        </div>

        <div class="col-md-12 text-right">
          <button type="submit" value="submit" class="primary-btn">
            Войти
          </button>
        </div>
        </div>
      </form>
