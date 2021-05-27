@if(!empty($banners))
<div class="banner">
    <div class="container">
        <div class="row d-flex">

            @foreach($banners as $item)
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="hero__item set-bg banner_{{ $loop->iteration }} d-flex flex-column flex-md-row flex-lg-row justify-content-center align-items-center" data-setbg="{{ asset('img/transparent.png') }}">
                        <div class="hero__text d-none d-md-block" >
                            @if($item->banner_type == 'Product')
                                @if($item->images->first()->img != null && Storage::disk('local_public')->exists('img/products/'.$item->images->first()->img))
                                    <img src="{{ Croppa::url('img/products/'.$item->images->first()->img, 300, 300 ) }}" alt="{{ $item->title }}">
                                @endif
                            @else
                                @if($item->img != null && Storage::disk('local_public')->exists('img/posts/'.$item->img))
                                    <img src="{{ Croppa::url('img/posts/'.$item->img, 300, 300 ) }}" alt="{{ $item->title }}">
                                @endif
                            @endif
                        </div>
                        <div class="hero__text">
                            <span>
                                @if($item->banner_type == 'Product')
                                    Выгодно
                                @else
                                    Акция
                                @endif
                            </span>

                            <h2>{{ $item->title }}</h2>

                            @if($item->banner_type == 'Product')
                                <h3>
                                    @if($item->special_price != 0)
                                        {{ $item->special_price }}
                                        <small style="text-decoration:line-through;">
                                            {{ $item->price }}
                                        </small>
                                    @else
                                        {{ $item->price }}
                                    @endif
                                    {{ config('template_settings.currency') }}
                                </h3>
                                <p>
                                    @if($item->special_price != 0)
                                        Скидка {{ round(($item['price'] - $item['special_price'])/$item['price']*100) }} %
                                    @endif
                                </p>
                                <a href="{{ route('product', ['alias' => $item->alias]) }}" class="primary-btn">Купить</a>

                            @else
                                <p>{{ $item->description }}</p>
                                <a href="{{ route('post', ['alias' => $item->alias]) }}" class="primary-btn">Подробнее</a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endif
