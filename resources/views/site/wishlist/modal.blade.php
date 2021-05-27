@if(isset($wishlist_products) && $wishlist_products->isNotEmpty())
    <div class="select-items">
        <table>
            <tbody>
                @php $i=0 @endphp
                @foreach ($wishlist_products as $item)
                <tr>
                    <td class="si-pic">
                        <a href="{{ route('product', ['alias' => $item['attributes']['alias']]) }}">
                            @if($item['attributes']['img'] && $item['attributes']['img'] != null && Storage::disk('local_public')->exists('img/products/'.$item['attributes']['img']))
                                <img style="max-height: 70px;" src="{{ asset('img/products/'.$item['attributes']['img']) }}" alt="{{ $item['name'] }}"/>
                            @else
                                <img style="max-height: 70px;" src="{{ asset('img/products/no-image.png') }}" alt="{{ $item['name'] }}">
                            @endif
                        </a>
                    </td>
                    <td class="si-text">
                        <div class="product-selected">
                            <p>{{ $item['price'] }} {{ config('template_settings.currency') }}</p>
                        <h6>{{ $item['name'] }}</h6>
                        @if($item['attributes']['option'])
                            <h6>({{ $item['attributes']['option'] }})</h6>
                        @endif
                        </div>
                    </td>
                    <td class="si-close d-flex flex-column justify-content-center align-items-center">
                        <i class="fa fa-close pb-2" data-id="{{ $item['id'] }}"></i>
                        <i class="fa fa-shopping-cart move-to-cart"
                            data-id="{{ $item['id'] }}"
                            data-productid="{{ $item['attributes']['product_id'] }}"
                            data-option="{{ $item['attributes']['option'] }}"
                            ></i>
                    </td>
                </tr>
                @php $i++ @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="select-total">
        <span>Товаров в списке:</span>
        <h5>{{ $i}}</h5>
    </div>
    <div class="select-button">
        <a id="clearWishList" href="{{route('wishlist.clear') }}" class="primary-btn view-card">Очистить список </a>
        <a href="{{ route('wishlist.view') }}" class="primary-btn checkout-btn">Перейти в список</a>
    </div>

    <input name="total_qty" type="hidden" value="{{ $i }}">

@else
    <p class="text-center">Список пожеланий пуст</p>
@endif
