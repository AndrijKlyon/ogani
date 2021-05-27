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
        <li><a href="{{ route('shopinfos.index') }}"><i class="fa fa-file-text"></i> Справочные статьи</a></li>
        <li class="active"> Информация о справочной статье</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Справочная статья "{{ $shopinfo['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td style="min-width: 250px;">ID </td>
                                    <td>{{ $shopinfo['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название </td>
                                    <td>{{ $shopinfo['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $shopinfo['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Автор</td>
                                    <td><a href="{{ route('users.show', ['user' => $shopinfo->author['id']]) }}"> {{ $shopinfo->author['name'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова</td>
                                    <td> {{ $shopinfo['keywords'] }}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $shopinfo['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Контент</td>
                                    <td>
                                        {!! $shopinfo->text  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Изображение</td>
                                    <td>
                                        @if($shopinfo->img != null)
                                            @if(Storage::disk('local_public')->exists('img/shopinfos/'.$shopinfo->img))
                                                <img style="width: 120px;" src="{{ asset('img/shopinfos/'.$shopinfo->img) }}" />
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Опубликовано</td>
                                    <td>{{ $shopinfo['status'] == '0' ? 'Нет' : 'Да'  }} </td>
                                </tr>

                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $shopinfo['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата обновления</td>
                                    <td> {{ $shopinfo['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('shopinfos.index') }}"><i class="fa fa-reply"></i> Вернуться к списку статей</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
