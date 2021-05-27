@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('categories.index') }}"><i class="fa fa-folder"></i> Категории</a></li>
        <li class="active"> Редактирование категории</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('categories.update', ['category' => $category['id']]) }}" method="post"
                    data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-header with-border">
                        <h3 class="box-title">Категория "{{ $category['title'] }}"</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название категории</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    value="{{ old('title') ? old('title') : $category['title'] }}"
                                    required
                                    data-required-error="Название категории обязательно">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="alias">Псевдоним (alias)</label>
                            <input type="text"
                                    name="alias"
                                    class="form-control"
                                    id="alias"
                                    value="{{ old('alias') ? old('alias') : $category['alias'] }}">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Родительская категория</label>
                                @widget('TreeMenu', [
                                    'tpl' => 'select_menu',
                                    'parent_element' => 'select',
                                    'child_element' => 'option',
                                    'class' => 'form-control',
                                    'prepend' => '<option value="0">Родительская категория</option>',
                                    'active_category' => $category['id'],
                                    'parent_category' => $category['parent_id'],
                                    'name' => 'parent_id',
                                    'cache' => false,
                                    ])
                        </div>
                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text"
                                    name="keywords"
                                    class="form-control"
                                    id="keywords"
                                    value="{{ old('keywords') ? old('keywords') : $category['keywords'] }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') ? old('description') : $category['description'] }}">
                        </div>
                        {{-- <div class="form-group">
                            <label>
                                <input type="checkbox" name="hit" @if($category['hit'] == '1') checked @endif> На Главной странице
                            </label>
                        </div> --}}
                        <div class="form-group dropzone-box_single">
                            <label for="img">Изображение</label>
                            <p>
                                Рекомендуемое разрешение изображения - 450 х 450 px.
                                Выберите изображение и нажмите на кнопке "загрузить". Для замены изображения вначале удалите
                                имеющееся изображение, а затем нажмите на кнопке "Добавить файл".
                            </p>
                            @php $img_template = $category['img'] == null || $category['img'] == '' ? true : false @endphp
                            <div id="loading_button_single" style="display: {{ $img_template ? 'block' : 'none'}};">
                                @include('admin.image_upload.buttons', ['template' => true, 'mode' => 'single' ])
                            </div>
                            @php $filePath = 'img/categories/'.$category['img'] @endphp
                            @if($img_template == false && Storage::disk('local_public')->exists($filePath))
                                @include('admin.image_upload.exist_image',
                                            [
                                                'filePath' => $filePath,
                                                'image_name' => $category['img']
                                            ])
                            @endif
                            @include('admin.image_upload.template', ['mode' => 'single'])
                            <input type="hidden" name="img" value="{{ old('img') ? old('img') : $category['img'] }}"/>

                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-refresh"></i>
                            Обновить категорию
                        </button>
                        <a class="btn btn-warning" href="{{ route('categories.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection
