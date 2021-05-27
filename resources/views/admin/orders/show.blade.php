@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header position-relative">
    <h1 class="d-fex flex-row">
        <a href="" id="change_orderstatus_link" class="btn btn-sm btn-primary">
            <i class="fa fa-pencil-square-o"></i> Изменить статус заказа
        </a>
        <a href="" id="change_paystatus_link" class="btn btn-sm btn-primary">
            <i class="fa fa-pencil-square-o"></i> Изменить статус оплаты
        </a>
        <button class="delete btn btn-sm btn-danger" element="Заказ № {{ $order['id'] }} ?">
            <i class="fa fa-trash"></i> Удалить
        </button>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('orders.index') }}"><i class="fa fa-shopping-cart"></i> Заказы</a></li>
        <li class="active"> Заказ #{{ $order['id'] }}</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    @php $qty=0;
        foreach($order_products as $product) {
            $qty += $product->qty;
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Заказ #{{ $order['id'] }}</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td>Номер заказа</td>
                                    <td>{{ $order['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Дата заказа</td>
                                    <td>{{ $order['created_at']->format('d/m/Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата изменения</td>
                                    <td>{{ $order['updated_at']->format('d/m/Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>Позиций в заказе</td>
                                    <td> {{ count($order_products) }}</td>
                                </tr>
                                <tr>
                                    <td>Товаров в заказе</td>
                                    <td> {{ $qty }}</td>
                                </tr>
                                <tr>
                                    <td>Сумма заказа</td>
                                    <td>{{ $order['amount'] }} {{ config('template_settings.currency') }}</td>
                                </tr>
                                <tr>
                                    <td>Имя заказчика</td>
                                    <td><a href="{{ route('users.show', ['user' => $order['user']['id'] ]) }}">{{ $order['user']['name'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Статус заказа</td>
                                    <td>{{ $order->status['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Комментарий</td>
                                    <td>{{ $order['note'] }}</td>
                                </tr>
                                <tr>
                                    <td>Способ доставки</td>
                                    <td>{{ $order['shipping_method'] }}</td>
                                </tr>
                                <tr>
                                    <td>Способ оплаты</td>
                                    <td>{{ $order['pay_method'] }}</td>
                                </tr>
                                <tr>
                                    <td>Статус оплаты</td>
                                    <td>{{ $order['pay_status'] == 0 ? 'не оплачен' : 'оплачен' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Товары заказа</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Кол-во</th>
                                    <th>Цена</th>
                                    <th>Всего</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }} ({{ $product->option1 }} | {{ $product->option2 }})</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>{{ $product->price }} {{ config('template_settings.currency') }}</td>
                                        <td>{{ $product->price*$product->qty }} {{ config('template_settings.currency') }}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="2"><b>Итого:</b> </td>
                                        <td><b> {{ $qty }}</b></td>
                                        <td></td>
                                        <td> <b>{{ $order['amount'] }}  {{ config('template_settings.currency') }}</b></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal change order status -->
<div class="modal modal-info fade" id="change_orderstatus_modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="{{ route('orders.update', ['order' => $order['id']]) }}">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Заказ # {{ $order['id'] }}: изменение статуса заказа</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="status_current" class="col-sm-4 control-label">Текущий статус заказа</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled id="status_current" placeholder="{{ $order->status['title'] }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Новый статус заказа</label>
                            <div class="col-sm-8">
                                <select name="orderstatus_new" id="statuses_select" class="form-control">
                                    <option>Загрузка статусов...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- // Modal change order status -->

<!-- Modal change pay status -->
<div class="modal modal-info fade" id="change_paystatus_modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="{{ route('orders.update', ['order' => $order['id']]) }}">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Заказ # {{ $order['id'] }}: изменение статуса оплаты</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="status_current" class="col-sm-4 control-label">Текущий статус оплаты</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled placeholder="{{ $order->paystatus == '0' ? 'Не оплачен' : 'Оплачен' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Новый статус оплаты</label>
                            <div class="col-sm-8">
                                <select name="paystatus_new" class="form-control">
                                    <option value = 'no'>Не оплачен</option>
                                    <option value = 'yes'>Оплачен</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-outline">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- // Modal change pay status -->

@endsection
