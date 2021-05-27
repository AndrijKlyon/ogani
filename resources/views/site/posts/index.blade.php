@extends('layouts.site')

@section('content')

<!-- Breadcrumb Section Begin -->
    @include('site.parts.breadcrumbs')
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                @include('site.posts.side')
            </div>
            <div class="col-lg-8 col-md-7">
               @include('site.posts.posts_list')
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

@endsection


@section('additional_scripts')
     <script src="{{ asset('js/blog.js') }}"></script>
@endsection
