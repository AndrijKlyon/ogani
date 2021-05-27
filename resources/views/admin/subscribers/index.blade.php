@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <a href="{{ route('subscribers.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus"></i> Добавить подписчика
        </a>
        <a id="delete_all-button" data-model="subscribers" href="#" class="btn btn-sm btn-danger disabled">
            <i class="fa fa-trash"></i> Удалить выделенные
        </a>
        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-pencil-square"></i> Главная</a></li>
        <li class="active"><i class="fa fa-pencil-square"></i> Подписчики</li>
    </ol>
</section>
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Подписчики</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><input id="delete-all-items" type="checkbox"></th>
                                    <th>Email</th>
                                    <th>ID пользователя</th>
                                    <th>Текущий статус</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscribers as $item)
                                    <tr  data-id="{{ $item['id'] }}" data-model="Subscriber">
                                        <td>{{ $item['id'] }}</td>
                                        <td><input class="delete-item-marker" type="checkbox"></td>
                                        <td>{{ $item['email'] }}</td>
                                        <td>{{ $item['user_id'] }}</td>
                                        <td>{{ $item['unsubscribed_at'] == null ? 'Подписан' : 'Отписан' }}</td>
                                        <td>{{ $item['updated_at']->format('d/m/Y') }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('subscribers.destroy', ['subscriber'=> $item['id']]) }}" method="POST">
                                                @csrf
                                                @if($item['unsubscribed_at'] != null)
                                                    <a class="btn btn-social-icon btn-vk"
                                                        href="{{ route('subscribers.edit', ['subscriber'=> $item['id']]) }}"
                                                        data-toggle="tooltip"
                                                        title="Подписать"><i class="fa fa-arrow-right"></i>
                                                    </a>
                                                @endif
                                                @if($item['unsubscribed_at'] == null)
                                                    <a class="btn btn-social-icon btn-instagram"
                                                        href="{{ route('subscribers.edit', ['subscriber'=> $item['id']]) }}"
                                                        data-toggle="tooltip"
                                                        title="Отписать"><i class="fa fa-arrow-left"></i>
                                                    </a>
                                                @endif
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                        data-toggle="tooltip"
                                                        element="Подписчик '{{ $item['email'] }}' ?"
                                                        title="Удалить"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if( $subscribers->hasPages())
                    <div class="box-footer text-center">
                        {{ $subscribers->links('admin.paginate-table_items') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
