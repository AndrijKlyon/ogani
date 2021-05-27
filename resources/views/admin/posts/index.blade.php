@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Добавить пост
        </a>
        <a id="delete_all-button" data-model="posts" href="#" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-file-text"></i> Посты блога</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Посты</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th><input id="delete-all-items" type="checkbox"></th>
                                        <th>Название</th>
                                        <th>Опубликовано</th>
                                        <th>Дата создания</th>
                                        <th>Дата обновления</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $item)
                                        <tr data-id="{{ $item['id'] }}" data-model="Post">
                                            <td>{{ $item['id'] }}</td>
                                            <td><input class="delete-item-marker" type="checkbox"></td>
                                            <td>{{ $item['title'] }}</td>
                                            <td class="text-center"><input name="status" class="bootstrap-toggle" type="checkbox" @if($item['status']=='1') checked @endif data-toggle="toggle" data-size="small" data-on="Да" data-off="Нет"></td>
                                            <td>{{ $item['created_at']->format('d/m/Y') }}</td>
                                            <td>{{ $item['updated_at']->format('d/m/Y') }}</td>
                                            <td>
                                                <form action="{{ route('posts.destroy', ['post'=> $item['id']]) }}" method="POST">
                                                    @csrf
                                                    <a class="btn btn-social-icon btn-vk"
                                                        href="{{ route('posts.show', ['post'=> $item['id']]) }}"
                                                        data-toggle="tooltip"
                                                        title="Просмотреть"><i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-social-icon btn-instagram"
                                                        href="{{ route('posts.edit', ['post'=> $item['id']]) }}"
                                                        data-toggle="tooltip"
                                                        title="Редактировать"><i class="fa fa-pencil"></i>
                                                    </a>
                                                    @method('DELETE')
                                                    <button class="btn btn-social-icon btn-google delete"
                                                            data-toggle="tooltip"
                                                            element="Пост  '{{ $item['title'] }}' ?"
                                                            title="Удалить"><i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if( $posts->hasPages() )
                        <div class="box-footer text-center">
                            {{ $posts->links('admin.paginate-table_items') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
