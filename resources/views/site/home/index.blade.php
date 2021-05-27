@extends('layouts.site')

@section('content')

<!-- Categories Section Begin -->
    @include('site.home.categories')
<!-- Categories Section End -->

<!-- Featured Section Begin -->
    @include('site.home.featured_products')
<!-- Featured Section End -->

<!-- Banner Begin -->
    @include('site.home.banners')
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            @include('site.home.products_slider', ['title' => 'Новые товары', 'products' => $latest_products])
            @include('site.home.products_slider', ['title' => 'Товары со скидкой', 'products' => $offer_products])
            @include('site.home.products_slider', ['title' => 'Популярные товары', 'products' => $popular_products])
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
    @include('site.home.latest_posts')
<!-- Blog Section End -->

@endsection
