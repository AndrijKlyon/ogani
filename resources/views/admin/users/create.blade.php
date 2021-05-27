@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Пользователи</a></li>
        <li class="active"><i class="fa fa-user"></i> Новый пользователь</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('users.store') }}" method="post" data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание пользователя</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="name">Имя пользователя</label>
                            <input type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    value="{{ old('name') }}"
                                    required
                                    data-required-error="Имя пользователя обязательно"
                                    placeholder="Введите имя пользователя">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="firstname">Имя</label>
                            <input type="text"
                                    name="firstname"
                                    class="form-control"
                                    id="firstname"
                                    value="{{ old('firstname') }}"
                                    placeholder="Введите адрес">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="lastname">Фамилия</label>
                            <input type="text"
                                    name="lastname"
                                    class="form-control"
                                    id="lastname"
                                    value="{{ old('lastname') }}"
                                    placeholder="Введите адрес">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email"
                                    name="email"
                                    class="form-control"
                                    id="email"
                                    value="{{ old('email') }}"
                                    required
                                    email
                                    data-required-error="Email обязателен"
                                    autocomplete="email"
                                    placeholder="Введите email">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address">Адрес</label>
                            <input type="text"
                                    name="address"
                                    class="form-control"
                                    id="address"
                                    value="{{ old('address') }}"
                                    placeholder="Введите адрес">
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="phone"
                                    name="phone"
                                    class="form-control"
                                    id="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Введите номер телефона">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password"
                                    required
                                    name="password"
                                    class="form-control"
                                    id="password"
                                    value=""
                                    placeholder="Введите пароль"
                                    autocomplete="current-password">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Подтвердите пароль</label>
                            <input type="password"
                                    required
                                    name="password_confirmation"
                                    class="form-control"
                                    id="password_confirmation"
                                    data-match="#password"
                                    data-match-error="Пароли не свопадают"
                                    value=""
                                    placeholder="Подтвердите пароль"
                                    autocomplete="new-password">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value=""
                                    placeholder="Описание"
                                    autocomplete="description">
                        </div>
                        <div class="form-group has-feedback">
                            <label>Роль</label>
                            <select name="role" class="form-control" required>
                                <option value="user" {{ old('role') == 'user' ? 'selected': '' }}>Пользователь</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected': '' }}>Администратор</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Аватар</label>
                            <input name="file"
                                    id="file"
                                    type='file'
                                    value=""
                                    onchange="readURL(this);" ><br>
                                    <img class="p-2 blah" src="{{ Croppa::url('img/no-image.png', 70, 70) }}" alt="User avatar">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Создать пользователя</button>
                        <a class="btn btn-warning" href="{{ route('users.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('additional_scripts')
    <script>
        function readURL(input) {
           if (input.files && input.files[0]) {

               var fileName = input.files[0].name;
               var ext = fileName.split('.').pop();
               var allowed_extensions = ["png", "jpg", "jpeg", "gif", "bmp"];
               console.log(ext);
               if(allowed_extensions.includes(ext)) {
                   var reader = new FileReader();
                   reader.onload = function (e) {
                       var b = document.querySelector(".blah");
                       b.setAttribute('src', e.target.result);
                   };
                   reader.readAsDataURL(input.files[0]);
               }
               else {
                   document.getElementById('imgtype_error').innerHTML = '<div class="help-block with-errors">Аватар должен быть изображением!</div>';
                       setTimeout(function() {
                           document.getElementById('imgtype_error').innerHTML = '<div></div>';
                       }, 2000);
               }
           }
       }
   </script>
@endsection
