@foreach($category_collection as $category)

@if(isset($categories[$category['id']]))
    <{!! $config['child_element'] !!} class="sub-menu container">
    {{-- Parent category: 1 level --}}
    <br>
    <div class="row">
    <div class="col-sm-4">
    <a
        href="{{ route('categories.edit', ['category'=> $category['id']]) }}"
        class=" d-flex justify-content-between
        @if($config['current_category'] == $category['alias']) active_category @endif"
        data-group="{{ $category['alias'] }}"
    >
    {{ $category['title'] }}
    </a>
    </div>
    <div class="col-sm-8">
        <form action="{{ route('categories.destroy', ['category' => $category['id']]) }}" method="POST">
            @csrf
            <a class="btn btn-social-icon btn-vk"
                href="{{ route('categories.show', ['category'=> $category['id']]) }}"
                data-toggle="tooltip"
                style="margin: 2px;"
                title="Просмотреть"><i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-social-icon btn-instagram"
                href="{{ route('categories.edit', ['category'=> $category['id']]) }}"
                data-toggle="tooltip"
                style="margin: 2px;"
                title="Редактировать"><i class="fa fa-pencil"></i>
            </a>
            @method('DELETE')
            <button class="btn btn-social-icon btn-google delete"
                    data-toggle="tooltip"
                    element="Категория '{{ $category['title'] }}' ?"
                    style="margin: 2px;"
                    title="Удалить"><i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
    </div>
    <{!! $config['parent_element'] !!}>
        @include('widgets.admin_treemenu_item', [
            'category_collection' => $categories[$category['id']],
        ])
    </{!! $config['parent_element'] !!}>
@else
    <{!! $config['child_element'] !!} class="container">
    {{-- Child category: 2 level --}}
    <div class="row">
        <div class="col-sm-4">
            <a href="{{ route('categories.edit', ['category'=> $category['id']]) }}"
            @if($config['current_category'] == $category['alias']) class="active_category" @endif>
            {{ $category['title'] }}
            </a>
        </div>
        <div class="col-sm-8">

            <form action="{{ route('categories.destroy', ['category' => $category['id']]) }}" method="POST">
                @csrf
                <a class="btn btn-social-icon btn-vk"
                href="{{ route('categories.show', ['category'=> $category['id']]) }}"
                data-toggle="tooltip"
                style="margin: 2px;"
                title="Просмотреть"><i class="fa fa-eye"></i>
            </a>
            <a class="btn btn-social-icon btn-instagram"
                href="{{ route('categories.edit', ['category'=> $category['id']]) }}"
                data-toggle="tooltip"
                style="margin: 2px;"
                title="Редактировать"><i class="fa fa-pencil"></i>
            </a>
            @method('DELETE')
            <button class="btn btn-social-icon btn-google delete"
                    data-toggle="tooltip"
                    element="Категория '{{ $category['title'] }}' ?"
                    style="margin: 2px;"
                    title="Удалить"><i class="fa fa-trash"></i>
            </button>
            </form>
        </div>
    </div>
@endif
</{!! $config['child_element'] !!}>
@endforeach
