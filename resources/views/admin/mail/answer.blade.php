@extends('admin.mail.folders')

@section('mailbox')
          <!-- /.col -->
          <form class="mailform" action="/admin/mail/send" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Ответить на сообщение</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                    @if($mode == 'reply')
                    <div class="form-group has-feedback">
                        <input class="form-control"
                                placeholder=""
                                value="Кому: {{ $message->user_name }} ({{ $message->user_email }})"
                                disabled>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                        <input type="hidden" name="to" value="{{ $message->user_email }}">
                        <input type="hidden" name="user_name" value="{{ $message->user_name }}">
                    @elseif($mode == 'share')
                        <input class="form-control"
                                name="to"
                                placeholder="Кому: "
                                value="">
                        <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    @endif
                </div>
                <div class="form-group">
                    @if( $mode == 'reply' )
                        <input class="form-control"
                                placeholder=""
                                value="Тема: Re:{{ $message->subject }}"
                                disabled>
                    @elseif( $mode == 'share' )
                        <input class="form-control"
                                placeholder=""
                                value="Пересылаемое сообщение: {{ $message->subject }}">
                    @endif
                    <input type="hidden" name="subject" value="Re:{{ $message->subject }}">
                </div>
                <div class="form-group">
                      <textarea name="mailtext" id="compose-textarea" class="form-control" style="height: 300px">
                        @if( $mode == 'reply' )
                            <br>
                            <p>С уважением, служба поддержки<br>
                            Winter</p>
                        @elseif( $mode == 'share' )
                            <p>Пересылаемое сообщение</p>
                        @endif
                            --------------------------------
                            <br>{{ $message->folder == 'sent' ? 'Кому:' : 'От:' }}

                            {{ $message->user_name }} ({{ $message->user_email }})<br/>
                            Тема: {{ $message->subject }}<br>
                            Сообщение: {{ $message->text }}
                      </textarea>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <button data-button="draft" type="button" class="btn btn-default"><i class="fa fa-pencil"></i> В черновики</button>
                  <button data-button="send" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Отправить</button>
                </div>
                <a type="reset" href="{{ url('/admin/mail/messages?filter[folder]=inbox') }}" class="btn btn-default"><i class="fa fa-times"></i> Отмена</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
          </form>
@endsection
