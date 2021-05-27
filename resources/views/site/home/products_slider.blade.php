@if($products->isNotEmpty())
<div class="col-lg-4 col-md-6">
    <div class="latest-product__text">
        <h4>{{ $title }}</h4>
            <div class="latest-product__slider owl-carousel">

                @foreach ($products->chunk(3) as $chunk)
                    <div class="latest-prdouct__slider__item">
                        @foreach ($chunk as $item)

                            <a href="{{ route('product', ['alias' => $item->alias] ) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    @if($item->images->first()['img'] !=null && Storage::disk('local_public')->exists('img/products/'.$item->images->first()['img']))
                                        <img src="{{ Croppa::url('img/products/'.$item->images->first()['img'], 300, 300) }}" alt="{{ $item->title }}">
                                    @else
                                        <img src="{{ Croppa::url('img/no-image.png', 300, 300) }}" alt="{{ $item->title }}">
                                    @endif
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $item->title }}</h6>
                                    <span>
                                        @if($item->special_price != 0)
                                            {{ $item->special_price }}
                                            <small style="text-decoration:line-through;">
                                                {{ $item->price }}
                                            </small>
                                        @else
                                            {{ $item->price }}
                                        @endif
                                        {{ config('template_settings.currency') }}
                                    </span>
                                </div>
                            </a>

                        @endforeach
                    </div>
                @endforeach

            </div>
    </div>
</div>
@endif
