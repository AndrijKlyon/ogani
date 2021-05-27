<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
              @include('site.post.side')
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    @if($post->img != null && Storage::disk('local_public')->exists('img/posts/'.$post->img))
                        <img src="{{ url('img/posts/'.$post->img ) }}" alt="{{ $post->title }}">
                    @endif
                    {!! $post->text !!}
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img class="mr-3 avatar" src="@if($post->author->img != null) {{ asset($post->author->img) }} @else https://www.gravatar.com/avatar/{{ md5($post->author->email ?? null) }}.jpg?d=mm&s=70 @endif" alt="{{ $post->author->name ?? null }} Avatar">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6>{{ $post->author_name }}</h6>
                                    <span>{{ $post->author->description }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Категория:</span> {{ $post->category->title }}</li>
                                    <li class="tag_list">
                                        <span>Теги:</span>
                                        @foreach($post->tags as $item)
                                            <a href="{{ url('posts?filter[tags.alias]='.$item->alias) }}">{{ $item->title }}</a>
                                            @if($item != $post->tags->last()) , @endif
                                        @endforeach
                                    </li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ request()->getUri() }}&title={{ $post->title }}"><i class="fa fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ request()->getUri() }}&text={{ $post->title }}"><i class="fa fa-twitter"></i></a>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ request()->getUri() }}&amp;title={{ $post->title }}&amp;summary={{ $post->description }}"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <h4 class="blogpost_comments">Комментарии</h4>
                    @comments(['model' => $post, 'perPage' => 4, 'auth_mode' => 'post'])
                </div>
            </div>
        </div>
    </div>
</section>
