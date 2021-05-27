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
        <li><a href="{{ route('subscribers.index') }}"><i class="fa fa-pencil-square"></i> Подписчики</a></li>
        <li class="active"> Создание подписки</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('subscribers.store') }}" method="post"
                    data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание подписки</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email"
                                    name="email"
                                    class="form-control"
                                    id="email" value="{{ old('email') }}"
                                    required
                                    data-required-error="Email">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Создать подписчика</button>
                        <a class="btn btn-warning" href="{{ route('subscribers.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
