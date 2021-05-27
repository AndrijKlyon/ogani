<{!! $config['parent_element'] !!} class="list">
    @foreach($categories as $id => $category_collection)

        {{-- Output only parent categories with id = 0 --}}
        @if($id != 0)
            @break
        @endif
        @include('widgets.admin_treemenu_item', [
            'category_collection' => $category_collection,
        ])

    @endforeach
</{!! $config['parent_element'] !!}>
