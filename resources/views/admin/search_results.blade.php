@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a id="delete_all-button" data-model="products" href="#" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-search"></i> Результаты поиска</li>
        </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Результаты поиска по запросу "{{ $search_query }}"</h3>
                </div>
                <div class="box-body">
                    @if(isset($products) && $products->isNotEmpty())
                        @php $i = 1 @endphp
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                              <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>ID</th>
                                        <th><input id="delete-all-items" type="checkbox"></th>
                                        <th>Название товара</th>
                                        <th>Категория</th>
                                        <th>Дата создания</th>
                                        <th>Действия</th>
                                    </tr>
                                @foreach($products as $product)
                                    <tr data-id="{{ $product['id'] }}" data-model="products">
                                        <td>{{ $i }}</td>
                                        <td><input class="delete-item-marker" type="checkbox"></td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>
                                            {{ $product->category['title'] }}
                                        </td>
                                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
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
                                                        element="Товар '{{ $product['title'] }}' ?"
                                                        title="Удалить"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($products->hasPages())
                            <div class="box-footer text-center">
                                {{ $products->links('admin.paginate-table_items') }}
                            </div>
                        @endif
                    @else
                        <h5>По данному запросу ничего не найдено.</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
