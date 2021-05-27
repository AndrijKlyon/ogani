@if($offer_products && $offer_products->isNotEmpty())
<div class="section-title product__discount__title">
    <h2>Товары со скидкой</h2>
</div>
<div class="row">
    <div class="product__discount__slider owl-carousel">

        @foreach($offer_products as $item)
            <div class="col-lg-4">
                <div class="product__discount__item">
                    @if($item->images->first()['img'] !=null && Storage::disk('local_public')->exists('img/products/'.$item->images->first()['img']))
                            <div class="product__discount__item__pic set-bg" data-setbg="{{ asset('img/products/'.$item->images->first()['img']) }}">
                        @else
                            <div class="product__discount__item__pic set-bg" data-setbg="{{ Croppa::url('img/no-image.png', 300, 300) }}">
                        @endif
                        <div class="product__discount__percent">-{{ round(($item['price'] - $item['special_price'])/$item['price']*100) }}%</div>
                        <ul class="product__item__pic__hover">
                            <li><a href="{{ route('product', ['alias' => $item->alias] ) }}"><i class="fa fa-eye"></i></a></li>
                            <li><a href="{{ route('wishlist.add', ['product_id' => $item->id] ) }}" class="add-towish-link" data-id="{{ $item->id }}"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('cart.add', ['product_id' => $item->id] ) }}" class="add-tocart-link" data-id="{{ $item->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__discount__item__text">
                        <span>{{ $item->category->title }}</span>
                        <h5><a href="{{ route('product', ['alias' => $item->alias] ) }}">{{ $item->title }}</a></h5>
                        <div class="product__item__price">
                            @if($item->special_price != 0)
                                {{ $item->special_price }}
                                <small style="text-decoration:line-through;">
                                    {{ $item->price }}
                                </small>
                            @else
                                {{ $item->price }}
                            @endif
                            {{ config('template_settings.currency') }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endif
