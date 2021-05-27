@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        <br>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('aboutrecords.index') }}"><i class="fa fa-info"></i> Записи О магазине</a></li>
        <li class="active"> Редактирование записи</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('aboutrecords.update', ['aboutrecord' => $aboutrecord['id']]) }}" method="post" data-toggle="validator">
                    @csrf
                    @method('PATCH')
                    <div class="box-header with-border">
                        <h3 class="box-title">Запись О магазине "{{ $aboutrecord['title'] }}"</h3>
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
                                    value="{{ old('title') ? old('title') : $aboutrecord['title'] }}">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') ? old('description') : $aboutrecord['description'] }}"
                                    placeholder="Описание">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea
                                    name="text"
                                    id="editor1"
                                    required
                                    data-required-error="Контент обязателен"
                                    cols="80"
                                    rows="10">{{ old('text') ? old('text') : $aboutrecord['text']  }}</textarea>
                        </div>
                        <div class="form-group dropzone-box_single">
                            <label for="img">Изображение</label>
                            <p>
                                Рекомендуемое разрешение изображения - 320 х 320 px. <br>
                                Выберите изображение и нажмите на кнопке "загрузить". Для замены изображения вначале удалите
                                имеющееся изображение, а затем нажмите на кнопке "Добавить файл".
                            </p>
                            @php $img_template = $aboutrecord['img'] == null || $aboutrecord['img'] == '' ? true : false @endphp
                            <div id="loading_button_single" style="display: {{ $img_template ? 'block' : 'none'}};">
                                @include('admin.image_upload.buttons', ['template' => true, 'mode' => 'single' ])
                            </div>
                            @php $filePath = 'img/aboutrecords/'.$aboutrecord['img'] @endphp
                            @if($img_template == false)
                                @include('admin.image_upload.exist_image',
                                        [
                                            'filePath' => $filePath,
                                            'image_name' => $aboutrecord['img']
                                        ])
                            @endif
                            @include('admin.image_upload.template', ['mode' => 'single'])
                            <input type="hidden" name="img" value="{{ old('img') ? old('img') : $aboutrecord['img'] }}"/>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-refresh"></i>
                            Обновить запись
                        </button>
                        <a class="btn btn-warning" href="{{ route('aboutrecords.index') }}"><i class="fa fa-ban"></i> Отмена</a>
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
