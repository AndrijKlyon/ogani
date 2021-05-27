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
        <li><a href="{{ route('options.index') }}"><i class="fa fa-folder"></i> Значения Опции</a></li>
        <li class="active"> Редактирование значения Опции</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ route('options.update', ['option' => $option['id']]) }}" method="post"
                    data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="box-header with-border">
                        <h3 class="box-title">Значение Опции "{{ $option['title'] }}"</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Название значения</label>
                            <input type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    value="{{ old('title') ? old('title') : $option['title'] }}"
                                    required
                                    data-required-error="Название значения обязательно">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="alias">Псевдоним (alias)</label>
                            <input type="text"
                                    name="alias"
                                    class="form-control"
                                    id="alias"
                                    value="{{ old('alias') ? old('alias') : $option['alias'] }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text"
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    value="{{ old('description') ? old('description') : $option['description'] }}">
                        </div>
                        <div class="form-group dropzone-box_single">
                            <label for="img">Изображение</label>
                            <p>
                                Рекомендуемое разрешение изображения - 100 х 100 px. <br>
                                Выберите изображение и нажмите на кнопке "загрузить". Для замены изображения вначале удалите
                                имеющееся изображение, а затем нажмите на кнопке "Добавить файл".
                            </p>
                            @php $img_template = $option['img'] == null || $option['img'] == '' ? true : false @endphp
                            <div id="loading_button_single" style="display: {{ $img_template ? 'block' : 'none'}};">
                                @include('admin.image_upload.buttons', ['template' => true, 'mode' => 'single' ])
                            </div>
                            @php $filePath = 'img/options/'.$option['img'] @endphp
                            @if($img_template == false)
                                @include('admin.image_upload.exist_image',
                                        [
                                            'filePath' => $filePath,
                                            'image_name' => $option['img']
                                        ])
                            @endif
                            @include('admin.image_upload.template', ['mode' => 'single'])
                            <input type="hidden" name="img" value="{{ old('img') ? old('img') : $option['img'] }}"/>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-refresh"></i>
                            Обновить значение
                        </button>
                        <a class="btn btn-warning" href="{{ route('options.index') }}"><i class="fa fa-ban"></i> Отмена</a>
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
