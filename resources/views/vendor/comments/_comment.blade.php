<div class="review_item">

    @inject('markdown', 'Parsedown')
    @php($markdown->setSafeMode(true))

    @if(isset($reply) && $reply === true)
      <div id="comment-{{ $comment->getKey() }}" class="media">
    @else
      <li id="comment-{{ $comment->getKey() }}" class="media">
    @endif

    <div class="d-flex">
        <img class="mr-3 avatar" src="@if($comment->commenter->img != null) {{ asset($comment->commenter->img) }} @else https://www.gravatar.com/avatar/{{ md5($comment->commenter->email ?? $comment->guest_email) }}.jpg?d=mm&s=70 @endif" alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar">
    </div>
        <div class="media-body avatar-text">
            <h5 class="">{{ $comment->commenter->name ?? $comment->guest_name }} <small class="text-date"> ({{ $comment->created_at->translatedFormat('d M Y') }})</small></h5>
            @if(isset($product))
            <div class="at-rating">
                @if($product->ratings->where('user_id', $comment->commenter->id)->first() !=null)
                    @for($i = 0; $i < $product->ratings->where('user_id', $comment->commenter->id)->first()['rating']; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                @else
                    @for($i = 0; $i < 5; $i++)
                        <i class="fa fa-star-o"></i>
                    @endfor
                @endif
            </div>
            @endif

            <p class="at-reply comment-text" style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</p>

        <div class="text-right">
            <div>
                @can('reply-to-comment', $comment)
                    <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">Ответить</button>
                @endcan
                @can('edit-comment', $comment)
                    <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">Редактировать</button>
                @endcan
                @can('delete-comment', $comment)
                    <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="btn btn-sm btn-link text-danger text-uppercase">Удалить</a>
                    <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                @endcan
            </div>

            @can('edit-comment', $comment)
                <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                                @method('PUT')
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Редактирование комментария</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">Редакутируемый комментарий:</label>
                                        <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                        <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> разметка.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">Обновить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            @can('reply-to-comment', $comment)
                <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Ответ на комментарий</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">Ваш ответ на комментарий:</label>
                                        <textarea required class="form-control" name="message" rows="3"></textarea>
                                        <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> разметка.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">Ответить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>

            <br />{{-- Margin bottom --}}

            {{-- Recursion for children --}}
            @if($grouped_comments->has($comment->getKey()))
                @foreach($grouped_comments[$comment->getKey()] as $child)
                    @include('comments::_comment', [
                        'comment' => $child,
                        'reply' => true,
                        'grouped_comments' => $grouped_comments
                    ])
                @endforeach
            @endif

        </div>
    @if(isset($reply) && $reply === true)
      </div>
    @else
      </li>
    @endif

    </div>
