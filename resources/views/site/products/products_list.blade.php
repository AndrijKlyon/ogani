<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="filter__sort">
            <span>Сортировка</span>
            <select class="sort-select">
                <option value="sort=id">по умолчанию</option>
                <option value="sort=title">название</option>
                <option value="sort=price">цена: возраст</option>
                <option value="sort=-price">цена: убыв</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="filter__found">
            <h6><span>{{ $products->total() }}</span> товаров найдено</h6>
        </div>
    </div>
    <div class="col-lg-4 col-md-3">
        <div class="filter__sort ">
            <span>На странице</span>
            <select class="perpage-select">
                <option value="6">6 товаров</option>
                <option value="9">9 товаров</option>
                <option value="12">12 товаров</option>
            </select>
        </div>
    </div>
</div>

@if($products && $products->isNotEmpty())
    <div class="row">
        @foreach($products as $item)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    @if($item->images->first()['img'] !=null && Storage::disk('local_public')->exists('img/products/'.$item->images->first()['img']))
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('img/products/'.$item->images->first()['img']) }}">
                    @else
                        <div class="product__item__pic set-bg" data-setbg="{{ Croppa::url('img/no-image.png', 300, 300) }}">
                    @endif
                        <ul class="product__item__pic__hover">
                            <li><a href="{{ route('product', ['alias' => $item->alias] ) }}"><i class="fa fa-eye"></i></a></li>
                            <li><a href="{{ route('wishlist.add', ['product_id' => $item->id] ) }}" class="add-towish-link" data-id="{{ $item->id }}"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('cart.add', ['product_id' => $item->id] ) }}" class="add-tocart-link" data-id="{{ $item->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{ route('product', ['alias' => $item->alias] ) }}">{{ $item->title }}</a></h6>
                        <h5>
                            @if($item->special_price != 0)
                                    {{ $item->special_price }}
                                    <small style="text-decoration:line-through;">
                                        {{ $item->price }}
                                    </small>
                                @else
                                    {{ $item->price }}
                                @endif
                                {{ config('template_settings.currency') }}
                        </h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@else
    <div class="row pt-4">
        <div class="col pt-4 text-center">
            Товары, удовлетворяющие запросу, не найдены.
        </div>
    </div>
@endif
