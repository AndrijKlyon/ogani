@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a id="delete_all-button" data-model="ratings" href="#" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-star"></i> Рейтинги</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Рейтинги</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><input id="delete-all-items" type="checkbox"></th>
                                    <th>Товар</th>
                                    <th>Пользователь</th>
                                    <th>Рейтинг</th>
                                    <th>Дата выставления</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ratings as $item)
                                    <tr data-id="{{ $item['id'] }}" data-model="Rating">
                                        <td>{{ $item['id'] }}</td>
                                        <td><input class="delete-item-marker" type="checkbox"></td>
                                        <td><a href="{{ route('product', ['alias' =>  $item->product['alias']]) }}" target="_blank">{{ $item->product['title'] }}</a></td>
                                        <td><a href="{{ route('users.show', ['user' => $item->user['id']]) }}">{{ $item->user['name'] }}</a></td>
                                        <td>
                                            {{ $item['rating'] }}
                                            @for($i = 0; $i < $item['rating']; $i++)
                                                <i style="color:#ffd700;" class="fa fa-star rating_star"></i>
                                            @endfor
                                        </td>
                                        <td>{{ $item['created_at']->format('d/m/Y') }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('ratings.destroy', ['rating' => $item['id']]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                    data-toggle="tooltip"
                                                    element="Рейтинг #{{ $item['id'] }} ?"
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
                @if($ratings->hasPages())
                    <div class="box-footer text-center">
                        {{ $ratings->links('admin.paginate-table_items') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
