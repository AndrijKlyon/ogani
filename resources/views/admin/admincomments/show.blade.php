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
        <li class="active"> Просмотр комментария</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Просмотр комментария</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $element['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Автор</td>
                                    <td><a href="{{ route('users.show', ['user' => $element['user']['id']]) }}">{{ $element['user']['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Товар/Новость</td>
                                    <td>
                                        @php
                                            if($element->commentable->getTable() == 'posts')
                                                $items = 'newsposts';
                                            else
                                                $items = 'products';
                                        @endphp
                                        <a href="{{ url( $items.'/'.$element->commentable['alias']) }}" target="_blank">{{ $element->commentable['title'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Родительский комментарий</td>
                                    <td>@if($parent) {{ $parent['user']['name'].' : '.$parent['comment'] }} @endif</td>
                                </tr>
                                <tr>
                                    <td>Текст комментария</td>
                                    <td>{{ $element['comment'] }}</td>
                                </tr>
                                <tr>
                                    <td>Добавлен</td>
                                    <td>{{ $element['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Изменен</td>
                                    <td>{{ $element['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('admincomments.index') }}"><i class="fa fa-reply"></i> Вернуться к списку комментариев</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
