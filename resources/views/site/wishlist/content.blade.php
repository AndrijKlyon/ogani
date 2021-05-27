@if(isset($wishlist_products) && $wishlist_products->isNotEmpty())
<div class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table class="js-wish-table">
                        <thead>
                            <tr>
                                <th class="shoping__product">Товары</th>
                                <th>Цена</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist_products as $item)
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

                                <td class="shoping__cart__item__close">
                                    <div class="d-flex flex-row justify-content-center">
                                        <span data-id="{{ $item['id'] }}" class="icon_close px-3"></span>
                                        <i class="fa fa-shopping-cart px-3 mt-1 move-to-cart"
                                        data-id="{{ $item['id'] }}"
                                        data-productid="{{ $item['attributes']['product_id'] }}"
                                        data-option="{{ $item['attributes']['option'] }}"></i>
                                    </div>
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
                    <a href="{{ route('cart.recalculate') }}" id="clearWishList" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Очистить список</a>
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
                <p class="pb-5 text-center">Список пожеланий пуст</p>
            </div>
        </div>
    </div>
</div>
@endif
