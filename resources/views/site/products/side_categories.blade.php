<div class="sidebar__item">
    <h4>Категории</h4>
    <ul class="categories_filter">
        @foreach($categories->where('parent_id', 0) as $item)
            <li>
                <a data-alias="{{ $item->alias }}" class="font-weight-bold"
                    href="{{ url('products?filter[category.alias]='.$item->alias) }}">
                    {{ $item->title }}
                </a>
            </li>
            @foreach($categories->where('parent_id', $item->id) as $child_cat)
                <li class="pl-2">
                    <a href="{{ url('products?filter[category.alias]='.$child_cat->alias) }}"
                        data-alias="{{ $child_cat->alias }}">
                        {{ $child_cat->title }}
                    </a>
                </li>
                @endforeach
            @endforeach
    </ul>
</div>
