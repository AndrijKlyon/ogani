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
        <li class="active"><i class="fa fa-user"></i> Пользователь {{ $user['name'] }}</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Пользователь {{ $user['name'] }}</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID пользователя</td>
                                    <td>{{ $user['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Имя пользователя</td>
                                    <td>{{ $user['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Имя</td>
                                    <td>{{ $user['firstname'] }}</td>
                                </tr>
                                <tr>
                                    <td>Фамилия</td>
                                    <td>{{ $user['lastname'] }}</td>
                                </tr>
                                <tr>
                                    <td>Роль</td>
                                    <td>{{ $user['role'] }}</td>
                                </tr>
                                <tr>
                                    <td>Дата регистрации</td>
                                    <td>{{ $user['created_at'] }}</td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td>{{ $user['updated_at'] }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $user['email'] }}</td>
                                </tr>
                                <tr>
                                    <td>Адрес</td>
                                    <td>{{ $user['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>Телефон</td>
                                    <td>{{ $user['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td>Аватар</td>
                                    <td>
                                        <img style="width: 100px;" src="{{ $user->img != null ? asset($user->img) : Croppa::url('img/no-image.png', 100, 100) }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Заказы пользователя</h3>
                </div>
                @if(count($user->orders)>0)
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>ID заказа</th>
                                <th>Статус</th>
                                <th>Сумма заказа</th>
                                <th>Дата создания </th>
                                <th>Дата обновления</th>
                                <th>Действия</th>
                            </thead>
                            <tbody>
                                @foreach($user->orders as $order)
                                    <tr>
                                        <td>{{ $order['id'] }}</td>
                                        <td>{{ $order['status']['title'] }}</td>
                                        <td>{{ $order['amount'] }} {{ config('template_settings.currency') }}</td>
                                        <td>{{ $order['created_at']->format('d/m/Y') }}</td>
                                        <td>{{ $order['updated_at']->format('d/m/Y') }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('orders.show', ['order' => $order['id']]) }}">
                                                <i class="fa fa-eye"></i> Просмотреть
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                    <div class="box-body">
                        <div class="text-danger">Пользователь еще ничего не заказывал.</div>
                    </div>
                @endif
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('users.index') }}"><i class="fa fa-reply"></i> Вернуться к списку пользователей</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
