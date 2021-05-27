@extends('layouts.site')

@section('content')

<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
    @include('site.product.details')
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
    @include('site.product.related', ['title' => 'Похожие товары', 'products' => $related_products])
<!-- Related Product Section End -->

<!-- Recently Product Section Begin -->
    @include('site.product.related', ['title' => 'Просмотренные товары', 'products' => $recently_products])
<!-- Recently Product Section End -->
@endsection

@section('additional_scripts')
     <script src="{{ asset('js/products.js') }}"></script>
@endsection
