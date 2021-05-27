<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="register-form">
                    <h2>Мои заказы</h2>
                    @if($orders->isNotEmpty())
                    <table class="table table-striped my-orders">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Дата заказа</th>
                            <th scope="col">Статус заказа</th>
                            <th scope="col">Статус оплаты</th>
                            <th scope="col">Товары в заказе</th>
                            <th scope="col">Общая стоимость</th>
                          </tr>
                        </thead>
                        <tbody>

                          @php $i = count($orders) @endphp
                          @foreach($orders as $item)
                          <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $item->created_at->format('d.m.Y') }}</td>
                            <td>{{ $item->status['title'] }}</td>
                            <td>{{ $item->paystatus == 0 ? 'Не оплачен' : 'Оплачен' }}</td>
                            <td>
                                @php $total_price = 0 @endphp
                                @foreach($item->products as $product)
                                    {{ $product['title'] }}
                                    @if($item['attributes']['option'])
                                        ({{ $item->attributes['option'] }})
                                    @endif
                                    x {{ $product['qty'] }}
                                    @php $total_price += $product['qty']*$product['price'] @endphp
                                @endforeach
                            </td>
                            <td>{{ $total_price }} {{ config('template_settings.currency') }}</td>
                          </tr>
                          @php $i-- @endphp
                          @endforeach

                        </tbody>
                    </table>

                @else
                    <div class="pt-lg-5">
                        <p class="pt-5">Вы пока ничего не заказывали в нашем магазине.</p>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

