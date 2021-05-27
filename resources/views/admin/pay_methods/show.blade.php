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
        <li><a href="{{ route('pay_methods.index') }}"><i class="fa fa-money"></i> Способы оплаты</a></li>
        <li class="active"> Просмотр Способа оплаты</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Способ оплаты "{{ $paymethod['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $paymethod['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название значения</td>
                                    <td>{{ $paymethod['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $paymethod['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $paymethod['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $paymethod['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата обновления</td>
                                    <td> {{ $paymethod['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('pay_methods.index') }}"><i class="fa fa-reply"></i> Вернуться к списку способов оплаты</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
