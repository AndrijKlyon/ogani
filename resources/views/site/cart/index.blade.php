@extends('layouts.site')

@section('content')
<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
    @include('site.cart.content')
<!-- Shoping Cart Section End -->

@endsection
