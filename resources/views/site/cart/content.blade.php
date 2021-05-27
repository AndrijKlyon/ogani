@if(isset($cart_products) && $cart_products->isNotEmpty())
<div class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table class="js-cart-table">
                        <thead>
                            <tr>
                                <th class="shoping__product">Товары</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Всего</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_products as $item)
                            <tr>
                                <td class="shoping__cart__item">
                                    <a href="{{ route('product', ['alias' => $item['attributes']['alias']]) }}">
                                        @if($item['attributes']['img'] && $item['attributes']['img'] != null && Storage::disk('local_public')->exists('img/products/'.$item['attributes']['img']))
                                            <img style="max-height: 90px;" src="{{ Croppa::url('img/products/'.$item['attributes']['img'], 300, 300) }}" alt="{{ $item['name'] }}"/>
                                        @else
                                            <img style="max-height: 90px;" src="{{ Croppa::url('img/no-image.png', 300, 300) }}" alt="{{ $item['name'] }}">
                                        @endif
                                        <h5>{{ $item['name'] }}
                                        @if($item['attributes']['option'])
                                            ({{ $item['attributes']['option'] }})</h5>
                                        @endif
                                    </a>
                                </td>
                                <td class="shoping__cart__price">
                                    {{ $item['price'] }} {{ config('template_settings.currency') }}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input data-id="{{ $item['id'] }}" type="text" value="{{ $item['quantity'] }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    {{ $item['price']*$item['quantity'] }} {{ config('template_settings.currency') }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span data-id="{{ $item['id'] }}" class="icon_close"></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ route('products') }}" class="primary-btn cart-btn">Продолжить покупки</a>
                    <a href="{{ route('cart.recalculate') }}" id="recalculate" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Обновить корзину</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        {{-- <h5>Купон</h5>
                        <form action="#">
                            <input type="text" placeholder="Введите код">
                            <button type="submit" class="site-btn">Применить купон</button>
                        </form> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Итого</h5>
                    <ul>
                        <li>к оплате <span>{{ $total_sum }} {{ config('template_settings.currency') }}</span></li>
                        {{-- <li>Total <span>$454.98</span></li> --}}
                    </ul>
                    <a href="{{ route('checkout') }}" class="primary-btn">Далее</a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 py-5">
                <p class="pb-5 text-center">Корзина пуста</p>
            </div>
        </div>
    </div>
</div>
@endif
