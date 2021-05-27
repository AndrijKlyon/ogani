<div class="">
    <div class="">
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_id') }}
            </div>
        @endif

        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
                <div class="form-group">
                    <label for="message">Enter your name here:</label>
                    <input type="text" class="form-control @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" />
                    @error('guest_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Enter your email here:</label>
                    <input type="email" class="form-control @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" />
                    @error('guest_email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            @if(isset($product))
                @php $user_rating = $product->ratings->where('user_id', Auth::user()->id)->first(); @endphp
                @if(!$user_rating)
                <div class="personal-rating d-flex flex-row justify-align-center align-items-center pb-2">
                    <p class="pr-2">Ваш рейтинг: </p>
                    <div class="rating"></div>
                </div>
                @else
                    <p class="pb-3">Вы уже оценили этот товар.</p>
                @endif

            @endif

            <div class="form-group form-submit">
                <textarea
                    class="form-control @if($errors->has('message')) is-invalid @endif"
                    name="message"
                    rows="3"
                    placeholder="Ваше сообщение"
                    ></textarea>
                <div class="invalid-feedback">
                    Текст сообщения обязателен.
                </div>
                <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> разметка.</small>
            </div>
            <div class="col-md-12 text-right">
                <input type="hidden" id="rating" name="rating" value="">
                <button type="submit" class="primary-btn">Добавить</button>
            </div>
        </form>
    </div>
</div>
<br />
