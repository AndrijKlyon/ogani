@if($featured_products->isNotEmpty())
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Избранные продукты</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Все</li>
                        @foreach($featured_products->unique('parent_category') as $item)
                                <li class="control" data-filter=".{{ $item['parent_category_alias'] }}">{{ $item['parent_category'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @foreach($featured_products as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $item['parent_category_alias'] }}">
                    <div class="featured__item">
                        @if($item->images->first()['img'] !=null && Storage::disk('local_public')->exists('img/products/'.$item->images->first()['img']))
                            <div class="featured__item__pic set-bg" data-setbg="{{ asset('img/products/'.$item->images->first()['img']) }}">
                        @else
                            <div class="featured__item__pic set-bg" data-setbg="{{ Croppa::url('img/no-image.png', 300, 300) }}">
                        @endif
                            <ul class="featured__item__pic__hover">
                                <li><a href="{{ route('product', ['alias' => $item->alias] ) }}"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{ route('wishlist.add', ['product_id' => $item->id] ) }}" class="add-towish-link" data-id="{{ $item->id }}"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{ route('cart.add', ['product_id' => $item->id] ) }}" class="add-tocart-link" data-id="{{ $item->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
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
    </div>
</section>
@endif
