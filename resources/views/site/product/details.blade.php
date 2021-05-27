<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                @if($product->images && $product->images->isNotEmpty())
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            @if($product->images->first()->img && $product->images->first()->img != null && Storage::disk('local_public')->exists('img/products/'.$product->images->first()->img))
                                <img class="product__details__pic__item--large" src="{{ asset('img/products/'.$product->images->first()->img) }}" alt="{{ $product->title }}">
                            @else
                                <img class="product__details__pic__item--large" src="{{ Croppa::url('img/no-image.png', 550, 550) }}" alt="{{ $product->title }}">
                            @endif
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach($product->images as $item)
                                @if($item->img && $item->img != null && Storage::disk('local_public')->exists('img/products/'.$item->img))
                                    <img data-imgbigurl="{{ url('img/products/'.$item->img) }}"
                                    src="{{ Croppa::url('img/products/'.$item->img, 300, 300) }}" alt="{{ $product->title }}">
                                @else
                                <img data-imgbigurl="{{ Croppa::url('img/no-image.png', 550, 550) }}"
                                    src="{{ Croppa::url('img/no-image.png', 300, 300) }}" alt="{{ $product->title }}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ Croppa::url('img/no-image.png', 550, 550) }}" alt="{{ $product->title }}">
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->title }}</h3>
                    <div class="product__details__rating">
                        @php $i = 0 @endphp
                            @if ($product->aver_rating > 0)
                                @for($i; $i < $product->aver_rating; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            @endif
                            @if($i < 5)
                                @for($i; $i < 5; $i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                            @endif
                            <span>({{ count($product->ratings) }})</span>
                    </div>
                    <div class="product__details__price">
                        @if($product->modifications->count() > 0)
                            @php
                                $price = $product->modifications->first()->modification_price == null ? $product->price : $product->modifications->first()->modification_price;
                                if($price == $product->price && $product->special_price != 0) $price = $product->special_price;
                            @endphp
                        @else
                            @php $price = $product->special_price != 0 ? $product->special_price : $product->price  @endphp
                        @endif
                            <span id="current_price">
                                {{ $price }}
                            </span>
                            @if($product->special_price != 0)
                                <small style="text-decoration:line-through;">
                                    {{ $product->price }}
                                </small>
                            @endif
                            {{ config('template_settings.currency') }}
                    </div>
                        {{ $product->description }}

                    <div class="product__details__option">
                        @if($product->modifications->count()>0)
                            <select class="option-select">
                                @foreach($product->modifications as $item)
                                    @php $option_title = $product->options->where('id', $item->option_id)->first()->title;
                                        $price = $product->special_price == null ? $product->price : $product->special_price;
                                    @endphp
                                    <option data-option="{{ $option_title }}"
                                                data-img="{{ $product->options->where('id', $item->option_id)->first()->img }}"
                                                data-price="{{ $item->modification_price == null ? $price : $item->modification_price }}"
                                                value="{{ $option_title }}">
                                        {{ $option_title }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    @if($product->modifications->count() > 0)
                        <div id="optionImg" data-startimage="{{ $product->options->first()->img }}"
                            data-startprice="{{ $price }}">
                            {{-- <img src="{{ asset('img/options/'. $product->options->first()->img) }}"> --}}
                        </div>
                    @endif
                    </p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="help-block with-errors cart-error pb-2"></div>
                    <a href="{{ route('cart.add', ['product_id' => $product['id']]) }}" data-id="{{ $product->id }}" class="primary-btn add-tocart-link">В корзину</a>
                    <a href="{{ route('wishlist.add', ['product_id' => $product->id ]) }}" data-id="{{ $product->id }}" class="heart-icon add-towish-link"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><b>Наличие</b> <span>Уточняйте</span></li>
                        <li><b>Доставка</b> <span>1-3 дня. <samp></samp></span></li>
                        {{-- <li><b>Weight</b> <span>0.5 kg</span></li> --}}
                        <li><b>Поделиться</b>
                            <div class="share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->getUri() }}&title={{ $product->title }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ request()->getUri() }}&text={{ $product->title }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                {{-- <a href="#" target="_blank"><i class="fa fa-instagram"></i></a> --}}
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ request()->getUri() }}&amp;title={{ $product->title }}&amp;summary={{ $product->description }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Описание</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Характеристики</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Отзывы <span>({{ $product->comments->count() }})</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tabs-1" role="tabpanel">
                            @include('site.product.descriptionTab')
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            @include('site.product.specificationTab')
                        </div>
                        <div class="tab-pane active" id="tabs-3" role="tabpanel">
                            @include('site.product.reviewTab')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
