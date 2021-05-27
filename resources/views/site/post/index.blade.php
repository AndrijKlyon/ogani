@extends('layouts.site')

@section('content')

<!-- Blog Details Hero Begin -->
    @include('site.post.hero')
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
    @include('site.post.content')
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
    @include('site.post.related')
<!-- Related Blog Section End -->

@endsection

@section('additional_scripts')
     <script src="{{ asset('js/blog.js') }}"></script>
@endsection
