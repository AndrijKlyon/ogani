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
        <li><a href="{{ route('order_statuses.index') }}"><i class="fa fa-clock-o"></i> Статусы заказа</a></li>
        <li class="active"> Просмотр Статуса заказа</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статус заказа "{{ $order_status['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $order_status['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название значения</td>
                                    <td>{{ $order_status['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $order_status['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $order_status['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Цветовая индикация</td>
                                    <td style="background-color: {{ $order_status['color'] }}; "> {{ $order_status['color'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('order_statuses.index') }}"><i class="fa fa-reply"></i> Вернуться к списку статусов</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
