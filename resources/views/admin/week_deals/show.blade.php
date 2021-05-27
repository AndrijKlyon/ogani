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
        <li><a href="{{ route('week_deals.index') }}"><i class="fa fa-gift"></i> Предложение недели</a></li>
        <li class="active"> Информация о предложении недели</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!-- | Your Page Content Here |  -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Предложение недели</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>

                                <tr>
                                    <td style="min-width: 250px;">ID товара</td>
                                    <td>{{ $weekdeal->product['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название</td>
                                    <td>{{ $weekdeal->product['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Цена товара</td>
                                    <td> {{ $weekdeal->product['price'] }} {{ config('template_settings.currency') }}</td>
                                </tr>
                                <tr>
                                    <td>Акционная цена товара</td>
                                    <td> {{ $weekdeal->product['special_price'] }} {{ config('template_settings.currency') }}</td>
                                </tr>
                                <tr>
                                    <td>Скидка</td>
                                    <td>{{ $weekdeal->product['price'] - $weekdeal->product['special_price'] }} {{ config('template_settings.currency') }} (- {{ round(($weekdeal->product->price - $weekdeal->product->special_price)/$weekdeal->product->price*100) }}% )</td>
                                </tr>
                                <tr>
                                    <td>Состояние</td>
                                    <td>{{ Carbon\Carbon::now() < $weekdeal['ended_at'] ? 'Акция активна' : 'Акция окончена' }} </td>
                                </tr>

                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $weekdeal['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата окончания акции</td>
                                    <td> {{ Carbon\Carbon::create($weekdeal['ended_at'])->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата обновления</td>
                                    <td> {{ $weekdeal['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('week_deals.index') }}"><i class="fa fa-reply"></i> Вернуться к списку предложений</a>
                </div>
            </div>
        </div>
    </div>
  </section>

 @endsection
