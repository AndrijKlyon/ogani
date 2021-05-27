@extends('admin.mail.folders')

@section('mailbox')
          <!-- /.col -->
          <form class="mailform" action="/admin/mail/send" enctype="multipart/form-data" method="post">
            @csrf
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Новое сообщение</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <input name="to"  class="form-control" placeholder="Кому:" value="{{ ($message != null) ? $message->user_email : '' }}">
                  <input type="hidden" name="user_name" value="{{ ($message != null) ? $message->user_name : '' }}">
                  <input type="hidden" name="id" value="{{ ($message != null) ? $message->id : null }}">
                </div>
                <div class="form-group">
                  <input name="subject" class="form-control" placeholder="Тема:" value="{{ ($message != null) ? $message->subject : '' }}">
                </div>
                <div class="form-group">
                      <textarea name="mailtext" id="compose-textarea" class="form-control" style="height: 300px">
                            @if($message != null)
                                {{ $message->text }}
                            @else
                                <br>
                                <p>С уважением, служба поддержки<br>
                                KA Studio</p>
                                <br>
                            @endif
                      </textarea>
                </div>
                {{-- <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div> --}}
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                    @if($message == null)
                        <button data-button="draft" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> В черновики</button>
                    @endif
                        <button data-button="send" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Отправить</button>
                </div>{
                <a  href="{{ url('/admin/mail/messages?filter[folder]=inbox') }}" type="reset" class="btn btn-default"><i class="fa fa-times"></i> Отмена</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </form>
@endsection
