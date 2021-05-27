<section class="hero @if(!isset($mainpage)) hero-normal @endif">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Все категории</span>
                    </div>
                    <ul>
                        @foreach($categories->where('parent_id', 0) as $item)
                            <li><a href="{{ url('categories?filter[category.alias]='.$item->alias) }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 d-flex flex-column">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ url('search') }}" class="advanced-search">
                            @csrf
                            <div class="typeahead__container">
                            <div class="hero__search__categories">
                                <p class="cat_value">Все категории</p>
                                <span class="arrow_carrot-down"></span>
                                <div class="category_hover_menu">
                                    <p class="category-item" data-cat="all">Все категории</p>
                                    @foreach($categories->where('parent_id', 0) as $item)
                                        <p class="category-item" data-alias="{{ $item->alias }}" data-cat="{{ $item->id }}">{{ $item->title }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <input name="query" id="search_input" type="text" placeholder="Поисковый запрос" autocomplete="off">
                            <input name="cat" type="hidden">
                            <button type="submit" class="site-btn">ПОИСК</button>
                            </div>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon d-flex justify-content-center align-items-center">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{ config('template_settings.contacts.phone') }}</h5>
                            <span>{{ config('template_settings.contacts.phone_hours') }}</span>
                        </div>
                    </div>
                </div>

                @if(isset($mainpage) && $weekdeal_product)
                    <div class="hero__item set-bg d-flex flex-column flex-md-row flex-lg-row justify-content-center align-items-center" data-setbg="{{ asset('img/transparent.png') }}">
                        <div class="hero__text">
                            <span>Предложение недели</span>
                            <h2>{{ $weekdeal_product->title }}</h2>
                            <h3>{{ $weekdeal_product->special_price }}  <small style="text-decoration: line-through;"> {{ $weekdeal_product['price'] }}</small> {{ config('template_settings.currency') }}</h3>
                            <p>Скидка {{ round(($weekdeal_product['price'] - $weekdeal_product['special_price'])/$weekdeal_product['price']*100) }} %</p>
                            <a href="{{ route('product', ['alias' => $weekdeal_product->alias]) }}" class="primary-btn">Купить</a>
                        </div>
                        <div class="hero__text d-none d-md-block" >
                            @if($weekdeal_product->images->first()->img != null && Storage::disk('local_public')->exists('img/products/'.$weekdeal_product->images->first()->img))
                                <img src="{{ Croppa::url('img/products/'.$weekdeal_product->images->first()->img, 300, 300 ) }}" alt="{{ $weekdeal_product->title }}">
                            @endif
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

</section>
