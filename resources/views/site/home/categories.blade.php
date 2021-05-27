<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">

                @foreach($categories->where('hit', '1') as $item)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/'.$item->img) }}">
                            <h5><a href="{{ url('products?filter[category.alias]='.$item->alias) }}">{{ $item->title }}</a></h5>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
