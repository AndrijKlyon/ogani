@if(isset($cart_products) && $cart_products->isNotEmpty())
<div class="select-items">
    <table>
        <tbody>
            @foreach ($cart_products as $item)
            <tr>
                <td class="si-pic">
                    <a href="{{ route('product', ['alias' => $item['attributes']['alias']]) }}">
                        @if($item['attributes']['img'] && $item['attributes']['img'] != null && Storage::disk('local_public')->exists('img/products/'.$item['attributes']['img']))
                            <img style="max-height: 70px;" src="{{ Croppa::url('img/products/'.$item['attributes']['img'], 300, 300) }}" alt="{{ $item['name'] }}"/>
                        @else
                            <img style="max-height: 70px;" src="{{ Croppa::url('img/no-image.png', 300, 300) }}" alt="{{ $item['name'] }}">
                        @endif
                    </a>
                </td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>{{ $item['price'] }} {{ config('template_settings.currency') }} x  {{ $item['quantity'] }}</p>
                        <h6>{{ $item['name'] }}</h6>
                        @if($item['attributes']['option'])
                            <h6>({{ $item['attributes']['option'] }})</h6>
                        @endif
                    </div>
                </td>
                <td class="si-close">
                    <i class="fa fa-close" data-id="{{ $item['id'] }}"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="select-total">
    <span>всего:</span>
    <h5>{{ $total_sum }} {{ config('template_settings.currency') }}</h5>
</div>
<div class="select-button">
    <a id="clearCart" href="{{route('cart.clear') }}" class="primary-btn view-card">Очистить корзину</a>
    <a href="{{route('cart.view') }}" class="primary-btn checkout-btn">Оформить заказ</a>
</div>

<input name="total_qty" type="hidden" value="{{ $total_quantity }}">
<input name="total_products" type="hidden" value="{{ Cart::getTotalQuantity() }} {{ trans_choice('template.products', Cart::getTotalQuantity()) }}:<span>{{ Cart::getTotal() }} {{ config('template_settings.currency_symbol') }}</span>">

@else
    <p class="text-center">Корзина пуста</p>
@endif
