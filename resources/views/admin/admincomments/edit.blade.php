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
        <li><a href="{{ route('admincomments.index') }}"><i class="fa fa-comment"></i> Комментарии</a></li>
        <li class="active"> Редактирование комментария </li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('admincomments.update', ['admincomment' => $element['id']]) }}" method="post"
                    data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-header with-border">
                        <h3 class="box-title">Комментарий #{{ $element['id'] }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="comment">Контент</label>
                            <textarea name="comment"
                                        required
                                        data-required-error="Контент обязателен"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Введите комментарий ...">{{ $element['comment'] ? $element['comment'] : old('comment') }}</textarea>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-refresh"></i>
                            Обновить
                        </button>
                        <a class="btn btn-warning" href="{{ route('admincomments.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection


