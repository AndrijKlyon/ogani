@if($posts->isNotEmpty())
<div class="row">

    @foreach($posts as $item)
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="blog__item">
                <div class="blog__item__pic">
                    @if($item->img != null && Storage::disk('local_public')->exists('img/posts/'.$item->img))
                        <img class="card-img rounded-0" src="{{ Croppa::url('img/posts/'.$item->img, 400 ) }}" alt="{{ $item->title }}">
                    @else
                        <img src="{{ Croppa::url('img/no-image.png', 400) }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="blog__item__text">
                    <ul>
                        <li><i class="fa fa-calendar-o"></i> {{ $item->created_at->translatedFormat('d M Y') }}</li>
                        <li><i class="fa fa-comment-o"></i> {{ $item->comments->count() }}</li>
                    </ul>
                    <h5><a href="{{ route('post', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h5>
                    <p>{!! $item->intro !!}</p>
                    <a href="{{ route('post', ['alias' => $item->alias]) }}" class="blog__btn">Подробнее <span class="arrow_right"></span></a>
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-lg-12">
        <div class="product__pagination blog__pagination justify-content-start d-flex">
            {{ $posts->links('site.parts.paginate') }}
        </div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-12 py-5">
            <p class="text-center">Посты, удовлетовряющие заданным фильтрам, не найдены.</p>
        </div>
    </div>
@endif
