@extends('admin.mail.folders')

@section('mailbox')
<div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Просмотр сообщения</h3>

        <div class="box-tools pull-right">
          <a href="{{ url('/admin/mail/prev?current='.$message->id) }}" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
          <a href="{{ url('/admin/mail/next?current='.$message->id) }}" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="mailbox-read-info">
            <h3>{{ $message->subject }}</h3>
          <h5>От:
              {{ $message->user_email }}
            <span class="mailbox-read-time pull-right">{{ $message->created_at->format( 'd M Y, h:i' ) }}</span>
          </h5>
        </div>
        <!-- /.mailbox-read-info -->
        <div class="mailbox-controls with-border text-center">
          <div class="btn-group">

            <a href="{{ url('/admin/mail/delete/'.$message->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Удалить">
              <i class="fa fa-trash-o"></i></a>

            <a href="{{ url('/admin/mail/answer?mode=reply&id='.$message->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Ответить">
              <i class="fa fa-reply"></i></a>

            <a href="{{ url('/admin/mail/answer?mode=share&id='.$message->id) }}" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Переслать">
              <i class="fa fa-share"></i></a>
          </div>
          <!-- /.btn-group -->
          <button data-button="print" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Печать">
            <i class="fa fa-print"></i></button>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
          {!! $message->text !!}
        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.box-body -->

      <!-- /.box-footer -->
      <div class="box-footer">
        <div class="pull-right">
            <a href="{{ url('/admin/mail/answer?mode=reply&id='.$message->id) }}" type="button" class="btn btn-default"><i class="fa fa-reply"></i> Ответить</a>
            <a href="{{ url('/admin/mail/answer?mode=share&id='.$message->id) }}" type="button" class="btn btn-default"><i class="fa fa-share"></i> Переслать</a>
        </div>
        <a href="{{ url('/admin/mail/delete/'.$message->id) }}" type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Удалить</a>
        <button data-button="print" type="button" class="btn btn-default"><i class="fa fa-print"></i> Печать</button>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /. box -->
  </div>

@endsection
