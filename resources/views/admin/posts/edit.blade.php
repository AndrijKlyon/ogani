@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('posts.index') }}"><i class="fa fa-file-text"></i> Посты блога</a></li>
        <li class="active"> Редактирование поста</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('posts.update', ['post' => $post['id']]) }}" method="post" data-toggle="validator">
                    @csrf
                    @method('PATCH')
                    <div class="box-header with-border">
                        <h3 class="box-title">Новость "{{ $post['title'] }}"</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    placeholder="Название товара"
                                    required
                                    data-required-error="Название обязательно"
                                    value="{{ old('title') ? old('title') : $post['title'] }}">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="alias">Псевдоним (alias)</label>
                            <input type="text"
                                    name="alias"
                                    class="form-control"
                                    id="alias"
                                    placeholder="Псевдоним"
                                    value="{{ old('alias') ? old('alias') : $post['alias'] }}">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            <select class="form-control"
                                    name="category_id"
                                    data-placeholder="Выберите категорию"
                                    style="width: 100%;"
                                    required
                                    data-required-error="Категория обязательна">
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }} @if($item->id == $post->id) selected @endif">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text"
                                    name="keywords"
                                    class="form-control"
                                    id="keywords"
                                    value="{{ old('keywords') ? old('keywords') : $post['keywords'] }}"
                                    placeholder="Ключевые слова">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') ? old('description') : $post['description'] }}"
                                    placeholder="Описание">
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            <select class="form-control select2-tags" name="tags[]" multiple="multiple" data-placeholder="Выберите теги из списка"
                                    style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) selected @endif>{{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea
                                    name="text"
                                    id="editor1"
                                    cols="80"
                                    required
                                    data-required-error="Контент обязателен"
                                    rows="10">{{ old('text') ? old('text') : $post['text']  }}</textarea>
                        </div>
                        <div class="form-group dropzone-box_single">
                            <label for="img">Изображение</label>
                            <p>
                                Рекомендуемое разрешение изображения - 750 х 500 px. <br>
                                Выберите изображение и нажмите на кнопке "загрузить". Для замены изображения вначале удалите
                                имеющееся изображение, а затем нажмите на кнопке "Добавить файл".
                            </p>
                            @php $img_template = $post['img'] == null || $post['img'] == '' ? true : false @endphp
                            <div id="loading_button_single" style="display: {{ $img_template ? 'block' : 'none'}};">
                                @include('admin.image_upload.buttons', ['template' => true, 'mode' => 'single' ])
                            </div>
                            @php $filePath = 'img/posts/'.$post['img'] @endphp
                            @if($img_template == false)
                                @include('admin.image_upload.exist_image',
                                        [
                                            'filePath' => $filePath,
                                            'image_name' => $post['img']
                                        ])
                            @endif
                            @include('admin.image_upload.template', ['mode' => 'single'])
                            <input type="hidden" name="img" value="{{ old('img') ? old('img') : $post['img'] }}"/>


                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status" @if($post['status'] == '1') checked @endif> Опубликовано
                            </label>
                        </div>

                    </div>
                    <div class="box-footer">
                        <div name="images" value=""></div>
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-refresh"></i>
                            Обновить пост
                        </button>
                        <a class="btn btn-warning" href="{{ route('posts.index') }}"><i class="fa fa-ban"></i> Отмена</a>
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
