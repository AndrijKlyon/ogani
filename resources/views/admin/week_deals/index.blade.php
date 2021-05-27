@extends('layouts.admin')

 @section('content')


 <!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>
        <br>
        @if($weekdeals->count() == 0)
            <a href="{{ route('week_deals.create') }}" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i> Добавить
            </a>
        @endif
        <small> </small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li class="active"><i class="fa fa-gift"></i> Предложение недели</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!-- | Your Page Content Here |  -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Предложение недели</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Акционный товар</th>
                                        <th>Дата создания</th>
                                        <th>Дата окончания акции</th>
                                        <th>Состояние</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($weekdeals as $item)
                                        <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item->product['title'] }}</td>
                                        <td>{{ $item['created_at']->format('d/m/Y') }}</td>
                                        <td>{{ Carbon\Carbon::create($item['ended_at'])->format('d/m/Y') }}</td>
                                        <td>{{ Carbon\Carbon::now() < $item['ended_at'] ? 'Акция активна' : 'Акция окончена' }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('week_deals.destroy', ['week_deal'=> $item['id']]) }}" method="POST">
                                                @csrf
                                                <a class="btn btn-social-icon btn-vk"
                                                    href="{{ route('week_deals.show', ['week_deal'=> $item['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Просмотреть"><i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-social-icon btn-instagram"
                                                    href="{{ route('week_deals.edit', ['week_deal'=> $item['id']]) }}"
                                                    data-toggle="tooltip"
                                                    title="Редактировать"><i class="fa fa-pencil"></i>
                                                </a>
                                                @method('DELETE')
                                                <button class="btn btn-social-icon btn-google delete"
                                                        data-toggle="tooltip"
                                                        element="Предложение недели '{{ $item['id'] }}' ?"
                                                        title="Удалить"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $weekdeals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

  </section>

  @endsection
