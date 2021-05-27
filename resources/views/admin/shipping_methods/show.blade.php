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
        <li><a href="{{ route('shipping_methods.index') }}"><i class="fa fa-truck"></i> Способы доставки</a></li>
        <li class="active"> Просмотр Способа доставки</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Способ доставки "{{ $shipping['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID </td>
                                    <td>{{ $shipping['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название </td>
                                    <td>{{ $shipping['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $shipping['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Цена</td>
                                    <td> {{ $shipping['price'] }} {{ config('template_settings.currency') }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $shipping['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $shipping['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td> {{ $shipping['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('shipping_methods.index') }}"><i class="fa fa-reply"></i> Вернуться к списку способов доставки</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
