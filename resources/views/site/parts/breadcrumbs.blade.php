<section class="breadcrumb-section set-bg" data-setbg="{{ asset('img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>
                        @if(!empty($product))
                            <h2>{{ $product->title }}</h2>
                        @elseif(!isset($braadcrumb_title))
                            <h2>{{ $breadcrumb_title }}</h2>
                        @endif
                    </h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}">Главная</a>
                        @if(!empty($breadcrumbs_array))
                            @foreach ($breadcrumbs_array as $alias => $title)
                                <a class='breadcrumbs' href='{{ url('products?filter[category.alias]='.$alias) }}'>{{ $title }}</a>
                                @if($title !== last($breadcrumbs_array)) /  @endif
                            @endforeach

                        @elseif(isset($breadcrumb_title))
                            <span>{{ $breadcrumb_title }}</span>
                        @endif

                        @if(!empty($product))
                            <span>{{ $product['title'] }}</span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
