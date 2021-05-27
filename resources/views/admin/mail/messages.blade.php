@extends('admin.mail.folders')

@section('mailbox')
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title folder-title">Текущая папка</h3>

        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="text" class="form-control input-sm" placeholder="Поиск по теме">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <div class="btn-group">
            <button data-button="trash" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-trash-o"></i></button>
            <button data-button="answer" data-mode="reply" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Ответить"><i class="fa fa-reply"></i></button>
            <button data-button="answer" data-mode="share" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Переслать"><i class="fa fa-share"></i></button>
          </div>
          <!-- /.btn-group -->
          <button data-button="reload" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Обновить"><i class="fa fa-refresh"></i></button>
          <div class="pull-right">
                @if($messages->count() > 0)
                @if( $messages->currentPage() == 1 )
                1-{{ $messages->count() }}
                @elseif($messages->currentPage() == $messages->lastPage())
                {{ ($messages->currentPage() - 1) * $messages->perPage()+1 }}-{{ $messages->total() }}
                @else
                {{ ($messages->currentPage() - 1) * $messages->perPage() + 1 }}-{{ $messages->currentPage() * $messages->perPage() }}
                @endif
                /@endif
                {{ $messages->total() }}
            <div class="btn-group">
              <a href="{{ $messages->previousPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
              <a href="{{ $messages->nextPageUrl()}}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
            </div>
            <!-- /.btn-group -->
          </div>
          <!-- /.pull-right -->
        </div>
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>

            @foreach($messages as $message)
            <tr>

                <td><input data-type="message" data-id="{{ $message->id }}" type="checkbox"></td>
              <td class="mailbox-star">
                  <a href="{{ url('/admin/mail/read') }}">
                        @if($message->viewed == 0)
                            <i class="fa fa-star text-yellow"></i>
                        @else
                        <i class="fa fa-star-o text-yellow"></i>
                        @endif
                    </a>
                </td>
                <td class="mailbox-name">
                    @if( $message->user['id'] != null)
                    <a href="{{ url('/admin/users/'.$message->user['id']) }}">
                        {{ $message->user['name'] }}
                    </a>
                    @else
                        {{ $message->user['name'] }}
                    @endif
                </td>
                <td class="mailbox-subject">

                    @if( $message->type == 'inbox' )
                    <a style="color: #000;" href="{{ url('/admin/mail/read/'.$message->id) }}">
                        <b>{{ substr($message->subject, 0, 40) }} @if(strlen($message->subject) > 40){{ '...' }}@endif</b>
                        - {{ substr(strip_tags($message->text), 0, 100) }} @if(strlen(strip_tags($message->text)) > 100){{ '...' }}@endif
                    </a>
                    @elseif( $message->type == 'sent' )
                    <a style="color: #000;" href="{{ url('/admin/mail/reads/'.$message->id) }}">
                        <b>{{ substr($message->subject, 0, 40) }} @if(strlen($message->subject) > 40){{ '...' }}@endif</b>
                        - {{ substr(strip_tags($message->text), 0, 100) }} @if(strlen(strip_tags($message->text)) > 100){{ '...' }}@endif
                    </a>
                    @elseif( $message->type == 'draft' )
                    <a style="color: #000;" href="{{ url('/admin/mail/new/'.$message->id) }}">
                        <b>{{ substr($message->subject, 0, 40) }} @if(strlen($message->subject) > 40){{ '...' }}@endif</b>
                        - {{ substr(strip_tags($message->text), 0, 100) }} @if(strlen(strip_tags($message->text)) > 100){{ '...' }}@endif
                    </a>
                    @endif

                </td>
                <td class="mailbox-attachment"></td>
                <td class="mailbox-date">{{ $message->created_at->diffForHumans() }}</td>

            </tr>
            @endforeach

            </tbody>
          </table>
          <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer no-padding">
        <div class="mailbox-controls">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
          <div class="btn-group">
            <button data-button="trash" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Удалить"><i class="fa fa-trash-o"></i></button>
            <button data-button="answer" data-mode="reply" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ответить"><i class="fa fa-reply"></i></button>
            <button data-button="answer" data-mode="share" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Переслать"><i class="fa fa-share"></i></button>
          </div>
          <!-- /.btn-group -->
          <button data-button="reload" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Обновить"><i class="fa fa-refresh"></i></button>
          <div class="pull-right">
            @if($messages->count() > 0)
            @if( $messages->currentPage() == 1 )
                1-{{ $messages->count() }}
                @elseif($messages->currentPage() == $messages->lastPage())
                {{ ($messages->currentPage() - 1) * $messages->perPage()+1 }}-{{ $messages->total() }}
                @else
                {{ ($messages->currentPage() - 1) * $messages->perPage() + 1 }}-{{ $messages->currentPage() * $messages->perPage() }}
                @endif
                /@endif
                {{ $messages->total() }}
            <div class="btn-group">
                <a href="{{ $messages->previousPageUrl() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                <a href="{{ $messages->nextPageUrl()}}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
            </div>
            <!-- /.btn-group -->
          </div>
          <!-- /.pull-right -->
        </div>
      </div>
    </div>
    <!-- /. box -->
  </div>

  @endsection
