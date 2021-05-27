@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Главная
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">

        <!-- small box - orders -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $new_orders_count }}</h3>
                    <p>Заказов</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('orders.index') }}" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- small box - users -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $users_count }}</h3>
                    <p>Пользователей</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- small box - products -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $products_count }}</h3>
                    <p>Товаров</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- small box - categories -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $categories_count }}</h3>
                    <p>Категорий</p>
                </div>
                <div class="icon">
                    <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">Подробнее <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</section>

@endsection
