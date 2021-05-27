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
        <li class="active"><i class="fa fa-comment"></i> Комментарии</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Комментарии</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><input id="delete-all-items" type="checkbox"></th>
                                    <th>Новый</th>
                                    <th>Автор</th>
                                    <th>Товар/Новость</th>
                                    {{-- <th>ID родителя</th> --}}
                                    <th>Комментарий </th>
                                    <th>Добавлен </th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($elements as $item)
                                    <tr data-id="{{ $item['id'] }}" data-model="comment">
                                        @php
                                            if($item->commentable->getTable() == 'posts')
                                                $items = 'newsposts';
                                            else
                                                $items = 'products';
                                        @endphp
                                        <td>{{ $item['id'] }}</td>
                                        <td><input class="delete-item-marker" type="checkbox"></td>
                                        <td class="text-center"><input name="viewed" class="bootstrap-toggle" type="checkbox" @if($item['viewed']=='0') checked @endif data-toggle="toggle" data-size="small" data-on="Да" data-off="Нет"></td>
                                        <td><a href="{{ route('users.show', ['user' => $item->user['id']]) }}">{{ $item->user['name'] }}</a></td>
                                        <td><a href="{{ url( $items.'/'.$item->commentable['alias']) }}" target="_blank">{{ $item->commentable['title'] }}</a></td>
                                        <td>{{ mb_strimwidth($item['comment'], 0, 30, "...") }}</td>
                                        <td>{{ $item['created_at']->format('d/m/Y') }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('admincomments.update', ['admincomment' => $item['id']]) }}" method="POST">
                                                @csrf
                                                <a class="btn btn-social-icon btn-vk"
                                                    href="{{ route('admincomments.show', ['admincomment'=> $item['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Просмотреть"><i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-social-icon btn-instagram"
                                                    href="{{ route('admincomments.edit', ['admincomment'=> $item['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Редактировать"><i class="fa fa-pencil"></i>
                                                </a>
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                    data-toggle="tooltip"
                                                    element="Комментарий #{{ $item['id'] }} ?"
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
                @if( $elements->hasPages() )
                    <div class="box-footer text-center">
                        {{ $elements->links('admin.paginate-table_items') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
