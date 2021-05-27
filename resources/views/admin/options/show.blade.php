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
        <li><a href="{{ route('options.index') }}"><i class="fa fa-barcode"></i> Значения опции</a></li>
        <li class="active"> Просмотр значения Опции</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Значение Опции "{{ $option['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID значения</td>
                                    <td>{{ $option['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название значения</td>
                                    <td>{{ $option['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $option['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td>{{ $option['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Изображение</td>
                                    <td>@if($option['img'] != null)
                                            <img style="width: 120px;" src="{{ asset('img/options/'.$option['img']) }}" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td>{{ $option['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td>{{ $option['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('options.index') }}"><i class="fa fa-reply"></i> Вернуться к списку значений</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
