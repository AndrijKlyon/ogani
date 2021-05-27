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
        <li><a href="{{ route('brands.index') }}"><i class="fa fa-barcode"></i> Бренды</a></li>
        <li class="active"> Просмотр бренда</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Бренд "{{ $brand['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID бренда</td>
                                    <td>{{ $brand['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название бренда</td>
                                    <td>{{ $brand['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $brand['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова</td>
                                    <td> {{ $brand['keywords'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td>{{ $brand['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Изображение</td>
                                    <td>@if($brand['img'] != null)
                                            <img style="width: 120px;" src="{{ asset('img/brands/'.$brand['img']) }}" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td>{{ $brand['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td> {{ $brand['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('brands.index') }}"><i class="fa fa-reply"></i> Вернуться к списку брендов</a>
                </div>
            </div>
        </div>
    </div>
</section>

 @endsection
