@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{ route('order_statuses.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Добавить статус
        </a>
        <a id="delete_all-button" data-model="order_statuses" href="#" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-clock-o"></i> Статусы заказа</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Статусы заказа</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><input id="delete-all-items" type="checkbox"></th>
                                    <th>Название</th>
                                    <th>Дата создания</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_statuses as $item)
                                    <tr style="background-color: {{ $item['color'] }};" data-id="{{ $item['id'] }}" data-model="OrderStatus">
                                        <td>{{ $item['id'] }}</td>
                                        <td><input class="delete-item-marker" type="checkbox"></td>
                                        <td>{{ $item['title'] }}</td>
                                        <td>{{ $item['created_at']->format('d/m/Y') }}</td>
                                        <td>{{ $item['updated_at']->format('d/m/Y') }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('order_statuses.destroy', ['order_status'=> $item['id']]) }}" method="POST">
                                                @csrf
                                                <a class="btn btn-social-icon btn-vk"
                                                    href="{{ route('order_statuses.show', ['order_status'=> $item['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Просмотреть"><i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-social-icon btn-instagram"
                                                    href="{{ route('order_statuses.edit', ['order_status'=> $item['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Редактировать"><i class="fa fa-pencil"></i>
                                                </a>
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                        data-toggle="tooltip"
                                                        element="Статус заказа '{{ $item['title'] }}' ?"
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
                @if( $order_statuses->hasPages() )
                    <div class="box-footer text-center">
                        {{ $order_statuses->links('admin.paginate-table_items') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
