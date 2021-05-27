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
        <li class="active"> Редактирование Способа доставки</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('shipping_methods.update', ['shipping_method' => $shipping['id']]) }}" method="post"
                    data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-header with-border">
                        <h3 class="box-title">Способ доставки {{ $shipping['title'] }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    value="{{ old('title') ? old('title') : $shipping['title'] }}"
                                    required
                                    data-required-error="Название значения обязательно">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="alias">Псевдоним (alias)</label>
                            <input type="text"
                                    name="alias"
                                    class="form-control"
                                    id="alias"
                                    value="{{ old('alias') ? old('alias') : $shipping['alias'] }}">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="price">Цена</label>
                            <input type="text"
                                    name="price"
                                    class="form-control"
                                    id="price"
                                    placeholder="Цена доставки"
                                    required
                                    data-required-error="Цена доставки обязательна"
                                    pattern="^[0-9,]{1,}$"
                                    value="{{ old('price') ? old('price') : $shipping['price'] }}"
                                    data-pattern-error="Допускаются только цифры и запятая">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') ? old('description') : $shipping['description'] }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-refresh"></i>
                            Обновить способ доставки
                        </button>
                        <a class="btn btn-warning" href="{{ route('shipping_methods.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
