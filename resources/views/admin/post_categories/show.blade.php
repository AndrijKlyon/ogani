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
        <li><a href="{{ route('post_categories.index') }}"><i class="fa fa-barcode"></i> Категории постов</a></li>
        <li class="active"> Просмотр категории постов</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Категория постов "{{ $category['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $category['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название</td>
                                    <td>{{ $category['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $category['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td>{{ $category['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова</td>
                                    <td> {{ $category['keywords'] }}</td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td>{{ $category['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td>{{ $category['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('post_categories.index') }}"><i class="fa fa-reply"></i> Вернуться к списку категорий</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
