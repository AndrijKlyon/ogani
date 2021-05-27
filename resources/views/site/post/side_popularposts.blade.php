<div class="blog__sidebar__item">
    <h4>Популярные посты</h4>
    <div class="blog__sidebar__recent">

        @foreach($popular_posts as $item)
            <a href="{{ route('post', ['alias' => $item->alias]) }}" class="blog__sidebar__recent__item">
                <div class="blog__sidebar__recent__item__pic">
                    @if($item->img != null && Storage::disk('local_public')->exists('img/posts/'.$item->img))
                        <img src="{{ Croppa::url('img/posts/'.$item->img, 70, 70) }}" alt="{{ $item->title }}">
                    @else
                        <img src="{{ Croppa::url('img/no-image.png', 70, 70) }}" alt="{{ $item->title }}">
                    @endif
                </div>
                <div class="blog__sidebar__recent__item__text">
                    <h6>{{ $item->title }}</h6>
                    <span>{{ $item->created_at->translatedFormat('d M Y') }}</span>
                </div>
            </a>
        @endforeach

    </div>
</div>
