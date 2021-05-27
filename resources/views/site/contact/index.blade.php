@extends('layouts.site')

@section('content')
<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
    @include('site.contact.contact_info')
<!-- Contact Section End -->

<!-- Map Begin -->
    @include('site.contact.map')
<!-- Map End -->

<!-- Contact Form Begin -->
    @include('site.contact.contact_form')
<!-- Contact Form End -->
@endsection
