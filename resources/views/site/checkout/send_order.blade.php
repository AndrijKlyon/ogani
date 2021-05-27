@extends('layouts.site')

@section('content')

<!-- breadcrumb start-->
@include('site.parts.breadcrumbs')
<!-- breadcrumb start-->

@if(Session::has('message'))
@php Session::forget('message'); @endphp
    <!--================ confirmation part start =================-->
  <section class="confirmation_part padding_top p-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle pt-4">
            <span>Спасибо за заказ! В ближайшее время с Вами свяжется наш менеджер для уточнения Вашего заказа.</span>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>Информация о заказе</h4>
            <ul>
              <li>
                <p>Номер заказа</p><span>: {{ $order->id }} / {{ $order->user_id }}</span>
              </li>
              <li>
                <p>Дата заказа</p><span>: {{ $order->created_at->format('d-m-Y \ H:i:s') }}</span>
              </li>
              <li>
                <p>Общая сумма заказа</p><span>: {{ $order['amount'] }} {{ config('template_settings.currency') }}</span>
              </li>
              <li>
                <p>Способ оплаты</p><span>: {{ $order['pay_method'] }}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>Доставка</h4>
            <ul>
                <li>
                    <p>Способ доставки</p><span>: {{ $data['shipping_method'] }}</span>
                </li>
                <li>
                    <p>Адрес доставки</p><span>: {{ $data['address'] }}</span>
                </li>
                <li>
                    <p>Получатель</p><span>: {{ $data['firstname'] }} {{ $data['lastname'] }}</span>
                </li>
                <li>
                    <p>Телефон получателя</p><span>: {{ $data['phone'] }} </span>
                </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="order_details_iner">
            <h3>Детали заказа</h3>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Товар</th>
                  <th scope="col">Количество</th>
                  <th scope="col">Сумма</th>
                </tr>
              </thead>
              <tbody>

                @foreach($order_products as $item)
                    <tr>
                        <th colspan="2"><span>{{ $item->name }}
                            @if($item['attributes']['option'])
                                ({{ $item->attributes['option'] }})
                            @endif
                            </span>
                        </th>
                        <th>X{{ $item->quantity }}</th>
                        <th> <span> {{ $item->price*$item->quantity }} {{ config('template_settings.currency') }}</span></th>
                    </tr>
                @endforeach

                <tr>
                    <th colspan="3">Всего</th>
                        <th> <span>{{ $order['amount'] }} {{ config('template_settings.currency') }}</span></th>
                    </tr>
                <tr>
                    <th colspan="3">Доставка</th>
                    <th><span> {{ $shipping->price }} {{ config('template_settings.currency') }} {{ $shipping->title }}</span></th>
                </tr>

              </tbody>
              <tfoot>
                <tr>
                  <th scope="col" colspan="3">Итого</th>
                  <th scope="col">{{ $order['amount'] + $shipping->price }} {{ config('template_settings.currency') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ confirmation part end =================-->
@else
    <section class="padding_top">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-lg-12 text-center">
                    <p class="pb-5">Корзина пуста</p>
                </div>
            </div>
        </div>
    </section>

@endif

@endsection
