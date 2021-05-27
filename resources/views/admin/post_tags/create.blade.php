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
        <li><a href="{{ route('post_tags.index') }}"><i class="fa fa-barcode"></i> Теги постов</a></li>
        <li class="active"> Создание тега</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('post_tags.store') }}" method="post"
                    data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание тега новостей</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    value="{{ old('title') }}"
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
                                    value="{{ old('alias') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') }}">
                        </div>
                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text"
                                    name="keywords"
                                    class="form-control"
                                    id="keywords"
                                    value="{{ old('keywords') }}"
                                    placeholder="Ключевые слова">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Создать тег</button>
                        <a class="btn btn-warning" href="{{ route('post_tags.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
