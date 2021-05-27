@if($posts->isNotEmpty())
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Блог</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($posts as $item)
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
                            <h5><a href="{{ route('post', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h5>
                            <p>{!! $item->intro !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endif
