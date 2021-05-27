@extends('layouts.site')

@section('content')
<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
    @include('site.checkout.content')
<!-- Checkout Section End -->

@endsection
