@if($post->related->count() > 1)
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Похожие посты</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($post->related->where('id', '!=', $post->id) as $item)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        @if($item->img != null && Storage::disk('local_public')->exists('img/posts/'.$item->img))
                            <img src="{{ Croppa::url('img/posts/'.$item->img, 400, 300) }}" alt="{{ $item->title }}">
                        @else
                            <img src="{{ Croppa::url('img/no-image.png', 400, 300) }}" alt="{{ $item->title }}">
                        @endif
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> {{ $item->created_at->translatedFormat('d M Y') }}</li>
                            <li><i class="fa fa-comment-o"></i> {{ $item->comments->count() }}</li>
                        </ul>
                        <h5><a href="#">{{ $item->title }}</a></h5>
                        {!! $item->intro !!}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
