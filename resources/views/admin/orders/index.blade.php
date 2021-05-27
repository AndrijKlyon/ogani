@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a id="delete_all-button" data-model="orders" href="{{ route('products.create') }}" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><i class="fa fa-shopping-cart"></i> Заказы</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Заказы</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><input id="delete-all-items" type="checkbox"></th>
                                    <th>Покупатель</th>
                                    <th>Статус заказа</th>
                                    <th>Статус оплаты</th>
                                    <th>Сумма</th>
                                    <th>Способ доставки</th>
                                    <th>Способ оплаты</th>
                                    <th>Дата создания</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr style="background-color: {{ $order->status['color'] }}" data-id="{{ $order['id'] }}" data-model="Order">
                                        <td>{{ $order['id'] }}</td>
                                        <td><input class="delete-item-marker" data-id="$order['id']" type="checkbox"></td>
                                        <td>{{ $order['user']['name'] }}</td>
                                        <td>{{ $order['status']['title'] }}</td>
                                        <td>{{ $order['pay_status'] == '0' ? 'Не оплачен': 'Оплачен' }}</td>
                                        <td>{{ $order['amount'] }} {{ config('template_settings.currency') }}</td>
                                        <td>{{ $order['shipping_method'] }}</td>
                                        <td>{{ $order['pay_method'] }}</td>
                                        <td>{{ $order['created_at']->format('d/m/Y') }}</td>
                                        <td>{{ $order['updated_at']->format('d/m/Y') }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('orders.destroy', ['order' => $order['id']]) }}" method="POST">
                                                @csrf
                                                <a class="btn btn-social-icon btn-vk"
                                                    href="{{ route('orders.show', ['order'=> $order['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Просмотреть"><i class="fa fa-eye"></i>
                                                </a>
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                        data-toggle="tooltip"
                                                        element="Заказ № {{ $order['id'] }} ?"
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
                @if($orders->hasPages() )
                    <div class="box-footer text-center">
                        {{ $orders->links('admin.paginate-table_items') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
