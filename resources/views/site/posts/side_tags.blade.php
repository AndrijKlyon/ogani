<div class="blog__sidebar__item">
    <h4>Теги</h4>
    <div class="blog__sidebar__item__tags">

        <a href="{{ route('posts') }}" data-filter="">Все теги</a>

        @foreach($tags as $item)
            <a data-filter="{{ $item->alias }}"
                href="{{ url('posts?filter[tags.alias]='. $item->alias) }}">
                {{ $item->title }}
            </a>
        @endforeach

    </div>
</div>
