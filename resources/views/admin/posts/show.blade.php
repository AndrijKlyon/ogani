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
        <li><a href="{{ route('posts.index') }}"><i class="fa fa-file-text"></i> Посты блога</a></li>
        <li class="active"> Информация о посте</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Пост "{{ $post['title'] }}"</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td style="min-width: 250px;">ID </td>
                                    <td>{{ $post['id'] }}</td>
                                </tr>
                                <tr>
                                    <td>Название </td>
                                    <td>{{ $post['title'] }}</td>
                                </tr>
                                <tr>
                                    <td>Псевдоним</td>
                                    <td>{{ $post['alias'] }}</td>
                                </tr>
                                <tr>
                                    <td>Автор</td>
                                    <td><a href="{{ route('users.show', ['user' => $post->author['id']]) }}"> {{ $post->author['name'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Категория</td>
                                    <td><a href="{{ route('post_categories.show', ['post_category' => $post->category['id']]) }}"> {{ $post->category['title'] }}</a></td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова</td>
                                    <td> {{ $post['keywords'] }}</td>
                                </tr>
                                <tr>
                                    <td>Теги</td>
                                    <td>
                                        @foreach($post->tags as $item)
                                            {{ $item['title'] }}<br>
                                            @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td> {{ $post['description'] }}</td>
                                </tr>
                                <tr>
                                    <td>Контент</td>
                                    <td>
                                        {!! $post->text  !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Изображение</td>
                                    <td>
                                        @if($post->img != null)
                                            @if(Storage::disk('local_public')->exists('img/posts/'.$post->img))
                                                <img style="width: 120px;" src="{{ asset('img/posts/'.$post->img) }}" />
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Опубликовано</td>
                                    <td>{{ $post['status'] == '0' ? 'Нет' : 'Да'  }} </td>
                                </tr>
                                <tr>
                                    <td>Дата создания</td>
                                    <td> {{ $post['created_at']->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Дата обновления</td>
                                    <td> {{ $post['updated_at']->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-sm btn-primary" href="{{ route('posts.index') }}"><i class="fa fa-reply"></i> Вернуться к списку постов</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
