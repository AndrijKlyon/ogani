<section class="blog-details-hero set-bg" data-setbg="{{ asset('img/details-hero.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>{{ $post->title }}</h2>
                    <ul>
                        <li>{{ $post->author_name }}</li>
                        <li>{{ $post->created_at->translatedFormat('d F Y') }}</li>
                        <li>{{ $post->comments->count() }} {{ trans_choice('template.comments', Cart::getTotalQuantity()) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
