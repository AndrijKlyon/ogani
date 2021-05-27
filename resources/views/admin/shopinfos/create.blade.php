@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('shopinfos.index') }}"><i class="fa fa-cube"></i> Справочные статьи</a></li>
        <li class="active"> Добавление статьи</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('shopinfos.store') }}" method="post" data-toggle="validator">
                    @csrf
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание справочной статьи</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    placeholder="Название"
                                    required
                                    data-required-error="Название обязательно"
                                    value="{{ old('title') }}">
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
                                    value="{{ old('alias') }}">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
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
                            <label for="text">Контент</label>
                            <textarea name="text"
                                        id="editor1"
                                        required
                                        data-required-error="Контент обязателен"
                                        cols="80"
                                        rows="10">{{ old('text') }}</textarea>
                        </div>
                        <div class="form-group dropzone-box_single">
                            <label for="img">Изображение</label>
                            <p>
                                Рекомендуемое разрешение изображения - 750 х 400 px. <br>
                                Выберите изображение и нажмите на кнопке "загрузить". Для замены изображения вначале удалите
                                имеющееся изображение, а затем нажмите на кнопке "Добавить файл".
                            </p>
                            @php $img_template = old('img') ? false : true @endphp
                            <div id="loading_button_single" style="display: {{ $img_template ? 'block' : 'none'}};">
                                @include('admin.image_upload.buttons', ['template' => true, 'mode' => 'single' ])
                            </div>
                            @php  $filePath = 'img/temp/'.old('img'); @endphp
                            @if($img_template == false && Storage::disk('local_public')->exists($filePath))
                                @include('admin.image_upload.old_image')
                            @endif
                            @include('admin.image_upload.template', ['mode' => 'single'])
                            <input type="hidden" name="img" value="{{ old('img') }}"/>
                        </div>
                        <div type="hidden" name="new_images[]" value="{{ old('new_images[]') }}"></div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status"> Опубликовано
                            </label>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-upload"></i>
                            Создать справочную статью
                        </button>
                        <a class="btn btn-warning" href="{{ route('shopinfos.index') }}"><i class="fa fa-ban"></i> Отмена</a>
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
        var editor = CKEDITOR.replace('editor1', {
        extraPlugins: 'notification'
        });

        CKFinder.setupCKEditor( editor );

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
