@foreach($category_collection as $category)
    <{!! $config['child_element'] !!} value="{{ $category['id'] }}" @if($category['id'] == $config['parent_category']) selected @endif @if($category['id'] == $config['active_category'])) disabled @endif>
        @php echo $tree; @endphp  {{  $category['title'] }}
    </{!! $config['child_element'] !!}>
    @if(isset($categories[$category['id']]))
    {{-- <{!! $config['child_element'] !!}> --}}
        @include('widgets.select_menu_item', [
            'category_collection' => $categories[$category['id']],
            'tree' => $tree . '&nbsp; -',
        ])
    {{-- </{!! $config['child_element'] !!}> --}}
    @endif
@endforeach
