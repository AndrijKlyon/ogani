<div class="blog__sidebar__item blog__sidebar__item__cats">
    <h4>Категории блога</h4>
    <ul>
        <li>
            <a href="{{ route('posts') }}" class="d-flex" data-filter="">
                Все категории ({{ $post_count }})
            </a>
        </li>

        @foreach($categories as $item)
            <li>
                <a href="{{ url('posts?filter[category.alias]='. $item->alias) }}"
                    data-filter="{{ $item->alias }}"
                    class="d-flex">
                    {{ $item->title }} ({{ $item->posts_count }})
                </a>
            </li>
       @endforeach

    </ul>
</div>
