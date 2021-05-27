<{!! $config['parent_element'] . ' class="' . $config['class'] . '" name="' . $config['name'] . '"' !!}>
    @if($config['prepend'] != '')
        {!! $config['prepend'] !!}
    @endif
    @foreach($categories as $id => $category_collection)

        {{-- Output only parent categories with id = 0 --}}
        @if($id != 0)
            @break
        @endif
        @include('widgets.select_menu_item', [
            'category_collection' => $category_collection,
        ])

    @endforeach
</{!! $config['parent_element'] !!}>
