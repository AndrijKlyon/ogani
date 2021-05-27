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
        <li class="active"> Очистка кэша</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Очистка кэша</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>Название </th>
                            <th>Описание</th>
                            <th>Действие</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Кэш категорий магазина</td>
                                <td>Кэширование категорий магазина на сайте. </td>
                                <td><a class="btn btn-primary" href="{{ route('admin.cache_clear', ['keys' => array('categories')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Кэш брендов</td>
                                <td>Кэширование брендов на сайте. </td>
                                <td><a class="btn btn-primary" href="{{ route('admin.cache_clear', ['keys' => array('brands')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Кэш справочных постов</td>
                                <td>Кэширование справочных постов на сайте. </td>
                                <td><a class="btn btn-primary" href="{{ route('admin.cache_clear', ['keys' => array('shopinfo')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Кэш меню</td>
                                <td>Кэширование меню на сайте.</td>
                                <td><a class="btn btn-primary" href="{{ route('admin.cache_clear', ['keys' => array('menu')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Кэш футер меню</td>
                                <td>Кэширование футер меню на сайте.</td>
                                <td><a class="btn btn-primary" href="{{ route('admin.cache_clear', ['keys' => array('footer_menu')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Папка временных изображений</td>
                                <td>Папка со временными изображениями.</td>
                                <td><a class="btn btn-primary" href="{{ route('admin.tempfolder_delete', ['folders' => array('temp')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Папка миниатюр изображений</td>
                                <td>Папка с миниатюрами изображений (thumbs).</td>
                                <td><a class="btn btn-primary" href="{{ route('admin.tempfolder_delete', ['folders' => array('thumbs')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Весь кэш</td>
                                <td>Полная очистка кэша.</td>
                                <td><a class="btn btn-warning" href="{{ route('admin.cache_clear', ['keys' => array('categories', 'brands', 'shopinfo', 'menu', 'footer_menu')]) }}">Очистить</a></td>
                            </tr>
                            <tr>
                                <td>Все временные изображения</td>
                                <td>Очистка всех папок с временными изображениями.</td>
                                <td><a class="btn btn-warning" href="{{ route('admin.tempfolder_delete', ['folders' => array('temp','thumbs')]) }}">Очистить</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
