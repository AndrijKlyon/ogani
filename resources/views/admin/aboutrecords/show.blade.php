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
        <li><a href="{{ route('aboutrecords.index') }}"><i class="fa fa-info"></i> Записи О магазине</a></li>
        <li class="active"> Информация о записи </li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Запись О магазине "{{ $aboutrecord['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td style="min-width: 250px;">ID </td>
                                    <td>{{ $aboutrecord['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название </td>
                                    <td>{{ $aboutrecord['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $aboutrecord['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Контент</td>
                                    <td>
                                        {!! $aboutrecord->text  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Изображение</td>
                                    <td>
                                        @if($aboutrecord->img != null)
                                            <img style="width: 120px;" src="{{ asset('img/aboutrecords/'.$aboutrecord->img) }}" />
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $aboutrecord['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата обновления</td>
                                    <td> {{ $aboutrecord['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('aboutrecords.index') }}"><i class="fa fa-reply"></i> Вернуться к списку записей</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
