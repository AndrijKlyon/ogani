<section class="blog-details spad shopinfo">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
              @include('site.post.side')
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    @if($shopinfo->img != null && Storage::disk('local_public')->exists('img/shopinfos/'.$shopinfo->img))
                        <img src="{{ url('img/shopinfos/'.$shopinfo->img ) }}" alt="{{ $shopinfo->title }}">
                    @endif
                    {!! $shopinfo->text !!}
                </div>

            </div>
        </div>
    </div>
</section>
