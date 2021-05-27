@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Добавить товар
        </a>
        <a id="delete_all-button" data-model="products" href="#" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-cube"></i> Товары</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Товары</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><input id="delete-all-items" type="checkbox"></th>
                                    <th>Название</th>
                                    <th>Категория</th>
                                    <th>Цена</th>
                                    <th>Опубликовано</th>
                                    <th>На Главной</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr data-id="{{ $product['id'] }}" data-model="Product">
                                        <td>{{ $product['id'] }}</td>
                                        <td><input class="delete-item-marker" type="checkbox"></td>
                                        <td>{{ $product['title'] }}</td>
                                        <td>{{ $product['category']['title'] }}</td>
                                        <td>{{ $product['price'] }} {{ config('template_settings.currency') }}</td>
                                        <td class="text-center"><input name="status" class="bootstrap-toggle" type="checkbox" @if($product['status']=='1') checked @endif data-toggle="toggle" data-size="small" data-on="Да" data-off="Нет"></td>
                                        <td class="text-center"><input name="hit" class="bootstrap-toggle" type="checkbox" @if($product['hit'] == '1') checked @endif data-toggle="toggle" data-size="small" data-on="Да" data-off="Нет"></td>
                                        <td>{{ $product['updated_at']->format('d/m/Y') }}</td>
                                        <td>
                                            <form action="{{ route('products.destroy', ['product'=> $product['id']]) }}" method="POST">
                                                @csrf
                                                <a class="btn btn-social-icon btn-vk"
                                                    href="{{ route('products.show', ['product'=> $product['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Просмотреть"><i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-social-icon btn-instagram"
                                                    href="{{ route('products.edit', ['product'=> $product['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Редактировать"><i class="fa fa-pencil"></i>
                                                </a>
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                        data-toggle="tooltip"
                                                        element="Товар  '{{ $product['title'] }}' ?"
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
                @if($products->hasPages() )
                    <div class="box-footer text-center">
                        {{ $products->links('admin.paginate-table_items') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection


