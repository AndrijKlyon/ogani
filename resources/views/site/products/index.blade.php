@extends('layouts.site')

@section('content')
<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                   @include('site.products.sidebar')
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    @include('site.products.offer_products')
                </div>
                <div class="filter__item">
                    @include('site.products.products_list')
                </div>
                <div class="product__pagination justify-content-start d-flex">
                    {{ $products->links('site.parts.paginate') }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

@endsection

@section('additional_scripts')
     <script src="{{ asset('js/products.js') }}"></script>
@endsection
