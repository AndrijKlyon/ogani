@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Почта
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Почта</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- .col -->
        <div class="row">
            <div class="col-md-3">
              <a href="{{ url('/admin/mail/new') }}" class="btn btn-primary btn-block margin-bottom">Новое сообщение</a>

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Папки</h3>

                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="menu-link"><a href="{{ url('/admin/mail/messages?filter[folder]=inbox') }}"><i class="fa fa-inbox"></i> Входящие
                        @if( $new_messages > 0 )
                            <span class="label label-primary pull-right">{{ $new_messages }}</span></a></li>
                        @endif
                    <li class="menu-link"><a href="{{ url('/admin/mail/messages?filter[folder]=sent') }}"><i class="fa fa-envelope-o"></i> Отправленные</a></li>
                    <li class="menu-link"><a href="{{ url('/admin/mail/messages?filter[folder]=draft') }}"><i class="fa fa-file-text-o"></i> Черновики</a></li>
                    <li class="menu-link"><a href="{{ url('/admin/mail/messages?filter[folder]=trash') }}"><i class="fa fa-trash-o"></i> Корзина</a></li>
                  </ul>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /. box -->
            </div>
        <!-- /.col -->
            @yield('mailbox')
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection

@section('additional_scripts')
    <script src="{{ asset('js/custom_mailbox.js') }}"></script>
@endsection

@section('additional_styles')
    <link rel="stylesheet" href="{{ asset('css/custom_mailbox.css') }}">
@endsection





