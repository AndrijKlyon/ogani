@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-cube"></i> Товары</a></li>
        <li class="active"> Добавление товара</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('products.store') }}" method="post" data-toggle="validator">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание товара</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название товара</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    placeholder="Название товара"
                                    required
                                    data-required-error="Название товара обязательно"
                                    value="{{ old('title') }}">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="alias">Псевдоним товара (alias)</label>
                            <input type="text"
                                    name="alias"
                                    class="form-control"
                                    id="alias"
                                    placeholder="Псевдоним товара"
                                    value="{{ old('alias') }}">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                                @widget('TreeMenu', [
                                    'tpl' => 'select_menu',
                                    'parent_element' => 'select',
                                    'child_element' => 'option',
                                    'class' => 'form-control',
                                    'name' => 'category_id',
                                    // 'parent_category' => $product['category_id'],

                                    ])
                        </div>
                        <div class="form-group">
                            <label for="brand_id">Бренд</label>
                            <select class="form-control" name="brand_id">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand['id'] }}">{{ $brand['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text"
                                    name="keywords"
                                    class="form-control"
                                    id="keywords"
                                    value="{{ old('keywords') }}"
                                    placeholder="Ключевые слова">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') }}"
                                    placeholder="Описание">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="price">Цена товара</label>
                            <input type="text"
                                    name="price"
                                    class="form-control"
                                    id="price"
                                    placeholder="Цена товара"
                                    required
                                    data-required-error="Цена товара обязательна"
                                    pattern="^[0-9,]{1,}$"
                                    value="{{ old('price') }}"
                                    data-pattern-error="Допускаются только цифры и запятая">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="special_price">Акционная цена товара</label>
                            <input type="text"
                                    name="special_price"
                                    class="form-control"
                                    id="special_price"
                                    placeholder="Акционная цена товара"
                                    pattern="^[0-9,]{1,}$"
                                    value="{{ old('special_price') }}"
                                    data-pattern-error="Допускаются только цифры и запятая">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="content"
                                        id="editor1"
                                        required
                                        cols="80" rows="10">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="related">Похожие товары</label>
                            <select name="related[]" class="form-control select2-products" multiple="multiple" data-placeholder="Введите название товара..."
                                id="related" style="width: 100%;">
                            </select>
                        </div>
                        <div class="form-group dropzone-box_multi">
                            <label for="img">Изображения товара</label>
                            <p>
                                Изображения, отображаемые на странице товара.
                                Рекомендуемое разрешение изображений товара - 550 х 550 px. Рекомендуемое
                                количество изображений - 3.<br>
                                Вначале выберите изображение, нажав на кнопке "Добавить файл". Далее, для загрузки
                                выбранного изображения на сервер, нажмите на кнопке "Загрузить". <br>
                                Чтобы удалить изображение, нажмите на кнопке "Удалить".
                            </p>
                            @include('admin.image_upload.buttons', ['template' => true, 'mode' => 'multi'])
                            @include('admin.image_upload.template', ['mode' => 'multi'])
                        </div>
                        <div type="hidden" name="new_images[]" value="{{ old('new_images[]') }}"></div>
                        <div class="form-group">
                            <label for="specifications">Характеристики</label>
                            <div>
                                <button type="button" class="btn btn-success" id="specifications_add">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Добавить характеристику...</span>
                                </button>
                                <button type="button" class="btn btn-danger" id="delete_allspecifications" >
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Удалить все</span>
                                </button>
                            </div>
                            <div id="specifications">
                                {{-- Specifications template --}}
                                    @include('admin.products.specification_template')
                                {{-- / Specifications template --}}
                                <div class="added_specifications"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modifications">Модификации товара</label>
                            <p>Обратите внимание: цена, указанная для модификации товара, имеет больший приоритет по сравнению
                                с основной и акционной ценами.
                            </p>
                            <div>
                                <button type="button" class="btn btn-success" id="modifications_add">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Добавить модификацию...</span>
                                </button>
                                <button type="button" class="btn btn-danger" id="delete_allmodifications" >
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Удалить все</span>
                                </button>
                            </div>
                            <div id="modifications">
                                {{-- Modifications template --}}
                                @include('admin.products.modification_template')
                                {{-- / Modifications template --}}
                                <div class="added_modifications"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status"> Опубликовано
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="hit"> На Главной странице
                            </label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div name="images" value=""></div>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-upload"></i>
                            Сохранить товар
                        </button>
                        <a class="btn btn-warning" href="{{ route('products.index') }}"><i class="fa fa-ban"></i> Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('ckfinder::setup')

@endsection

@section('additional_scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        var editor =  CKEDITOR.replace('editor1', {
        extraPlugins: 'notification'
        });

        CKFinder.setupCKEditor(editor);

        CKEDITOR.on( 'dialogDefinition', function( ev ) {
            // Take the dialog name and its definition from the event data
            var dialogName = ev.data.name;
            var dialogDefinition = ev.data.definition;
            if ( dialogName == 'image' || dialogName == 'link' ) {
            // Remove upload tab
            dialogDefinition.removeContents('Upload');
            }
        });

        editor.on('required', function(evt) {
        editor.showNotification( 'Контент обязателен', 'warning' );
        evt.cancel();
        });

    });
    </script>

@endsection
